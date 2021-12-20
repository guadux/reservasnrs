@extends('layouts.app')

@section('content')
<div class="container">

    

    <form id="reservar" action="{{ url('/reservas' )}}" method="post" >      
        <div class="btn btn-primary d-block escenario">
            ESCENARIO
        </div>
    @csrf
    @include('reservas.form', ["modo"=>"reservar"])
        
    </form>

    
</div>

@endsection

@section('scripts')
	<script src="{{ asset('js/teatro.js') }}"></script>
@endsection