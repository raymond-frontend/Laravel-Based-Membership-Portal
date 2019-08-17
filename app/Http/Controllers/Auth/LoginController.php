<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user){
        
        switch ($user) {
            case ($user->getDays() == true):
                Auth::logout();
                 return redirect('/login')->withErrors(['msg' => 'Pay up your dues']);
                break;
            case ($user->isAdmin()):
                return redirect()->route('adminUsers');
                break;
            case ($user->membergroup_id == '2');
            Auth::logout();
            return redirect('/login')->withErrors(['msg'=>'You have been banned']);   
            default:
                 return redirect('/home');
                break;
        }
    }

 public function username(){
     return 'reference_id';
 }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


}
