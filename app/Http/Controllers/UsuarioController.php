<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Model_has_roles;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index(Request $request) {  
        $busqueda = $request->busqueda;
        $especialidades = Especialidad::all();
        $usuarios = User::where('id', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('nombres', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('apellidos', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('dni', 'LIKE', '%' . $busqueda . '%')
                        ->paginate(4);
        
        
                        

        return view("user.gestionUsuarios", compact('usuarios', 'busqueda','especialidades'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'nombres'=>'required',
            'apellidos'=>'required',
            'dni'=>'required|unique:users|numeric|digits:8',
            'password' => [
                'required',
                'confirmed',
                'min:8', // Cambiamos la longitud mínima a 8 caracteres
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]+$/' // Requiere al menos una mayúscula, una minúscula, un número y un carácter especial
            ],
            'cargo' => [
                'required',
                Rule::in(['Administrador', 'Medico', 'Recepcionista']) // Valida que el campo "rol" esté entre los valores permitidos
            ]
        ]);

        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $dni = $request->input('dni');
        $cargo= $request->input('cargo');
        $especialidad= $request->input('especialidad');
        $password = bcrypt($request->input('password'));

        $user = User::crearUsuario($nombres,$apellidos,$dni,$cargo,$password);
        $role = Role::where('name', $cargo)->first();
        Model_has_roles::asignarRol($role->id,"App\Models\User",$user->id);
        if ($cargo === 'Medico' ) {
            Medico::crearMedico($user->id,$especialidad);
        }
        
        return response()->json(['success' => true]);
    
    }

    public function update(Request $request){
        
    
    }
    public function destroy(Request $request){
        $id = $request->input('id');
        User::eliminarUsuario($id);
        return redirect()->route('gestionUsuarios')->with('success','Usuario Eliminado correctamente');
    }

}
