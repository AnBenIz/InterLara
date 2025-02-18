<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nueva Canción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Agregar Nueva Canción</h1>

    @if($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
    @endif

    <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data">
       @csrf
       <div class="form-group">
           <label for="title">Título</label>
           <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
       </div>
       <div class="form-group">
           <label for="artist">Artista</label>
           <input type="text" name="artist" id="artist" class="form-control" required value="{{ old('artist') }}">
       </div>
       <div class="form-group">
           <label for="audio">Archivo de Audio (MP3 o WAV)</label>
           <input type="file" name="audio" id="audio" class="form-control-file" required>
       </div>
       <button type="submit" class="btn btn-primary">Agregar Canción</button>
    </form>
</div>
</body>
</html>
