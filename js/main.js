
var verLegal = false;
var btnLegal  = false;
$(function () {

    $('.carousel').carousel();

        var divCheck = $('#divCheck'); // asigno el elemento a la variable para manipularla despues
        divCheck.css('display', 'none'); // pongo el atributo no visible para todo el elemento
        

        // dejo visible o no el input de la fecha
            $("#radio-0").click(function(){
                $('#radio0').prop('checked', true)
                divCheck.show("swing");
            });

            $("#radio-1").click(function(){
                divCheck.hide("swing");
                $('#radio1').prop('checked', true)
            });


    // picker del formulario
    var picker = new Pikaday(
        {
            field: document.getElementById('check'),    
            position: 'bottom right',
            firstDay: 1,
            format: 'DD-MM-YYYY',
            minDate: new Date(),
            maxDate: new Date(2020, 12, 31),
            yearRange: [2000,2020]
        });


        // validacion de correo nombre y fecha

        $('#form_log').submit(function(e){
            /*
            1) traerme los datos que estan en los campos
            2) comprobar que tengan datos los campos
            3) verificar si es visitante o huesped
            4) devilver un verdadero o falso 
            5) si es falso disparar el setTiemout con el alert.

            */
            var email= $("#txtmail").val();
            var nombre = $("#txtnombre").val();
            var fecha = $("#check").val();

                if (email == "" || nombre == "") {
                    
                        showAlert()
                        return false

                } else {
                    
                    if($('#radio0').prop('checked')){

                        // comprobar que es una fecha el contenido
                        if(!moment(fecha, 'dd/mm/YYYY').isValid()){
                            showAlert()
                            return false
                        }

                    }


                    //  comprobar que este pulsado legal
                    
                    if($('#check1').prop('checked')){
                        return true;

                    }else{
                        
                        return false;
                    }
                    
                }

            });
            
});


    function showAlert(){

        $( "#alerta" ).addClass("alert alert-danger text-center")
        $( "#alerta" ).html("<strong><i class='fa fa-exclamation-triangle' aria-hidden='true'></i></strong>  Debes indicar la fecha de salida.");  
        //class="alert alert-danger text-center" 
        setTimeout(function(){

        $( "#alerta" ).html("");
        $( "#alerta" ).removeClass("alert alert-danger text-center");
        }, 4000);
            
    }

    $("#iconLegal").click(function(){

        if (verLegal){

            $('#legal').removeClass( "habilitar" );
            $('#legal').addClass( "deshabilitar" );
            verLegal = false;

        }else{
            $('#legal').removeClass( "deshabilitar" );
            $('#legal').addClass( "habilitar" );
            verLegal = true;
        }

    });


    function enabledBtn(){

        if ($("#check1").prop( "checked" )){

            $("#btn").attr('disabled', false);

        }else{

            $("#btn").attr('disabled', true);
        }
    
    };
