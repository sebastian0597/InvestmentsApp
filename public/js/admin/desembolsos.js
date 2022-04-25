const seleccionarActividadEconomica = () => {
    $("#div_independiente").css("display", "none");
    $("#div_empleado").css("display", "none");
    $("#div_empleado_2").css("display", "none");
    $("#div_empleado_3").css("display", "none");
    $("#div_pensionado").css("display", "none");
    $("#div_otros").css("display", "none");

    switch ($("#actividad_economica").val()) {
        case "1":
            $("#div_independiente").css("display", "flex");
            //Se muestra el div de Independiente
            break;
        case "2":
            $("#div_empleado").css("display", "flex");
            $("#div_empleado_2").css("display", "flex");
            $("#div_empleado_3").css("display", "flex");

            //Se muestra el div de Empleado
            break;
        case "3":
            $("#div_pensionado").css("display", "flex");

            //Se muestra el div de Pensionado
            break;
      

        default:
            break;
    }
};
const seletipodecliente = () => {
    $("#div_estandar").css("display", "none");
    $("#div_vip").css("display", "none");
    $("#div_premium").css("display", "none");
   
   

    switch ($("#tipocliente01").val()) {
        case "estandar":
            $("#div_estandar").css("display", "flex");
            //Se muestra el div de Independiente
            break;
        case "vip":
       
            $("#div_vip").css("display", "flex");
           

            //Se muestra el div de Empleado
            break;
        case "premium":
            $("#div_premium").css("display", "flex");

            //Se muestra el div de Pensionado
            break;
      

        default:
            break;
    }
};
