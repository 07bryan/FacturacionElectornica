<?php

namespace App\Http\Controllers;

use App\Models\Usuario; // Asegúrate de que este modelo exista
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    public function index(Request $request) {
        // Manejo de paginación
        if (!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE') ? 
                                          $request->records_per_page : 
                                          env('PAGINATION_MAX_SIZE');
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');
        }

        // Búsqueda de usuarios
        $usuarios = Usuario::where('nombre', 'LIKE', "%$request->filter%")
                           ->paginate($request->records_per_page);

        return view('usuarios/index', ['usuarios' => $usuarios, 'data' => $request]);
    }

    public function create() {
        return view('usuarios/create');
    }

    public function edit($id) {
        $usuario = Usuario::find($id);

        if (empty($usuario)) {
            Session::flash('message', ['content' => "El usuario con id '$id' no existe.", 'type' => 'error']);
            return redirect()->back();
        }

        return view('usuarios/edit', ['usuario' => $usuario]);
    }

    public function delete($id) {
        try {
            $usuario = Usuario::find($id);

            if (empty($usuario)) {
                Session::flash('message', ['content' => "El usuario con id '$id' no existe.", 'type' => 'error']);
                return redirect()->back();
            }

            $usuario->delete();

            Session::flash('message', ['content' => 'Usuario eliminado con éxito', 'type' => 'success']);
            return redirect()->action([UsuariosController::class, 'index']);

        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function store(Request $request) {
        Validator::make($request->all(), [
            'nombre' => 'required|max:30',
            'cedula' => 'required|unique:usuarios,cedula|digits_between:1,20', // Ajusta según sea necesario
            'rol' => 'required|integer'
        ],
        [
            'nombre.required' => 'El nombre es requerido.',
            'nombre.max' => 'El nombre no puede ser mayor a :max caracteres.',
            'cedula.required' => 'La cédula es requerida.',
            'cedula.unique' => 'La cédula ya está en uso.',
            'rol.required' => 'El rol es requerido.',
        ])->validate();

        try {
            $usuario = new Usuario();
            $usuario->cedula = $request->cedula;
            $usuario->nombre = $request->nombre;
            $usuario->rol = $request->rol;
            $usuario->fecha_creacion = now(); // Asegúrate de que el formato sea correcto
            $usuario->save();

            Session::flash('message', ['content' => 'Usuario agregado con éxito', 'type' => 'success']);
            return redirect()->action([UsuariosController::class, 'index']);

        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function update(Request $request) {
        Validator::make($request->all(), [
            'nombre' => 'required|max:30',
            'cedula' => 'required|exists:usuarios,cedula',
            'rol' => 'required|integer'
        ],
        [
            'nombre.required' => 'El nombre es requerido.',
            'nombre.max' => 'El nombre no puede ser mayor a :max caracteres.',
        ])->validate();

        try {
            $usuario = Usuario::find($request->cedula);
            $usuario->nombre = $request->nombre;
            $usuario->rol = $request->rol;
            $usuario->save();

            Session::flash('message', ['content' => 'Usuario actualizado con éxito', 'type' => 'success']);
            return redirect()->action([UsuariosController::class, 'index']);

        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
