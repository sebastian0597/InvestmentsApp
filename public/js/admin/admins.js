const crearAdmin = () =>{

    if(validarCrearAdmin()){

        $('#btn_crear_admin').text('Creando administrador...')
        $('#btn_crear_admin').prop('disabled', true)
        let nombres = $('#nombres').val().trim()
        let correo = $('#correo').val().trim()
        let rol = $('#rol').val()


        var form_data = new FormData()
        form_data.append('name', nombres)
        form_data.append('email', correo)
        form_data.append('id_rol', rol)
       
        let url = document.location.origin + '/api/v1/admin/'
        let method = 'POST'

        enviarPeticion(url, method, form_data, 'continuarCrearAdmin')
    }
}

const continuarCrearAdmin = (response) =>{
    $('#btn_crear_admin').text('Crear administrador')
    $('#btn_crear_admin').prop('disabled', false)
    
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
            })
            $('#form-admin')[0].reset();
            break

        case 400:
        case 401:
        case 402:
            console.log(response)
            break

        case 422:
            Swal.fire({
                icon: 'warning',
                confirmButtonColor: '#6610f2',
                confirmButtonText: 'Aceptar',
                text: response.responseText,
                allowEscapeKey: false,
                allowOutsideClick: false,
            })

            break
        case 404:
            break

        case 500:
            Swal.fire({
                icon: 'error',
                confirmButtonColor: '#6610f2',
                confirmButtonText: 'Aceptar',
                text: response.responseJSON.message,
                allowEscapeKey: false,
                allowOutsideClick: false,
            })

            break
        default:
            console.log(response)
            break
    }

}


const validarCrearAdmin = () =>{
    let validador=true;

    if ($('#nombres').val().trim() == '') {
        agregarError('nombres')
        validador = false
    } else {
        quitarError('nombres')
    }

    if ($('#correo').val().trim() == '') {
        agregarError('correo')
        validador = false
    } else {
        quitarError('correo')
    }

    if ($('#rol').val() == '') {
        agregarError('rol')
        validador = false
    } else {
        quitarError('rol')
    }

    return validador;

}