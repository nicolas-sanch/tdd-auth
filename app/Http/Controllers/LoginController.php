<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([                                // On utilise la fonction validate() pour vérifier les valeurs des identitfiants
            'email' => 'required|email|exists:users'        // $request->email doit être au format "email" et doit être présent en bdd et ne peut pas être vide sinon retourne Exception
        ]);
        
        $user = User::whereEmail($request->email)->first();

        Auth::login($user);
        return redirect('/dashboard');
    }
}
