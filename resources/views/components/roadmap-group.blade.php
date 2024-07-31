@props(['image', 'title', 'time', 'location' => '', 'map' => '', 'reverse' => false])

<div class="roadmap-group flex {{ $reverse ? 'flex-row-reverse' : '' }}">
    <div class="roadmap-img flex justify-center items-center">
        <img src="{{ asset($image) }}" alt="" class="rounded-img">
    </div>
    <div class="roadmap-description flex flex-col items-center {{ $reverse ? 'text-end' : 'text-start' }} gap-6 justify-center">
        <h3 class="sm:text-2xl">{{ $title }}</h3>
        <p class="sm:text-2xl">{{ $time }}</p>
        @if($location)
            <p class="sm:text-2xl">{{ $location }}</p>
        @endif
        @if($map)
            <a class="sm:text-2xl underline text-blue-600" href="{{ $map }}">Mapa</a>
        @endif
    </div>
</div>
