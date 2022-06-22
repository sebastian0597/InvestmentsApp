const registrarSolicitud = () =>{

    if(validarFormularioSolicitudes()){
        
        let form_data = new FormData();
        form_data.append('id_customer', $('#user_id').val());
        form_data.append('request_type', $('#tipo_solicitud').val());
        form_data.append('description', $('#descripcion_solicitud').val().trim());
        let url = document.location.origin + '/api/v1/request/store';
        let method = 'POST';
        enviarPeticion(url, method, form_data, 'continuarRegistrarSolicitud');
    }
}

const continuarRegistrarSolicitud = (response) =>{
    setResponseMessage(response, '/cliente/solicitudes');
}
 
const validarFormularioSolicitudes = () =>{
     let validador = true
     
     if($('#tipo_solicitud').val() == ''){
         agregarError('tipo_solicitud')
         validador=false
     }else{
         quitarError('tipo_solicitud')
     }
 
     if($('#descripcion_solicitud').val().trim() == ''){
         agregarError('descripcion_solicitud')
         validador=false
     }else{
         quitarError('descripcion_solicitud')
     }
 
     return validador
}