const seleccionarActividadEconomica = () =>{

    $('#div_independiente').css('display','none')
    $('#div_empleado').css('display','none')
    $('#div_empleado_2').css('display','none')
    $('#div_pensionado').css('display','none')
    $('#div_otros').css('display','none')
    

    switch ($('#actividad_economica').val()) {
        case '1':
            $('#div_independiente').css('display','flex')
            //Se muestra el div de Independiente
            break;
        case '2':
                $('#div_empleado').css('display','flex')
                $('#div_empleado_2').css('display','flex')
                
                //Se muestra el div de Empleado
            break;
            case '3':
                $('#div_pensionado').css('display','flex')
               
                //Se muestra el div de Pensionado
            break;
            case '4':
                $('#div_otros').css('display','flex')
               
                //Se muestra el div de Otra actividad
            break;
    
        default:
            break;
    }

    
}

const seleccionarCuentaBancaria = () =>{

    $('#div_cuenta_personal').css('display','none')
    $('#div_cuenta_personal_2').css('display','none')
    $('#div_cuenta_tercero').css('display','none')
    $('#div_cuenta_tercero_2').css('display','none')
    
    switch ($('#cuenta_bancaria').val()) {
        case '1':
            $('#div_cuenta_personal').css('display','flex')
            $('#div_cuenta_personal_2').css('display','flex')
        
            break;

        case '2':
                $('#div_cuenta_tercero').css('display','flex')
                $('#div_cuenta_tercero_2').css('display','flex')
            
            break;
    
        default:
            break;
    }
}

$('#monto_inversion').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});

const validarMontoMinimo = () =>{

    if($('#monto_inversion').val().trim()<1000000){
        alert('El monto no puede ser menor a 1000000')
    }
}

const crearCliente = () =>{

    validarFormularioCliente()
}

const validarFormularioCliente = () =>{

    if($('#nombres').val().trim() == ""){
        agregarError('nombres')
    }
    
    if($('#apellidos').val().trim() == ""){
        agregarError('apellidos')
    }
    if($('#tipo_documento').val() == ""){
        agregarError('tipo_documento')
    }
    if($('#numero_documento').val().trim() == ""){
        agregarError('numero_documento')
    }
    if($('#actividad_economica').val() == ""){
        agregarError('actividad_economica')
    }

    
    
}