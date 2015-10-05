<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Eloquent;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Models\Profile;

class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
     
     public $timestamps = true;
    //protected $hidden = ['password', 'remember_token'];
    
    public function profiles()
    {
        return $this->hasMany('App\Models\Profile');
    }
	
	 public function apikeys()
    {
        return $this->hasMany('App\Models\Apikey','uid','id');
    }
}
