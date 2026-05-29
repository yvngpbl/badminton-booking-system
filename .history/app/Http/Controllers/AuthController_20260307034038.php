<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

public function loginForm()
{
return view('auth.login');
}

public function registerForm()
{
return view('auth.register');
}

public function register(Request $request)
{

User::create([
'name'=>$request->name,
'email'=>$request->email,
'password'=>Hash::make($request->password),
'role'=>'user'
]);

return redirect('/login');

}

public function login(Request $request)
{

if(Auth::attempt($request->only('email','password')))
$request->session()->regenerate()
{

if(auth()->user()->role == 'admin'){
return redirect('/admin/dashboard');
}

return redirect('/dashboard');

}

return back()->with('error','Login gagal');

}

public function logout()
{

Auth::logout();
return redirect('/login');

}

}
