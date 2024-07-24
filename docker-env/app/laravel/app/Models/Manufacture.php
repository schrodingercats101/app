<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    use HasFactory;

    public function kind()
    {
        return $this->hasMany(Kind::class);
    }
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
