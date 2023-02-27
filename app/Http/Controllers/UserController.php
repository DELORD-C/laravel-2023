<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view('user.login');
    }

    public function auth (Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                ->with(['Success' => 'Successfully Signed In.']);
        }

        return redirect('login')->withErrors('Login details are not valid');
    }

    public function register()
    {
        return view('user.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $this->create($data);

        return redirect('/')->with(['Success' => 'You have signed-in.']);
    }

    public function create(array $data)
    {
//        $user = new User([
//           'name' => $data['name'],
//           'email' => $data['email'],
//           'password' => Hash::make($data['password'])
//        ]);
//        $user->save();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}