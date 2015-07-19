<?php namespace App\Storage\User\Registrar;

use App\Storage\User\InterfaceUser as UserContract;

class SiteRegistrar extends AbstractRegistrar implements InterfaceRegistrar {

	/**
	 * UserRepository that has been injected into the class.
	 * @param App\Storage\User
	 */
	private $userRepository;

	/**
	* Create a new instance of the SiteRegistrator
	*
	* @return void
	*/
	public function __construct(UserContract $user)
	{
		parent::__construct();
		$this->userRepository = $user;
	}

	/**
	* Create a new user entity
	*
	* @param array $data
	* @return User
	*/
	public function create(array $data)
	{
		return $this->userRepository->saveUser(null, $data); 
	}

}