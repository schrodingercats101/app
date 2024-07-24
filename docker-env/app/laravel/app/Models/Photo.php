<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Photo extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'manufacture_id',
        'kind_id',
        'name',
        'category',
        'path',
        'setting',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class);
    }
    public function kind()
    {
        return $this->belongsTo(Kind::class);
    }
    public function like()
    {
        return $this->hasMany(Like::class);
    }
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('photo_id', $this->id)->first() !==null;
    }

}
