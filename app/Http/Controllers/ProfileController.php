<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request){
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            Log::error('User not authenticated.');
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        Log::info('Authenticated user:', ['user' => $user]);
        Log::info('Request data:', $request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|max:20',
            'gender' => 'required|string',
            'department' => 'required|string|max:50',
            'grade' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->update($validatedData);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user,
            'code' => 200
        ]);

    }
}
