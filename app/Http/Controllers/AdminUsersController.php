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
use App\Mail\duesNotification;



class AdminUsersController extends Controller
{
    public function index(){
        $users = User::all();
        $latestUsers = User::latest()->orderBy('created_at', 'DESC')->paginate(30);
        $pendingUsers = $users->where('membergroup_id', '=', '1');
        $verifiedUsers= $users->where('membergroup_id', '=', '3');
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
             return view('admin.users.index', compact('users', 'latestUsers', 'pendingUsers', 'verifiedUsers'));
        }else{
            return redirect()->route('home');
        }
        }
      
        
    }

    public function verified(){
        $users = User::all();
        $verifiedMembers = $users->where('membergroup_id', '=' , '3');
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
            return view('admin.users.verified', compact('verifiedMembers'));
        }else{
             return redirect()->back()->withErrors(['message', 'You are not authorized to check this page']);
        }
        }
        
    }

    public function pending(){
        $users = User::all();
        $pendingUsers = $users->where('membergroup_id', '=', '1');
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
        $bannedUsers = $users->where('membergroup_id', '=', '2');
        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                return view('admin.users.pending', compact('bannedUsers'));
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
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
            return view('admin.users.edit', compact('user', 'memberships', 'membergroups'));
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
            'activeLocation' => $request ->input('active_location')
        ]);

        if(Auth::check()){
            if(Auth::User()->isAdmin()){
                switch ($user->membergroup_id) {
                    case '4':
                        Mail::to($user)->send(new duesNotification());
                        return redirect()->route('adminUsers');
                        break;                  
                    default:
                        return redirect()->route('adminUsers');
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
