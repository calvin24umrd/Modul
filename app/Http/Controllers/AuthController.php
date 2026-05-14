<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view("auth.login");
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->isAdmin()) {
                return redirect()->route("admin.dashboard");
            }

            return redirect()->intended("/dashboard");
        }

        return back()->with("error", "Email atau password salah.");
    }

    // Tampilkan form register
    public function showRegister()
    {
        return view("auth.register");
    }

    // Proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6|confirmed",
            "alamat" => "required|string",
            "no_telepon" => "required|string|max:20",
        ]);

        $user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
            "alamat" => $validated["alamat"],
            "no_telepon" => $validated["no_telepon"],
            "role" => "user",
        ]);

        Auth::login($user);

        return redirect()->route("dashboard")->with("success", "Registrasi berhasil! Selamat datang, " . $user->name);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/")->with("success", "Anda telah logout.");
    }

    // Dashboard user
    public function dashboard()
    {
        $user = Auth::user();
        $orders = $user->orders()->with("items")->latest()->take(5)->get();

        return view("user.dashboard", compact("user", "orders"));
    }

    // Edit profil
    public function editProfile()
    {
        $user = Auth::user();
        return view("user.profile", compact("user"));
    }

    // Update profil
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "alamat" => "required|string",
            "no_telepon" => "required|string|max:20",
        ]);

        $user = Auth::user();
        $user->update($validated);

        return back()->with("success", "Profil berhasil diperbarui.");
    }
}
