<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumsLike extends Model
{
    use HasFactory;

    public function album() {
        return $this->belongsTo(Album::class);
    }
}
