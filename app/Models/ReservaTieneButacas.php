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
}
