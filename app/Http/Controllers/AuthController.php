<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
        ]);
        // dd($abc);
        return redirect('/login') -> with('success', 'Dang ky thanh cong');
    }
    public function login(Request $request){
        $credentials = $request -> validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) { // dữ liệu nhập từ form
            $user = Auth::user(); // so sánh bên model 
            if ($user->role === 'admin') {
                return redirect('/categories') -> with('success', 'Dang nhap thanh cong');
            }else{
                return redirect('/list') -> with('success', 'Dang nhap thanh cong');
            }
        }
    }
}
