<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;



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
            case ($user->membergroup->name == 'Owing'):
                $user-> update([
                'last_login_at' =>Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
                ]);
                Auth::logout();
                 return redirect('/login')->withErrors(['msg' => 'Please pay up your dues. Contact the secretariat on info@icmc.org']);
                break;

            case ($user->isAdmin()):
                $user-> update([
                'last_login_at' =>Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
                ]);
                return redirect()->route('adminUsers');
                break;

            case ($user->membergroup->name == 'Banned');
                $user-> update([
                'last_login_at' =>Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
                ]);
                Auth::logout();
                return redirect('/login')->withErrors(['msg'=>'You have been banned. Contact the secretariat on info@icmc.org']);   
                
            default:
                $user-> update([
                'last_login_at' =>Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
                ]);
                 return redirect('/home');
                break;
            
        }

      
    }

 public function username(){
     return 'member_id';
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
