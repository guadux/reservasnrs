<ol class="teatro">

        <?php
            $fila_actual = 0;
            $empezo = false;
        ?>
        @foreach ($asientos as $asiento)

            @if ($fila_actual != $asiento->fila)

                @if ($empezo)
                    <!--cierro la fila anterior-->
                    </ol>
                    </li> 
                @endif

                <?php
                    $fila_actual = $asiento->fila;
                    $empezo = true;
                ?>
                <!-- arranca una nueva fila-->
                <li class="row row--1">
                <ol class="seats" type="A">
            @endif
            @if ($asiento->ocupada == 1)
                @if($modo == "ver" and $asiento->id_usuario == Auth::user()->id)
                    <li class="seat">
                        <input type="checkbox" disabled id="<?=$asiento->fila?><?=$asiento->nombre_columna?>" />
                        <label class="btn btn-success" for="<?=$asiento->fila?><?=$asiento->nombre_columna?>">Ocupado</label>
                    </li>
                @elseif($modo == "editar" and $asiento->id == $id_reserva)
                
                    <li class="seat">
                        <input class ="check" checked type="checkbox" id="<?=$asiento->fila?><?=$asiento->nombre_columna?>"  name="<?=$asiento->fila?><?=$asiento->nombre_columna?>" />
                        <label class="btn-success" id="label-<?=$asiento->fila?><?=$asiento->nombre_columna?>" for="<?=$asiento->fila?><?=$asiento->nombre_columna?>"><?=$asiento->fila?><?=$asiento->nombre_columna?></label>
                    </li>
                @else
                    <li class="seat">
                    <input type="checkbox" disabled id="<?=$asiento->fila?><?=$asiento->nombre_columna?>" />
                    <label class="btn btn-secondary" for="<?=$asiento->fila?><?=$asiento->nombre_columna?>">Ocupado</label>
                    </li>
                @endif
            @else
            
                    <li class="seat">
                    <input class ="check" type="checkbox" id="<?=$asiento->fila?><?=$asiento->nombre_columna?>"  name="<?=$asiento->fila?><?=$asiento->nombre_columna?>" />
                    <label class="btn-warning" id="label-<?=$asiento->fila?><?=$asiento->nombre_columna?>" for="<?=$asiento->fila?><?=$asiento->nombre_columna?>"><?=$asiento->fila?><?=$asiento->nombre_columna?></label>
                    </li>
                
            @endif
            
        @endforeach
            <!--cierro la ultima fila-->
            </ol>
            </li>
        </ol>

        <div class="row align-items-start">

            <div class="col-8">
            @if ($modo =="reservar" or $modo=="editar")
            <label>Personas: </label>
            <input type="number" min="1" max="10" step="1" name="personas" id="personas" value="{{ isset($reserva->personas) ? $reserva->personas:1 }}">
            <input type="submit" value="{{ ucfirst($modo)}}" class="btn btn-primary" >
            @endif
            </div>
                    
            <div class="col-4 float-end text-end">
               
                <div class="mb-3">
                @if ($modo =="reservar" or $modo=="editar")
                    <button type="button" class="btn btn-warning btn-sm">Libre</button>
                    <button type="button" class="btn btn-secondary btn-sm">Ocupado</button>
                    <button type="button" class="btn btn-success btn-sm ">Seleccionado</button>
                @else
                    <button type="button" class="btn btn-warning btn-sm">Butaca</button>
                    <button type="button" class="btn btn-success btn-sm">Tu reserva</button>
                @endif
                </div>
                Referencias
            </div>
        </div>