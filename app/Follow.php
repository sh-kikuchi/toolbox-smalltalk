<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    public function user_following()
    {
         return $this->belongsTo('App\User', 'id', 'following_id');
    }

    public function user_followed()
    {
         return $this->belongsTo('App\User', 'id', 'followed_id');
    }



}
