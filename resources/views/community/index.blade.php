@extends('layouts.app')


@section('content')
    <div class="container">
        @include('flash-message')
        <div class="row">
            {{-- Columna de enlaces (partial) --}}
            @include('community.link-column')

            {{-- Columna de formulario para añadir enlaces (partial) --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Contribute a link</h3>
                    </div>
                    <div class="card-body">
                        @include('community.add-link')
                    </div>
                </div>
            </div>
        </div>
        {{ $links->links() }}
    </div>
@stop
