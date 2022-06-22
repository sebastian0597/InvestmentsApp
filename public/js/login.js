const login = () =>{
       
    if(validarLogin()){ 
        let url = document.location.origin+'/login_validate'
        let method = 'POST'
    
        var form_data = new FormData()
        form_data.append('email', $('#correo').val().trim())
        form_data.append('password', $('#contrasena').val().trim())
        form_data.append('personal_code', $('#codigo').val().trim())
        enviarPeticion(url, method, form_data, 'continuarLogin')

    }
    
}

const continuarLogin = (response) =>{

    if(response.status == 200){
        if(response.message.user_type != '2'){
            window.location.href = window.location.origin+'/clientes';
        }else {
            window.location.href = window.location.origin+'/cliente/perfil';
        }
        
    }else{
        setResponseMessage(response);
    }
   
}

const validarLogin = () =>{
    let validador=true
   
    if($('#correo').val().trim() == ''){
        validador=false
        agregarErrorLogin('correo')
    }else{
        quitarErrorLogin('correo')
    }

    if(!validarSintaxisCorreo($('#correo')[0])){
        validador=false
    }

    if($('#contrasena').val().trim() == ''){
        validador=false
        agregarErrorLogin('contrasena')
    }else{
        quitarErrorLogin('contrasena')
    }

    if($('#codigo').val().trim() == ''){
        agregarErrorLogin('codigo')
        validador=false
    }else{
        quitarErrorLogin('codigo')
    }

    return validador
} 
