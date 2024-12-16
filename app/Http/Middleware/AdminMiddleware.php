<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Log information pour vérifier l'utilisateur connecté et son statut admin
        \Log::info('AdminMiddleware', [
            'Utilisateur connecté' => auth()->check(),
            'ID Utilisateur' => auth()->id(),
            'Est admin' => auth()->user() ? auth()->user()->is_admin : 'Non connecté',
            'Type is_admin' => auth()->user() ? gettype(auth()->user()->is_admin) : 'Non connecté'
        ]);

        \Log::info('Utilisateur connecté', ['user' => auth()->user()]);


        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            // Rediriger vers la page de login si non authentifié
            return redirect()->route('login');
        }

        // Vérifier si l'utilisateur est un administrateur
        if (!auth()->user()->is_admin) {
            // Rediriger vers la page d'accueil si l'utilisateur n'est pas un administrateur
            return redirect()->route('home')->with('error', 'Accès non autorisé');
        }

        // Continuer avec la requête si tout est ok
        return $next($request);
    }
}
