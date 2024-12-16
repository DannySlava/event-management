@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="profile-edit-card">
            <div class="card-header">
                <i class="fas fa-sign-in-alt"></i>
                Connexion
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Se connecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.profile-edit-card {
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
    .profile-edit-card {
        margin: 1rem;
    }
    
    .card-body {
        padding: 1rem;
    }
}
</style>

@endsection
