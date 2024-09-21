<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="main flex flex-col justify-center items-center">
        <nav class="">
            <ul class="mt-5 flex gap-10">
                <li>
                    <form action="{{ route('download.csv') }}" method="GET">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Descargar CSV
                        </button>
                    </form>
                </li>
                <li>
                    <form action="{{ route('download.pdf') }}" method="GET">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Descargar PDF
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <main>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10 flex justify-center">
                <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 w-11/12">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="text-center px-6 py-3 w-1/7">
                                Nombre
                            </th>
                            <th scope="col" class="text-center px-6 py-3 w-1/7">
                                Apellidos
                            </th>
                            <th scope="col" class="text-center px-6 py-3 w-1/7">
                                ¿Transporte al banquete?
                            </th>
                            <th scope="col" class="text-center px-6 py-3 w-1/7">
                                ¿Transporte a Casa?
                            </th>
                            <th scope="col" class="text-center px-6 py-3 w-1/7">
                                Menú
                            </th>
                            <th scope="col" class="text-center px-6 py-3 w-1/7">
                                Alergias
                            </th>
                            <th scope="col" class="text-center px-6 py-3 w-1/7">
                                Canción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guestsInfo as $info)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                @foreach ($info->only('name', 'surname', 'banquet', 'home', 'menu', 'allergies', 'song') as $key => $value)
                                    @switch($key)
                                        @case('banquet')
                                            <th scope="row" class="text-center px-6 py-4 font-medium text-gray-900 break-words dark:text-white w-1/7">
                                                {{ $value == 0 ? 'No' : 'Sí' }}
                                            </th>
                                        @break
        
                                        @default
                                            <th scope="row" class="text-center px-6 py-4 font-medium text-gray-900 break-words dark:text-white w-1/7">
                                                {{ $value == '' ? '-' : $value }}
                                            </th>
                                    @endswitch
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
        
    </div>
</body>

</html>
