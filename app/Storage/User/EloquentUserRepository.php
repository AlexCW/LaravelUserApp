<?php namespace App\Storage\User;

// use App\Storage\User\User as User;
use App\Storage\EloquentRepository;

class EloquentUserRepository extends EloquentRepository implements InterfaceUser {

	public function __construct( User $model ) {
		parent::__construct($model);
	}

	/**
	 * Save a new or existing user(if a username is specified)
	 * @param  string $username 
	 * @param  array  $data     
	 * @return App\Storage\User\User          
	 */
	public function saveUser( $username = null, array $data = array() ) {
		if(!empty( $username )){
			return parent::saveExisting( array('username' => $username), $data );
		} 

		return parent::saveNew($data);
	}
}