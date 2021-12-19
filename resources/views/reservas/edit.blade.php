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

<script>
   
   $(".check").click(function() {
        id = $(this).attr("id");
        label_class = $("#label-"+id).attr("class");
        // alert(label_class);
        if (label_class=="btn-warning"){
            $("#label-"+id).removeClass("btn-warning").addClass("btn-success");
            $("#"+id).attr("checked", true);
        }
        else{
            $("#label-"+id).removeClass("btn-success").addClass("btn-warning");
            $("#"+id).attr("checked", false);
        }
        
    });

   $("#reservar").submit(function(event) {
        // event.preventDefault();
        var numberOfChecked = $('input:checkbox:checked').length;
        var personas = $('#personas').val();
        if (numberOfChecked==personas)
            return true;
            
        else{
            alert("La cantidad de butacas seleccionadas no coincide con la cantidad de personas");
            return false;
        }
    });



</script>
@endsection