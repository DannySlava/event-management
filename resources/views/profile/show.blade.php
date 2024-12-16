@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="profile-avatar-container">
            @if($user->avatar)
                <img src="{{ Storage::url($user->avatar) }}" alt="Avatar de {{ $user->name }}" class="profile-avatar">
            @else
                <div class="profile-avatar-placeholder">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
            @endif
            
            @if(auth()->id() === $user->id)
                <a href="{{ route('profile.edit') }}" class="edit-profile-btn" title="Modifier le profil">
                    <i class="fas fa-edit"></i>
                </a>
            @endif
        </div>

        <h1 class="profile-name">{{ $user->name }}</h1>
        
        <div class="profile-info">
            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <span>{{ $user->email }}</span>
            </div>
            
            @if($user->is_admin)
        <div class="admin-badge">
            <i class="fas fa-crown"></i>
            Administrateur
        </div>
        @else
            <div class="user-badge">
                <i class="fas fa-user"></i>
                Membre
            </div>
        @endif
        </div>

        <div class="profile-bio">
            <i class="fas fa-quote-left"></i>
            <p>{{ $user->bio ?? 'Aucune bio définie.' }}</p>
            <i class="fas fa-quote-right"></i>
        </div>
    </div>

    <div class="events-section">
        <h2>
            <i class="fas fa-calendar-check"></i>
            Mes événements
        </h2>
        
        @if(auth()->user()->events->count() > 0)
            <div class="events-grid">
                @foreach(auth()->user()->events as $event)
                    <div class="event-card">
                        <div class="event-image">
                            @if($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}">
                            @endif
                            <div class="event-date">
                                <span class="day">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                                <span class="month">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                            </div>
                        </div>
                        <div class="event-details">
                            <h3>{{ $event->title }}</h3>
                            <p>
                                <i class="far fa-clock"></i>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('H:i') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-events">
                <i class="far fa-calendar-times"></i>
                <p>Vous n'êtes inscrit à aucun événement.</p>
                <a href="{{ route('events.index') }}" class="browse-events-btn">Découvrir les événements</a>
            </div>
        @endif
    </div>
    

</div>

<style>
.profile-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    background-color: #f8f9fa;
    min-height: 100vh;
}

.profile-header {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.profile-avatar-container {
    position: relative;
    width: 150px;
    height: 150px;
    margin: 0 auto 1.5rem;
}

.profile-avatar, .profile-avatar-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.profile-avatar-placeholder {
    background: linear-gradient(45deg, #2193b0, #6dd5ed);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: bold;
}

.edit-profile-btn {
    position: absolute;
    bottom: 0;
    right: 0;
    background: white;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    color: #2193b0;
    transition: all 0.3s ease;
}

.edit-profile-btn:hover {
    transform: scale(1.1);
    color: #1c7a94;
}

.profile-name {
    font-size: 2rem;
    color: #333;
    margin-bottom: 1rem;
}

.profile-info {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 1.5rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #666;
}

.user-badge {
    background: linear-gradient(45deg, #3498db, #2ecc71);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: bold;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.admin-badge {
    background: linear-gradient(45deg, #FFD700, #FFA500);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: bold;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.profile-bio {
    position: relative;
    padding: 1.5rem;
    color: #666;
    font-style: italic;
    max-width: 600px;
    margin: 0 auto;
}

.profile-bio i {
    color: #2193b0;
    opacity: 0.3;
}

.profile-bio .fa-quote-left {
    position: absolute;
    top: 0;
    left: 0;
}

.profile-bio .fa-quote-right {
    position: absolute;
    bottom: 0;
    right: 0;
}

.events-section {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.events-section h2 {
    color: #333;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
}

.event-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.event-card:hover {
    transform: translateY(-5px);
}

.event-image {
    position: relative;
    height: 150px;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.event-date {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255,255,255,0.9);
    padding: 0.5rem;
    border-radius: 8px;
    text-align: center;
}

.event-date .day {
    display: block;
    font-size: 1.2rem;
    font-weight: bold;
    color: #2193b0;
}

.event-date .month {
    font-size: 0.8rem;
    color: #666;
    text-transform: uppercase;
}

.event-details {
    padding: 1rem;
}

.event-details h3 {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    color: #333;
}

.event-details p {
    color: #666;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.no-events {
    text-align: center;
    padding: 3rem;
    color: #666;
}

.no-events i {
    font-size: 4rem;
    color: #2193b0;
    margin-bottom: 1rem;
}

.browse-events-btn {
    display: inline-block;
    margin-top: 1rem;
    padding: 0.8rem 1.5rem;
    background: linear-gradient(45deg, #2193b0, #6dd5ed);
    color: white;
    border-radius: 25px;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.browse-events-btn:hover {
    transform: scale(1.05);
    color: white;
}

@media (max-width: 768px) {
    .profile-container {
        padding: 1rem;
    }
    
    .profile-info {
        flex-direction: column;
        gap: 1rem;
    }
    
    .events-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection