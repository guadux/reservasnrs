@extends('layouts.app')


@section('content')
<div class="container">
    
    <a href="{{ url('reservas/grilla') }}" class="btn btn-success"><i class="fa fa-eye"></i></a> 


    @if (Session::has("mensaje"))
        <hr>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
            {{ Session::get("mensaje") }}
        </div>
    @endif
     
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha y Hora</th>
                <th>Personas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
            <tr>
                <td scope="row">{{ $reserva->id }}</td>
                <td>{{ \Carbon\Carbon::createFromDate($reserva->created_at)->format('d-m-Y H:m'); }}</td>
                <td>{{ $reserva->personas }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ url('reservas/'.$reserva->id.'/edit') }}">Editar</a>
                    <form method="post" action="{{ url ('reservas', $reserva->id) }}" class="d-inline">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class="btn btn-danger" value="Eliminar" onclick="return confirm('Está seguro que desea eliminar esta reserva?')" type="submit">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection