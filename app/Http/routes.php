<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Home
Route::get('/', 'HomeController@index');


// Auth
$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');
$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\PasswordController@reset');


// Admin prefix
Route::group(['prefix' => 'lb-admin','middleware' => ['auth']], function () {

    // Admin dashboard
    Route::get('/', 'Admin\AdminHomeController@index');

    // Posts
    Route::get('post/destroy/{id}', 'PostController@destroy')->name('destroypost');
    Route::get('post/deleted/{id}', 'PostController@restore')->name('restorepost');
    Route::get('post/deleted', 'PostController@deleted')->name('deletedposts');
    Route::post('post/previewslug', 'PostController@previewSlug')->name('postslug');
    Route::resource('post','PostController');

    // Pages
    Route::get('page/destroy/{id}', 'PageController@destroy')->name('destroypage');
    Route::get('page/deleted/{id}', 'PageController@restore')->name('restorepage');
    Route::get('page/deleted', 'PageController@deleted')->name('deletedpages');
    Route::post('page/previewslug', 'PageController@previewSlug')->name('pageslug');
    Route::resource('page','PageController');

    // Categories
    Route::resource('category','Admin\CategoryController');

    // Tags
    Route::resource('tag','Admin\TagController');

    // Menus
    Route::resource('menu','Admin\MenuController');

    // Comments
    Route::get('comment/approve/{comment}', 'CommentController@approve')->name('approvecomment');
    Route::get('comment/reject/{comment}', 'CommentController@destroy')->name('rejectcomment');
    Route::get('comment/unapproved', function(App\Comment $comment) {
        return $comment->where('approved', 0)->count();
    })->name('unapprovedComments');
    Route::resource('comment','CommentController');

    // Users
    Route::get('user/pass/{id?}','UserController@getPass')->name('changepass');
    Route::post('user/pass','UserController@updatePassword')->name('updatepass');
    Route::get('user/setpass/{id}','UserController@setPass')->name('setpass');
    Route::get('user/deleted', 'UserController@deleted')->name('deletedusers');
    Route::get('user/deleted/{id}', 'UserController@restore')->name('restoreuser');
    Route::get('user/destroy/{id}', 'UserController@destroy')->name('destroyuser');
    Route::resource('user','UserController');

});

// Tag and category slugs
Route::get('tag/{slug}','Admin\TagController@showBySlug');
Route::get('category/{slug}','Admin\CategoryController@showBySlug');

// Post and page slugs
Route::get('{year}/{month}/{slug}', 'PostController@show')->where('year', '[0-9]+')->where('month', '[0-9]+');
Route::get('{slug}', 'PageController@show')->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*$');

// Comments
Route::get('comments/{post}', function(App\Post $post){
    return $post->publicComments()->get();
})->name('comments');
Route::post('comment/{post}', 'CommentController@store')->name('postcomment');


Route::get('img/{path}', function(League\Glide\Server $server, Illuminate\Http\Request $request, $path){
    $server->outputImage($path, $request->input());
})->where('path', '.+');