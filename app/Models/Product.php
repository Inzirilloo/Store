<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'user_id',
        'price',
        /*'image',*/
    ];

    //visto che ho fatto che il post ha una foreign key
    //devo fare una roba per farmi dare tutto lo user grazie alla
    //foreing key
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
