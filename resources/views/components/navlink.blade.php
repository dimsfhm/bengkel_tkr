@props([
    'href' => '',
])

<a href="{{ route($href) }}"
    class="nav-link {{ request()->routeIs($href) ? 'text-white fw-semibold border-bottom' : 'text-body-tertiary' }}">
    {{ $slot }}

</a>
