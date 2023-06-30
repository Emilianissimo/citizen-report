<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SocialRequestsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\Admin\OrganizationsController as AdminOrganizationsController;

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
Route::get('/', function () {
    return redirect(app()->getLocale());
});


Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setLocale'], function() {
	Route::get('/', [MainController::class, 'index'])->name('client.index');
	Route::get('/profile', [MainController::class, 'profile'])->name('client.profile');
	Route::put('/profile', [MainController::class, 'profileUpdate'])->name('client.profile.update');

	Route::get('/requests', [MainController::class, 'requests'])->name('client.requests.index');
	Route::get('/requests/show/{slug}', [MainController::class, 'singleRequest'])->name('client.requests.show');
	
	Route::get('/organizations', [OrganizationsController::class, 'index'])->name('client.organizations.index');
	Route::get('/organizations/{id}/posts', [OrganizationsController::class, 'posts'])->name('client.posts');
	Route::get('/organizations/{id}/posts/{slug}', [OrganizationsController::class, 'show'])->name('client.posts.show');
	
	Route::get('/organizations/{id}/incomes', [OrganizationsController::class, 'incomes'])->name('client.incomes');
	Route::get('/organizations/{id}/consumptions', [OrganizationsController::class, 'consumptions'])->name('client.consumptions');

	Route::group(['middleware' => 'guest'], function() {
		Route::get('/login', [AuthController::class, 'clientLoginPage'])->name('client.loginPage');
		Route::post('/login', [AuthController::class, 'clientLogin'])->name('client.login');
		Route::get('/register', [AuthController::class, 'registerPage'])->name('client.registerPage');
		Route::post('/register', [AuthController::class, 'register'])->name('client.register');
	});

	Route::group(['middleware' => 'auth'], function() {
		Route::get('/requests/create', [MainController::class, 'requestCreate'])->name('client.requests.create');
		Route::post('/requests/store', [MainController::class, 'requestStore'])->name('client.requests.store');
		Route::post('/requests/{slug}', [MainController::class, 'addFileRequest'])->name('client.requests.addFile');
		Route::delete('/requests/{slug}/file/{id}', [MainController::class, 'destroyFileRequest'])->name('client.requests.destroyFileRequest');
		Route::post('/requests/show/{slug}/comment', [MainController::class, 'storeCommentRequest'])->name('client.requests.comment');
		Route::delete('/requests/show/{slug}/comment/{id}', [MainController::class, 'destroyCommentRequest'])->name('client.requests.comment.destroy');

		Route::get('/organizations/{id}/posts/{slug}/create', [OrganizationsController::class, 'create'])->name('client.posts.create');
		Route::post('/organizations/{id}/posts/{slug}/store', [OrganizationsController::class, 'store'])->name('client.posts.store');
		Route::get('/organizations/{id}/posts/{slug}/edit', [OrganizationsController::class, 'edit'])->name('client.posts.edit');
		Route::put('/organizations/{id}/posts/{slug}/update', [OrganizationsController::class, 'update'])->name('client.posts.update');
		Route::delete('/organizations/{id}/posts/{slug}/delete', [OrganizationsController::class, 'destroy'])->name('client.posts.destroy');
		Route::post('/organizations/{id}/posts/{slug}/add-file', [OrganizationsController::class, 'addFile'])->name('client.posts.addFile');
		Route::delete('/organizations/{id}/posts/{slug}/file/{file_id}', [OrganizationsController::class, 'destroyFile'])->name('client.posts.destroyFile');
		Route::post('/organizations/{id}/posts/{slug}/comment', [OrganizationsController::class, 'comment'])->name('client.posts.comment');
		Route::delete('/organizations/{id}/posts/{slug}/comment/{comment_id}/delete', [OrganizationsController::class, 'commentDelete'])->name('client.posts.comment.destroy');
	});
});

Route::group(['prefix' => 'dashboard', 'middleware'=>'guest'], function() {
	Route::get('/login', [AuthController::class, 'loginPage'])->name('dashboard.loginPage');
	Route::post('/login', [AuthController::class, 'login'])->name('dashboard.login');
});

Route::group(['middleware'=>'auth'], function() {
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['prefix'=>'dashboard', 'namespace'=>'App\Http\Controllers\Admin', 'middleware' => 
'staff'], function(){
	Route::get('/', [AdminController::class, 'index'])->name('dashboard');
	Route::resource('/categories', 'CategoriesController');
	Route::resource('/regions', 'RegionsController');
	Route::resource('/statuses', 'RequestStatusesController');
	Route::get('/requests', [SocialRequestsController::class, 'index'])->name('social_requests.index');
	Route::get('/requests/{id}', [SocialRequestsController::class, 'show'])->name('social_requests.show');
	Route::post('/requests/{id}/add-report', [SocialRequestsController::class, 'addReport'])->name('social_requests.addReport');
	Route::post('/requests/{id}/change-status', [SocialRequestsController::class, 'changeStatus'])->name('social_requests.changeStatus');
	Route::post('/requests/{id}/update-manager', [SocialRequestsController::class, 'updateManager'])->name('social_requests.updateManager');
	Route::delete('/requests/{id}/comment/{comment_id}', [SocialRequestsController::class, 'destroyComment'])->name('social_requests.comment.destroy');
});

Route::group(['prefix'=>'dashboard', 'namespace'=>'App\Http\Controllers\Admin', 'middleware' => 
'admin'], function(){
	Route::resource('/organizations', 'OrganizationsController');
	Route::get('/organizations/{id}/incomes', [AdminOrganizationsController::class, 'incomes'])->name('organizations.incomes');
	Route::get('/organizations/{id}/consumptions', [AdminOrganizationsController::class, 'consumptions'])->name('organizations.consumptions');
	Route::resource('/posts', 'PostsController');
});

Route::group(['prefix'=>'dashboard', 'namespace'=>'App\Http\Controllers\Admin', 'middleware' => 
'org_admin'], function(){
	Route::resource('/users', 'UsersController');
	Route::put('/profile/organization', [AdminController::class, 'updateOrganization'])->name('profile.updateOrganization');
});
