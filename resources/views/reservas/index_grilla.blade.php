@extends('layouts.app')

@section('content')
<div class="container">

    <a href="{{ url('reservas') }}" class="btn btn-success"><i class="fa fa-eye"></i></a> 
    <hr>
    <form action="" >      
        <div class="btn btn-primary d-block escenario">
            ESCENARIO
        </div>
    
    @include('reservas.form', ["modo"=>"ver"])
        
    </form>

    
</div>


@endsection