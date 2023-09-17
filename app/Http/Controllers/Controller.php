<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        return view('welcome');
    }

    ////////////////// the basic authentication ///////////////
    public function showLoginForm()
    {
        return view('basicAuthentication.login');
    }

    public function showRegisterForm()
    {
        return view('basicAuthentication.register');
    }

    public function login(LoginRequest $request)
    {
        $userToken = Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'));

        if ($userToken) {
            $data = Auth::user();
            $request->session()->put('data', $data);
            return redirect('/products')->with('success', "Account successfully registered.");
        } else {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['error' => 'wrong email or password']);
        }

    }
    function register(RegisterRequest $request)
    {
        $pwd = Hash::make($request->password);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pwd
        ]);

        auth()->login($user);
        return redirect()->route('products.index')->with('success', "Account successfully registered.");
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }

}