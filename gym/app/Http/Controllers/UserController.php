<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        Log::info($request);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return view('user.profile',['user'=>$user]);
    }

    public function  registerTrainee(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "trainee"
        ]);

        return view('home');
    }


    public function profile(Request $request)
    {
        $user = $request->user();
        return response()->json(['message' => `user:{$user->name}`],200);
    }

    public function profileData()
    {
        if(Auth::check()){
            $user = Auth::user();
            Log::info($user);
            return response()->json($user,200);
        }else{
            return response()->json(['message'=>"Unauthorized"],401);
        }
    }

}
