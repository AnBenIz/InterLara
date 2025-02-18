<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Canciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Mis Canciones</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('music.create') }}" class="btn btn-success">Agregar Nueva Canción</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Artista</th>
                <th>Reproducir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($musicFiles as $music)
                <tr>
                    <td>{{ $music->title }}</td>
                    <td>{{ $music->artist }}</td>
                    <td>
                        <audio controls>
                            <source src="{{ Storage::disk('private_public')->url($music->audio_path) }}" type="audio/mpeg">
                            Tu navegador no soporta la reproducción de audio.
                        </audio>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No se encontraron canciones.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
