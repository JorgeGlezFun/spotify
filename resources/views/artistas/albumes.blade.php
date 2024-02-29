<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álbumes del Artista</title>
</head>
<body>
    <h1>Artista: {{ $artista->nombre }}</h1>
    <h2>Álbumes:</h2>
    <ul>
        @foreach ($albumes as $album)
            <li>{{ $album }}</li>
        @endforeach
    </ul>
</body>
</html>
<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="artista" :value="'Artista'" />
                <x-text-input id="artista" class="block mt-1 w-full"
                    type="text" name="artista" :value="old('artista', $artista->nombre)" disabled
                    autofocus autocomplete="artista" />
                <x-input-error :messages="$errors->get('artista')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="albumes" :value="'Album(s)'" />
                @foreach ($albumes as $album)
                    <div class="flex items-center mb-4">
                        <input name="albumes[]" id="album{{ $album->id }}" type="checkbox" value="{{ $album->id }}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            {{$tema->albumes->contains("id", $album->id) ? 'checked' : '' }} disabled>
                        <label for="album{{ $album->id }}"
                            class="ms-2 text-sm font-medium text-">{{ $album->titulo }}</label>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('temas.index') }}">
                    <x-secondary-button class="ms-4">
                        Volver
                    </x-secondary-button>
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
