<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Membership;
use App\Membergroup;
use Mail;
use App\Post;
use App\Role;
use App\Paid;
use App\Mail\duesNotification;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use DateTime;
use DB;



class AdminUsersController extends Controller
{

    public function __construct(){

        $this->middleware('auth');
    }

    public function index()
    {   
        $users = User::all();
        $latestUsers = User::latest()->orderBy('created_at', 'DESC')->paginate(100);
        $pendingUsers = $users->where('membergroup_id', '=', '1');
        $verifiedUsers= $users->where('membergroup_id', '=', '3');
        $paid = $users->where('paid_id', '=', '2');
        $debtors = $users->where('paid_id', '=', '3');
        if(Auth::check())
        {
                if(Auth::User()->isAdmin())
                {
                return view('admin.users.index', compact('users', 'latestUsers', 'pendingUsers', 'verifiedUsers', 'paid', 'debtors'));
                }
                elseif (Auth::User() == null) 
                {
                return redirect()->route('welcome');
                }
                else
                {
                return redirect()->route('home');
                }
        }
      
        
    }

  

    public function calculateDate()
    {
        $users = User::all();
        $verifiedUsers= $users->where('membergroup_id', '=', '3');
        foreach ($verifiedUsers as $key => $verifiedUser) 
        {
            $created = new Carbon($verifiedUser->created_at);
            $now = Carbon::now();
            $difference = $created->diff($now);
            $count = $difference->format('%d');
            dd($verifiedUsers->count);
            $check = 10;
            
        }


    }

    public function getBannedUsers()
    {
        $users = User::all();
        $bannedUsers = $users->where('membergroup_id', '=', '2');
        foreach($bannedUsers as $key => $bannedUser)
        {
            return $bannedUser;
        }
        
    }

    public function deleteBannedUsers()
    {
        User::where( 'membergroup_id', '=' , '2' )
        ->where('paid_id', '=', '1')
        ->delete();
    }
    

      public function getDebtors()
      {
       //dd(Carbon::now()->subDays(1)->toDateTimeString());
        $users = User::where('created_at', '<', Carbon::now()->sub('365', 'Days')->toDateTimeString())
                     ->where('membergroup_id', '=', '3')
                     ->where('paid_id', '=', '1')
                     ->update(['paid_id' => '3']);
                     return redirect()->back()->with(['message'=>'Debtors List Updated'])->withInput();   
      }

    public function verified()
    {
        $users = User::all();
        $verifiedMembers = User::where('membergroup_id', '=' , '3')->paginate(100);
        if(Auth::check())
        {
                if(Auth::User()->isAdmin())
                {
                return view('admin.users.verified', compact('verifiedMembers'));
                }
                else
                {
                    return redirect()->back()->withErrors(['message', 'You are not authorized to check this page']);
                }
        }
        
    }

    public function paid()
    {
        $users = User::all();
        $paidMembers = User::where('paid_id', '=', '2')->paginate(100);
        if(Auth::check())
        {
            if(Auth::User()->isAdmin())
            {
                return view('admin.users.paid', compact('paidMembers'));
            }else
            {
                 return redirect()->back()->withErrors(['message', 'You are not authorized to check this page']);
            }

        }
    }

    public function owing()
    {
        $users = User::all();
        $debtors = User::where('paid_id', '=', '3')->paginate(150);
        if(Auth::User()->isAdmin())
        {
            return view('admin.users.debtors', compact('users', 'debtors'));
        }else
            {
                 return redirect()->back()->withErrors(['message', 'You are not authorized to check this page']);
            }
    }

    public function pending()
    {
        $users = User::all();
        $pendingUsers = User::where('membergroup_id', '=', '1')->paginate(100);
        if(Auth::check())
        {
            if(Auth::user()->isAdmin())
            {
                return view('admin.users.pending',  compact('pendingUsers' ,  'users'));
            }
            else
            {
                return redirect()->back()->withErrors(['message', 'You are not authorized to check this page']);
            }

        }
    }

        public function banned()
        {
            $users = User::all();
            $bannedUsers = User::where('membergroup_id', '=', '2')->paginate(100);
            if(Auth::check())
            {
                if(Auth::user()->isAdmin())
                {
                    return view('admin.users.banned', compact('bannedUsers'));
                }

            }
        }

    public function show($id)
    {
        $user = User::findOrFail($id);
        if(Auth::check())
        {
                if(Auth::User()->isAdmin())
                {
                return view('admin.users.profile', compact('user'));
                }
                else
                {
                return redirect()->back();
                }
        }
        
       

    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $memberships = Membership::pluck('name', 'id')->all();
        $membergroups = Membergroup::pluck('name', 'id')->all();
        $paids = Paid::pluck('name', 'id')->all();
        $roles = Role::pluck('name', 'id')->all();
        if(Auth::check())
        {
            if(Auth::User()->isAdmin())
            {
            return view('admin.users.edit', compact('user', 'memberships', 'membergroups', 'paids'));
            }
            else
            {
            return redirect()->back();
            }
        }
        

    }


    public function userUpdate(Request $request, $id){
        $membership_id = Input::get('membership_id');
        $membergroup_id = Input::get('membergroup_id');
        $user = User::findOrFail($id);


        if(Auth::check())
        {
            if(Auth::User()->isAdmin())
            {
                $user->update([
                'membership_id' => $request->input('membership_id'),
                'membergroup_id' => $request->input('membergroup_id'),
                ]);
                
                return redirect()->route('adminUsers')->with(['message' =>'User updated successfully']);  
            }
               
        }
            else
            {
                return redirect()->back();
            }
    }



    public function paidUsers(Request $request, $id)
    {
        $paid_id = Input::get('paid_id');
        $user = User::findOrFail($id);
        
        if(Auth::user()->isAdmin())
        {
            $user->update(['paid_id' => $request->input('paid_id')]);
            return redirect()->route('adminUsers')->with(['message' =>'User Updated Successfully']);

        }
    }

    
   

        public function destroy($id)
        {
            $user = User::findOrFail($id);
            if(Auth::User()->isAdmin())
            {
                if(Auth::User() !==  $user)
                {
                    $user->delete();
                    return redirect()->route('adminUsers')->with(['message'=>'User Deleted Successfully']);
                }
                else
                {
                    return redirect()->back()->withErrors(['msg' =>'You cannot delete this user']);
                }
           
            }

        }




}
