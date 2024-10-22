<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fileds = $request->validate([
            'email' => ['required', 'min:3', 'max:1000', 'email', Rule::unique('users', 'email')],
            'name' => ['required', Rule::unique('users', 'name')],
            'password' => 'required'
        ]);
        $fileds['password'] = bcrypt($fileds['password']);
        $user =  User::create($fileds);
        auth()->login($user);
        return redirect('/');
    }
    public function login(Request $request)
    {
        $fileds = $request->validate([

            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['name' => $fileds['loginname'], 'password' => $fileds['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }
    public function logout()
    {

        auth()->logout();
        return redirect('/');
    }
}
