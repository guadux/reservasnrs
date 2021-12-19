<?php

namespace Database\Seeders;

use App\Models\Butaca;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //insertamos las butacas x default ASCII A=65
        for ($fila=1;$fila<=5;$fila++){
            for ($columna=1;$columna<=10;$columna++){
               $butaca = new Butaca();
               $butaca["fila"] = $fila;
               $butaca["columna"] = $columna;
               //si columna = 1 => columna + 64 = 65, que es 'A'
               $caracter = $columna + 64;
               $butaca["nombre_columna"] = chr($caracter);
               $butaca->save();
            }
        }
        
         //seeder de usrs
         $this->call(UsersTableSeeder::class);
    }
}
