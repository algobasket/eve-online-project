<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Apikey extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'api_keys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['name', 'email', 'password','mobile','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
   // protected $hidden = ['password', 'remember_token'];
   //public $timestamps = false;
   
   
}
