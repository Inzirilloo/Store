<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
    ];

    //visto che ho fatto che il post ha una foreign key
    //devo fare una roba per farmi dare tutto lo user grazie alla
    //foreing key
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
