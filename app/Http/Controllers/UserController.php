<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Exception;

class UserController extends Controller
{
    public function register(Request $request) {
        
        try {
            $fields = $request->validate(
                [
                    'username' => 'required|string',
                    'email' => 'required|string|unique:users,email',
                    'password' => 'required|string|confirmed'
                ]
            );
        } catch (exception $e) {
            return response(['message'=>'Invalid User Criteria'], 400);
        }

        try {
            $user = User::create([
                'username' => $fields['name'],
                'email' => $fields['email'],
                'password' => Hash::make($fields['password'])
            ]);
        } catch (exception $e) {
            return response(['message' => 'User could not be created'], 400);
        };

        return response(['user' => $user]);
    }

    public function login(Request $request) {
        try {
            $fields = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string'
            ]);
        } catch(Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }

        try {
            $user = User::where('username', $fields['username'])->first();
        } catch(Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Username or password does not match what we have on record'], 401);
        }

        $token = $user->createToken('cavemanDFSNyBXP')->plainTextToken;

        return response(['user' => $user, 'token' => $token]);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return response(['message' => 'User Logged Out']);
    }

}
