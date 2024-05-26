<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserProfile($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['name' => $user->name]);
    }
}
