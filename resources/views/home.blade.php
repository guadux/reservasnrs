@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenidx!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Ya podés elegir tus butacas!') }}
                </div>
                <div class="card-body">
                    <div class="panel-body">
                      Acceso para administradores del sitio
                      <a class="" href="{{route('admin.index')}}">ACCEDER</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
