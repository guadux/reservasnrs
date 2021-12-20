@extends('admin.layout')

@section('content')


<div class="container">
<form action="{{ url('admin/users/'.$usuario->id) }}" method="post">
	@csrf
    {{ method_field('PATCH') }}
	
    <h1>Editar Usuario</h1>

    @if (count($errors)>0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        
            <ul>
        @foreach($errors->all() as $err)
        
            <li>{{ $err }}</li>
        @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ isset($usuario->name) ? $usuario->name:old('name') }}">
    
    </div>

    <div class="form-group">
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ isset($usuario->apellidos) ? $usuario->apellidos:old('apellido') }}">
    
    </div>
    <div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" disabled class="form-control" value="{{$usuario->email}}">
    
    </div>

    
    <hr>
    <div class="form-group">
    <input class="btn btn-success" type="submit" value="Editar"> 

    <a class="btn btn-primary" href="{{url('admin/users')}}">Volver</a>
    </div>
	
</form>
</div>
@endsection