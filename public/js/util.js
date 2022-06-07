const agregarError = (element) => {
    /*$('#error_'+element).empty()
    let mensaje = 'El campo '+ element + ' no puede estar vacío.'
    $('#error_'+element).append(mensaje)*/
    $('#' + element).addClass('error_border');
    $('#' + element).addClass('is-invalid');
    $('#' + element)
        .prev()
        .addClass('error_text');
};

const quitarError = (element) => {
    //$('#error_'+element).empty()
    $('#' + element).removeClass('error_border');
    $('#' + element).removeClass('is-invalid');
    $('#' + element)
        .prev()
        .removeClass('error_text');
};

const agregarErrorLogin = (element) => {
    $('#error_' + element).empty();
    let mensaje = 'El campo ' + element + ' no puede estar vacío.';
    $('#error_' + element).append(mensaje);
    $('#' + element).addClass('error_border');
    /*$('#' + element)
    
        .prev()
        .addClass('error_text');*/
};

const quitarErrorLogin = (element) => {
    $('#error_' + element).empty();
    $('#' + element).removeClass('error_border');
    /*$('#'+ element)
    .prev()
    .removeClass('error_text');**/
};

const validarSintaxisCorreo = (element) => {
    let validador = true;
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    $('#error_correo').empty();
    if (!emailRegex.test($('#' + element.id).val())) {
        $('#error_correo').append('La sintáxis del correo no es válida.');
        validador = false;
    }
    return validador;
};

const validarTelefono = (element) =>{
    let validador = true;
    $('#error_'+element.id).empty();
    quitarError(element.id)
    if ($('#'+element.id).val().trim().replace(/\D+/g,'').length != 10) {
        validador = false;
        $('#error_'+element.id).append('El número ingresado no es válido, debe tener 10 dígitos.');
        agregarError(element.id)
    }
    return validador;
}

/*$.getJSON('https://api.ipify.org?format=json', function(data){
            ip = data.ip
            miStorage = window.localStorage;
            localStorage.setItem('ip', ip);
            console.log(localStorage.getItem('ip'))
        });*/

async function consultarIP() {
    let opciones = { method: 'GET', headers: { Accept: 'application/json' } };
    const response = await fetch(
        `https://api.ipify.org?format=json`,
        opciones
    );
    const json_response = await response();

    return response;
}


async function consultarAPIDivisas(moneda = 'COP') {
    let opciones = { method: 'GET', headers: { Accept: 'application/json' } };
    const response = await fetch(
        `https://api.fastforex.io/fetch-multi?from=${moneda}&to=COP&api_key=34f13d24cc-60ddfbf0ab-rbqsu9`,
        opciones
    );
    const monedas = await response.json();

    return monedas.results.COP;
}

const convertirMoneda = () => {
    let divisa = $('#tipo_moneda').val()
    let base_amount = $('#base_monto_inversion').val().trim();
   
    if(divisa!='' && base_amount!==''){
        consultarAPIDivisas(divisa).then(moneda => {
            let amount = parseInt(moneda) * quitarformatNumber(base_amount)
        
            $('#monto_inversion').val(formatNumber(amount));
        });
    } 
};

function isObjEmpty(obj) {
    return Object.keys(obj).length === 0;
}

function formatNumber (n) {
	n = String(n).replace(/\D/g, '');
  return n === '' ? n : Number(n).toLocaleString();
}

function quitarformatNumber(num){
    return num.replace(/[$.]/g,'')
}

const setResponseMessage = (response, url_redireccionamiento = '') => {
    switch (response.status) {
        case 200:
        case 201:
        case 202:
            
            Swal.fire({
                icon: 'success',
                confirmButtonColor: '#6610f2',
                confirmButtonText: 'Aceptar',
                text: response.message,
                allowEscapeKey: false,
                allowOutsideClick: false,
            });
            if (url_redireccionamiento != '') {
                location.href =
                    document.location.origin + url_redireccionamiento;
            }

            break;

        case 400:
        case 401:
        case 402:
            Swal.fire({
                icon: 'warning',
                confirmButtonColor: '#6610f2',
                confirmButtonText: 'Aceptar',
                text: response.message,
                allowEscapeKey: false,
                allowOutsideClick: false,
            });
          
            break;
          

        case 422:
            
            Swal.fire({
                icon: 'warning',
                confirmButtonColor: '#6610f2',
                confirmButtonText: 'Aceptar',
                text: response.responseText,
                allowEscapeKey: false,
                allowOutsideClick: false,
            });

            break;
        case 404:
            Swal.fire({
                icon: 'warning',
                confirmButtonColor: '#6610f2',
                confirmButtonText: 'Aceptar',
                text: 'Not found response',
                allowEscapeKey: false,
                allowOutsideClick: false,
            });
            break;

        case 500:
            Swal.fire({
                icon: 'error',
                confirmButtonColor: '#6610f2',
                confirmButtonText: 'Aceptar',
                text: response.responseJSON.message,
                allowEscapeKey: false,
                allowOutsideClick: false,
            });

            break;
        default:
            console.log(response);
            break;
    }
};

const validarContrasena = (element) => {
   
    $('#'+element.id).strength({
        strengthClass: 'strength',
        strengthMeterClass: 'strength_meter',
        strengthButtonClass: 'button_strength',
        strengthButtonText: 'Mostrar Password',
        strengthButtonTextToggle: 'Ocultar Password' 
    });
}

const mostrarContrasena = (element) =>{
    $('#'+element.id).prop('type', 'text');
}

const ocultarContrasena = (element) =>{
    $('#'+element.id).prop('type', 'password');
}


const validarInicioSesionPrimeraVez = () =>{
    
    if(parseInt($('#ind_inicio_sesion').val()) == 1 && location.pathname != "/cambiar_contrasena"){

        Swal.fire({ 
            icon: 'warning', 
            title: 'Cambio de contraseña',
            text: "Antes de continuar, debe cambiar la contraseña.",  
            showDenyButton: false, 
            showCancelButton: false,  
            confirmButtonColor: '#6610f2',
            confirmButtonText: 'Aceptar',
            allowEscapeKey: false,
            allowOutsideClick: false,
          }).then((result) => {  
              /* Read more about isConfirmed, isDenied below */  
              if (result.isConfirmed) {    
                    location.href = document.location.origin + '/cambiar_contrasena';
              } /*else if (result.isDenied) {    
                  Swal.fire('Changes are not saved', '', 'info')  
               }*/
          });
   

    }
}

const validarInicioSesionPrimeraVezCliente = () =>{
    
    if(parseInt($('#ind_inicio_sesion').val()) == 1 && location.pathname != "/cliente/cambiar_contrasena"){

        Swal.fire({ 
            icon: 'warning', 
            title: 'Cambio de contraseña',
            text: "Antes de continuar, debe cambiar la contraseña.",  
            showDenyButton: false, 
            showCancelButton: false,  
            confirmButtonColor: '#6610f2',
            confirmButtonText: 'Aceptar',
            allowEscapeKey: false,
            allowOutsideClick: false,
          }).then((result) => {  
              /* Read more about isConfirmed, isDenied below */  
              if (result.isConfirmed) {    
                    location.href = document.location.origin + '/cliente/cambiar_contrasena';
              } /*else if (result.isDenied) {    
                  Swal.fire('Changes are not saved', '', 'info')  
               }*/
          });
   

    }
}


const renderizarSolicitudes = () =>{

    let url = window.location.origin+`/api/v1/get_last_active_request`
    let method = 'GET'
    form_data = {}
    enviarPeticion(url, method, form_data, 'continuarRenderizarSolicitudes')
 
 }
 
const continuarRenderizarSolicitudes = (response) =>{
    $('#ultimas_solicitudes').empty()
    $('#span_cantidad').empty()
 
    requests = response.data
    requests = requests == undefined || null ? {} : requests
    let html = ''
    let cantidad_solicitudes = 0
    if (!isObjEmpty(requests)) {
    cantidad_solicitudes=requests.length
        
    requests.forEach(function (request) {

            html+= `<li class="b-l-primary border-4">
                    
                        <p>${request.request_type}<span class="font-info">${request.date}</span></p>
                        <p><span class="font-info">${request.customer.name} - ${request.customer.customer_type}</span></p>
                
                </li>`

    })

    html+=`<li><a class="f-w-700 btn btn-secondary" href="${document.location.origin+'/solicitudes'}">Ver todas las notificaciones</a></li>`
    

    }else{
    
    html+=`<li><a class="f-w-700 btn btn-secondary" href="${document.location.origin+'/solicitudes'}">Ver todas las notificaciones</a></li>`
    }

    $('#span_cantidad').append(cantidad_solicitudes)
    $('#ultimas_solicitudes').append(html)
}

const validarTiempoSesion = ()=>{

    if($('#user_id').val() != '' && $('#user_id').val() != undefined){
        let url = document.location.origin + `/api/validate_sesion`
        let method = 'POST'
    
        let form_data = new FormData()
        form_data.append('id_user', $('#user_id').val())
        enviarPeticion(url, method, form_data, 'continuarvalidarTiempoSesion')
    }
}

const continuarvalidarTiempoSesion = (response) =>{
  
    if(response.status == 200){
        location.href = document.location.origin + '/login';
    }
    else if(response.status == 201){
        
        Swal.fire({ 
            icon: 'warning', 
            title: 'Cierre de sesión',
            text: response.message,  
            showDenyButton: true, 
            showCancelButton: false,  
            confirmButtonColor: '#6610f2',
            confirmButtonText: 'Sí',
            cancelButtonText:'No',
            cancelButtonColor: '#f73164',
            allowEscapeKey: false,
            allowOutsideClick: false,
          }).then((result) => {  
             
              if (result.isConfirmed) {    
                   
                let url = document.location.origin + `/api/extend_session`
                let method = 'POST'
                let form_data = new FormData()
                form_data.append('id_user', $('#user_id').val())
                enviarPeticion(url, method, form_data, 'terminarvalidarTiempoSesion')

              }else if (result.isCancel) {
                Swal.close()
              }
          });
    }
}
const terminarvalidarTiempoSesion = (response) =>{
    setResponseMessage(response)
}
 
setInterval('validarTiempoSesion()',15000);
/*function process(element) {

    const file = document.getElementById(element.id)
        .files[0];
    

    filetype = file.type.replace(/(.*)\//g, '')
    fileSize = (Math.round((file.size * 100) / 1024) / 100).toString() + 'KB';

    /*document.getElementById('details').innerHTML +=
        'FOTO: ' +
        file.name +
        '<br>Size: ' +
        fileSize +
        '<br>Type: ' +
        file.type;
    document.getElementById('details').innerHTML += '<p>';

    if (!file || filetype=='pdf') return;
  
    const reader = new FileReader();
    reader.readAsDataURL(file);

    reader.onload = function (event) {
        const imgElement = document.createElement('img');
        imgElement.src = event.target.result;
        //document.querySelector('#input').src = event.target.result;

        imgElement.onload = function (e) {
            //console.log('leyo:2');

            const canvas = document.createElement('canvas');
            const MAX_WIDTH = 400;

            const scaleSize = MAX_WIDTH / e.target.width;
            canvas.width = MAX_WIDTH;
            canvas.height = e.target.height * scaleSize;

            const ctx = canvas.getContext('2d');

            ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);

            const srcEncoded = ctx.canvas.toDataURL(e.target, 'image/jpeg');
            console.log(srcEncoded)
            // you can send srcEncoded to the server
            document.querySelector('#output').src = srcEncoded;

            //get the resized image from src
            var resized = document.querySelector('#output').src;
        };
    };
}*/
