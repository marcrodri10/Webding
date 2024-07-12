<div class="img-header-date relative dark-text">
    <img src="{{ asset('img/main.jpeg') }}" alt="" id="main-img" />
    <div id="wedding-date" class="flex flex-col justify-end items-center">
        <h2 id="wedding-date-text" class="lg:text-4xl font-bold dark-text sm:text-xl">{{ $date->format('d') }} • {{ $date->format('m') }} • {{ $date->format('Y') }}</h2>
        <h1 class="dark-text lg:text-5xl text-center sm:text-2xl">ALEXANDRA & CARLOS</h1>
        <div id="timer" class="sm:flex sm:flex-row flex flex-col dark-text">
            <div id="days" class="flex flex-col justify-center items-center"></div>
            <span class="sm:flex sm:justify-center sm:items-center time hidden">︰</span>
            <div id="hours" class="flex flex-col justify-center items-center"></div>
            <span class="sm:flex sm:justify-center sm:items-center time hidden">︰</span>
            <div id="minutes" class="flex flex-col justify-center items-center"></div>
            <span class="sm:flex sm:justify-center sm:items-center time hidden">︰</span>
            <div id="seconds" class="flex flex-col justify-center items-center"></div>
        </div>
    </div>
</div>
