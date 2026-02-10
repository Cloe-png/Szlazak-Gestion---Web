<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('settings.password');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate(
            [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
                'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            ]
        );

        $request->user()->update([
            'mot_de_passe' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'Mot de passe mis à jour.');
    }
}
