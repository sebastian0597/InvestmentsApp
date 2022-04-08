const reestablecerContrasena = () =>{

    if($('#codigo').val().trim() !=""){
        
        $("#btn_reestablecer_contrasena").text("Reestableciendo...");
        $("#btn_reestablecer_contrasena").prop("disabled", true);

        quitarErrorLogin('codigo')
        let url = document.location.origin+'/api/reset_password'
        let method = 'POST'
        
        var form_data = new FormData()
        form_data.append('personal_code', $('#codigo').val().trim())
        enviarPeticion(url, method, form_data, 'continuarReestablecerContrasena')

    }else{
        agregarErrorLogin('codigo')
    }
}

const continuarReestablecerContrasena = (response) =>{

   
    if(response.status == 200 || response.status == 201){
        Swal.fire({
            icon: "success",
            title: "La contraseña se ha restablecido correctamente",
            html: `Al correo electrónico se han enviado las nuevas credenciales.<br/>`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            allowEscapeKey : false,
            allowOutsideClick: false,
        }).then((result) => {

            if (result.isConfirmed) {
                
               location.href = document.location.origin + '/login'
            }
            if (result.isDismissed) {
               
            }
        });
    }else{
        setResponseMessage(response);
    }

    $("#btn_reestablecer_contrasena").text("Solicitar contraseña");
    $("#btn_reestablecer_contrasena").prop("disabled", false);
   

}