 /**
    * cambio la clase del boton 
    * de acuerdo al estado anterior
    */
   $(".check").click(function() {
        id = $(this).attr("id");
        label_class = $("#label-"+id).attr("class");
        if (label_class=="btn-warning"){
            $("#label-"+id).removeClass("btn-warning").addClass("btn-success");
            $("#"+id).attr("checked", true);
        }
        else{
            $("#label-"+id).removeClass("btn-success").addClass("btn-warning");
            $("#"+id).attr("checked", false);
        }
        
    });

    /**
     * antes de enviar cheque que haya seleccionado
     * la cantidad de personas correctamente
     */
   $("#reservar").submit(function(event) {
        var numberOfChecked = $('input:checkbox:checked').length;
        var personas = $('#personas').val();
        if (numberOfChecked==personas)
            return true;
            
        else{
            alert("La cantidad de butacas seleccionadas no coincide con la cantidad de personas");
            return false;
        }
    });
	
	