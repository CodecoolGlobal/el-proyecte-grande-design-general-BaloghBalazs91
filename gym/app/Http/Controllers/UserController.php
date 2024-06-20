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
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $user->createToken('my-app-token')->plainTextToken;

            return view('users.profile', compact('user'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request){
        Auth::logout();

        return redirect('/');
    }

    public function  registerTrainee(Request $request)
    {
        // Validate the incoming request data
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "user"
        ]);

        return view('home');
    }


    public function profile()
    {
        $user = Auth::user();
        Log::info($user);
        if(Auth::check()){
        return view('users.profile', compact('user'));
        }
        return response()->json(['message'=>"Unauthorized"],401);
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
        if($request->old_password){
            if(!Hash::check($request->old_password, $user->password)){
                return response()->json(['message'=>'Old password is incorrect'],401);
            }
            if($request->new_password1===$request->new_password2){
            $user->password = Hash::make($request->new_password1);
            }else{
                return response()->json(['message'=>'New Passwords do not match'],401);
            }
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            //'password' => $request->password ? Hash::make($request->password) : $user->password,
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
