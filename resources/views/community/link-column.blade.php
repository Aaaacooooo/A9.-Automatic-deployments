<!-- link-column.blade.php -->
<div class="col-md-8">
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
                <a class="label label-default" style="background: {{ $link->channel->color }}" class="text-decoration-none"
                    href="/community/{{ $link->channel->slug }}">
                    {{ $link->channel->title }}
                </a>
                <a>Count_user:{{ $link->users()->count() }}</a>
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
