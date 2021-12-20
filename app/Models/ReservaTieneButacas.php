<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaTieneButacas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_reserva',
        'id_butaca',
    ];

    public static function infoButaca($id_reserva){
        $reservas = static::where("id_reserva","=",$id_reserva)
                            ->leftjoin("butacas", "butacas.id","=","reserva_tiene_butacas.id_butaca")
                            ->orderBy("butacas.fila","asc")
                            ->orderBy("butacas.columna","asc")
                            ->get();
        return $reservas;

    }
}
