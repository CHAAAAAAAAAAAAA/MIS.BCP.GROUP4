<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminLoginRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        // Check email/password first
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        $admin->otp = $otp;
        $admin->otp_expires_at = Carbon::now()->addMinutes(5);
        $admin->save();

        // Send OTP email
        Mail::to($admin->email)->send(new \App\Mail\SendOtpMail($otp));

        // Redirect to OTP verification page
        return redirect()->route('admin.otp.verify')->with('email', $admin->email);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showOtpForm()
    {
        return view('admin.auth.otp'); // create this Blade
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $admin = Admin::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$admin) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        if (Carbon::now()->gt($admin->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP expired']);
        }

        // Log in admin
        Auth::guard('admin')->login($admin);

        // Clear OTP
        $admin->otp = null;
        $admin->otp_expires_at = null;
        $admin->save();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard', false));
    }
}
