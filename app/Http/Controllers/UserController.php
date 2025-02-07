<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return  view('home', compact('users'));        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'pass' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => "agent",
            'password' =>Hash::make($request->pass), // Secure password storage
        ]);
        return redirect()->route('user.all')->with('success', 'User Insert successfully');
        // return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }
    public function newpassword(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',  // Ensure the user exists
            'new_pass' => 'required', // Ensure the new password is valid
        ]);
    
        $user = User::findOrFail($request->user_id); // Find user by ID
    
        // Update password securely
        $user->password = Hash::make($request->new_pass);
        $user->save();
    
        return redirect()->route('user.all')->with('success', 'Password updated successfully');
    

    }
    
    public function getuser()
    {
        $users = User::all();
        return response()->json($users);
    }
    public function showLoginForm()
    {
         return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

    //   dd($user,$request->email);
        if ( password_verify($request->password,$user->password)) {
            Auth::login($user);
            // $request->session()->regenerate();
            session([
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'role' => Auth::user()->role, // Ensure your User model has a 'role' column
            ]);
            session(['user_id' => $user->id]);
            return view('dash');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');

       
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->forget('user_id');
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
