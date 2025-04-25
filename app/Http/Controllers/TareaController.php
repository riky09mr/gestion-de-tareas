<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareas = Tarea::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tareas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|integer',
            'fecha_vencimiento' => 'required|date|after_or_equal:today',
        ]);

        $tarea = new Tarea();
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->estado = $request->estado;
        $tarea->fecha_vencimiento = $request->fecha_vencimiento;
        $tarea->user_id = Auth::id();
        $tarea->save();

        return redirect()->route('tareas.index')->with('success', 'Tarea creada con éxito');
    }

    public function estado(string $id, Request $request)
    {
        $tarea = Tarea::findOrFail($id);
        if ($tarea->user_id !== Auth::id()) {
            abort(403);
        }

        $tarea->estado = $request->estado;
        $tarea->save();

        return redirect()->route('tareas.index')->with('success', 'Estado actualizado correctamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tarea = Tarea::findOrFail($id);
        if ($tarea->user_id !== Auth::id()) {
            abort(403);
        }
        $tarea->usuario = User::find($tarea->user_id);
        return view('tareas.show', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        if ($tarea->user_id !== Auth::id()) {
            abort(403);
        }
        $users = User::all();
        if ($users->isEmpty()) {
            return redirect()->route('tareas.index')->with('error', 'No hay usuarios disponibles para asignar tareas');
        }
        return view('tareas.edit', compact('tarea', 'users'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|integer',
            'fecha_vencimiento' => 'required|date|after_or_equal:today',
            'user_id' => 'required|exists:users,id'
        ]);

        $tarea = Tarea::findOrFail($id);

        if ($tarea->user_id !== Auth::id()) {
            abort(403);
        }

        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->estado = $request->estado;
        $tarea->fecha_vencimiento = $request->fecha_vencimiento;
        $tarea->user_id = $request->user_id;
        $tarea->save();

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
