<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(protected ApiService $api) {}

    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $response = $this->api->login($request->email, $request->password);

        if (!$response->successful()) {
            $message = $response->json('message') ?? 'Login gagal.';
            return back()->withErrors(['email' => $message])->withInput();
        }

        $data = $response->json('data');

        session([
            'api_token' => $data['token'],
            'user'      => $data['user'],
            'role'      => $data['role'],
        ]);

        // Redirect sesuai role
        return match ($data['role']) {
            'superadmin' => redirect()->route('superadmin.dashboard'),
            'admin'      => redirect()->route('admin.checkin'),
            default      => redirect()->route('login'),
        };
    }

    public function logout(Request $request)
    {
        $token = session('api_token');

        if ($token) {
            $this->api->logout($token); // Hapus token di Sistem A
        }

        $request->session()->flush(); // Hapus semua session di Sistem B

        return redirect()->route('login');
    }
}
