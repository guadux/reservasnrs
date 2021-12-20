<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario',
    ];

    /* Reservas del usuario logueado */
    public static function reservasUser(){
        $reservas = static::where("id_usuario","=",Auth::user()->id)
                            ->join("reserva_tiene_butacas", "reservas.id","=","reserva_tiene_butacas.id_reserva")
                            ->join("butacas", "butacas.id","=","reserva_tiene_butacas.id_butaca")
                            ->select("reservas.id", "reservas.created_at", 
                            "butacas.fila", "butacas.columna", "butacas.nombre_columna")
                            ->get();
        return $reservas;

    }

    public static function deleteDatos($id_reserva){
        $reserva = static::find($id_reserva);
        $butacas_reservadas = ReservaTieneButacas::where("id_reserva","=",$id_reserva)->get();

        foreach ($butacas_reservadas as $butaca_r){
            //libero las butaca
            Butaca::where("id","=",$butaca_r->id_butaca)->update(['ocupada' => 0]);
            //elimino la butaca de la reserva
            ReservaTieneButacas::destroy($butaca_r->id);
        }
    }
    
}
