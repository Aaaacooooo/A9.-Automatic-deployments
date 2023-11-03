@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    <form action="/profile/store" method="POST" id="updateImage" enctype="multipart/form-data">
                        @csrf

                        <!-- Campo para subir la imagen del perfil -->
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
                            <input type="file" class="form-control" id="profile_image" name="imageUpload" accept="image/*">
                        </div>                        

                        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
