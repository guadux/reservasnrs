
        /** 
         * cargar la info de la reserva en el modal
         * de acuerdo a la butaca clickada
         */
    $(".ver-reserva").on("click", function(){
        var id_reserva = $(this).attr('id');
        
        var parametros = {
            "_token": "{{csrf_token()}}",
            "id_reserva" : id_reserva,
            
        };
        $.ajax({
            data: parametros,
            dataType: 'JSON',
            method: "GET",
            url: "reservas/view",
            success: function(response){
                $("#modal-body").html(response.html);
            }
        });
        
    });