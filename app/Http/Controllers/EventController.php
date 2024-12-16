<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Notifications\EventReminderNotification;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image',
            'event_date' => 'required|date',
            'location' => 'required',
            'max_participants' => 'required|integer|min:1'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        Event::create($validated);
        return redirect()->route('events.index')->with('success', 'Événement créé avec succès!');
    }

    public function register(Event $event)
    {
        if ($event->participants_count() >= $event->max_participants) {
            return back()->with('error', 'Cet événement est complet.');
        }

        auth()->user()->events()->attach($event);
        return back()->with('success', 'Inscription réussie!');
    }

    public function unregister(Event $event)
    {
        auth()->user()->events()->detach($event);
        return back()->with('success', 'Désinscription réussie!');
    }

    /**
     * Envoie un rappel par email à tous les utilisateurs inscrits à un événement.
     */
    public function sendEventReminder($eventId)
{
    // Récupérer l'événement
    $event = Event::findOrFail($eventId);

    // Récupérer tous les utilisateurs inscrits à cet événement
    $users = $event->users;

    // Envoyer la notification à chaque utilisateur
    foreach ($users as $user) {
        $user->notify(new EventReminderNotification($event)); // Envoi de la notification via Mailgun
    }

    // Retourner une réponse ou rediriger
    return redirect()->back()->with('success', 'Les rappels ont été envoyés avec succès.');
}


    public function show($id)
    {
        // Récupérer l'événement par son ID
        $event = Event::findOrFail($id);

        // Retourner la vue avec l'événement
        return view('events.show', compact('event'));
    }
}