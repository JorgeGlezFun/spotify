<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Artista;
use App\Models\Tema;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('albumes.index', ['albumes'=>Album::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artistas = Artista::all();
        $temas = Tema::all();

        return view('albumes.create', compact('artistas', 'temas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'temas' => [
                'required',
                'array',
                /* 'imagen' => 'required|mimes:jpg,png,jpeg|max:400', */
                function ($attribute, $value, $fail) {
                    foreach ($value as $temaId) {
                        $tema = Tema::find($temaId);
                        if (!$tema || !$tema->artistas()->exists()) {
                            $fail("El tema con ID $temaId no tiene ningún artista asociado.");
                        }
                    }
                },
            ],
        ]);

        Album::create([
            'titulo'=>$request->titulo,
            'anyo'=>$request->anyo
        ]);
        return redirect()->route('albumes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $artistas = Artista::all();
        $temas = Tema::all();
        $duracionTotal = $album->temas->sum('duracion');
        return view('albumes.show', ['album' => $album, 'artistas' => $artistas, 'temas' => $temas, 'duracionTotal' => $duracionTotal]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('albumes.edit', ['album' => $album]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $album->update([
            'titulo'=>$request->titulo,
            'anyo'=>$request->anyo
        ]);
        return redirect()->route('albumes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        Album::destroy($album->id);
        return redirect()->route('albumes.index');
    }
}
