<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Music;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function index()
    {
        return Music::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:mp3,wav,ogg|max:51200', // 50MB
        ]);

        $path = $request->file('file')->store('audios', 'public');

        $audio = new Music();
        $audio->title = $request->title;
        $audio->path = $path;
        $audio->save();

        return response()->json($audio, 201);
    }

    public function show($id)
    {
        return Music::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $audio = Music::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'file' => 'sometimes|required|mimes:mp3,wav,ogg|max:51200', // 50MB
        ]);

        if ($request->has('title')) {
            $audio->title = $request->title;
        }

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('audios', 'public');
            $audio->path = $path;
        }

        $audio->save();

        return response()->json($audio, 200);
    }

    public function destroy($id)
    {
        $audio = Music::findOrFail($id);
        $audio->delete();

        return response()->json(null, 204);
    }


}
