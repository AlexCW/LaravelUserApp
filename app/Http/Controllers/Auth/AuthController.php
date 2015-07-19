<?php namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard;
use App\Storage\User\Registrar\InterfaceRegistrar as Registrar;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use Redirect;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        parent::__construct();
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->auth = $auth;
        $this->registrar = $registrar;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Foundation\Http\FormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $user = $this->registrar->create( $request->all() );

        if($user['success']) {
            $this->auth->login( $user['response'] );
            return redirect()->intended('/home'); 
        } 

        return Redirect::to('auth/register')
                       ->withErrors( $user['errors'] )
                       ->withInput();
    }
}
