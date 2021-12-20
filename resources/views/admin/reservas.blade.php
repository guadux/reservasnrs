@extends('admin.layout')

@section('content')
<div class="container">

    <form action="" >      
        <div class="btn btn-primary d-block escenario">
            ESCENARIO
        </div>
    
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
        
        <li class="seat ver-reserva" id="{{$asiento->id}}" data-bs-toggle="modal" data-bs-target="#seatModal">
            <input class ="check" type="checkbox" id="<?=$asiento->fila?><?=$asiento->nombre_columna?>"  name="<?=$asiento->fila?><?=$asiento->nombre_columna?>" />
            <label class="btn-secondary" id="label-<?=$asiento->fila?><?=$asiento->nombre_columna?>" for="<?=$asiento->fila?><?=$asiento->nombre_columna?>"><?=$asiento->fila?><?=$asiento->nombre_columna?></label>
        </li>
       
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

      
    <div class="col-3 ">
       
        Haciendo click sobre las butacas ocupadas encontrará la información de la reserva
    </div>

      
    <div class="col-9 float-end text-end">
       
        <div class="mb-3">
            <button type="button" class="btn btn-warning btn-sm">Libre</button>
            <button type="button" class="btn btn-secondary btn-sm">Ocupado</button>
       
        </div>
        Referencias
    </div>
</div>
        
    </form>

    
</div>

<!-- Modal -->
<div class="modal fade" id="seatModal" tabindex="-1" aria-labelledby="seatModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="seatModalLabel">Info de la reserva seleccionada</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
	<script src="{{ asset('js/admin.js') }}"></script>
@endsection