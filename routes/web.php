<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\User;
use Illuminate\Support\Facades\Input;

Event::listen('illuminate.query.*', function($query){
    var_dump($query);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('home', 'HomeController@index')->name('home')->middleware('verified');
//Route::get('home', 'HomeController@index')->name('home');

/****Route::get('/csv', 'CsvFile@index')->name('importPage');
Route::post('csv/import', 'CsvFile@csv_import')->name('import');***/

//Users Route
Route::get('users', 'UsersController@index')->name('users');
Route::get('users/profile/{slug}', 'UsersController@show')->name('user');
Route::get('users/edit/{id}', 'UsersController@edit')->name('editUser')->where('id', '\d+');
Route::put('users/edit/{id}', 'UsersController@update')->name('update')->where('id', '\d+');
Route::patch('users/edit/{id}', 'UsersController@changeAvatar')->name('changeAvatar')->where('id', '\d+');
Route::get('terms-of-use', 'UsersController@terms')->name('terms');


//Admin User Route
Route::get('admin/users', 'AdminUsersController@index')->name('adminUsers')->middleware('auth');
Route::get('admin/users/verified', 'AdminUsersController@verified')->name('adminVerified');
Route::get('admin/users/paid', 'AdminUsersController@paid')->name('adminPaid')->middleware('auth');
Route::get('admin/users/pending', 'AdminUsersController@pending')->name('adminPending');
Route::get('admin/users/banned', 'AdminUsersController@banned')->name('adminBanned')->middleware('auth');
Route::get('admin/users/profile/{id}', 'AdminUsersController@show')->name('adminUser')->where('id', '\d+');
Route::get('admin/users/edit/{id}', 'AdminUsersController@edit')->name('adminEditUser')->where('id', '\d+');
Route::patch('admin/users/edit/{id}', 'AdminUsersController@userUpdate')->name('adminUpdateUser')->where('id', '\d+');
Route::put('admin/users/edit/{id}', 'AdminUsersController@paidUsers')->name('updatePaidUser')->where('id', '\d+');
Route::get('admin/{id}', ['uses'=>'AdminUsersController@destroy', 'as' => 'deleteUser', 'middleware' => 'auth']);
Route::get('updatedebtors', 'adminUsersController@getDebtors')->name('allDebtors');
Route::get('debtors', 'adminUsersController@owing')->name('getDebtors');

//Posts Route
Route::get('admin_user/announcements', 'PostController@index')->name('adminPosts');
Route::get('admin_user/post/{id}', 'PostController@show')->name('post')->where('id', '\d+');
Route::get('admin_user/create_announcement', 'PostController@createAnnouncement')->name('makeAnnouncement');
Route::any('admin_user/posts/announcement', 'PostController@create')->name('adminPost');
Route::get('post/{id}', 'PostController@show')->name('post')->where('id', '\d+');
Route::get('admin_user/post/edit/{id}', 'PostController@edit')->name('editPost')->where('id', '\d+');
Route::put('admin_user/post/update/{id}', 'PostController@update')->name('updatePost')->where('id', '\d+');
Route::get('admin_user/post/delete/{id}', 'PostController@destroy')->name('deletePost')->where('id', '\d+');


//Members Route
Route::get('find-a-mediator', 'MembersController@index')->name('allmembers');
Route::get('member/{slug}', 'MembersController@profile')->name('public-profile');



//search
Route::any('/search', function()
{
    $q = Input::get('q');
    $users = User::where('name', 'LIKE', '%'.$q.'%')->orWhere('email', 'LIKE', '%'.$q.'%')->get();
    $verifiedUsers = $users->where('membergroup_id', '=', '3');
    if($verifiedUsers)
    {
        if(Auth::check())
        {
            return view('users.result', compact('verifiedUsers'))->withDetails($verifiedUsers)->withQuery($q);
        }
        else
        {
            return view('members.search', compact('verifiedUsers'))->withDetails($verifiedUsers)->withQuery($q);  
        }
        
    }
    else
    {
        return redirect()->back()->withErrors(['msg' =>['Member not found']]);
    }
} )->name('search');
