<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function chats()
    {
        return $this->hasMany('App\Chat');
    }

    public function admins()
    {
        return $this->hasMany('App\Admin');
    }

}
