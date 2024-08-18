@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
    {{-- <div id="wedding-day" class="flex flex-col justify-center mt-10 items-center">
        <h1 class="text-3xl">WEDDING DAY</h1>
        <div id="roadmap" class="mt-10 relative flex flex-col">
            <img src="{{ asset('img/roadmap.svg') }}" alt="" class="roadmap-bar">
            <x-roadmap-group image="img/IglesiaColor.jpeg" title="Ceremonia" time="12 : 30"
                location="PARRÒQUIA DE SANT EUGENI I PAPA"
                map="https://www.google.es/maps/place/Iglesia+de+San+Eugenio/@41.3896705,2.1435739,17z/data=!3m1!4b1!4m6!3m5!1s0x12a4a28291573501:0x6cf16d975f77d450!8m2!3d41.3896665!4d2.1461542!16s%2Fg%2F1tr46pjv?entry=ttu" />
            <x-roadmap-group image="img/transporte.png" title="Traslado al restaurante" time="13 : 30" reverse="true" />
            <x-roadmap-group image="img/magi.jpeg" title="Recepción" time="14 : 00" location="CAN MAGÍ"
                map="https://www.google.es/maps/place/Masía+Can+Magí/@41.4810881,2.0881215,16z/data=!3m1!4b1!4m6!3m5!1s0x12a496eb43420dc1:0x2a3daa82ed2111de!8m2!3d41.4810841!4d2.0907018!16s%2Fg%2F11b7l84ww0?entry=ttu" />
            <x-roadmap-group image="img/transporte2.png" title="Traslado a casa" time="02 : 00" reverse="true" />
        </div>
    </div> --}}
    <div id="wedding-day" class="flex flex-col justify-center mt-10 items-center">
        <h1 class="text-3xl">Dónde y cuándo</h1>
        <div class="wedding-day-info-wrapper mt-10 border-spacing-5 md:table flex flex-col justify-center items-center gap-10">
            <x-wedding-day title="Ceremonia católica" time="12:30h" site="PARRÒQUIA DE SANT EUGENI I PAPA"
            city="Barcelona" img="{{asset('img/iglesia.jpeg')}}" map="https://www.google.es/maps/place/Iglesia+de+San+Eugenio/@41.3896705,2.1435739,17z/data=!3m1!4b1!4m6!3m5!1s0x12a4a28291573501:0x6cf16d975f77d450!8m2!3d41.3896665!4d2.1461542!16s%2Fg%2F1tr46pjv?entry=ttu">

            </x-wedding-day>
            <x-wedding-day title="Cóctel, banquete y celebración" time="15:00h" site="CAN MAGÍ"
            city="Sant Cugat" img="{{asset('img/magi.jpeg')}}" map="https://www.google.es/maps/place/Masía+Can+Magí/@41.4810881,2.0881215,16z/data=!3m1!4b1!4m6!3m5!1s0x12a496eb43420dc1:0x2a3daa82ed2111de!8m2!3d41.4810841!4d2.0907018!16s%2Fg%2F11b7l84ww0?entry=ttu">

            </x-wedding-day>
        </div>
        
        
    </div>

    <div id="our-story" class="flex flex-col justify-center mt-32 items-center">
        <h1 class="text-3xl">Nuestra historia</h1>
        <div class="story-group flex flex-col mt-10 md:flex-row">
            @foreach ($ourStory as $story => $value)
                <div class="story flex flex-col gap-5 items-center mb-20 md:w-1/3">
                    {{-- <img src="{{ asset('img/' . $image . '.jpeg') }}" alt="" class="story-img"> --}}
                    <div style="background-image:url({{ asset('img/' . $story . '.jpeg') }})" class="story-img"></div>
                    <div class="story-text">
                        <h2 class="text-2xl font-semibold mt-2 mb-2">{{ $value["title"] }}</h2>
                        <p>{{$value["text"]}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="image-gallery mt-32 flex justify-center items-center">
        <div class="gallery grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @for ($i = 1; $i <= 9; $i++)
                {{-- <div style="background-image:url({{ asset('img/gallery/' . $i . '.jpeg') }})" class="gallery-image"></div> --}}
                <x-card imgFront="{{ asset('img/gallery/' . $i . '.jpg') }}">
                    {{$cardsImg[$i - 1]}}
                </x-card>
            @endfor
        </div>
    </div>
    <div class="transport-service-wrapper mt-40 flex justify-center flex-col items-center">
        <div class="transport-service flex justify-center flex-col items-center">
            <div class="transport-service-text text-center">
                <h1 class="text-3xl">Servicio de transporte</h1>
                <h3 class="mt-3">Horarios y puntos de recogida del servicio de autobús</h3>
            </div>
            <div class="transport-info-wrapper flex mt-10 gap-10 w-full">
                <x-content-card class="w-1/2 flex flex-col items-center justify-around" height="250px">
                    <h1 class="text-3xl">IDA</h1>
                    <div class="schedule text-center flex flex-col gap-4">
                        <p>Punto de recogida en: <strong>Parroquia de SANT EUGENI I PAPA, 
                            BARCELONA</strong>  </p>
                        <p class="italic">*Horarios por confirmar</p>
                    </div>
                    
                </x-content-card>
                <x-content-card class="w-1/2 flex flex-col items-center justify-around" height="250px">
                    <h1 class="text-3xl">VUELTA</h1>
                    <div class="schedule text-center flex flex-col gap-4">
                        <p>Vuelta a: <strong>Can Magí - Plaça de Francesc Macià, Barcelona <br>
                            Can Magí - Plaça de Catalunya, Gavà  </strong></p>
                        <p class="italic">*Horarios por confirmar</p>
                    </div>
                </x-content-card>
            </div>
        </div>
        

    </div>
    <div class="adults-only mt-32 flex flex-col justify-center items-center">
        <div class="adults flex flex-col justify-center items-center">
            <h1 class="text-3xl text-center">Adults only</h1>
            <p class="adults-text mt-10">Os pedimos en la medida de lo posible, dejéis a vuestros peques en casa, para que
                entre todos podamos disfrutar del día sin preocupaciones. Si tenéis cualquier inconveniente nos podéis
                contactar personalmente</p>
            <strong>¡Gracias!</strong>
        </div>
    </div>
    <div class="dress-code mt-32 flex flex-col justify-center items-center">
        <div class="adults flex flex-col justify-center items-center">
            <h1 class="text-3xl text-center">Dress code</h1>
            <p class="dress-code-text mt-5">Elegante</p>
        </div>
    </div>

    <div class="confirmar-asistencia mt-40 flex flex-col justify-center items-center">
        <div class="form-asistencia flex flex-col justify-center items-center" id="confirm-form">
            <h1 class="text-3xl text-center">RVSP</h1>
            <h3 class="text-center mt-5">Rogamos confirmar la asistencia antes del
                <br><span class="italic">20 de septiembre de 2024</span></h3>
            <form id="confirm" class="mt-10 flex flex-col justify-center">
                <div id="person-container" class="mb-10">
                    <div class="person-group">
                        <h1 class="text-xl font-bold mb-5 person-number">Invitado 1</h1>
                        <div class="guest-data">
                            {{-- <h1 class="text-md font-bold mb-5">Datos del invitado</h1> --}}
                            <div class="label-group md:flex justify-between items-start">
                                <div id="nombre" class="flex flex-col justify-center mb-10 md:mb-0 input-form">
                                    <x-input-label for="name" :value="__('Nombre')" class="required" />
                                    <x-text-input type="text" name="name[]" id="name1" class="form-input"
                                        required></x-text-input>
                                    <x-input-error class="mt-2" />
                                </div>
                                <div id="apellidos" class="flex flex-col justify-center input-form">
                                    <x-input-label for="surname" :value="__('Apellidos')" class="required" />
                                    <x-text-input type="text" name="surname[]" id="surname1" class="form-input"
                                        required></x-text-input>
                                    <x-input-error class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="traslado mt-10">
                            <div class="input-form">
                                <p class="mb-5">Elige tu traslado</p>
                                <p class="mb-3">Traslado a Can Magí</p>
                                <div class="label-group flex items-center gap-5">
                                    <input type="checkbox" name="banquet[]" id="banquet1">
                                    <x-input-label for="banquet1" :value="__('Barcelona - Sant Cugat')" />
                                </div>
                                <x-input-error class="mt-2" />
                            </div>
                            <div class="input-form">
                                <p class="mt-8 mb-3">Traslado a casa</p>
                                <div class="label-group flex items-center gap-5">
                                    <input type="checkbox" name="home[]" id="bcn1" value="Barcelona" class="return">
                                    <x-input-label for="bcn1" :value="__('Sant Cugat - Barcelona')" />
                                </div>
                                <div class="label-group flex items-center gap-5">
                                    <input type="checkbox" name="home[]" id="gava1" value="Gavà" class="return">
                                    <x-input-label for="gava1" :value="__('Sant Cugat - Gavà')" />
                                </div>
                                <x-input-error class="mt-2" />
                            </div>

                        </div>
                        <div class="menu mt-8 input-form">
                            <p class="mb-3 required">¿Algún menú especial?</p>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="menu[]" id="all1" value="No" class="menu-input">
                                <x-input-label for="all1" :value="__('No')" />
                            </div>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="menu[]" id="vegan1" value="Vegano" class="menu-input">
                                <x-input-label for="vegan1" :value="__('Vegano')" />
                            </div>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="menu[]" id="vegetarian1" value="Vegetariano"
                                    class="menu-input">
                                <x-input-label for="vegetarian1" :value="__('Vegetariano')" />
                            </div>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="menu[]" id="gluten-free1" value="Gluten free (Celíaco)"
                                    class="menu-input">
                                <x-input-label for="gluten-free1" :value="__('Gluten free (Celíaco)')" />
                            </div>
                            <x-input-error class="mt-2" />
                        </div>
                        <div class="alergias mt-8 input-form">
                            <p class="mb-3">Alergias</p>
                            <textarea name="allergies[]" id="allergies1" cols="100" rows="5"
                                class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"></textarea>
                            <x-input-error class="mt-2" />
                        </div>
                        <div class="cancion mt-8 input-form">
                            <h3 class="mb-3 text-xl">¡Conviértete en DJ!</h3>
                            <p class="mb-3">Envíanos tu canción favorita y la añadiremos a la lista que sonará en nuestra boda.</p>
                            <x-text-input type="text" name="song[]" id="song1" class="song form-input"
                                autocomplete="off"></x-text-input>
                            <div id="songs"></div>
                            <x-input-error class="mt-2" />
                        </div>
                    </div>
                </div>

                <button type="button" id="add-person"
                    class="py-1 inline-flex items-center justify-center mr-2 text-white transition-colors duration-150 bg-blue-500 hover:bg-blue-700 rounded-lg focus:shadow-outline ">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                    <p>Añadir persona</p>
                </button>
                <button type="button" id="remove-person"
                    class="hidden py-1 mt-5 inline-flex items-center justify-center mr-2 text-white transition-colors duration-150 bg-red-500 hover:bg-red-700 rounded-lg focus:shadow-outline ">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    <p>Eliminar persona</p>
                </button>
                <button type="submit"
                    class="py-1 inline-flex font-bold items-center justify-center mr-2 text-white transition-colors duration-150 bg-black hover:bg-gray-800 rounded-lg focus:shadow-outline mt-10 mb-5">ENVIAR</button>
        </div>
        </form>
    </div>
    </div>
@endsection
