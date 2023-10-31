<!-- link-column.blade.php -->
<div class="col-md-8">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->exists('popular') ? '' : 'disabled' }}" href="{{ request()->url() }}">Most
                recent</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->exists('popular') ? 'disabled' : '' }}" href="?popular">Most popular</a>
        </li>
        <form class="form-inline my-2 my-lg-0" method="GET" action="{{ action('App\Http\Controllers\CommunityLinkController@index') }}">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="search" value="{{ request('search') }}">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </ul>
    <a class="titulo" href="/community">Community {{ $channel ? $channel->title : '' }}</a>
    @if (count($links) === 0)
        <p>No approved contributions yet</p>
    @else
        @foreach ($links as $link)
            <li>
                <a href="{{ $link->link }}" target="_blank" class="nombre">
                    {{ $link->title }}
                </a>
                <p>Fecha de creación: {{ $link->created_at->format('d/m/Y H:i:s') }}</p>
                <small>Contributed by: {{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}</small>
                <a class="label label-default" style="background: {{ $link->channel->color }}"
                    class="text-decoration-none" href="/community/{{ $link->channel->slug }}">
                    {{ $link->channel->title }}
                </a>
                
                <span>Count_user:{{ $link->users()->count() }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z"/></svg>
                
            </li>
            <form method="POST" action="/votes/{{ $link->id }}">
                {{ csrf_field() }}
                <button type="submit"
                    class="btn {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-secondary' }}"
                    {{ Auth::guest() ? 'disabled' : '' }}>
                    {{ $link->users()->count() }}
                </button>
            </form>
        @endforeach
    @endif
</div>
