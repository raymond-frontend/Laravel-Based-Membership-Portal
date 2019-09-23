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



class AdminUsersController extends Controller
{
    public function index(){
        $users = User::all();
        $latestUsers = User::latest()->orderBy('created_at', 'DESC')->paginate(100);
        $pendingUsers = $users->where('membergroup_id', '=', '1');
        $verifiedUsers= $users->where('membergroup_id', '=', '3');
        $paid = $users->where('paid_id', '=', '2');
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
             return view('admin.users.index', compact('users', 'latestUsers', 'pendingUsers', 'verifiedUsers', 'paid'));
        }elseif (Auth::User() == null) {
            return redirect()->route('welcome');
        }else{
            return redirect()->route('home');
        }
        }
      
        
    }

    public function verified(){
        $users = User::all();
        $verifiedMembers = User::where('membergroup_id', '=' , '3')->paginate(100);
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
            return view('admin.users.verified', compact('verifiedMembers'));
        }else{
             return redirect()->back()->withErrors(['message', 'You are not authorized to check this page']);
        }
        }
        
    }

    public function paid(){
        $users = User::all();
        $paidMembers = User::where('paid_id', '=', '2')->paginate(100);
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
                return view('admin.users.paid', compact('paidMembers'));
            }else{
                 return redirect()->back()->withErrors(['message', 'You are not authorized to check this page']);
            }

        }
    }

    public function pending(){
        $users = User::all();
        $pendingUsers = User::where('membergroup_id', '=', '1')->paginate(100);
        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                return view('admin.users.pending',  compact('pendingUsers' ,  'users'));
            }else{
                return redirect()->back()->withErrors(['message', 'You are not authorized to check this page']);
            }

        }
    }

        public function banned(){
        $users = User::all();
        $bannedUsers = User::where('membergroup_id', '=', '2')->paginate(100);
        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                return view('admin.users.banned', compact('bannedUsers'));
            }

        }
    }

    public function show($id){
        $user = User::findOrFail($id);
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
            return view('admin.users.profile', compact('user'));
        }else{
             return redirect()->back();
            }
        }
        
       

    }


    public function edit($id){
        $user = User::findOrFail($id);
        $memberships = Membership::pluck('name', 'id')->all();
        $membergroups = Membergroup::pluck('name', 'id')->all();
        $paids = Paid::pluck('name', 'id')->all();
        $roles = Role::pluck('name', 'id')->all();
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
            return view('admin.users.edit', compact('user', 'memberships', 'membergroups', 'roles', 'paids'));
        }else{
             return redirect()->back();
             }
        }
        

    }


    public function update(Request $request, $id){

        $inspiration = Input::get('inspiration');
        $language = Input::get('language');
        $bio = Input::get('bio');
        $academics = Input::get('academics');
        $professional = Input::get('professional');
        $experience = Input::get('experience');
        $style = Input::get('style');
        $membership_id = Input::get('membership_id');
        $membergroup_id = Input::get('membergroup_id');
        $activeLocation = Input::get('active_location');
        $role = Input::get('role_id');
        $paid = Input::get('paid_id');


       $user = User::findOrFail($id);
        $user->update([
            'inspiration' => $request->input('inspiration'),
            'language' => $request->input('language'),
            'bio' => $request->input('bio'),
            'academics' =>$request->input('academics'),
            'professional' => $request->input('professional'),
            'experience' => $request->input('experience'),
            'style' => $request->input('style'),
            'membership_id' => $request->input('membership_id'),
            'membergroup_id' => $request->input('membergroup_id'),
            'activeLocation' => $request ->input('active_location'),
            'role_id' => $request->input('role_id'),
            'paid_id' => $request->input('paid_id')
        ]);

        if(Auth::check()){
            if(Auth::User()->isAdmin()){
                switch ($user->membergroup_id) {
                    case '4':
                        Mail::to($user)->send(new duesNotification());
                        return redirect()->route('adminUsers')->with(['message' =>'User updated successfully']);
                        break;                  
                    default:
                        return redirect()->route('adminUsers')->with(['message' =>'User updated successfully']);;
                        break;
                }
               
            }else{
                return redirect()->back();
                }
        }

    }

   

        public function destroy($id){
        $user = User::findOrFail($id);
        if(Auth::User()->isAdmin()){
            if(Auth::User() !==  $user){
            $user->delete();
            return redirect()->route('adminUsers')->with(['message'=>'User Deleted Successfully']);
            }else{
                return redirect()->back()->withErrors(['msg' =>'You cannot delete this user']);
            }
           
        }

    }




}
