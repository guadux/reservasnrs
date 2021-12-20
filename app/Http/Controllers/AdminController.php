<?php

namespace App\Http\Controllers;

use App\Models\Butaca;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ReservaTieneButacas;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    /* descarga del log file */
    public function log()
    {
        $pathToFile = storage_path("logs/reservas.log");

        $name = time().'.txt';

        $headers = ['Content-Type: application/octet-stream'];

        return response()->download($pathToFile, $name, $headers);

    }

    /* Grilla para el admin*/
    public function reservas()
    {
        $asientos = Butaca::reservasUsers();
        return view('admin.reservas', compact('asientos'));
    }

    /* MODAL de cada reserva*/
    public function verReserva(Request $request)
    {
        $id_reserva = $request['id_reserva'];
        $reserva = Reserva::find($id_reserva);
        $usuario = User::find($reserva->id_usuario);
        $butacas = ReservaTieneButacas::infoButaca($id_reserva);

        $datos["html"]= "<b>Usuario: </b>".$usuario['name']." ".$usuario['apellidos']."<br>";
        $datos["html"] .= "<b>Reserva ID: </b>".$reserva['id']." - ".$reserva['created_at']."<br>";
        $datos["html"] .= "<br><b>Butacas Reservadas:</b><br>";
        foreach ($butacas as $b){
            $datos["html"] .= "- Butaca: ".$b['fila']."".$b['nombre_columna']."<br>";
        }

        
        return response()->json($datos);
    }

}
