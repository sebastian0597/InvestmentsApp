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
       
        let url = document.location.origin + '/api/v1/admin/store'
        let method = 'POST'

        enviarPeticion(url, method, form_data, 'continuarCrearAdmin')
    }
}

const continuarCrearAdmin = (response) =>{
    $('#btn_crear_admin').text('Crear administrador')
    $('#btn_crear_admin').prop('disabled', false)
    
    setResponseMessage(response)

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
            let url = document.location.origin + `/editar_administrador/${user.id}`
            if (user.model_rol.role_id != 2) {
                
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
                        user.model_rol.role_id == null
                            ? ''
                            : user.model_rol.role_id
                    }</td>
                    <td>
                        <a href='${url}' class='btn btn-primary btn-block btn-mail w-100'>Editar</a>                     
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


const actualizarAdmin = (id_usuario) =>{
    
    if(validarFormularioActualizarAdmin()){

        //$('#btn_crear_admin').text('Creando administrador...')
        //$('#btn_crear_admin').prop('disabled', true)
        let nombres = $("#nombres").val().trim();
        let correo = $("#correo").val().trim();
        let rol = $("#rol").val();
        let estado = $("#estado").val();
   
        let url = document.location.origin + `/api/v1/admin/${id_usuario}`
        
        let method = 'PUT'
        form_data = { name: nombres, email:correo, rol:rol, status:estado, '_method':'PUT'}
      
        enviarPeticion(url, method, form_data, 'continuarActualizarAdmin')
        
    }

}

const continuarActualizarAdmin = (response) => {

    setResponseMessage(response)

}

const validarFormularioActualizarAdmin = () =>{
    let validador=true
    if($("#nombres").val().trim() == ""){

        agregarError('nombres')
        validador = false
    }else{
        quitarError('nombres')
    }

    if($("#correo").val().trim() == ""){

        agregarError('correo')
        validador = false
    }else{
        quitarError('correo')
    }

    if($("#rol").val() == ""){

        agregarError('rol')
        validador = false
    }else{
        quitarError('rol')
    }

    if($("#estado").val() == ""){

        agregarError('estado')
        validador = false
    }else{
        quitarError('estado')
    }

    return validador

}


const cambiarContrasena = () =>{

    if(validarCambioContrasena()){
        let contrasena_1 = $('#password_1').val().trim()
        let contrasena_2 = $('#password_2').val().trim()
        let user_id = $('#user_id').val().trim()
        
        if(contrasena_1 === contrasena_2){

            let form_data = new FormData()
            form_data.append('password', contrasena_1 )
            form_data.append('id_user', user_id)
            form_data.append('password_confirm', contrasena_2)
            let method = 'POST'
            let url = window.location.origin+`/api/change_password`
            enviarPeticion(url, method, form_data, 'continuarCambiarContrasena')
  

        }else{
            agregarError('password_1')
            agregarError('password_2')
            Swal.fire({
                icon: 'error',
                text: 'Las contraseñas ingresadas no coinciden, por favor revise que las contraseñas sean iguales.',
              })
        }
        
    }
}
const continuarCambiarContrasena = (response) =>{
    setResponseMessage(response, '/');
}




const validarCambioContrasena = () =>{
    let validador = true

    if($('#password_1').val().trim() == ''){
        agregarError('password_1')
        validador=false
    }else{
        quitarError('password_1')
    }

    if($('#password_2').val().trim() == ''){
        agregarError('password_2')
        validador=false
    }else{
        quitarError('password_2')
    }


    return validador

}