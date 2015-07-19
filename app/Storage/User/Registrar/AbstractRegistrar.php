<?php namespace App\Storage\User\Registrar;
 
use Illuminate\Support\MessageBag;

abstract class AbstractRegistrar {

	/**
	* The errors MesssageBag instance
	*
	* @var Illuminate\Support\MessageBag
	*/
	protected $errors;

	/**
	* Create a new instance of Illuminate\Support\MessageBag
	* automatically when the child class is created
	*
	* @return void
	*/
	public function __construct()
	{
		$this->errors = new MessageBag;
	}

	/**
	* Return the errors MessageBag
	*
	* @return Illuminate\Support\MessageBag
	*/
	public function errors()
	{
		return $this->errors;
	}

}