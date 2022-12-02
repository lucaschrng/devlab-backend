<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function createUser(){
        //verify the info
        $data=request()->validate([
            'username'=>'required|max:255',
            'email'=>'email|required|max:255',
            'firstName'=>'required|max:255',
            'lastName'=>'required|max:255',
            'password'=>'required|max:255|min:7'

        ]);

if($date!)
        //$data =request()->all();

       // $user =new \App\Models\User();
        User::create($data);

        return redirect('/');


    }

}
