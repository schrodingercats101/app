<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacture_id',
        'type',
        'name',
    ];

    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class);
    }
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
