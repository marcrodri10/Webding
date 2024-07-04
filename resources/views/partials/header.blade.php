<div class="img-header-date relative dark-text">
    <img src="{{ asset('img/main.jpeg') }}" alt="" id="main-img" />
    <div id="wedding-date" class="flex flex-col justify-end items-center">
        <h2 id="wedding-date-text" class="text-4xl font-bold dark-text">{{ $date->format('d') }} • {{ $date->format('m') }} • {{ $date->format('Y') }}</h2>
        <h1 class="dark-text text-5xl">ALEXANDRA & CARLOS</h1>
        <div id="timer" class="flex dark-text">
            <div id="days" class="flex flex-col justify-center items-center"></div>
            <span class="flex justify-center items-center time">︰</span>
            <div id="hours" class="flex flex-col justify-center items-center"></div>
            <span class="flex justify-center items-center time">︰</span>
            <div id="minutes" class="flex flex-col justify-center items-center"></div>
            <span class="flex justify-center items-center time">︰</span>
            <div id="seconds" class="flex flex-col justify-center items-center"></div>
        </div>
    </div>
</div>
