<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Session::has('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Credentials simples pour l'admin (à améliorer avec Hash en production)
        if ($request->username === 'admin' && $request->password === 'admin123') {
            Session::put('admin_authenticated', true);
            Session::put('admin_username', $request->username);
            
            return redirect()->route('admin.dashboard')->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'username' => 'Identifiants incorrects.',
        ])->withInput($request->only('username'));
    }

    public function logout()
    {
        Session::forget('admin_authenticated');
        Session::forget('admin_username');
        
        return redirect()->route('admin.login')->with('success', 'Déconnexion réussie.');
    }
}
