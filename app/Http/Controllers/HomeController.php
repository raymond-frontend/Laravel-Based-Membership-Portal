<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $posts = Post::latest()->orderBy('id')->paginate(5);
        $users = User::all();
        $latestUsers = User::latest()->orderBy('id')->paginate(10);
        $user = Auth::user();
        return view('home', compact('user','posts', 'users', 'latestUsers'));
    }



    
}
