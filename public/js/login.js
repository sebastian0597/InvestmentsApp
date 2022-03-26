const login = () =>{
    
       if(validarLogin()){ 
        let url = document.location.origin+'/api/login'
        let method = 'POST'
        
        var form_data = new FormData()
        form_data.append('email', $('#correo').val().trim())
        form_data.append('password', $('#contrasena').val().trim())
        form_data.append('personal_code', $('#codigo').val().trim())
        enviarPeticion(url, method, form_data, 'continuarLogin')

    }
    
}

const continuarLogin = (response) =>{
    location.href='/'
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