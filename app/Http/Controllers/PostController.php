<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Post;
use App\User;
use Auth;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
            $posts = Post::orderBy('created_at', 'desc')->get();
            return view('admin.posts.index', compact('posts', 'users'));
            }

        }
        
    }

      public function createAnnouncement()
    {
        $users = User::all();
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
            $posts = Post::orderBy('created_at', 'desc')->get();
            return view('admin.posts.create', compact('posts', 'users'));
            }

        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Auth::check()){
            if(Auth::user()->isAdmin()){
            $this->validate($request, [
            'body' =>'required|max:800',
            'title' => 'required'
        ]);

        $body = $request['body'];
        $title = $request['title'];

        $post = new Post();
        $post->body = $body;
        $post->title = $title;
        $message = 'Announcement Wasnt Created';
        if($request->user()->posts()->save($post)){
            $message = "Announcement successfully created";
            return redirect()->route('adminPosts')->with(['message' => $message]);
        }else{
            return redirect()->back()->withErrors(['msg' => $message])->withInput();
        }

            }

        }
       
        

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     /******   if(Post::create($request->all())){
            $request->session()->flash('status', 'Post was successfully created');
        }else{
            $request->session()->flash('status', 'Error!');
        }
        return redirect()->back();* */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        if(Auth::check()){
            return view('admin.posts.post', compact('post'));

        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if(Auth::check()){
            if(Auth::User()->isAdmin()){
            return view('admin.posts.edit', compact('post'));
            }
           
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $title = Input::get('title');
        $body = Input::get('body');

        $post = Post::findOrFail($id);
        $post ->update([
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ]);

        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                return redirect()->route('adminPosts');
            }else{
                return redirect()->back()->withErrors(['msg'=>'You do not have permission to update this announcement']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                $post->delete();
                return redirect()->route('adminPosts')->with(['message' => 'Announcement Deleted Successfully']);

            }

        }
    }
}
