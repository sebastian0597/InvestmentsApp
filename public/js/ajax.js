function enviarPeticion(url,method, data, funcion=""){

    switch (method) {
        case 'POST':
        case 'Post':
        case 'post':
     
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                url: url,
                type: method,
                data:data, 
                cache:false,
                contentType: false,
                processData: false,
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
                    if (funcion != "") {
                        eval(funcion + "(" + JSON.stringify(e) + ")");
                    }
                     
                    if (e.status == 422) { // when status code is 422, it's a validation issue
                        console.log(e.responseJSON.errors);
                       
                    }else if(e.status == 500){
        
                        console.error("Message => " + e.responseJSON.message);
                        console.error("Exception => "+ e.responseJSON.exception);
                        console.error("File => "+ e.responseJSON.file);
                        
                    }else{ 
                        console.log(e.responseJSON);
                    }
                }
            });
            break;
        
        case 'GET':
        case 'get':
        case 'Get':

            $.get(url, {
                data:{data,"_token": "{{ csrf_token() }}" },
            }, function (response) {

                if (funcion != "") {
                    eval(funcion + "(" + JSON.stringify(response) + ")");
                }
            })
            .fail(function(){
                Swal.fire({
                    icon: 'error',
                    confirmButtonColor: "#141e30",
                    confirmButtonText: "Aceptar",
                    text: 'Al ocurrido un error al momento de realizar la petición.',
                    allowEscapeKey : false,
                    allowOutsideClick: false
                })
            });

            break;

        case 'PUT':
        case 'PUT':
        case 'PUT':
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                url: url,
                type: method,
                data:data,
                success: function(result){
                 
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
                    if (funcion != "") {
                        eval(funcion + "(" + JSON.stringify(e) + ")");
                    }
                     
                    if (e.status == 422) { // when status code is 422, it's a validation issue
                        console.log(e.responseJSON.errors);
                       
                    }else if(e.status == 500){
        
                        console.error("Message => " + e.responseJSON.message);
                        console.error("Exception => "+ e.responseJSON.exception);
                        console.error("File => "+ e.responseJSON.file);
                        
                    }else{ 
                        console.log(e.responseJSON);
                    }
                }
              });

            break;


        default:
            break;
    }
    
}