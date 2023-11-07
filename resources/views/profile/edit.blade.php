@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/profile/store" method="POST" id="updateImage" enctype="multipart/form-data">
                            @csrf

                            <!-- Campo para subir la imagen del perfil -->
                            <div class="mb-3">
                                <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
                                <input type="file" class="form-control" id="profile_image" name="imageUpload"
                                    accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>

                            @if ($profile->imageUpload)
                                <img src="{{ asset('storage/' . $profile->imageUpload) }}" alt="Perfil del usuario"
                                    style="max-width: 300px; height: auto; padding: 20px;">
                            @endif

                        </form>
                        @error('imageUpload')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
