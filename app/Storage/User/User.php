<?php namespace App\Storage\User;

use Illuminate\Auth\Authenticatable;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends \Eloquent implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
     * This specifies which fields can be filled.
     * 
     * @var array
     */
    protected $fillable = array('username', 'email', 'password');

    /**
     * This can't be filled directly from an input
     * 
     * @var array
     */
    protected $guarded = array('id', 'created_by', 'updated_by'); 

	/**
	 * Overload of the parent service provider
	 * This will be 'booted' whenever the model is called. 
	 */
	public static function boot()
    {
        parent::boot();
        static::registerEventListeners();
    }

    /**
     * Registers the event listeners for the model.
     * @return void
     */
    protected static function registerEventListeners()
    {
        //Intercept the saving method and bcrypt the password
        static::creating(function($user) {
            $user->password = bcrypt($user->password);
        });
    }
}