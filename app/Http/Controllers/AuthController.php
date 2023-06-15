<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function home(){
        if (!Auth::check()) {
            return redirect()->route('awal');
        }
        return view("imagic")->with(['username'=>Auth::user()->username,'id'=>Auth::user()->id]);
    }
    
    public function awal(){
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view("imagic2");
    }


    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('id','username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors('Username atau password salah');
        }
    }

    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }


    public function dashboard()
    {
        $result = DB::select("select tb_images.nama from tb_images where tb_images.id_user =" . Auth::user()->id);

        if (!Auth::check()) {
            return redirect()->route('home');
        }
        return view('converter.index')->with(['username'=>Auth::user()->username,'id'=>Auth::user()->id, 'gambarNya' => $result]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

}
