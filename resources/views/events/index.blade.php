@extends('layouts.app')

@section('title', 'Accueil')


@section('content')
<div class="events-container">
    <h1 class="text-center mb-5">
        <span class="gradient-text">Événements à venir</span>
    </h1>

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4 mb-4">
                <div class="event-card">
                    <div class="event-image">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                        <div class="event-date">
                            <span class="day">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                            <span class="month">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                        </div>
                    </div>
                    
                    <div class="event-content">
                        <h3 class="event-title">{{ $event->title }}</h3>
                        <p class="event-description">{{ Str::limit($event->description, 100) }}</p>
                        
                        <div class="event-details">
                            <div class="detail">
                                <i class="fas fa-clock"></i>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('H:i') }}
                            </div>
                            
                            <div class="detail">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $event->location }}
                            </div>
                            
                            <div class="detail">
                                <i class="fas fa-users"></i>
                                {{ $event->max_participants - $event->participants_count() }} places
                            </div>
                        </div>
                        
                        @auth
                            <div class="event-actions">
                                @if(!auth()->user()->events->contains($event))
                                    <form action="{{ route('events.register', $event) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-register">
                                            <i class="fas fa-check-circle"></i> S'inscrire
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('events.unregister', $event) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-unregister">
                                            <i class="fas fa-times-circle"></i> Se désinscrire
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination-container">
        {{ $events->links() }}
    </div>
</div>

<style>
.events-container {
    padding: 2rem;
    background-color: #f8f9fa;
    min-height: 100vh;
}

.gradient-text {
    background: linear-gradient(45deg, #2193b0, #6dd5ed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 2.5rem;
    font-weight: bold;
}

.event-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.event-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.event-card:hover .event-image img {
    transform: scale(1.1);
}

.event-date {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255,255,255,0.9);
    padding: 10px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.event-date .day {
    display: block;
    font-size: 1.5rem;
    font-weight: bold;
    color: #2193b0;
}

.event-date .month {
    display: block;
    font-size: 0.9rem;
    color: #666;
    text-transform: uppercase;
}

.event-content {
    padding: 1.5rem;
}

.event-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
}

.event-description {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.event-details {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    padding: 0.5rem 0;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
}

.detail {
    display: flex;
    align-items: center;
    color: #666;
    font-size: 0.9rem;
}

.detail i {
    margin-right: 5px;
    color: #2193b0;
}

.event-actions {
    text-align: center;
}

.btn-register, .btn-unregister {
    width: 100%;
    padding: 0.8rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-register {
    background: linear-gradient(45deg, #2193b0, #6dd5ed);
    color: white;
}

.btn-register:hover {
    background: linear-gradient(45deg, #1c7a94, #5bbdd5);
}

.btn-unregister {
    background: linear-gradient(45deg, #ff416c, #ff4b2b);
    color: white;
}

.btn-unregister:hover {
    background: linear-gradient(45deg, #e63960, #e64327);
}

.pagination-container {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

/* Animation de chargement des cartes */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.event-card {
    animation: fadeIn 0.6s ease-out forwards;
}

@media (max-width: 768px) {
    .events-container {
        padding: 1rem;
    }
    
    .gradient-text {
        font-size: 2rem;
    }
    
    .event-details {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endsection