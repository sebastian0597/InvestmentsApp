const agregarError = (element) =>{
    
    /*$("#error_"+element).empty()
    let mensaje = "El campo "+ element + " no puede estar vacío."
    $("#error_"+element).append(mensaje)*/
    $("#" + element).addClass("error_border");
    $("#" + element)
    
        .prev()
        .addClass("error_text");
} 

const quitarError = (element) =>{
    //$("#error_"+element).empty()
    $("#" + element).removeClass("error_border");
    $("#"+ element)
    .prev()
    .removeClass("error_text");
} 

const agregarErrorLogin = (element) =>{
    
    $("#error_"+element).empty()
    let mensaje = "El campo "+ element + " no puede estar vacío."
    $("#error_"+element).append(mensaje)
    $("#" + element).addClass("error_border");
    /*$("#" + element)
    
        .prev()
        .addClass("error_text");*/
} 

const quitarErrorLogin = (element) =>{
    $("#error_"+element).empty()
    $("#" + element).removeClass("error_border");
    /*$("#"+ element)
    .prev()
    .removeClass("error_text");**/
} 


const validarSintaxisCorreo = (element) => {
  
    let validador = true
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i
    $("#error_correo").empty()
    if (!emailRegex.test($("#"+element.id).val())) {
        $("#error_correo").append("La sintáxis del correo no es válida.")
        validador = false
    }
    return validador
};


async function consultarAPIDivisas(moneda="COP") {
    let opciones = {method: 'GET', headers: {Accept: 'application/json'}}
    const response = await  fetch(`https://api.fastforex.io/fetch-multi?from=${moneda}&to=COP&api_key=73306c96fe-5a91bbb373-r8ylp0`, opciones);
    const monedas = await response.json();

    return monedas.results.COP;
}


const convertirMoneda = () =>{

   
    //let divisa = $("#tipo_moneda").val()
    let base_amount = $("#base_monto_inversion").val().trim()
    $("#monto_inversion").val(base_amount/*.toFixed(2)*/);
    /*if(divisa!="" && base_amount!==""){
        consultarAPIDivisas(divisa).then(moneda => {
            //let amount = moneda * base_amount
            $("#monto_inversion").val(base_amount.toFixed(2));
        });
    } */

}

function isObjEmpty(obj) {
    
    return Object.keys(obj).length === 0;

}

function formatNumber(num) {
    if (!num || num == 'NaN') return '-';
    if (num == 'Infinity') return '&#x221e;';
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
    return (((sign) ? '' : '-') + num + ',' + cents);
}


const setResponseMessage = (response, url_redireccionamiento='') =>{

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
            if(url_redireccionamiento!=''){
                location.href = document.location.origin+url_redireccionamiento;
            }
          
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
            Swal.fire({
                icon: 'warning',
                confirmButtonColor: '#6610f2',
                confirmButtonText: 'Aceptar',
                text: 'Not found response',
                allowEscapeKey: false,
                allowOutsideClick: false,
            })
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