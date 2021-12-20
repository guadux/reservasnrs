<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::where("is_admin","<>",1)->get();
        return view('admin.users', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin =0;
        if (isset($request["admin"])){ 
            $admin=1; 
        }
        
        $campos =[
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $mensaje=[
            'required' => 'El campo :attribute es requerido'
        ];

        $this->validate($request,$campos, $mensaje);

        User::insert([
            'name' => $request['name'],
            'apellidos' => $request['apellidos'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'is_admin' => $admin,
        ]);

        return redirect('admin/users')->with('mensaje','Usuario creado con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('admin.edit-user', compact('usuario') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos =[
            'name' => 'required|string|max:100',
            'apellido' => 'string|max:100',
        ];

        $mensaje=[
            'required' => 'El campo :attribute es requerido'
        ];

        $this->validate($request,$campos, $mensaje);

        $datos = $request->except('_token', '_method');
        User::where("id","=",$id)->update($datos);
		
		// return response()->json($datos);
        return redirect('admin/users')->with('mensaje','Usuario editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //primero eliminamos todas sus reservas
        $reservas = Reserva::where("id_usuario","=",$id)->get();
        
        foreach ($reservas as $reserva){
            Reserva::deleteDatos($reserva->id);
            //elimino la reserva
            Reserva::destroy($reserva->id);
        }
        
        User::destroy($id);
        return redirect('admin/users')->with('mensaje','Usuario eliminado con éxito');
    }
}
