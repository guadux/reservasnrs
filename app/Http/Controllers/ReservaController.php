<?php

namespace App\Http\Controllers;

use App\Models\Butaca;
use App\Models\Reserva;
use App\Models\ReservaTieneButacas;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = Reserva::where("id_usuario","=",Auth::user()->id)->get();
        return view("reservas.index", compact('reservas'));
    }

    public function indexGrilla()
    {
        
        $asientos = Butaca::reservasUsers();
        return view("reservas.index_grilla", compact( 'asientos'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asientos = Butaca::orderBy("fila", "asc")->orderBy("columna","asc")->get();
        return view("reservas.create", compact('asientos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_usr = Auth::user()->id;
        $datos = $request->except('_token', 'personas');
        
        $reserva = new Reserva();
        $reserva->id_usuario = $id_usr;
        $reserva->personas = $request['personas'];
        $reserva->save();

        $id_reserva = $reserva->id;

        foreach ($datos as $d=>$e){
            
            //actualizo la butaca como ocupada
            $fila = substr($d, 0, 1);
            $columna = substr($d, 1, 1);
            $butaca = Butaca::where("fila","=",$fila)->where("nombre_columna","=",$columna)->first();
            $butaca->update(array('ocupada' => 1));

            //asigno la butaca a la reserva
            ReservaTieneButacas::create(array('id_reserva' => $id_reserva, "id_butaca"=> $butaca->id));

            

        }

        //Guardo en el log que se realizo una reserva
        Log::channel('reservas')
        ->info('Reserva ejecutada del usuario '.$id_usr.". Cantidad de butacas: ".$request['personas'].
        '. Id de la reserva: '.$id_reserva);

        return redirect("reservas");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit($id_reserva)
    {
        $asientos = Butaca::reservasUsers();
        $reserva = Reserva::find($id_reserva);
        return view("reservas.edit", compact('asientos','id_reserva','reserva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        $id_usr = Auth::user()->id;
        $datos = $request->except('_token', 'personas', 'id_reserva', '_method');

        $id_reserva = $request['id_reserva'];
        $personas = $request['personas'];

        Reserva::where('id', $id_reserva)
            ->update(['personas' => $personas]);

        //elimino todos los datos de la reserva
        // $this->deleteDatos($id_reserva);
        Reserva::deleteDatos($id_reserva);

        foreach ($datos as $d=>$e){
            
            //actualizo la butaca como ocupada
            $fila = substr($d, 0, 1);
            $columna = substr($d, 1, 1);
            $butaca = Butaca::where("fila","=",$fila)->where("nombre_columna","=",$columna)->first();
            $butaca->update(array('ocupada' => 1));

            //asigno la butaca a la reserva
            ReservaTieneButacas::create(array('id_reserva' => $id_reserva, "id_butaca"=> $butaca->id));

            

        }

        //Guardo en el log que se realizo una reserva
        Log::channel('reservas')
        ->info('Reserva actualizada del usuario '.$id_usr.". Cantidad de butacas: ".$request['personas'].
        '. Id de la reserva: '.$id_reserva);

        return redirect("reservas");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_reserva)
    {
        
        Reserva::deleteDatos($id_reserva);

        //elimino la reserva
        Reserva::destroy($id_reserva);
        return redirect('reservas')->with('mensaje','Reserva eliminada con éxito');
    }
}
