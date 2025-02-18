<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Music;
use Illuminate\Support\Facades\Storage;

class MusicViewController extends Controller
{
    /**
     * Muestra la lista de canciones del usuario.
     */
    public function index(Request $request)
    {
        $musicFiles = Music::where('user_id', $request->user()->id)->get();
        return view('music_index', compact('musicFiles'));
    }

    /**
     * Muestra el formulario para agregar una nueva canción.
     */
    public function create()
    {
        return view('music_create');
    }

    /**
     * Procesa el formulario y almacena la nueva canción.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'audio'  => 'required|file|mimes:mp3,wav'
        ]);

        // Almacena el archivo en el disco "private_public" dentro de la carpeta "music"
        $audioPath = $request->file('audio')->store('music', 'private_public');

        Music::create([
            'title'      => $request->input('title'),
            'artist'     => $request->input('artist'),
            'audio_path' => $audioPath, // Se almacena algo como "music/filename.mp3"
            'user_id'    => $request->user()->id,
        ]);

        return redirect()->route('music.index')->with('success', 'Canción agregada exitosamente');
    }
}
