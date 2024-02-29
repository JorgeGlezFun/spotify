<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artista;
use App\Models\Tema;
use Illuminate\Http\Request;

class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = $request->query('order', 'albumes_count');
        $order_dir = $request->query('order_dir', 'asc');

        $temas = Tema::withCount(['albumes', 'artistas'])
                    ->orderBy($order, $order_dir)
                    ->orderBy('artistas_count', $order === 'albumes_count' ? 'asc' : 'desc')
                    ->get();

        return view('temas.index', [
            'temas'=>$temas,
            'order' => $order,
            'order_dir' => $order_dir,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artistas = Artista::all();
        $albumes = Album::all();

        return view('temas.create', compact('artistas', 'albumes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'anyo' => 'required|integer|min:1900|max:' . date('Y'),
            'duracion' => 'required|string|max:255',
            'artistas' => 'required|array',
            'artistas.*' => 'exists:artistas,id',
        ]);

        $tema = Tema::create([
            'titulo'=>$request->titulo,
            'anyo'=>$request->anyo,
            'duracion'=>$request->duracion
        ]);

        $tema->artistas()->attach($request->artistas);
        $tema->albumes()->attach($request->albumes);
        return redirect()->route('temas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tema $tema)
    {
        $artistas = Artista::all();
        $albumes = Album::all();
        return view('temas.show', ['tema' => $tema, 'artistas' => $artistas, 'albumes' => $albumes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tema $tema)
    {
        $artistas = Artista::all();
        $albumes = Album::all();
        return view('temas.edit', ['tema' => $tema, 'artistas' => $artistas, 'albumes' => $albumes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tema $tema)
    {

        $tema->artistas()->detach();
        $tema->albumes()->detach();

        $tema->update([
            'nombre'=>$request->titulo,
            'anyo'=>$request->anyo,
            'duracion'=>$request->duracion
        ]);

        $tema->artistas()->attach($request->artistas);
        $tema->albumes()->attach($request->albumes);

        return redirect()->route('temas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tema $tema)
    {
        $tema->artistas()->detach();
        $tema->albumes()->detach();
        $tema->delete();
        return redirect()->route('temas.index');
    }
}
