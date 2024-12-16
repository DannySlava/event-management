@extends('layouts.app')

@section('title', 'Créer un événement')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="create-event-card">
            <div class="card-header">
                <i class="fas fa-calendar-plus"></i> Créer un nouvel événement
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="form-label">Titre de l'événement</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Image de l'événement</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="event_date" class="form-label">Date et heure de l'événement</label>
                        <input type="datetime-local" class="form-control @error('event_date') is-invalid @enderror" id="event_date" name="event_date" value="{{ old('event_date') }}" required>
                        @error('event_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="location" class="form-label">Lieu</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="max_participants" class="form-label">Nombre maximum de participants</label>
                        <input type="number" class="form-control @error('max_participants') is-invalid @enderror" id="max_participants" name="max_participants" value="{{ old('max_participants') }}" required>
                        @error('max_participants')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save"></i> Créer l'événement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>
.create-event-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-top: 2rem;
}

.card-header {
    background: linear-gradient(45deg, #2193b0, #6dd5ed);
    color: white;
    padding: 1.5rem;
    font-size: 1.2rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.card-body {
    padding: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.input-group {
    border: 1px solid #dee2e6;
    border-radius: 10px;
    overflow: hidden;
}

.input-group-text {
    background: white;
    border: none;
    color: #2193b0;
    padding: 0.75rem;
}

.form-control {
    border: none;
    padding: 0.75rem;
    font-size: 1rem;
}

.form-control:focus {
    box-shadow: none;
    border-color: #2193b0;
}

textarea.form-control {
    min-height: 100px;
    resize: vertical;
}

.submit-btn {
    background: linear-gradient(45deg, #2193b0, #6dd5ed);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 25px;
    width: 100%;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(33, 147, 176, 0.3);
}

@media (max-width: 768px) {
    .create-event-card {
        margin: 1rem;
    }
    
    .card-body {
        padding: 1rem;
    }
}
</style>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            if (preview) {
                preview.src = e.target.result;
            }
        }
        reader.readAsDataURL(file);
    }
});
</script>

@endsection
