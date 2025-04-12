<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        return response()->json(User::all()); // lấy ra tất cả dạng mảng json
    }
    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $user = User::where('email',$fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user -> password)) {
            return response() -> json([
                'message' => "loiiii"
            ],401);
        }
        $token = $user -> createToken('eventoryapp') -> plainTextToken;
        return response() -> json([
            'token' => $token,
            'user' => $user
        ], 200);
    }
    public function register(Request $request){
        $validator = Validator::make($request -> all(),[
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('eventoryapp')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
        ], 201);
    }
}
