<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Notifications\duesNotification;
use Illuminate\Support\Facades\Mail;
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
            case ($user->paid_id == '3'):
                $user-> update([
                'last_login_at' =>Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
                ]);
                //Mail::to($user)->send(new duesNotification());
                Auth::logout();
                 return redirect('/login')->withErrors(['msg' => 'kindly pay your annual membership dues into the designated account. For inquiries, kindly contact the ICMC Secretariat (info@icmcng.org)']);
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
                return redirect('/login')->withErrors(['msg'=>'Greetings. Your profile has been flagged by the Administrator and disabled. Kindly contact the ICMC Secretariat (info@icmcng.org) for assistance']);   
                
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
