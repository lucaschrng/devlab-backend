<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    function  create($data){

        $this->username=$data["username"];
        $this->email=$data["email"];
        $this->firstName=$data["firstName"];
        $this->lastName=$data["lastName"];
        $this->password=md5($data["password"]);


        $this->save();
    }
}
