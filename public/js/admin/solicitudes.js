const responderSolicitud = (id_solicitud, contador) =>{

    if(validarFormularioSolicitudes(contador)){
        
        //$('#btn_crear_admin').text('Creando administrador...')
        //$('#btn_crear_admin').prop('disabled', true)
        let respuesta = $('#respuesta_solicitud_'+contador).val().trim()
        
        var form_data = new FormData()
        form_data.append('answer', respuesta)
        form_data.append('id_user_attends_request', 1)
       
        let url = document.location.origin + `/api/v1/request/${id_solicitud}` 
        let method = 'PUT'
        console.log(url)
        enviarPeticion(url, method, form_data, 'continuarResponderSolicitud')
    }
}

const continuarResponderSolicitud = (response) => {

    console.log(response)

}

const validarFormularioSolicitudes = (contador) => {
    let validador=true
   
    if($('#respuesta_solicitud_'+contador).val().trim() == ""){ 

        validador=false
        agregarError('respuesta_solicitud_'+contador)

    }else{
        quitarError('respuesta_solicitud_'+contador)
    }

    return validador;

}