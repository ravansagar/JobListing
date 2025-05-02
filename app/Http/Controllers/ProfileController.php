<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User;

class ProfileController extends Controller
{
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
        // dd($request->all());
        // $request->user()->fill($request->validated());

        $validated = $request->validate([
            'name' => ['required','min:3'],
            'email'=> ['required','email'],
            'company_name'=> ['required','min:3'],
            'company_location' => ['required','min:3'],
        ]);

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();
        // dd(Auth::user());
        $updated = User::where('name', $validated['name'])->update($validated);
        // dd(Auth::user()->id);
        // $updated = user()->update($validated);
        // dd($updated);
        $updated ? session()->flash('success', 'Profile edited successfully!') : session()->flash('failiure', 'Failed to updated profile!');
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        // dd($request->all());

        // dump(Auth::user()->password);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            session()->flash('failiure', 'Current password do not match!');
            return Redirect::route('profile.edit');
        }
        
        // dd(Auth::user()->password == Hash::make($request->password));
        $validated = $request->validate([
            'password'=> ['required','min:8'],
        ]);

        $updated = Auth::user()->update([
            'password'=> Hash::make($validated['password']),
        ]);

        $updated ? session()->flash('success', 'Profile edited successfully!') : session()->flash('failiure', 'Failed to updated profile!');

        return Redirect::route('profile.edit');

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
