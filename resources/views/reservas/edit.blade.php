@extends('layouts.app')

@section('content')
<div class="container">

    

    <form id="reservar" action="{{ url('/reservas/'.$id_reserva )}}" method="post" >      
        <div class="btn btn-primary d-block escenario">
            ESCENARIO
        </div>
    @csrf
    {{ method_field('PATCH') }}
    <input type="hidden" name="id_reserva" value="{{ $id_reserva }}">
    @include('reservas.form', ["modo"=>"editar"])
        
    </form>

    
</div>


@endsection

@section('scripts')
	<script src="{{ asset('js/teatro.js') }}"></script>
@endsection