<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use Illuminate\Auth\RequestGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $token = $user->createToken('my-app-token')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];

            // Redirect after successful login
            return view('users.profile', compact('user'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request){
        Log::info('Attempting to logout user.');
        auth()->guard('web')->logout();
        Log::info('User logged out.');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
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
        $user = Auth::user();
        Log::info($user);
        return view('users.profile', compact('user'));
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

    public function index()
    {
        $users = User::all() ?? [];
        return view('users.index',['users' => $users]);
    }




    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:user,admin,trainer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,]);

        return response()->json(['message'=>'User created successfully'],201);
    }


    public function edit(User $user)
    {

       return view("users.edit",['user'=> $user]);
    }


    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'message' => 'nullable|string',
            'role' => 'required|string|in:user,admin,trainer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'message' => $request->message,
            'role' => $request->role,
        ]);

        return redirect('/users');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users');
    }


}
