<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Http\Controllers\GenClass;

class AuthUserController extends Controller
{
	
    public function create(){
	return view('/register', ['title' => 'Register', 'page_slug'=>'register']);	
	}
	
    public function store(Request $request){
	$formFields = $request->validate([
	'name' => ['required', 'min:3'],
	'email' => ['required', 'email', Rule::unique('users', 'email')],
	'password' => 'required|confirmed|min:5'
	]);	
	$formFields['password'] = bcrypt($formFields['password']);
	$user = User::create($formFields);
	auth()->login($user);
	return redirect('/' . GenClass::$admin)->with('success', 'Account created and logged in successfully.');
	}
	
	public function login(Request $request){
	$formFields = $request->validate([
	'email' => ['required', 'email'],
	'password' => 'required'
	]);	
	if(auth()->attempt($formFields)){
	$request->session()->regenerate();
	return redirect('/' . GenClass::$admin);
	}
	return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
	}
	
	public function logout(Request $request){
	auth()->logout();
	$request->session()->invalidate();
	$request->session()->regenerateToken();
	return redirect('/login')->with('success', 'You have been logged out!');	
	}

}
