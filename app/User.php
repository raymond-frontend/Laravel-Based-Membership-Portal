<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Cache;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'reference_id', 'language', 'bio', 'academics',
         'professional', 'experience', 'style','inspiration', 'membership_id','role_id',
         'membergroup_id', 'slug', 'last_login_at', 'last_login_ip', 'location', 'paid_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function isOnline(){
        return Cache::has('user-is-online' . $this->id);
    }

    public function membership(){
        return $this->belongsTo('App\Membership');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function paid(){
        return $this->belongsTo('App\paid');
    }

    public function membergroup(){
        return $this->belongsTo('App\Membergroup');
    }

    public function isAdmin(){
       return $this->role['name'] == 'Administrator';
     
    }

 

    public function getDays(){
        $created = $this->created_at->toDateTimeString();
        $today = Carbon::now()->toDateTimeString();
        $start_time = Carbon::parse($created);
        $finish_time = Carbon::parse($today);
        $result = $start_time->diffInDays($finish_time, false);
        if($result >= 1){
            return true;
        }else {
            return false;
        }
    }


}
