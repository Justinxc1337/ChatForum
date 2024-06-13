<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);


        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return redirect('/');
    }
    

    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required|max:20', Rule::unique('users', 'name'),
            'email' => 'required|email', Rule::unique('users', 'email'),
            'password' => 'required|min:6|max:50'
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    }

    public function resetInfo(Request $request) {
        $user = Auth::user();

        $validatedData = $request->validate([
            'newName' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($user->id)],
            'newEmail' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'newPassword' => 'required|string|min:6|confirmed',
        ]);

        $user->name = $validatedData['newName'];
        $user->email = $validatedData['newEmail'];
        $user->password = Hash::make($validatedData['newPassword']);
        $user->save();

        return redirect()->back()->with('status', 'Information updated successfully!');
    }

    public function showProfile() {
        if (auth()->check()) {
            $user = auth()->user();
            $posts = $user->userPosts();
            return view('profile', compact('posts'));
        } else {
            return redirect('/login')->with('alert', 'You must be logged in to view the profile.');
        }
    }
}

