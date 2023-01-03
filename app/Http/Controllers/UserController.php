<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($username)
    {
        $user = \App\Models\User::where('username', $username)->get()[0];
        return view('user', [
            'user' => $user,
        ]);
    }
}
