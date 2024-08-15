
<div {{$attributes->merge(['class' => 'content-card table-cell items-center p-10 md:w-1/2 w-full'])}}>
    <div class="wedding-day-content grid">
        <div class="title-and-time text-center flex flex-col gap-2">
            <h2 class="text-xl">{{$title}}</h2>
            <p>{{$time}}</p>
        </div>
        <div class="name-and-city text-center flex flex-col gap-2 mt-5">
            <h1 class="text-3xl">{{$site}}</h1>
            <p class="uppercase text-gray-400">{{$city}}</p>
        </div>
        <div class="button-wrapper flex justify-center mt-5 items-center">
            <button class="location-button h-10">
                <a href="{{$map}}" target="__blank"><span class="button-text">Cómo llegar</span></a>
                <!-- El icono se agregará con CSS, por lo que no es necesario agregarlo aquí -->
            </button>
        </div>
        
        <div class="site-img-wrapper flex justify-center items-center mt-10">
            <div class="site-img" style='background-image: url({{$img}})'></div>
        </div>
    </div>
    
</div>
