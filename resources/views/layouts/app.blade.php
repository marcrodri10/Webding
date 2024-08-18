<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Document')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/scroll.js',
    'resources/js/checkboxes.js', 'resources/js/cards.js', 'resources/js/spotifyToken.js',
    'resources/js/confirmAssistance.js', 'resources/js/addPerson.js', 'resources/js/formInputs.js'])


</head>

<body>
    <div class="main flex flex-col justify-center items-center">
        <header class="header">
            @include('partials.navbar')
            @include('partials.header')
        </header>
        <main>
            @yield('content')
        </main>
    </div>
    <div id="message-container"></div>
</body>

</html>
