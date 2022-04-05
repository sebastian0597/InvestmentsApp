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


const consultarUsuariosAdmin = () => {

    form_data = {};
    let url = document.location.origin + `/api/v1/admin/`;
    let method = 'GET';

    enviarPeticion(
        url,
        method,
        form_data,
        'continuarConsultarUsuariosAdmin'
    );
}

const continuarConsultarUsuariosAdmin = (response) => {
    
   
    let users = response.data;
    users = users == undefined || null ? {} : users;
    $('#content-users').empty();

    if (!isObjEmpty(users)) {
        
        trAdmins = ``;
        aux=0
        users.forEach(function (user) {
           
            if (user.id_rol != 2) {
                
                trAdmins += `
                <tr>
                    <td>${
                        user.name == null
                            ? ''
                            : user.name
                    }</td>
                    <td>${
                        user.email == null
                            ? ''
                            : user.email
                    }</td>
                    <td>${
                        user.status == null
                            ? ''
                            : user.status
                    }</td>
                    <td>${
                        user.roles.role == null
                            ? ''
                            : user.roles.role
                    }</td>
                    <td>
                        <ul class='nav main-menu' role='tablist'>
                            <li class='nav-item'>
                                <button class='btn btn-primary btn-block btn-mail w-100' type='button' data-bs-toggle='modal' data-bs-target='.modalRquests_${aux}'>Editar</button>

                                <div class='modal fade modal-bookmark modalRquests_${aux}' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog modal-lg' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='exampleModalLabel'>Editar cliente</h5>
                                                    <button class='btn-close' type='button' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>

                                                <div class='modal-body'>
                                                    <form class='form-bookmark needs-validation' id='bookmark-form' novalidate=''>
                                                        
                                                    <div class='form-row'>
                                                        <div class='form-group col-md-6'>
                                                            <label>Nombres</label>
                                                            <input type='text' class='form-control' id='nombres_${aux}' value='${user.name}'>
                                                        </div>
                                                        <div class='form-group col-md-6'>
                                                            <label>Email</label>
                                                            <input type='email' class='form-control' id='correo_${aux}'value='${user.email}'>
                                                        </div>
                                                    </div>
                                                    <div class='form-group col-md-6'>
                                                        <label>Estado actual</label>
                                                        <input disabled type='text' class='form-control' id='estado_actual_${aux}' value='${user.status}'>
                                                    </div>
                                                    <div class='form-group col-md-6'>
                                                        <label>Rol actual</label>
                                                        <input disabled type='text' class='form-control' id='rol_actual_${aux}' value='${user.roles.role}' >
                                                    </div>
                                                    <div class='form-group col-md-6''>
                                                        <label>Rol</label>
                                                        <select class="form-select" id='rol_${aux}'>
                                                            <option value="" selected>Seleccione---</option>
                                                            <option value="3">Admin 2</option>
                                                            <option value="4">Admin 3</option>
                                                            <option value="5">Admin 4</option>
                                                            <option value="6">Admin 5</option>
                                                        </select>
                                                    </div>
                                                    <div class='form-group col-md-6'>
                                                    <label>Estado</label>
                                                    <select class="form-select" id='estado_${aux}'>
                                                        <option value="" selected>Seleccione---</option>
                                                        <option value="1">Activo</option>
                                                        <option value="0">Inactivo</option>
                                                    </select>
                                                </div>
                                                    <br><br>
                                                    <button onclick='actualizarAdmin(${user.id}, ${aux})' type='button' class='btn btn-secondary'>Guardar</button>
                                                    <button class='btn btn-primary' type='button' data-bs-dismiss='modal'>Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>                       
                    </td>
                </tr>
                `;
                aux++
            }
        });

         html = `
                <table class='table table-bordered'>
                    <thead>
                    <tr>
                        <th scope='col'>Nombre</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Rol</th>
                        <th scope='col'></th>
                    </tr>
                    </thead>
                    <tbody>
                    ` +
                        trAdmins +
                    `
                    </tbody>
                </table>

            ` 

    }

    $('#content-users').append(html);

}


const actualizarAdmin = (id_usuario, aux) =>{

    if(validarFormularioActualizarAdmin(aux)){

        //$('#btn_crear_admin').text('Creando administrador...')
        //$('#btn_crear_admin').prop('disabled', true)
        let nombres = $("#nombres_"+aux).val().trim();
        let correo = $("#correo_"+aux).val().trim();
        let rol = $("#rol_"+aux).val();
        let estado = $("#estado_"+aux).val();
   
        let url = document.location.origin + `/api/v1/admin/${id_usuario}` 
        let method = 'PUT'
        form_data = { name: nombres, email:correo, rol:rol, status:estado, '_method':'PUT'}
        enviarPeticion(url, method, form_data, 'continuarActualizarAdmin')
        
    }

}

const continuarActualizarAdmin = (response) => {
   
    setResponseMessage(response)
    if(response.status == 200 || response.status == 201 || response.status ==  202){
        location.reload()
    }
    
}

const validarFormularioActualizarAdmin = (aux) =>{
    let validador=true
    if($("#nombres_"+aux).val().trim() == ""){

        agregarError('nombres_'+aux)
        validador = false
    }else{
        quitarError('nombres_'+aux)
    }

    if($("#correo_"+aux).val().trim() == ""){

        agregarError('correo_'+aux)
        validador = false
    }else{
        quitarError('correo_'+aux)
    }

    if($("#rol_"+aux).val() == ""){

        agregarError('rol_'+aux)
        validador = false
    }else{
        quitarError('rol_'+aux)
    }

    if($("#estado_"+aux).val() == ""){

        agregarError('estado_'+aux)
        validador = false
    }else{
        quitarError('estado_'+aux)
    }

    return validador

}