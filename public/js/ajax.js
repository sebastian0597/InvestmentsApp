function enviarPeticion(url,method, data, funcion=""){

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: url,
        type: method,
        data:data, 
        success: function (result) {
            
            if (funcion != "" && result.status === 200 || result.status === 201) {
                
                eval(funcion + "(" + JSON.stringify(result) + ")");

            }else if(result.status === 200 || result.status === 201){
                console.log(result);
            
            }else if(result.status === 401 || result.status === 402){
                Swal.fire({
                    icon: 'error',
                    confirmButtonColor: "#141e30",
                    confirmButtonText: "Aceptar",
                    text: result.message,
                    allowEscapeKey : false,
                    allowOutsideClick: false
                })
            }
         
        },
        error: function (e) {
             
            if (e.status == 422) { // when status code is 422, it's a validation issue
                console.log(e.responseJSON.errors);
               
            }else{ 
                console.log(e.responseJSON);
            }
        }
    });
}