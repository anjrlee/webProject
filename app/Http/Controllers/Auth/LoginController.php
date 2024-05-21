<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Psw;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => '登入失敗，user'], 401);
        }

        // Find the hashed password in the psw table
        $psw = Psw::where('user_id', $user->id)->first();

        if (!$psw) {
            return response()->json(['message' => '登入失敗，psw'], 401);
        }

        // Check if the provided password matches the hashed password
        if (Hash::check($request->password, $psw->password)) {
            Auth::login($user);
            return response()->json([
                'message' => '登入成功',
                'user' => $user,
                'redirect' => $this->redirectPath() // 添加重定向 URL
            ], 200);

        } else {
            // Password did not match
            return response()->json(['message' => '登入失敗，password mismatch'], 401);
        }

    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => '登出成功'], 200);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function redirectPath()
    {
        return $this->redirectTo;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
