
<div {{$attributes->merge(['class' => 'content-card items-center p-10 md:w-1/2 w-full'])}}>
    <div class="wedding-day-content grid">
        <div class="title-and-time text-center flex flex-col gap-2">
            <h2 class="text-lg astralaga">{{$title}}</h2>
            <p>{{$time}}</p>
        </div>
        <div class="name-and-city text-center flex flex-col gap-2 mt-5">
            <h1 class="text-3xl astralaga font-bold">{{$site}}</h1>
            <p class="uppercase text-gray-400 text-sm">{{$city}}</p>
        </div>
        <div class="button-wrapper flex justify-center mt-5 items-center">
            <button class="location-button h-10">
                <a href="{{$map}}" target="__blank"><span class="button-text">Cómo llegar</span></a>
                <!-- El icono se agregará con CSS, por lo que no es necesario agregarlo aquí -->
            </button>
        </div>
        
        <div class="site-img-wrapper flex justify-center items-center mt-10">
            <div class="site-img bg-cover bg-center rounded-lg shadow-lg transform transition duration-300 hover:scale-95" style='background-image: url({{$img}});'></div>
        </div>
        
    </div>
    
</div>
