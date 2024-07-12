@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
    <div id="wedding-day" class="flex flex-col justify-center mt-10 items-center">
        <h1 class="text-3xl">WEDDING DAY</h1>
        <div id="roadmap" class="mt-10 relative">
            <img src="{{ asset('img/roadmap.svg') }}" alt="" class="roadmap-bar">
            <x-roadmap-group image="img/IglesiaColor.jpeg" title="Ceremonia" time="12 : 30"
                location="PARRÒQUIA DE SANT EUGENI I PAPA"
                map="https://www.google.es/maps/place/Iglesia+de+San+Eugenio/@41.3896705,2.1435739,17z/data=!3m1!4b1!4m6!3m5!1s0x12a4a28291573501:0x6cf16d975f77d450!8m2!3d41.3896665!4d2.1461542!16s%2Fg%2F1tr46pjv?entry=ttu" />
            <x-roadmap-group image="img/transporte.png" title="Traslado al restaurante" time="13 : 30" reverse="true" />
            <x-roadmap-group image="img/magi.jpeg" title="Recepción" time="14 : 00" location="CAN MAGÍ"
                map="https://www.google.es/maps/place/Masía+Can+Magí/@41.4810881,2.0881215,16z/data=!3m1!4b1!4m6!3m5!1s0x12a496eb43420dc1:0x2a3daa82ed2111de!8m2!3d41.4810841!4d2.0907018!16s%2Fg%2F11b7l84ww0?entry=ttu" />
            <x-roadmap-group image="img/transporte2.png" title="Traslado a casa" time="02 : 00" reverse="true" />
        </div>
    </div>

    <div id="our-story" class="flex flex-col justify-center mt-32 items-center">
        <h1 class="text-3xl">NUESTRA HISTORIA</h1>
        <div class="story-group md:flex mt-10">
            @foreach (['ale' => 'La historia de Alexandra', 'carlos' => 'La historia de Carlos', 'relacion' => 'Nuestra relación'] as $image => $title)
                <div class="story flex flex-col gap-5 items-center mb-10">
                    <img src="{{ asset('img/' . $image . '.jpeg') }}" alt="" class="story-img">
                    <div class="story-text">
                        <h2 class="text-2xl font-semibold mt-2 mb-2">{{ $title }}</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed purus vitae mi euismod
                            pretium et vitae ipsum. Integer a tellus imperdiet, dignissim justo a, hendrerit nulla. Praesent
                            ut vulputate nibh. Morbi porttitor facilisis ligula vitae finibus. Nunc varius non risus vitae
                            aliquet. Quisque vehicula dictum ornare. Suspendisse </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="image-gallery mt-32 flex justify-center items-center">
        <div class="gallery grid md:grid-cols-3 gap-5">
            @for ($i = 1; $i <= 9; $i++)
                <x-card imgFront="{{ asset('img/gallery/' . $i . '.jpeg') }}" />
            @endfor
        </div>
    </div>

    <div class="adults-only mt-32 flex flex-col justify-center items-center">
        <div class="adults flex flex-col justify-center items-center">
            <h1 class="text-3xl">ADULTS ONLY</h1>
            <p class="adults-text mt-10">Os pedimos en la medida de lo posible, dejéis a vuestros peques en casa, para que
                entre todos podamos disfrutar del día sin preocupaciones. Si tenéis cualquier inconveniente nos podéis
                contactar personalmente</p>
            <strong>¡Gracias!</strong>
        </div>
    </div>


    <div class="confirmar-asistencia mt-32 flex flex-col justify-center items-center">
        <div class="form-asistencia flex flex-col justify-center items-center">
            <h1 class="text-3xl text-center">CONFIRMAR ASISTENCIA</h1>
            <form id="confirm" class="mt-10 flex flex-col justify-center">
                <div id="person-container" class="mb-10">
                    <div class="person-group">
                        <div class="label-group flex justify-between">
                            <div id="nombre" class="flex flex-col justify-center">
                                <x-input-label for="name" :value="__('Nombre')" class="required" />
                                <x-text-input type="text" name="name[]" id="name1" class="form-input" required></x-text-input>
                            </div>
                            <div id="apellidos" class="flex flex-col justify-center">
                                <x-input-label for="surname" :value="__('Apellidos')" class="required" />
                                <x-text-input type="text" name="surname[]" id="surname1" class="form-input" required></x-text-input>
                            </div>
                        </div>
                        <div class="traslado mt-10">
                            <p class="mb-5">Elige tu traslado</p>
                            <p class="mb-3">Traslado al restaurante</p>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="banquet[]" id="banquet1">
                                <x-input-label for="banquet1" :value="__('Barcelona - Sant Cugat')" />
                            </div>
                            <p class="mt-8 mb-3">Traslado a casa</p>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="home[]" id="bcn1" value="Barcelona" class="return">
                                <x-input-label for="bcn1" :value="__('Sant Cugat - Barcelona')" />
                            </div>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="home[]" id="gava1" value="Gavà" class="return">
                                <x-input-label for="gava1" :value="__('Sant Cugat - Gavà')" />
                            </div>
                        </div>
                        <div class="menu mt-8">
                            <p class="mb-3 required">¿Algún menú especial?</p>
                            <div class="label-group flex items-center gap-5">
                                <input type="checkbox" name="menu[]" id="all1" value="No, como de todo"
                                    class="menu-input">
                                <x-input-label for="all1" :value="__('No, como de todo')" />
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
                                <input type="checkbox" name="menu[]" id="gluten-free1" value="Gluten free"
                                    class="menu-input">
                                <x-input-label for="gluten-free1" :value="__('Gluten free')" />
                            </div>
                            <x-input-error :messages="$errors->get('menu')" class="mt-2" />
                        </div>
                        <div class="alergias mt-8">
                            <p class="mb-3">Alergias</p>
                            <textarea name="allergies[]" id="allergies1" cols="100" rows="5"></textarea>
                        </div>
                        <div class="cancion mt-8">
                            <p class="mb-3">¿Qué canción no puede faltar?</p>
                            <x-text-input type="text" name="song[]" id="song1" class="song form-input"
                                autocomplete="off"></x-text-input>
                            <div id="songs"></div>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-person"
                    class="inline-flex items-center justify-center mr-2 text-indigo-100 transition-colors duration-150 bg-blue-500 hover:bg-blue-700 rounded-lg focus:shadow-outline ">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                    <p>Añadir persona</p>
                </button>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded mt-10">CONFIRMAR</button>
        </div>
        </form>
    </div>
    </div>
@endsection
