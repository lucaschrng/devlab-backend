<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function AlbumsLike() {
        return $this->hasMany(AlbumsLike::class);
    }
    
    public function ALbumInvite(){
        return $this->hasMany(AlbumInvite::class);
    }
}
