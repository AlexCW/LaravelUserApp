<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Auth;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $user;

   public function __construct() {
		//If there is a user authenticated assign them to the variable to be accessed through any controller. 
		if(Auth::check()){
			$this->user = Auth::user();
		} 
	}
}
