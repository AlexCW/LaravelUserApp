<?php namespace App\Storage\User\Registrar;
 
interface InterfaceRegistrar {
 
  /**
   * Create a new user entity
   *
   * @param array $data
   * @return User
   */
  public function create(array $data);
}