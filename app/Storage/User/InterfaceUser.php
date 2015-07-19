<?php namespace App\Storage\User;

interface InterfaceUser {
	public function saveUser( $username = null, array $data = array() );
}
