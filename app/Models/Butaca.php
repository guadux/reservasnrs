<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Butaca extends Model
{
    use HasFactory;

    protected $fillable = [
        'ocupada',
    ];

    /* Todas las Butacas con reservas de todos los usuarios */
    public static function reservasUsers(){
        $reservas = static::leftjoin("reserva_tiene_butacas", "butacas.id","=","reserva_tiene_butacas.id_butaca")
                            ->leftjoin("reservas", "reservas.id","=","reserva_tiene_butacas.id_reserva")
                            ->select("reservas.id", "reservas.created_at", 
                            "butacas.fila", "butacas.columna", "butacas.nombre_columna",
                            "reservas.id_usuario", "butacas.ocupada")
                            ->orderBy("butacas.fila","asc")
                            ->orderBy("butacas.columna","asc")
                            ->get();
        return $reservas;

    }
}
