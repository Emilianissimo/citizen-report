<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;

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
		if(!User::find(1)){
			$user = User::add([
				'name' => 'admin',
				'phone' => 'admin',
			]);
			$user->is_admin = true;
			$user->password = bcrypt('admin');
			$user->save();
		}
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
	Route::get('/requests', ['SocialRequestsController', 'index'])->name('social_requests.index');
});

Route::group(['prefix'=>'dashboard', 'namespace'=>'App\Http\Controllers\Admin', 'middleware' => 
'admin'], function(){
	Route::resource('/users', 'UsersController');
});
