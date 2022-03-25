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

$('#base_monto_inversion').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});

const validarMontoMinimo = () =>{
    convertirMoneda();
    if(parseFloat($('#monto_inversion').val().trim())<1000000){
        alert('El monto no puede ser menor a 1000000')
    }
}

const crearCliente = () =>{

    if(validarFormularioCliente()){
        alert('Campos validados')
    }
}

const validarFormularioCliente = () =>{
    let validador=true;
    if($('#nombres').val().trim() == ""){
        agregarError('nombres')
        validador=false
    }else{
        quitarError('nombres')
    }
    
    if($('#apellidos').val().trim() == ""){
        agregarError('apellidos')
        validador=false
    }else{
        quitarError('apellidos')
    }
    if($('#tipo_documento').val() == ""){
        agregarError('tipo_documento')
        validador=false
    }else{
        quitarError('tipo_documento')
    }
    if($('#numero_documento').val().trim() == ""){
        agregarError('numero_documento')
        validador=false
    }else{
        quitarError('numero_documento')
    }

    //Actividad económica
    if($('#actividad_economica').val() == ""){
        agregarError('actividad_economica')
        validador=false
    }else{
        quitarError('actividad_economica')
    }
    if($('#descripcion_independiente').val().trim() == "" && $('#descripcion_independiente').is(':visible')){
        agregarError('descripcion_independiente')
        validador=false
    }else{
        quitarError('descripcion_independiente')
    }
    if($('#empresa').val().trim() == "" && $('#empresa').is(':visible')){
        agregarError('empresa')
        validador=false
    }else{
        quitarError('empresa')
    }
    if($('#cargo').val().trim() == "" && $('#cargo').is(':visible')){
        agregarError('cargo')
        validador=false
    }else{
        quitarError('cargo')
    }
    if($('#antiguedad').val().trim() == "" && $('#antiguedad').is(':visible')){
        agregarError('antiguedad')
        validador=false
    }else{
        quitarError('antiguedad')
    }

    if($('#tipo_contrato').val() == "" && $('#tipo_contrato').is(':visible')){
        agregarError('tipo_contrato')
        validador=false
    }else{
        quitarError('tipo_contrato')
    }

    if($('#certificado_laboral').val() == "" && $('#certificado_laboral').is(':visible')){
        agregarError('certificado_laboral')
        validador=false
    }else{
        quitarError('certificado_laboral')
    }
    if($('#fondo_pension').val().trim() == "" && $('#fondo_pension').is(':visible')){
        agregarError('fondo_pension')
        validador=false
    }else{
        quitarError('fondo_pension')
    }

    if($('#otros_actividad').val().trim() == "" && $('#otros_actividad').is(':visible')){
        agregarError('otros_actividad')
        validador=false
    }else{
        quitarError('otros_actividad')
    }

    if($('#cuenta_bancaria').val() == ""){
        agregarError('cuenta_bancaria')
        validador=false
    }else{
        quitarError('cuenta_bancaria')
    }

    //Personal
    
    if($('#numero_cuenta').val().trim() == "" && $('#numero_cuenta').is(':visible')){
        agregarError('numero_cuenta')
        validador=false
    }else{
        quitarError('numero_cuenta')
    }
    
    if($('#tipo_cuenta').val().trim() == "" && $('#tipo_cuenta').is(':visible')){
        agregarError('tipo_cuenta')
        validador=false
    }else{
        quitarError('tipo_cuenta')
    }

    if($('#nombre_banco').val().trim() == "" && $('#nombre_banco').is(':visible')){
        agregarError('nombre_banco')
        validador=false
    }else{
        quitarError('nombre_banco')
    }

    if($('#certificado_cuenta').val().trim() == "" && $('#certificado_cuenta').is(':visible')){
        agregarError('certificado_cuenta')
        validador=false
    }else{
        quitarError('certificado_cuenta')
    }

    //tercero
    
    if($('#cedula_tercero').val().trim() == "" && $('#cedula_tercero').is(':visible')){
        agregarError('cedula_tercero')
        validador=false
    }else{
        quitarError('cedula_tercero')
    }

    if($('#nombre_tercero').val().trim() == "" && $('#nombre_tercero').is(':visible')){
        agregarError('nombre_tercero')
        validador=false
    }else{
        quitarError('nombre_tercero')
    }

    if($('#parentesco').val().trim() == "" && $('#parentesco').is(':visible')){
        agregarError('parentesco')
        validador=false
    }else{
        quitarError('parentesco')
    }
    
    if($('#certificado_bancario_tercero').val().trim() == "" && $('#certificado_bancario_tercero').is(':visible')){
        agregarError('certificado_bancario_tercero')
        validador=false
    }else{
        quitarError('certificado_bancario_tercero')
    }
    if($('#carta_tercero').val().trim() == "" && $('#carta_tercero').is(':visible')){
        agregarError('carta_tercero')
        validador=false
    }else{
        quitarError('carta_tercero')
    }
    
    
    


    

    if($('#tipo_moneda').val() == ""){
        agregarError('tipo_moneda')
        validador=false
    }else{
        quitarError('tipo_moneda')
    }

    if($('#metodo_pago').val() == ""){
        agregarError('metodo_pago')
        validador=false
    }else{
        quitarError('metodo_pago')
    }
    if($('#base_monto_inversion').val() == ""){
        agregarError('base_monto_inversion')
        validador=false
    }else{
        quitarError('base_monto_inversion')
    }

    return validador;
    
    

    
    
    
}