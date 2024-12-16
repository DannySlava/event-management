@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="profile-edit-card">
            <div class="card-header">
                <i class="fas fa-user-edit"></i>
                Mon Profil
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="avatar-upload">
                        <div class="avatar-preview">
                            @if(auth()->user()->avatar)
                                <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar" id="avatarPreview">
                            @else
                                <div class="avatar-placeholder">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div class="avatar-edit">
                            <label for="avatar" class="upload-btn">
                                <i class="fas fa-camera"></i>
                                Changer la photo
                            </label>
                            <input type="file" class="form-control" id="avatar" name="avatar" hidden>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-pen"></i>
                            </span>
                            <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Parlez-nous de vous...">{{ auth()->user()->bio }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save"></i>
                        Sauvegarder les modifications
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


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

.avatar-upload {
    text-align: center;
    margin-bottom: 2rem;
}

.avatar-preview {
    width: 150px;
    height: 150px;
    margin: 0 auto 1rem;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.avatar-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, #2193b0, #6dd5ed);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: bold;
}

.upload-btn {
    background: #f8f9fa;
    color: #2193b0;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.upload-btn:hover {
    background: #e9ecef;
    transform: translateY(-2px);
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
    .profile-edit-card {
        margin: 1rem;
    }
    
    .card-body {
        padding: 1rem;
    }
}
</style>

<script>
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatarPreview');
            if (preview) {
                preview.src = e.target.result;
            } else {
                const avatarPreview = document.querySelector('.avatar-preview');
                avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Avatar" id="avatarPreview">`;
            }
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection

