@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-4 card">
                <div class="card-body" style="background-color: #f8f9fa; border-radius: 10px;">
                    <h1 class="mb-4 text-2xl font-bold">Tarea</h1>
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $tarea->titulo }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" readonly>{{ $tarea->descripcion }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                        <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="{{ $tarea->fecha_vencimiento }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado" value="{{ $tarea->estado }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="{{ $tarea->user->nombre }} {{ $tarea->user->apellido }}" readonly>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection