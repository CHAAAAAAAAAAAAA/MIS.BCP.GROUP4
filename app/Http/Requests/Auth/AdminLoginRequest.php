<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\Admin;

class AdminLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // OTP is optional, only used in OTP verification step
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['sometimes', 'string'], 
            'otp' => ['sometimes', 'digits:6'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials or OTP.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // If OTP is provided, validate it
        if ($this->filled('otp')) {
            $admin = Admin::where('email', $this->email)
                        ->where('otp', $this->otp)
                        ->first();

            if (!$admin) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'otp' => 'Invalid OTP.',
                ]);
            }

            if (Carbon::now()->gt($admin->otp_expires_at)) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'otp' => 'OTP has expired.',
                ]);
            }

            // Login admin and clear OTP
            Auth::guard('admin')->login($admin);
            $admin->otp = null;
            $admin->otp_expires_at = null;
            $admin->save();

        } else {
            // Normal email/password login
            if (! Auth::guard('admin')->attempt($this->only('email', 'password'), $this->boolean('remember'))) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed'),
                ]);
            }
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}