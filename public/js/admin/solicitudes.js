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

    setResponseMessage(response)
    if(response.status == 200 || response.status == 201 || response.status ==  202){
        location.reload()
    }  

}

const validarFormularioSolicitudes = (contador) => {
    let validador=true
   
    if($('#respuesta_solicitud_'+contador).val().trim() == ''){ 

        validador=false
        agregarError('respuesta_solicitud_'+contador)

    }else{
        quitarError('respuesta_solicitud_'+contador)
    }

    return validador;

}

const buscarSolicitudesFecha = () => {

    let fecha = $('#calendario').val().trim()

    if(fecha != ''){

        let url = document.location.origin + `/api/v1/get_request_by_date/${fecha}` 
        let method = 'GET'
        form_data = {}
        enviarPeticion(url, method, form_data, 'continuarBuscarSolicitudesFecha')

    }

}

const continuarBuscarSolicitudesFecha = (response) => {
    $('#card_body').empty()

    let requests = response.data
   
    requests = requests == undefined || null ? {} : requests

    if (!isObjEmpty(requests)) {
        html = ``
        aux=0
        requests.forEach(function (request) {
            btn_responder = ``
            class_status = ``
            answer = ``
            btn_enviar =``

            if(request.id_status == 1){
                btn_responder = `<button class='btn btn-primary btn-block btn-mail w-100' type='button' data-bs-toggle='modal' data-bs-target='.modalRquests_${aux}'>Responder</button>`
                class_status = `badge-secondary`
                answer = `<textarea  class='form-control' id='respuesta_solicitud_${aux}' autocomplete='off'></textarea>`
                btn_enviar = `<button class='btn btn-secondary' id='btn_responder' onclick='responderSolicitud(${request.id}, ${aux})' type='button'>Enviar</button>`
               

            }else if(request.id_status != 1){
                class_status = `badge-primary`
                btn_responder = `<button class='btn btn-primary btn-block btn-mail w-100' type='button' data-bs-toggle='modal' data-bs-target='.modalRquests_${aux}'>Ver</button>`
                answer = `<label>${request.answer}</label>`
               
            }
            console.log(request.answer)
 
            html +=
            ` 
                <div class='media card-box'>
                    <div class='media-body'>
                        <p>${request.date} <span>${request.hour}</span><span
                            class='badge ${class_status}'>${request.status}</span>
                        </p>
                        <h6>${request.request_type}</h6>
                        <span>${request.short_desc}</span>

                    </div>

                    <ul class='nav main-menu' role='tablist'>
                        <li class='nav-item'> `+
                            btn_responder +
                            `
                            <div class='modal fade modal-bookmark modalRquests_${aux}' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>${request.request_type}</h5>
                                        <button class='btn-close' type='button' data-bs-dismiss='modal' aria-label='Close'> </button>
                                    </div>

                                    <div class='modal-body'>
                                    <form class='form-bookmark needs-validation' id='bookmark-form' novalidate=''>
                                        <div class='row'>
                                            <div class='media-body'>
                                                <div class='mb-3 mt-0 col-md-12'>
                                                <h6>Nombres</h6>
                                                <label>${request.customer.name} ${request.customer.last_name}</label>
                                                <h6>N° Identificación</h6>
                                                <label>${request.customer.document_number}</label>
                                                </div>
                                                <div class='mb-3 mt-0 col-md-6'>
                                                <h6>Tipo cliente</h6>
                                                <label>${request.customer.customer_type}</label>
                                                </div>
                                            </div>
                                            <div  class='mb-3 mt-0 col-md-12'>
                                                
                                                <h5>Asunto de la solicitud</h5>
                                                <span>${request.description}</span>
                            
                                            </div>

                                            <div class='mb-3 col-md-12 my-0'>
                                                <h6>Respuesta</h6>
                                                `+answer+`  
                                            </div>
                                        </div>
                                        `+ btn_enviar +`
                                        <button class='btn btn-primary' type='button' data-bs-dismiss='modal'>Cancel</button>

                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            `
            aux++
        })

        
    } else {
        html = `<span>No hay datos para los solicitudes para la fecha seleccionada.</span>`
    }
    $('#card_body').append(html)
    
}