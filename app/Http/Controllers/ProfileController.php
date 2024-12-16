<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
{
    $user = auth()->user();

    // Validation des données
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'bio' => 'nullable|string|max:500',
         'avatar' => 'nullable|image|max:10240'
    ]);

    // Mise à jour des données utilisateur
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->bio = $validated['bio'] ?? $user->bio;

    // Gestion de l'upload de l'avatar
    if ($request->hasFile('avatar')) {
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        // Enregistrer le nouvel avatar
        $user->avatar = $request->file('avatar')->store('avatars', 'public');
    }

    // Sauvegarder l'utilisateur
    $user->save();

    // Rediriger avec un message de succès
    return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès.');
}

    public function edit()
{
    $user = auth()->user(); // Récupère l'utilisateur connecté
    return view('profile.edit', compact('user'));
}
}
