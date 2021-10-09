<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function chats()
    {
        return $this->hasMany('App\Chat');
    }

}
