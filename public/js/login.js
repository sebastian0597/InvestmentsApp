const login = () =>{
    
    //consultarAPIDivisas().then(moneda => {

       if(validarLogin()){ 
        let url = 'http://127.0.0.1:8000/api/login';
        let method = 'POST';
        let data = {
            email:$("#correo").val().trim(),
            password:$("#contrasena").val().trim(),
            personal_code:$("#codigo").val().trim()
        };
        
        enviarPeticion(url, method, data, 'continuarLogin');

    }
    
    //});
    
  
}

const continuarLogin = (response) =>{
    $("#correo").val('')
    $("#contrasena").val('')
    $("#codigo").val('')
    console.log(response);
}

const validarLogin = () =>{
    let validador=true;
   
    if($("#correo").val().trim() == ""){
        validador=false;
        agregarError("correo");
    }else{
        quitarError("correo");
    }

    if(!validarSintaxisCorreo($("#correo")[0])){
        validador=false;
    }

    if($("#contrasena").val().trim() == ""){
        validador=false;
        agregarError("contrasena");
    }else{
        quitarError("contrasena");
    }

    if($("#codigo").val().trim() == ""){
        agregarError("codigo");
        validador=false;
    }else{
        quitarError("codigo");
    }

    return validador;
} 