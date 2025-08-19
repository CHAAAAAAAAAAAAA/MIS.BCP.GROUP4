<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{   

    public function editAdmin(Request $request): View
    {
        $admin = $request->user(); // Get the authenticated admin

        if (!$admin) {
            abort(404, 'Admin not found or not logged in.');
        }

        return view('profile.adminedit', [
            'admin' => $admin,
        ]);
    }

    public function updateAdmin(ProfileUpdateRequest $request): RedirectResponse
    {
        $admin = $request->user();

        $admin->fill($request->validated());

        if ($admin->isDirty('email')) {
            $admin->email_verified_at = null; // Reset email verification if email changes
        }

        $admin->save();

        return redirect()->route('profile.adminedit')->with('status', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'string'], // Check if the user has entered their current password
            'password' => ['required', 'string', 'confirmed', Password::defaults()], // Use Laravel's Password::defaults() for new password rules
        ]);

        $admin = $request->user();
        $admin->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profile.adminedit')->with('status', 'Password changed successfully!');
    }


    public function deleteAdmin(Request $request): RedirectResponse
    {
        // Validate that the password field is filled
        $request->validate([
            'password' => ['required', 'string'], // Validate the password field
        ]);

        $admin = $request->user();

        // Check if the provided password matches the admin's current password
        if (!Hash::check($request->password, $admin->password)) {
            return redirect()->route('profile.adminedit')->withErrors([
                'password' => 'The provided password does not match your current password.',
            ]);
        }

        // Log the admin out before deleting the account
        Auth::guard('admin')->logout();

        // Delete the admin account
        $admin->delete();

        // Invalidate the session and regenerate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Your account has been deleted successfully.');
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
