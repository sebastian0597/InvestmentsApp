const validarLogin = () =>{
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: 'http://127.0.0.1:8000/api/login',
        type: 'POST',
        data:{email:$("#correo").val().trim(),password:$("#contrasena").val().trim(),personal_code:$("#codigo").val().trim()}, 
        success: function (result) {
            
            if(result.status === 200 || result.status === 201){
                console.log(result);
            
            }else if(result.status === 401 || result.status === 402){
                Swal.fire({
                    icon: 'error',
                    title: '',
                    text: result.message,
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