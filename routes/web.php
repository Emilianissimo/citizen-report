<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SocialRequestsController;
use App\Http\Controllers\Admin\UsersController;

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
if (!strpos(Request::url(), "dashboard")) {

	Route::get('/{vue_capture?}', function () {
		return view('welcome');
	})->where('vue_capture', '[\/\w\.-]*');

}

Route::group(['prefix'=>'dashboard', 'middleware'=>'guest'], function() {
	Route::get('/login', [AuthController::class, 'loginPage'])->name('dashboard.loginPage');
	Route::post('/login', [AuthController::class, 'login'])->name('dashboard.login');
});

Route::group(['prefix'=>'dashboard', 'namespace'=>'App\Http\Controllers\Admin', 'middleware' => 
'staff'], function(){
	Route::get('/', [AdminController::class, 'index'])->name('dashboard');
	Route::post('/logout', [AuthController::class, 'logout'])->name('dashboard.logout');
	Route::resource('/categories', 'CategoriesController');
	Route::resource('/regions', 'RegionsController');
	Route::resource('/statuses', 'RequestStatusesController');
	Route::get('/requests', [SocialRequestsController::class, 'index'])->name('social_requests.index');
	Route::get('/requests/{id}', [SocialRequestsController::class, 'show'])->name('social_requests.show');
	Route::post('/requests/{id}/change-status', [SocialRequestsController::class, 'changeStatus'])->name('social_requests.changeStatus');
});

Route::group(['prefix'=>'dashboard', 'namespace'=>'App\Http\Controllers\Admin', 'middleware' => 
'admin'], function(){
	Route::resource('/organizations', 'OrganizationsController');
});

Route::group(['prefix'=>'dashboard', 'namespace'=>'App\Http\Controllers\Admin', 'middleware' => 
'org_admin'], function(){
	Route::resource('/users', 'UsersController');
});
