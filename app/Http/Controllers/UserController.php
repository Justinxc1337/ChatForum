<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email',
            'password' => 'required|min:6|max:50'
        ]);
        return 'thanks you new user';
    }
}
