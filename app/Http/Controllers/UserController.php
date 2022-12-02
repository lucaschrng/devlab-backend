<?php

namespace App\Http\Controllers;

///use http\Client\Curl\User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function createUser()
    {
        //verify the info
        $validator = Validator::make(request()->all(), [
            'username' => ['required', 'max:255'],
            'email' => ['email', 'required', 'max:255'],
            'firstName' => ['required', 'max:255'],
            'lastName' => ['required', 'max:255'],
            'password' => ['required', 'max:255', 'min:7']
        ]);



        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data =request()->all();

        $user =new \App\Models\User();




        $user->username=$data["username"];
        $user->email=$data["email"];
        $user->firstName=$data["firstName"];
        $user->lastName=$data["lastName"];
        $user->password=md5($data["password"]);


        $user->save();

        //auth()->login($user);

        return redirect('/');


    }


    public function authenticate( Request $request)
    {
        $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
        ]);
        dump($credentials);
        $user = \App\Models\User::find($credentials);
        dump($user);



        //return redirect('/');




    }



}
