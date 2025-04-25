@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-4 card">
                <div class="card-body" style="background-color: #f8f9fa; border-radius: 10px;">
                    <h1 class="mb-4 text-2xl font-bold">Editar tarea</h1>
                        <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $tarea->titulo }}">
                            </div>
                            <div class="mb-3">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion">{{ $tarea->descripcion }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_vencimiento">Fecha de vencimiento</label>
                                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" min="{{ date('Y-m-d') }}" value="{{ $tarea->fecha_vencimiento ? date('Y-m-d', strtotime($tarea->fecha_vencimiento)) : '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="estado">Estado</label>
                                <select class="form-control" id="estado" name="estado">
                                    @foreach(App\Models\Tarea::ESTADOS as $nombre => $valor)
                                        <option value="{{ $valor }}" {{ $tarea->estado == $valor ? 'selected' : '' }}>
                                            {{ $nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="user_id">Asignar a usuario</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $tarea->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->nombre . ' ' . $user->apellido }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                <a href="{{ route('tareas.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fechaInput = document.getElementById('fecha_vencimiento');
        const fechaActual = new Date().toISOString().split('T')[0];
        fechaInput.setAttribute('min', fechaActual);
    });
</script>
@endsection
