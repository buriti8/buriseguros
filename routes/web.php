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

use Illuminate\Support\Facades\Route;
use App\Http\Validations\Validation;

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

// Email Verification Routes...
/* Route::emailVerification(); */

// Admin Routes...
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::group(['namespace' => 'ProjectControllers'], function () {
        Route::get('/', 'HomeController@index')->name('home');

        // Clear caché Routes...
        Route::get('/cache', 'ArtisanCommandsController@cache');
        Route::get('/phpinfo', 'ArtisanCommandsController@phpinfo');

        // Users Routes...
        Route::get('/users/changePassword', 'UserController@changeMyPassword');
        Route::put('/users/changePassword', 'UserController@updateMyPassword');

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

        // Information Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('information')]], function () {
            Route::resource('information', 'InformationController')->only(['index', 'show', 'edit', 'update']);
        });

        // Networks Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('networks')]], function () {
            Route::resource('networks', 'NetworkController');
        });

        // Insurers Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('insurers')]], function () {
            Route::resource('insurers', 'InsurerController');
        });

        // Solutions Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('solutions')]], function () {
            Route::resource('solutions', 'SolutionController');
        });

        // Insurances Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('insurances')]], function () {
            Route::resource('insurances', 'InsuranceController');
        });
    });
});

Route::get('/', 'PageController@index')->name('page.index');

Route::get('/pagos', 'ProjectControllers\InsurerController@page')->name('insurer.page');
Route::get("/{insurance:slug}", "ProjectControllers\InsuranceController@page")->name('insurance.page');
Route::get('/seguros/{solution:name}', 'ProjectControllers\SolutionController@page')->name('solution.page');

// Image Routes...
Route::get('/information/{information}/image', 'ProjectControllers\InformationController@getImage')->name('information.image');
Route::get('/insurers/{insurer}/image', 'ProjectControllers\InsurerController@getImage')->name('insurer.image');
Route::get('/solutions/{solution}/image', 'ProjectControllers\SolutionController@getImage')->name('solution.image');
Route::get('/insurances/{insurance}/image', 'ProjectControllers\InsuranceController@getImage')->name('insurance.image');
