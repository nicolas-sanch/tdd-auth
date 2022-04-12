<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([                                    // On utilise la fonction validate() pour vérifier les valeurs des identitfiants
            'email' => 'required|email|exists:users',           // $request->email doit être au format "email" et doit être présent en bdd et ne peut pas être vide sinon retourne Exception
            'password' => 'required'
        ]);
        
        $user = User::whereEmail($request->email)->first();

        if(! Hash::check($request->password, $user->password)) {    // Si le mot de passe envoyé et le mot de passe en bdd ne correspondent pas :
            throw ValidationException::withMessages([               // On soulève une exception
                 'email' => 'Vos informations ne correspondent pas à notre base de données'
             ]);
         }
        Auth::login($user);
        return redirect('/dashboard');
    }
}
