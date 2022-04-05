const responderSolicitud = (id_solicitud, contador) =>{

    if(validarFormularioSolicitudes(contador)){
        
        //$('#btn_crear_admin').text('Creando administrador...')
        //$('#btn_crear_admin').prop('disabled', true)
        let respuesta = $('#respuesta_solicitud_'+contador).val().trim()
   
        let url = document.location.origin + `/api/v1/request/${id_solicitud}` 
        let method = 'PUT'
        form_data = { answer: respuesta, id_user_attends_request:1, '_method':'PUT'}
        enviarPeticion(url, method, form_data, 'continuarResponderSolicitud')
    }
}

const continuarResponderSolicitud = (response) => {

    Swal.fire({
        icon: 'success',
        confirmButtonColor: "#141e30",
        confirmButtonText: "Aceptar",
        text: response.message,
        allowEscapeKey : false,
        allowOutsideClick: false
    })
    location.reload();

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

const buscarSolicitudesFecha = () => {

    let fecha = $("#calendario").val().trim()

    if(fecha != ""){

        console.log(fecha)

       let url = document.location.origin + `/api/v1/get_request_by_date/${fecha}` 
        let method = 'GET'
        form_data = {}
        enviarPeticion(url, method, form_data, 'continuarBuscarSolicitudesFecha')

    }

}

const continuarBuscarSolicitudesFecha = (response) => {
     
    console.log(response)
}