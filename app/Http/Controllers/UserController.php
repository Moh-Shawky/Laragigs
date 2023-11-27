<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function store()
    {
        $ValidData = request()->validate([
            'name' => 'required',
            'email' => ['required','email', Rule::unique('users', 'email')],
            'password' => ['confirmed','required']
        ]);
        $ValidData['password'] = Hash::make($ValidData['password']);
        if(User::create($ValidData)){
            return redirect()->route('login')->with('message','Account has been created succssefully');
        }
    }
    public function login()
    {
        return view('login');
    }
    public function auth(){
        $ValidData = request()->validate([
            'email'=>['required','email'],
            'password'=>'required'
        ]);
        if(auth()->attempt($ValidData)){
            request()->session()->regenerate();
            return redirect()->route('home')->with(',message','You have been loged in successfully');
        }
        return back()->withErrors(['email'=>'Invalid creditional'])->onlyInput('email');

    }
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
