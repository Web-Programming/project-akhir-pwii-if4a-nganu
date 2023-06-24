<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\admin;
use App\Models\TbImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function home(){
        if (!Auth::check()) {
            return redirect()->route('awal');
        }
        return view("imagic")->with(['username'=>Auth::user()->username,'id'=>Auth::user()->id]);
    }
    public function admindashboard()
    {
    if (!Auth::guard('admin')->check()) {
        return redirect()->route('auth.loginadmin');
    }

    $users = User::all(); // Retrieve all user records

    return view("imagicAdmin")->with([
        'username' => Auth::guard('admin')->user()->username,
        'id' => Auth::guard('admin')->user()->id,
        'users' => $users,
    ]);
    }

    public function hapusAkun(Request $request, $nama)
    {
        $user = User::where('username', $nama)->first();

        if ($user) {
             // Delete tb_images table
             TbImage::where('id_user', $user->id)->delete();

            // Delete the user account
            $user->delete();
            return redirect()->back()->with('success', 'User account deleted successfully.');
        }

        return redirect()->back()->with('error', 'User account not found.');
    }


    
    public function profile(){
        $result = DB::select("SELECT tb_images.nama FROM tb_images WHERE tb_images.id_user =" . Auth::user()->id);
        $jmlhConvert = count($result);
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        return view("profile")->with(['username'=>Auth::user()->username,'id'=>Auth::user()->id,'jmlhConvert' => $jmlhConvert]);
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
        $result = DB::select("SELECT tb_images.nama FROM tb_images WHERE tb_images.id_user =" . Auth::user()->id);

        if (!Auth::check()) {
            return redirect()->route('home');
        }

        return view('converter.dashboard')->with([
            'username' => Auth::user()->username,
            'id' => Auth::user()->id,
            'gambarNya' => $result
        
         ]);
    }

    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function showChangePasswordForm()
    {
        return view('changepassword')->with('username', Auth::user()->username);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            Auth::logout();

            return redirect()->route('login')->with('success', 'Password changed successfully. Please login with your new password.');
        } else {
            return redirect()->back()->withErrors('Current password is incorrect.');
        }
    }

    //admin
    public function showLoginadminForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admindashboard');
        }
        return view('auth.loginadmin');
    }

    public function loginadmin(Request $request)
    {
        $credentials = $request->only('username', 'password');
    
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admindashboard'); // Mengarahkan ke route admindashboard setelah login admin berhasil
        } else {
            return redirect()->back()->withErrors('Username or password is incorrect');
        }
    }
    

    public function showRegistrationadminForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.registeradmin');
    }

    public function registeradmin(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('loginadmin')->with('success', 'Registration successful! Please login.');
    }
}