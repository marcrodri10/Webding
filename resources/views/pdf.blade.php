<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css'])
    <style>

        .banquets, .returns, .menus {
            width: 75%;
            border: 1px solid black;
            padding-left: 10px;
            margin-top: 20px;
        }
        .page_break { page-break-before: always; }
    </style>
</head>

<body>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="text-center px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="text-center px-6 py-3">
                        Apellidos
                    </th>
                    <th scope="col" class="text-center px-6 py-3">
                        ¿Transporte al banquete?
                    </th>
                    <th scope="col" class="text-center px-6 py-3">
                        ¿Transporte a Casa?
                    </th>
                    <th scope="col" class="text-center px-6 py-3">
                        Menú
                    </th>
                    <th scope="col" class="text-center px-6 py-3">
                        Alergias
                    </th>
                    <th scope="col" class="text-center px-6 py-3">
                        Canción
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guestsInfo as $info)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        @foreach ($info->only('name', 'surname', 'banquet', 'home', 'menu', 'allergies', 'song') as $key => $value)
                            @switch($key)
                                @case('banquet')
                                    <th scope="row"
                                        class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $value == 0 ? 'No' : 'Sí' }}
                                    </th>
                                @break

                                @default
                                    <th scope="row"
                                        class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $value == '' ? '-' : $value }}
                                    </th>
                            @endswitch
                        @endforeach
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <div class="page_break"></div>
    <div class="relevant-info">
        <div class="banquets">
            <h3>Traslado banquete</h3>
            @foreach ($totalBanquets as $total)
                <p>Total personas que {{ $total->banquet == 0 ? 'no quieren' : 'sí quieren' }} traslado al banquete:
                    {{ $total->cantidad }}</p>
            @endforeach
        </div>
        <div class="returns">
            <h3>Traslado a casa</h3>
            @foreach ($totalReturns as $total)
                <p>Total personas que
                    {{ $total->home == 'No' ? 'no quieren vuelta a casa' : 'sí quieren vuelta a casa ( ' . $total->home . ' )' }}:
                    {{ $total->cantidad }}</p>
            @endforeach
        </div>
        <div class="menus">
            <h3>Menús</h3>
            @foreach ($totalMenus as $total)
                <p>Total personas que han elegido la opción de menú ( {{ $total->menu }} ): {{ $total->cantidad }}</p>
            @endforeach
        </div>

    </div>
</body>

</html>
