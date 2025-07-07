<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function ShowLoginForm(){
        return view('login');
    }
    public function login(Request $request){
        // Validasi input, termasuk reCAPTCHA
        $credentials = $request->validate([
            'name'     => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => ['required', function ($attribute, $value, $fail) {
                $secretKey = config('services.recaptcha.secret_key');
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $secretKey,
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ]);
                if (!$response->json('success')) {
                    $fail('Validasi reCAPTCHA gagal. Silakan coba lagi.');
                }
            }],
        ]);

        // Coba login hanya dengan 'name' dan 'password' setelah reCAPTCHA valid
        if (Auth::attempt(['name' => $credentials['name'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('admin/dashboard'); // Gunakan intended() untuk fleksibilitas
            } elseif ($user->role === 'user') {
                return redirect()->intended('user/dashboard');
            }
            // Fallback jika role tidak terdefinisi, arahkan ke default dashboard atau home
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'name' => 'Username atau password salah.',
        ])->withInput($request->except('password')); // Kembalikan input kecuali password
    }


    public function ShowRegister(){
        return view('register');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return redirect('login')
            ->with('success', 'Registrasi berhasil!');
        }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
