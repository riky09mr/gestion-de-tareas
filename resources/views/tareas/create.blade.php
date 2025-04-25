@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-4 card">
                <div class="card-body" style="background-color: #f8f9fa; border-radius: 10px;">
                    <h1 class="mb-4 text-2xl font-bold">Crear nueva tarea</h1>
                    <form action="{{ route('tareas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="estado" value="1">
                        <div class="mb-3">
                            <label for="fecha_vencimiento" class="form-label">Fecha límite</label>
                            <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Crear tarea</button>
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

