@extends('admin.layout')

@section('content')
<div class="container">
    <a href="{{ url('admin/users/create') }}" class="btn btn-success">Cargar Usuario</a>

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
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usr)
            <tr>
                <td scope="row">{{ $usr->id }}</td>
                <td>{{ $usr->name }}</td>
                <td>{{ $usr->email }}</td>
                <td><a class="btn btn-warning" href="{{ url('admin/users/'.$usr->id.'/edit')}}">Editar</a>
                    <form class="d-inline" method="POST" action="{{ url('admin/users/'.$usr->id)}}">
                    @csrf
                    {{ method_field('DELETE') }}
                        <input type="submit" value="Eliminar" onclick="return confirm('Está seguro que desea eliminar el usuario?')" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection