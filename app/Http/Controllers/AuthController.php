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
		$phone = str_replace(
			['(',')','-',' '],
			'',
			$request->get('phone')
		);
		try{
			$user = User::add([
				'name' => $request->get('name'),
				'phone' => $phone
			]);
	
			$user->generatePassword($request->get('password'));
			Auth::login($user, true);
		}catch (\Exception $e){
			return redirect()->back()->with('status', '');
		}

		return redirect()->route('client.index', app()->getLocale());
	}

	public function clientLoginPage()
	{
		return view('auth.clientLogin');
	}

	public function clientLogin(Request $request)
	{
		$this->validate($request, [
			'phone' => 'required',
			'password' => 'required'
		]);

		$phone = str_replace(
			['(',')','-',' '],
			'',
			$request->get('phone')
		);

		$user = User::where('phone', $phone)->first();

		if ($user && password_verify($request->get('password'), $user->password))
		{
			Auth::login($user, $request->filled('remember'));
			return redirect()->route('client.index', app()->getLocale());
		}
		return redirect()->back()->with('status', 'Неправильный телефон или пароль');
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
		return redirect()->back()->with('status', 'Неправильный телефон или пароль');
	}

	public function logout()
	{
		Auth::logout();
		return redirect(route('client.loginPage', app()->getLocale()));
	}
}
