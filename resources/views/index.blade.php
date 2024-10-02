@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')

    <div id="wedding-main-message-wrapper" class="flex justify-center mt-24">
        <h1 class="astralaga text-7xl tracking-wider text-center">¡Nos casamos!</h1>
    </div>
    
    <div id="wedding-day" class="flex flex-col justify-center mt-24 items-center">
        
        <h1 class="text-3xl astralaga">Dónde y cuándo</h1>
        <div class="wedding-day-info-wrapper mt-10 flex md:flex-row flex-col justify-center items-center gap-10">
            <x-wedding-day title="Ceremonia católica" time="12:30h" site="PARRÒQUIA DE SANT EUGENI I PAPA"
            city="Barcelona" img="{{asset('img/parroquia3.jpg')}}" map="https://www.google.es/maps/place/Iglesia+de+San+Eugenio/@41.3896705,2.1435739,17z/data=!3m1!4b1!4m6!3m5!1s0x12a4a28291573501:0x6cf16d975f77d450!8m2!3d41.3896665!4d2.1461542!16s%2Fg%2F1tr46pjv?entry=ttu">

            </x-wedding-day>
            <x-wedding-day title="Cóctel, banquete y celebración" time="15:00h" site="CAN MAGÍ"
            city="Sant Cugat" img="{{asset('img/can_magi.jpeg')}}" map="https://www.google.es/maps/place/Masía+Can+Magí/@41.4810881,2.0881215,16z/data=!3m1!4b1!4m6!3m5!1s0x12a496eb43420dc1:0x2a3daa82ed2111de!8m2!3d41.4810841!4d2.0907018!16s%2Fg%2F11b7l84ww0?entry=ttu">

            </x-wedding-day>
        </div>
        
        
    </div>
    <div class="pre-wedding-wrapper mt-32 flex justify-center py-20">
        <div id="pre-wedding-content-wrapper" class="flex md:flex-row flex-col gap-10">
            <div class="pre-wedding-left-wrapper md:w-1/2 md:h-full h-1/2">
                <img src="{{asset('img/pre-wedding.jpeg')}}" alt="running" class="h-80 w-full">
            </div>
            <div class="pre-wedding-right-wrapper md:w-1/2 md:h-full h-1/2">
                <h1 class="astralaga text-4xl">Pre-wedding Running Club</h1>
                <div class="pre-wedding-date mt-5">
                    <p class="">29 Noviembre de 2024</p>
                    <p class="">18:00h</p>
                </div>
                <div class="pre-wedding-details-wrapper mt-5">
                    <div id="pre-wedding-details">
                        <h3 class="font-bold text-md">More details</h3>
                        <p class="text-sm">TBC soon</p>
                    </div>
                </div>
                <div class="pre-wedding-dresscode-wrapper mt-5">
                    <img src="{{asset("img/bow_tie.svg")}}" alt="" class="h-8 w-8">
                    <div id="pre-wedding-dresscode">
                        <h3 class="font-bold text-md">Dresscode</h3>
                        <p class="text-sm">Sport</p>
                    </div>
                </div>
                
                  
            </div>
        </div>
        
    </div>
    <div id="our-story" class="flex flex-col justify-center mt-32 items-center">
        <h1 class="text-3xl astralaga">Nuestra historia</h1>
        <div class="story-group flex flex-col mt-10 lg:flex-row">
            @foreach ($ourStory as $story => $value)
                <div class="story flex flex-col gap-5 items-center mb-20 lg:w-1/3">
                    {{-- <img src="{{ asset('img/' . $image . '.jpeg') }}" alt="" class="story-img"> --}}
                    <div style="background-image:url({{ asset('img/' . $story . '.jpeg') }})" class="story-img" id="{{$story}}-img"></div>
                    <div class="story-text">
                        <h2 class="text-2xl font-bold mt-2 mb-5 astralaga">{{ $value["title"] }}</h2>
                        <p>{{$value["text"]}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="image-gallery mt-32 flex justify-center items-center">
        <div class="gallery grid lg:grid-cols-3 gap-5 md:grid-cols-2">
            @for ($i = 1; $i <= 12; $i++)
                {{-- <div style="background-image:url({{ asset('img/gallery/' . $i . '.jpeg') }})" class="gallery-image"></div> --}}
                <x-card imgFront="{{ asset('img/gallery/' . $i . '.jpg') }}">
                    {{$cardsImg[$i - 1]}}
                </x-card>
            @endfor
        </div>
    </div>
    <div class="transport-service-wrapper mt-32 flex justify-center flex-col items-center">
        <div class="transport-service flex justify-center flex-col items-center">
            <div class="transport-service-text text-center">
                <h1 class="text-3xl astralaga">Servicio de transporte</h1>
                <h3 class="mt-3 text-gray-400">Horarios y puntos de recogida del servicio de autobús</h3>
            </div>
            <div class="transport-info-wrapper flex sm:flex-row flex-col mt-10 gap-10 w-full">
                <x-content-card class="sm:w-1/2 w-full flex flex-col items-center justify-around" minHeight="250px">
                    <h1 class="text-3xl astralaga">IDA</h1>
                    <div class="schedule text-center flex flex-col gap-4">
                        <p>Punto de recogida en: <strong>Parroquia de SANT EUGENI I PAPA, 
                            BARCELONA</strong>  </p>
                        <p class="italic">14:30h</p>
                    </div>
                    
                </x-content-card>
                <x-content-card class="sm:w-1/2 w-full flex flex-col flex-wrap items-center justify-around" minHeight="250px">
                    <h1 class="text-3xl astralaga">VUELTA</h1>
                    <div class="schedule text-center flex flex-col gap-4">
                        <p>Vuelta a: <strong>Can Magí - Plaça de Francesc Macià, Barcelona <br>
                            Can Magí - Plaça de Catalunya, Gavà</strong></p>
                        <p class="italic">2:15h</p>
                    </div>
                </x-content-card>
            </div>
        </div>
        

    </div>
    <div class="adults-only mt-32 flex flex-col justify-center items-center">
        <div class="adults bg-gray-100 p-8 rounded-lg shadow-lg flex flex-col justify-center items-center">
            <h1 class="text-4xl font-semibold text-center text-gray-800 astralaga">Adults only</h1>
            <p class="adults-text mt-6 text-lg text-center text-gray-600">
                Pedimos que en la medida de lo posible, dejéis a vuestros peques en casa, para que entre todos podamos disfrutar del día sin preocupaciones. Si tenéis cualquier inconveniente nos podéis contactar personalmente.
            </p>
            <strong class="mt-4 text-lg text-gray-800">¡Gracias!</strong>
        </div>
    </div>
    
    <div class="dress-code mt-20 flex flex-col justify-center items-center">
        <div class="dress-code bg-gray-100 p-8 rounded-lg shadow-lg flex flex-col justify-center items-center">
            <h1 class="text-4xl font-semibold text-center text-gray-800 astralaga">Dress code</h1>
            <img src="{{asset("img/hanger.svg")}}" alt="hanger" class="h-10 w-10">
            <h2 class="dress-code-text mt-6 text-xl text-center font-semibold text-gray-600 astralaga">FORMAL</h2>
            <div class="dress-code-text-wrapper w-3/5 mt-10 flex flex-col justify-center items-center gap-5">
                <p class="text-center">Lo más importante para nosotros es que disfrutéis. Pero nos gustaría que la vestimenta fuera formal </p>
                <img src="{{asset("img/heart.svg")}}" alt="heart" class="h-10 w-10">
            </div>
            <div class="dress-code-content-wrapper flex gap-20 mt-10">
                <div class="dress-code-female-wrapper flex flex-col justify-center items-center gap-2">
                    <h1>ELEGANTE</h1>
                    <img src="{{asset("img/female.svg")}}" alt="female icon" class="h-8 w-8">
                    <ul class="flex flex-col justify-center items-center">
                        <li>Vestido de noche</li>
                        <li>Vestido cóctel</li>
                        <li>Pantalón de fiesta</li>
                    </ul>
                </div>
                <div class="dress-code-male-wrapper flex flex-col justify-start items-center gap-2">
                    <h1>TRAJE FORMAL</h1>
                    <img src="{{asset("img/male.svg")}}" alt="male icon" class="h-8 w-8">
                    <ul class="flex flex-col justify-center items-center">
                        <li>Traje oscuro</li>
                        <li>Corbata o pajarita</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    

    <div class="confirmar-asistencia mt-40 flex flex-col justify-center items-center">
        <div class="form-asistencia flex flex-col justify-center items-center" id="confirm-form">
            <h1 class="text-3xl text-center astralaga">RSVP</h1>
            <h3 class="text-center mt-5">Rogamos confirmar la asistencia antes del
                <br><span class="italic">30 de septiembre de 2024</span></h3>
            <form id="confirm" class="mt-10 flex flex-col justify-center">
                <div id="person-container" class="mb-10">
                    <div class="person-group">
                        <h1 class="text-xl font-bold mb-5 person-number astralaga">Invitado 1</h1>
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
                                    <x-input-label for="banquet1" :value="__('Barcelona - Can Magí')" />
                                </div>
                                <x-input-error class="mt-2" />
                            </div>
                            <div class="input-form">
                                <p class="mt-8 mb-3">Traslado a casa</p>
                                <div class="label-group flex items-center gap-5">
                                    <input type="checkbox" name="home[]" id="bcn1" value="Barcelona" class="return">
                                    <x-input-label for="bcn1" :value="__('Can Magí - Barcelona')" />
                                </div>
                                <div class="label-group flex items-center gap-5">
                                    <input type="checkbox" name="home[]" id="gava1" value="Gavà" class="return">
                                    <x-input-label for="gava1" :value="__('Can Magí - Gavà')" />
                                </div>
                                <x-input-error class="mt-2" />
                            </div>

                        </div>
                        <div class="menu mt-8 input-form">
                            <p class="mb-3 required">¿Algún menú especial?</p>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="menu[1][menu]" id="all1" value="No" class="menu-input">
                                <x-input-label for="all1" :value="__('No')" />
                            </div>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="menu[1][menu]" id="vegan1" value="Vegano" class="menu-input">
                                <x-input-label for="vegan1" :value="__('Vegano')" />
                            </div>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="menu[1][menu]" id="vegetarian1" value="Vegetariano"
                                    class="menu-input">
                                <x-input-label for="vegetarian1" :value="__('Vegetariano')" />
                            </div>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="menu[1][menu]" id="gluten-free1" value="Gluten free (Celíaco)"
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
                            <h3 class="mb-3 text-xl astralaga">¡Conviértete en DJ!</h3>
                            <p class="mb-3">Envíanos tu canción favorita y la añadiremos a la lista que sonará en nuestra boda.</p>
                            <div class="spinner-input-wrapper flex gap-2">
                                <x-text-input type="text" name="song[]" id="song1" class="song form-input"
                                autocomplete="off"></x-text-input>
                                <div role="status" id="spinner" class="hidden flex justify-center items-center">
                                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                                
                            </div>
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
