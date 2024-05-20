<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Psw;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
            'department' => 'required|string|max:50', // Validate department
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department' => $request->department, // Save department
        ]);

        // Save hashed password to psw table
        Psw::create([
            'user_id' => $user->id,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => '後端註冊成功'], 201);
    }

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'department' => $data['department'], // Save department
        ]);

        // Save hashed password to psw table
        Psw::create([
            'user_id' => $user->id,
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }
}
