<div class="img-header-date relative dark-text">
    <div id="main-img"></div>
    <div id="wedding-date" class="flex flex-col justify-end items-center">
        <h2 id="wedding-date-text" class="sm:text-4xl font-bold dark-text text-2xl astralaga">{{ $date->format('d') }} • {{ $date->format('m') }} • {{ $date->format('Y') }}</h2>
        <h1 class="dark-text sm:text-4xl text-center text-2xl astralaga">ALEXANDRA & CARLOS</h1>
        <div id="timer" class="sm:flex sm:flex-row flex flex-col dark-text gap-3 sm:gap-0">
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
