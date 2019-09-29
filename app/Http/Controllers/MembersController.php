<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class MembersController extends Controller
{
    public function index()
    {
        $members = DB::table('users')->orderBy('name')->where('membergroup_id', '=', '3')->paginate(15);
        return view('members.index', compact('users', 'members'));
    }


   public function profile($slug)
   {
       $user = User::where('slug', $slug)->where('membergroup_id', '=', '3')->first();
       if($user)
       {
          return view('members.profile', compact('user')); 
       }else{
           return redirect()->back()->withErrors(['msg'=>'Mediator does not exist']);
       }
       
   }
}
