<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password as RulesPassword;

class AuthController extends Controller
{
    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()]
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>Hash::make($data['password'])
        ]);

        $token = $user->createToken('user-token')->plainTextToken;

        $response = [
            'user' => $user, 
            'token' => $token
        ];

        // This event is linked to the SendEmailVerificationNotification listener at the EventServiceProvider and triggers the email verification
        event(new Registered($user));

        return response($response, 201);
    }

    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|email|max:191',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $data['email'])->first();

        if(!$user || !Hash::check($data['password'], $user->password)) {
            return response(['message'=>'Invalid Credentials'], 401);
        }
        else {
            $token = $user->createToken('user-token-login')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 200);
        }
    }

    public function logout() {
        // DEV Dá erro mas é culpa do intelephense
        auth()->user()->tokens()->delete();
        return response(['message'=>'Logged Out Successfully']);
    }

}
