<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Curso;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all(); // viene con la relacion del curso
        return view('admin.cursos.index', compact(('cursos')));
    }

    public function create()
    {
        return view('admin.cursos.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required',
            'horas_requeridas' => 'required|integer|min:1',
            'estado' => 'required|in:A,I', // Asegúrate de que el estado sea válido
            // 'ubicacion' => 'nullable',
            // 'descripcion' => 'required',
        ]);

        // Crear un nuevo curso
        Curso::create([
            'nombre' => $request->nombre,
            // 'descripcion' => $request->descripcion,
            'horas_requeridas' => $request->horas_requeridas,
            'estado' => $request->estado,
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->route('admin.cursos.index')->with(['info', 'Curso registrado correctamente.','icono', 'success']);
    }


    public function show(Curso $curso)
    {
        return view('admin.cursos.show', compact('curso'));
    }

    public function edit(Curso $curso)
    {
        return view('admin.cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    { //dd($request->all());

        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'horas_requeridas' => 'required',
        ]);

        $curso->update($request->all()); // Actualizar el registro específico

        return redirect()->route('admin.cursos.index')->with([
            'info' => 'Curso actualizado correctamente.',
            'icono' => 'success'
        ]);
        
    }


    public function completados()
    {
        if (Auth::user()->hasRole('superAdmin') ||  Auth::user()->hasRole('admin') || 
            Auth::user()->hasRole('secretaria') || Auth::user()->hasRole('profesor')) {
                 // // Asegurarte de reemplazar 'Curso' y 'ClienteCurso' con los nombres de tus modelos.
                $cursosCompletados = DB::table('cursos')
                ->join('cliente_curso', 'cursos.id', '=', 'cliente_curso.curso_id')
                ->select('cursos.id', 'cursos.nombre', 'cursos.horas_requeridas', 'cliente_curso.horas_realizadas')//'cursos.descripcion'
                ->whereColumn('cliente_curso.horas_realizadas', '>=', 'cursos.horas_requeridas') // Compara las horas realizadas con las horas totales
                ->get();
                // dd($cursosCompletados);
                return view('admin.cursos.completados_all', compact('cursosCompletados'));
        } else {

            $userId = Auth::user()->id;
            $clienteId = Cliente::where('user_id', $userId)->first();
            // $query = DB::table('cursos')
            //     ->join('cliente_curso', 'cursos.id', '=', 'cliente_curso.curso_id')
            //     ->select('cursos.id', 'cursos.nombre', 'cursos.descripcion', 'cursos.horas_requeridas', 'cliente_curso.horas_realizadas')
            //     ->where('cliente_curso.cliente_id', $clienteId);

            // Muestra la consulta SQL generada
            $cursosCompletados = DB::table('cursos')
                ->join('cliente_curso', 'cursos.id', '=', 'cliente_curso.curso_id')
                ->select('cursos.id', 'cursos.nombre', 'cursos.horas_requeridas', 'cliente_curso.horas_realizadas')//, 'cursos.descripcion'
                ->where('cliente_curso.cliente_id', $clienteId->id) // Filtra por el cliente específico
                ->whereColumn('cliente_curso.horas_realizadas', '>=', 'cursos.horas_requeridas') // Compara las horas realizadas con las requeridas
                ->get();
                return view('admin.cursos.completados', compact('cursosCompletados'));
        }
    }
    
    public function destroy(Curso $curso)
    {
        if ($curso->user) { // Si existe un usuario asociado, eliminarlo
            $curso->user->delete();
        }

        $curso->delete(); // Eliminar el curso

        return redirect()->route('admin.cursos.index')
            ->with(['title', 'Exito','info', 'El curso se eliminó con éxito','icono', 'success']);
    }
    public function obtenerCursos($clienteId)
    {
        $cliente = Cliente::with('cursos')->findOrFail($clienteId);
        return response()->json($cliente->cursos);
    }
    
}
