
const cambiarContrasenaCliente = () =>{

    if(validarCambioContrasenaCliente()){
        let contrasena_1 = $('#password_cliente').val().trim()
        let contrasena_2 = $('#password_cliente_2').val().trim()
        let user_id = $('#user_id').val().trim()
        
        if(contrasena_1 === contrasena_2){

            let form_data = new FormData()
            form_data.append('password', contrasena_1 )
            form_data.append('id_user', user_id)
            form_data.append('password_confirm', contrasena_2)
            let method = 'POST'
            let url = window.location.origin+`/api/change_password`
            enviarPeticion(url, method, form_data, 'continuarcambiarContrasenaCliente')
  

        }else{
            agregarError('password_cliente')
            agregarError('password_cliente_2')
            Swal.fire({
                icon: 'error',
                text: 'Las contraseñas ingresadas no coinciden, por favor revise que las contraseñas sean iguales.',
              })
        }
        
    }
}

const continuarcambiarContrasenaCliente = (response) =>{
    setResponseMessage(response, '/');
}


const validarCambioContrasenaCliente = () =>{
    let validador = true

    if($('#password_cliente').val().trim() == ''){
        agregarError('password_cliente')
        validador=false
    }else{
        quitarError('password_cliente')
    }

    if($('#password_cliente_2').val().trim() == ''){
        agregarError('password_cliente_2')
        validador=false
    }else{
        quitarError('password_cliente_2')
    }


    return validador

}

$(document).ready(function(){

    // Modal

    $(".modal").on("click", function (e) {
        console.log(e);
        if (($(e.target).hasClass("modal-main") || $(e.target).hasClass("close-modal")) && $("#loading").css("display") == "none") {
            closeModal();
        }
    });

    // -> Modal

    // Abrir el inspector de archivos
    
    $(document).on("click", "#add-photo", function(){
        $("#add-new-photo").click();
    });
    
    // -> Abrir el inspector de archivos

    // Cachamos el evento change
    
    $(document).on("change", "#add-new-photo", function () {
    
        console.log(this.files);
        var files = this.files;
        var element;
        var supportedImages = ["image/jpeg", "image/png", "image/gif"];
        var seEncontraronElementoNoValidos = false;

        for (var i = 0; i < files.length; i++) {
            element = files[i];
            
            if (supportedImages.indexOf(element.type) != -1) {
                createPreview(element);
            }
            else {
                seEncontraronElementoNoValidos = true;
            }
        }

       /* if (seEncontraronElementoNoValidos) {
            alert("Se encontraron archivos no validos.");
        }
        else {
            alert("Todos los archivos se subieron correctamente.");
        }*/
    
    });

    // Eliminar previsualizaciones
    
    $(document).on("click", "#Images .image-container", function(e){
        $(this).parent().remove();
    });

});




function createPreview(file) {
    var imgCodified = URL.createObjectURL(file);
    var img = $('<div class="col-md-3" ><div class="image-container"> <figure> <img class="img-perfil rounded-circle" src="' + imgCodified + '" alt="Foto del usuario"> <figcaption> x </figcaption> </figure> </div></div>');
     $(img).insertBefore("#add-photo-container");

}
