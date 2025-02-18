<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Music;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class MusicController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'artist' => 'required|string',
            'audio' => 'required|file|mimes:mp3,wav',
        ]);

        $audioPath = $request->file('audio')->store('public/music');

        $music = Music::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'audio_path' => $audioPath,
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['message' => 'Music uploaded successfully', 'music' => $music], 201);
    }

    public function index(Request $request)
    {
        $music = Music::where('user_id', $request->user()->id)->get();

        return response()->json(['music' => $music], 200);
    }
}
