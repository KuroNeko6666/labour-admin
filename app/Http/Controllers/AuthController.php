<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AuthController extends Controller
{
    public function viewlogin(){
        return view('auth.login', [
            'title' => 'Labour',
        ]);
    }

    public function viewRegister(){
        return view('auth.register', [
            'title' => 'Labour',
        ]);
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(auth()->attempt($validated)){
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Gagal login');
    }

    public function logout(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|max:255',
            'password' => 'required|max:255|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Admin::create($validated);
        return redirect()->route('login')->with('message', 'Akun berhasil didaftarkan');
    }


}
