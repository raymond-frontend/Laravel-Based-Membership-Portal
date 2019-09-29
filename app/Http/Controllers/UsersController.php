<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\User;
use App\Membership;
use Image;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }


    public function index()
    {
       
        $users = User::all()->where('membergroup_id', '=' , '3');
        //$user = User::latest()->orderBy('id')->get()->paginate(7);
        return view('users.index', compact('users'));
    }


    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('users.profile', compact('user'));
    
    }


    public function edit( $id)
    {
        $user = User::findOrFail($id);
        $memberships = Membership::pluck('name', 'id')->all();
        if(Auth::user()->id !== $user->id){
        return redirect()->back();
        }else{
           return view('users.edit', compact('user', 'memberships')); 
        }
        

    }

    public function update(Request $request, $id)
    {
        $inspiration = Input::get('inspiration');
        $language = Input::get('language');
        $bio = Input::get('bio');
        $academics = Input::get('academics');
        $professional = Input::get('professional');
        $experience = Input::get('experience');
        $style = Input::get('style');
        $membership_id = Input::get('membership_id');
        $location = Input::get('location');
        $name = Input::get('name');
        $headline = Input::get('headline');
        $style = Input::get('style');


       $user = User::findOrFail($id);
        $user->update([
            'inspiration' => $request->input('inspiration'),
            'language' => $request->input('language'),
            'bio' => $request->input('bio'),
            'academics' =>$request->input('academics'),
            'professional' => $request->input('professional'),
            'experience' => $request->input('experience'),
            'membership_id' => $request->input('membership_id'),
            'location' => $request ->input('location'),
            'style' =>$request->input('style'),
            'name' => $request -> input('name'),
            'slug' => preg_replace('/\s+/', '-', strtolower($request -> input('name')) ),
            'headline'=> $request->input('headline'),
            
        ]);

        if($user)
        {
            $styleNames = explode(',', $request->get('mediationstyle'));
            foreach($styleNames as $styles)
            {
               
                $mediationstyle= $user->update(['mediationstyle' => json_encode($styleNames)]);
            }
        }

        if($request -> input('name') == null){
            return redirect()->back()->withErrors(['msg' => 'Please update update records to suit your personalty']);
        }else{
           return redirect()->route('user', $user->slug); 
        }

        
      
      

    }

     public function changeAvatar(Request $request, $id)
     {
         $this->validate($request, [
             'avatar' => 'image|required|mimes:jpeg,png,jpg,gif,svg|'
         ]);
         if($request->hasFile('avatar'))
         {
             $avatar = $request->file('avatar');
             $filename = time() . '.' . $avatar->getClientOriginalExtension();
             image::make($avatar)->resize(170,170)->save(public_path('/uploads/avatars/' . $filename));
             $user = User::findOrFail($id);
             $oldAvatar = '/uploads/avatars/'. $user->avatar;
             Storage::delete($oldAvatar);
             $user->avatar = $filename;
             $user->save();
             return redirect()->route('user', $user->slug);
         }else
         {
              return redirect()->back()->withErrors(['msg' => 'Select an Image to update your Avatar']);
         }

          

    }
    

    public function terms(){
        return view('users.terms');
    }

    
}
