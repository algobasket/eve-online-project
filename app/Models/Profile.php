<?php
namespace App\Models;

use Eloquent;

class Profile extends Eloquent {

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}