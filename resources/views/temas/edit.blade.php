<x-app-layout>
    <div class="w-1/2 mx-auto">
        <form method="POST" action="{{ route('temas.update', ['tema' => $tema]) }}">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="titulo" :value="'Título del tema'" />
                <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo', $tema->titulo)"
                    required autofocus autocomplete="titulo" />
                <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="anyo" :value="'Año de publicación'" />
                <x-text-input id="anyo" class="block mt-1 w-full" type="text" name="anyo" :value="old('anyo', $tema->anyo)"
                    required autofocus autocomplete="anyo" />
                <x-input-error :messages="$errors->get('anyo')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="duracion" :value="'Duración'" />
                <x-text-input id="duracion" class="block mt-1 w-full" type="text" name="duracion" :value="old('duracion', $tema->duracion)"
                    required autofocus autocomplete="duracion" />
                <x-input-error :messages="$errors->get('duracion')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="artistas" :value="'Artista(s)'" />
                @foreach ($artistas as $artista)
                    <div class="flex items-center mb-4">
                        <input name="artistas[]" id="artista{{ $artista->id }}" type="checkbox" value="{{ $artista->id }}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            {{$tema->artistas->contains("id", $artista->id) ? 'checked' : '' }}>
                        <label for="artista{{ $artista->id }}"
                            class="ms-2 text-sm font-medium text-">{{ $artista->nombre }}</label>
                    </div>
                @endforeach
            </div>

            <div>
                <x-input-label for="albumes" :value="'Album(s)'" />
                @foreach ($albumes as $album)
                    <div class="flex items-center mb-4">
                        <input name="albumes[]" id="album{{ $album->id }}" type="checkbox" value="{{ $album->id }}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            {{$tema->albumes->contains("id", $album->id) ? 'checked' : '' }}>
                        <label for="album{{ $album->id }}"
                            class="ms-2 text-sm font-medium text-">{{ $album->titulo }}</label>
                    </div>
                @endforeach
            </div>
    </div>


    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('temas.index') }}">
            <x-secondary-button class="ms-4">
                Volver
            </x-secondary-button>
        </a>
        <x-primary-button class="ms-4">
            Editar
        </x-primary-button>
    </div>
    </form>
    </div>
</x-app-layout>
