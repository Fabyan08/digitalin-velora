<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }

        // Use withErrors method to attach the error messages to the validator instance
        return redirect("login")->withErrors([
            'email' => 'Email address or password is incorrect.',
        ]);
    }

    public function customLogin_api(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first(); //ambil data pengguna berdasarkan email
        $token = DB::table('users')->select('users.token')
            ->where('email', $email)->first();

        if (Hash::check($password, $user->password)) { //password disandingkan apakah match
            // sendsms();
            return response()->json([
                'pesan' => 'Login Berhasil',
                'token' => $user->token, //ini sudah ada di dalam data
                'data' => $user
            ]);
        } else {
            return response()->json([
                'pesan' => 'Email tidak ditemukan',
                'data' => ''
            ]);
        }
    }


    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $token = Hash::make(Str::random(80));

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token' => $token

        ]);

        // Automatically log in the newly registered user
        Auth::login($user);

        return redirect("dashboard")->withSuccess('You have registered successfully');
    }

    public function customRegistration_api(Request $request)
    {
        $token = Str::random(80);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token' => $token
        ]);

        $otp = mt_rand(10000, 999999);

        if ($user) {
            Auth::login($user);

            return response()->json([
                'pesan' => 'Data berhasil disimpan',
                'status' => 200,
                'data' => $user,
                'otp' => $otp,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'pesan' => 'Gagal menyimpan data',
                'status' => 500,
            ], 500);
        }
    }


    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
    public function logout_api()
    {
        Auth::logout();

        // If you're using stateful authentication with Sanctum,
        // you may also want to revoke the user's tokens.
        // Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
