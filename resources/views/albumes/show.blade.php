<x-app-layout>
    <div class="w-1/2 mx-auto">
        <div>
            <x-input-label for="titulo" :value="'Título del album'" />
            <x-text-input id="titulo" class="block mt-1 w-full"
                type="text" name="titulo" :value="old('titulo', $album->titulo)" disabled
                autofocus autocomplete="titulo" />
            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="anyo" :value="'Año de publicación'" />
            <x-text-input id="anyo" class="block mt-1 w-full"
                type="text" name="anyo" :value="old('anyo', $album->anyo)" disabled
                autofocus autocomplete="anyo" />
            <x-input-error :messages="$errors->get('anyo')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="duracion" :value="'Duración'" />
            <x-text-input id="duracion" class="block mt-1 w-full"
                type="text" name="duracion" :value="old('duracion', sprintf('%d minutos %d segundos', intval($duracionTotal / 60), $duracionTotal % 60))" disabled
                autofocus autocomplete="duracion" />
            <x-input-error :messages="$errors->get('duracion')" class="mt-2" />
        </div>

        {{-- <div>
            <x-input-label for="artistas" :value="'Artista(s)'" />
            @foreach ($artistas as $artista)
                <div class="flex items-center mb-4">
                    <input name="artistas[]" id="artista{{ $artista->id }}" type="checkbox" value="{{ $artista->id }}"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        {{$tema->artistas->contains("id", $artista->id) ? 'checked' : '' }} disabled>
                    <label for="artista{{ $artista->id }}"
                        class="ms-2 text-sm font-medium text-">{{ $artista->nombre }}</label>
                </div>
            @endforeach
        </div> --}}

        <div>
            <x-input-label for="temas" :value="'Temas(s)'" />
            @foreach ($temas as $tema)
                <div class="flex items-center mb-4">
                    <input name="temas[]" id="tema{{ $tema->id }}" type="checkbox" value="{{ $tema->id }}"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        {{$album->temas->contains("id", $tema->id) ? 'checked' : '' }} disabled>
                    <label for="tema{{ $tema->id }}"
                        class="ms-2 text-sm font-medium text-">{{ $tema->titulo }}</label>
                </div>
            @endforeach
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('albumes.index') }}">
                <x-secondary-button class="ms-4">
                    Volver
                </x-primary-button>
            </a>
        </div>
    </div>
</x-app-layout>
