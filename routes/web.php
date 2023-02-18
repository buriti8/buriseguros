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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Validations\Validation;

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Clear caché Routes...
Route::get('/clear', 'ProjectControllers\ArtisanCommandsController@clear');

Route::group(['namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::get('logout', 'AuthController@getLogout');
});

// Admin Routes...
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'ProjectControllers'], function () {

        Route::group(['middleware' => ['role_or_permission:Administrador']], function () {
            // Users Routes...
            Route::get('/users/{user}/changePassword', 'UserController@changePassword');
            Route::put('/users/{user}/changePassword', 'UserController@updatePassword');
            Route::resource('users', 'UserController');

            // Roles Routes...
            Route::get('/roles/{role}/permissions', 'RolesController@editPermissions');
            Route::post('/roles/{role}/permissions', 'RolesController@assignPermissions');
            Route::resource('roles', 'RolesController')->only(['index', 'store', 'destroy']);
        });

        // Lists Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('lists')]], function () {
            Route::resource('lists', 'ListController');
        });

        // Insurers Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('insurers')]], function () {
            Route::resource('insurers', 'InsurerController');
            Route::get('/insurers/{insurer}/image', 'InsurerController@getImage')->name('insurer.image');
        });

        // Networks Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('networks')]], function () {
            Route::resource('networks', 'NetworkController');
        });

        // Posts Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('posts')]], function () {
            Route::resource('posts', 'PostController');
            Route::get('/posts/{post}/image', 'PostController@getImage')->name('post.image');
        });

        // Solutions Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('solutions')]], function () {
            Route::resource('solutions', 'SolutionController');
        });

        // Insurances Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('insurances')]], function () {
            Route::resource('insurances', 'InsurancesController');
            Route::get('/insurances/{insurance}/image', 'InsurancesController@getImage')->name('insurance.image');
        });

        // Contact Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('contacts')]], function () {
            Route::resource('contacts', 'ContactController')->only(['show', 'edit', 'update']);
            Route::get('/contacts/{contact}/image', 'ContactController@getImage')->name('contact.image');
        });
    });
});

Route::get('/', 'PageController@index')->name('page.index');
Route::get('/inicio', 'PageController@index')->name('page.index');

Route::get('/blog', 'BlogController@index')->name('blog.index');
Route::get("/blog/{post:slug}", "BlogController@show")->name('blog.show');

Route::get('/pagos', 'ProjectControllers\InsurerController@page')->name('insurer.page');
Route::get("/{insurance:slug}", "ProjectControllers\InsurancesController@page")->name('insurance.page');
Route::get('/seguros/{solution:name}', 'ProjectControllers\SolutionController@page')->name('solution.page');

// Img Routes...
Route::get('/contacts/{contact}/image', 'ProjectControllers\ContactController@getImage')->name('contact.image');
Route::get('/insurers/{insurer}/image', 'ProjectControllers\InsurerController@getImage')->name('insurer.image');
Route::get('/insurances/{insurance}/image', 'ProjectControllers\InsurancesController@getImage')->name('insurance.image');
Route::get('/posts/{post}/image', 'ProjectControllers\PostController@getImage')->name('post.image');
Route::get('/solutions/{solution}/image', 'ProjectControllers\SolutionController@getImage')->name('solution.image');