@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Lista de tareas</h4>
                    <a href="{{ route('tareas.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Crear nueva tarea
                    </a>
                </div>

                <!-- Formulario de búsqueda -->
                <div class="card-body border-bottom">
                    <form action="{{ route('tareas.index') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="buscar" class="form-control" placeholder="Buscar por título o descripción" value="{{ request('buscar') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="estado" class="form-select">
                                <option value="">Todos los estados</option>
                                @foreach(App\Models\Tarea::ESTADOS as $nombre => $valor)
                                    <option value="{{ $valor }}" {{ request('estado') == $valor ? 'selected' : '' }}>{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="fecha_vencimiento" class="form-control" value="{{ request('fecha_vencimiento') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="id" class="form-control" placeholder="Buscar por Numero de tarea" value="{{ request('id') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    @if($tareas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Numero de tarea</th>
                                        <th>Título</th>
                                        <th>Estado</th>
                                        <th>Fecha límite</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tareas as $tarea)
                                        <tr>
                                            <td>{{ $tarea->id }}</td>
                                            <td>{{ $tarea->titulo }}</td>
                                            <td>
                                                <span class="badge rounded-pill
                                                    {{ $tarea->estado == 1 ? 'bg-success' : '' }}
                                                    {{ $tarea->estado == 2 ? 'bg-warning' : '' }}
                                                    {{ $tarea->estado == 3 ? 'bg-primary' : '' }}">
                                                    @if($tarea->estado == 1)
                                                        Pendiente
                                                    @elseif($tarea->estado == 2)
                                                        En progreso
                                                    @elseif($tarea->estado == 3)
                                                        Completada
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{ $tarea->fecha_vencimiento ? date('d/m/Y', strtotime($tarea->fecha_vencimiento)) : 'Sin fecha' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('tareas.show', $tarea->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('tareas.estado', $tarea->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="estado" class="form-select form-select-sm d-inline" style="width: auto;" onchange="this.form.submit()">
                                                            @foreach(App\Models\Tarea::ESTADOS as $nombre => $valor)
                                                                <option value="{{ $valor }}" {{ $tarea->estado == $valor ? 'selected' : '' }}>
                                                                    {{ $nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i> No hay tareas disponibles
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection