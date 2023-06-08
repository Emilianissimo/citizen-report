<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerPage()
	{
    	return view('auth.register');
	}

	public function register(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'phone' => 'required|unique:users',
			'password' =>'required|confirmed|min:8',
		]);
		$user = User::add($request->all());
		$user->generatePassword($request->get('password'));
		Auth::login($user, true);

		return redirect(route('dasboard.login'));
	}

	public function loginPage()
	{
		return view('auth.login');
	}

	public function login(Request $request)
	{
		$this->validate($request, [
			'phone' => 'required',
			'password' => 'required'
		]);

		$user = User::where('phone', $request->get('phone'))->first();
		
		if ($user && password_verify($request->get('password'), $user->password))
		{
			Auth::login($user, $request->filled('remember'));
			return redirect(route('dashboard'));
		}
		return redirect()->back()->with('status', 'Неправильный Email или пароль');
	}

	public function logout()
	{
		Auth::logout();
		return redirect(route('dashboard.loginPage'));
	}
}
