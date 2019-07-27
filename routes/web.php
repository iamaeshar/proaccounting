<?php
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
// use Symfony\Component\Routing\Route;

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

/* Pages */
Route::get('/', 'IndexController@index');
Route::get('/about-us', function () { return view('pages.about'); });
Route::get('/quickbooks-software', function () { return view('pages.quickbooks-software'); });

Route::get('/quickbooks-services', function () { return view('pages.quickbooks-services'); });
Route::get('/quickbooks-support', function () { return view('pages.quickbooks-support'); });
Route::get('/quickbooks-payroll-support', function() { return view('pages.quickbooks-payroll-support'); });
Route::get('/quickbooks-proadvisor-support', function() { return view('pages.quickbooks-proadvisor-support'); });
Route::get('/quickbooks-enterprise-support', function() { return view('pages.quickbooks-enterprise-support'); });
Route::get('/quickbooks-desktop-support', function() { return view('pages.quickbooks-desktop-support'); });
Route::get('/quickbooks-premier-support', function() { return view('pages.quickbooks-premier-support'); });
Route::get('/quickbooks-pro-support', function() { return view('pages.quickbooks-pro-support'); });
Route::get('/quickbooks-pos-support', function() { return view('pages.quickbooks-pos-support'); });
Route::get('/quickbooks-cloud-hosting-support', function() { return view('pages.quickbooks-cloud-hosting-support'); });
Route::get('/quickbooks-window-support', function() { return view('pages.quickbooks-window-support'); });
Route::get('/quickbooks-error-support', function() { return view('pages.quickbooks-error-support'); });
Route::get('/privacy-policy', function () { return view('pages.privacy-policy'); });

Route::post('blog/search', 'BlogsController@search')->name('blog.search');
// Route::get('blog/{url}', 'BlogsController@show');
Route::post('blog/comment', 'BlogsController@comment')->name('blog.comment');
Route::resource('blog', 'BlogsController');

Route::get('/contact-us', function() { return view('pages.contact'); });
Route::resource('query', 'QueryController');

// Auth::routes();
// Authentication Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('admin/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('admin/blogs', 'DashboardController@blogs');
Route::get('admin/write-blog', 'DashboardController@write_blog');

Route::get('admin/blog/comments', 'DashboardController@showBlogComments');
Route::get('admin/blog/deleteComment', 'DashboardController@deleteComment')->name('blog.deleteComment');

Route::post('/editorFileUpload', 'DashboardController@editorFileUpload');