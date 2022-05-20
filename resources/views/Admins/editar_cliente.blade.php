@extends('layout')
@section('title', 'VIP WORLD TRADING')
@section('content')
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('Admins.componentes.barra_superior')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('Admins/componentes/barra_lateral')

            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>EDITAR CLIENTE</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include('Admins/componentes/enlance_navegacion')
                                    <li class="breadcrumb-item active">Edición de clientes</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Formulario de edición para clientes nuevos</h5>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" novalidate="" accept-charset="UTF-8" enctype="multipart/form-data">

                                        <h5>Datos de inicio</h5>
                                        <input type="hidden" id="id_usuario_cliente" value="{{$customer['id_user']}}">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Nombres</label>
                                                <input class="form-control" id="nombres" value="{{$customer['name']}}"  type="text">
                                                <span class="msg_error_form" id="error_nombres"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Apellidos</label>
                                                <input class="form-control" id="apellidos" value="{{$customer['last_name']}}"  type="text">
                                                <span class="msg_error_form" id="error_apellidos"></span>
                                            </div>
                                        </div>

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Tipo de documento</label>
                                                <select class="form-select" id="tipo_documento" >
                                                    @foreach ($documents_types as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $customer['id_document_type'] ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_documento"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Número de documento</label>
                                                <input class="form-control" id="numero_documento" value="{{$customer['document_number']}}" type="text">
                                                <span class="msg_error_form" id="error_numero_documento"></span>
                                            </div>

                                        </div>
                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Correo eléctronico</label>
                                                <input onblur="validarSintaxisCorreo(this)" class="form-control" value="{{$customer['email']}}"  id="correo" type="email">
                                                <span class="msg_error_form" id="error_correo"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Teléfono</label>
                                                <input class="form-control" id="telefono" onkeyup="validarTelefono(this)" value="{{$customer['phone']}}"  type="text">
                                                <span class="msg_error_form" id="error_telefono"></span>
                                            </div>

                                        </div>
                                        <?php 
                                            $icon_documento =  '';
                                            if(($customer['file_document']) <> ''){

                                                $icon_documento = "<div class='input-group-prepend'>
                                                        <div class='input-group-text'>
                                                            <span style='color:#7366ff' class='material-icons-outlined'>image</span></div>
                                                </div>";
                                            }

                                        ?>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Archivo documento identidad</label>
                                                <div class="input-group mb-2">
                                                   
                                                    <input class="form-control" id="archivo_documento" accept=".pdf, .png, .jpg, .jpeg" type="file">
                                                    <input type="hidden" id="archivo_documento_txt" value="{{$customer['file_document']}}" >
                                                    <span class="msg_error_form" id="error_archivo_documento"></span>
                                                    <?= $icon_documento ?>
                                                </div>
                                            </div>
                                        </div>
                                                                       
                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">País</label>
                                                <select class="form-select" id="pais">
                                                    <option value="">Seleccione---</option>
                                                    @foreach ($countries as $item)
                                                        <option value="{{ $item->name }}" {{ $item->name == $customer['country'] ? 'selected' : '' }}>{{ $item->name }}</option>
                                                        
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_pais"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Departamento</label>
                                                <input class="form-control" id="departamento" value="{{$customer['department']}}"  type="text">
                                                <span class="msg_error_form" id="error_departamento"></span>
                                            </div>
                                          

                                        </div>
                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Ciudad</label>
                                                <input class="form-control" id="ciudad" value="{{$customer['city']}}"  type="text">
                                                <span class="msg_error_form" id="error_ciudad"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Dirección</label>
                                                <input class="form-control" id="direccion" value="{{$customer['address']}}"  type="text">
                                                <span class="msg_error_form" id="error_direccion"></span>
                                            </div>                                        

                                        </div>
                                        
                                        <br>
                                        <h5>Actividad económica</h5>
                                        <div class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label">Actividad económica</label>
                                                <select onchange="seleccionarActividadEconomica()" class="form-select"
                                                    id="actividad_economica" >
                                                    <option value="">Seleccione---</option>
                                                    @foreach ($economics_activities as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $customer['id_economic_activity'] ? 'selected' : '' }}>{{ $item->name }}</option>    
                                                    @endforeach

                                                </select>
                                                <span class="msg_error_form" id="error_actividad_economica"></span>
                                            </div>
                                            <?php 
                                                $display_independiente='display:none';
                                                $display_empleado='display:none';
                                                $display_pensionado='display:none';
                                                $display_otro='display:none';

                                                switch ($customer['id_economic_activity']) {
                                                    case 1:
                                                        $display_independiente='display:flex';
                                                        break;
                                                    case 2:
                                                        $display_empleado='display:flex';
                                                        break;
                                                    case 3:
                                                        $display_pensionado='display:flex';
                                                        break;
                                                    case 4:
                                                        $display_otro='display:flex';
                                                        break;
                                                }

                                            ?>
                                            <!-- CAMPOS CUANDO ES INDEPENDIENTE -->
                                            <div style="{{$display_independiente}}" id="div_independiente" class="row g-3">

                                                <div class="col-md-6">
                                                    <label class="form-label">Descripción</label>
                                                    <textarea class="form-control" id="descripcion_independiente" placeholder="{{$customer['description_ind']}}"  rows="3"></textarea>
                                                    <input type="hidden" class="form-control" id="descripcion_independiente_txt" value="{{$customer['description_ind']}}"/>
                                                    <span class="msg_error_form" id="error_descripcion_independiente"></span>
                                                </div>

                                                <?php 
                                                    $icon_rut =  '';
                                                    if(($customer['file_rut']) <> ''){
        
                                                        $icon_rut = "<div class='input-group-prepend'>
                                                                <div class='input-group-text'>
                                                                    <span style='color:#7366ff' class='material-icons-outlined'>image</span></div>
                                                        </div>";
                                                    }
    
                                                ?>
                                                <div class="col-md-4">
                                                    <label class="form-label">RUT</label>
                                                    <div class="input-group mb-2">

                                                        <input class="form-control" id="archivo_rut" accept=".pdf, .png, .jpg, .jpeg" type="file">
                                                        <input type="hidden" id="archivo_rut_txt" value="{{$customer['file_rut']}}" >
                                                        <?= $icon_rut ?>
                                                    </div>
                                                </div>
                                        
                                            </div>

                                            <!-- CAMPOS CUANDO ES  EMPLEADO -->
                                            <div style="{{$display_empleado}}" id="div_empleado" class="row g-3">

                                                <div class="col-md-8">
                                                    <label class="form-label">Empresa</label>
                                                    <input class="form-control"  value="{{$customer['business']}}" id="empresa" type="text">
                                                    <span class="msg_error_form" id="error_empresa"></span>
                                                </div>

                                            </div>
                                            <div style="{{$display_empleado}}" id="div_empleado_3" class="row g-3">

                                                <div class="col-md-4">
                                                    <label class="form-label">Cargo</label>
                                                    <input class="form-control" id="cargo"  value="{{$customer['position_business']}}" type="text">
                                                    <span class="msg_error_form" id="error_cargo"></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Antigüedad</label>
                                                    <input class="form-control" id="antiguedad" value="{{$customer['antique_bussiness']}}" type="text">
                                                    <span class="msg_error_form" id="error_antiguedad"></span>
                                                </div>

                                            </div>
                                            <div style="{{$display_empleado}}" id="div_empleado_2" class="row g-3">

                                                <div class="col-md-4">
                                                    <label class="form-label">Tipo de contrato</label>
                                                    <select class="form-select" id="tipo_contrato"> 
                                                        <option value="Indefinido" {{$customer['type_contract'] == "Indefinido" ? 'selected' : '' }}>Indefinido</option>
                                                        <option value="Termino Fijo" {{$customer['type_contract'] == "Termino Fijo" ? 'selected' : '' }}>Término Fijo</option>
                                                        <option value="Prestacion de servicios"  {{$customer['type_contract'] == "Prestacion de servicios" ? 'selected' : '' }}>Prestación de servicios
                                                        </option>
                                                    </select>
                                                    <span class="msg_error_form" id="error_tipo_contrato"></span>
                                                </div>

                                                <?php 
                                                    $icon_certificado =  '';
                                                    if(($customer['work_certificate']) <> ''){
        
                                                        $icon_certificado = "<div class='input-group-prepend'>
                                                                <div class='input-group-text'>
                                                                    <span style='color:#7366ff' class='material-icons-outlined'>image</span></div>
                                                        </div>";
                                                    }

                                                ?>

                                                <div class="col-md-4">
                                                    <label class="form-label">Certificado laboral</label>
                                                    <div class="input-group mb-2">

                                                        <input class="form-control" id="certificado_laboral"  accept=".pdf, .png, .jpg, .jpeg" type="file">
                                                        <input type="hidden" id="certificado_laboral_txt" value="{{$customer['work_certificate']}}" >
                                                        <span class="msg_error_form" id="error_certificado_laboral"></span>
                                                        <?= $icon_certificado ?>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- CAMPOS CUANDO ES  PENSIONADO -->
                                            <div style="{{$display_pensionado}}" id="div_pensionado" class="row g-3">

                                                <div class="col-md-4">
                                                    <label class="form-label">Fondo de pensión</label>
                                                    <input class="form-control" id="fondo_pension" value="{{$customer['pension_fund']}}" type="text">
                                                    <span class="msg_error_form" id="error_fondo_pension"></span>
                                                </div>
                                            </div>
                                            <!-- CAMPOS CUANDO TIENE OTRA ACTIVIDAD -->
                                            <div style="{{$display_otro}}" id="div_otros" class="row g-3">

                                                <div class="col-md-4">
                                                    <label class="form-label">Especifique</label>
                                                    <input class="form-control" id="otros_actividad" value="{{$customer['especification_other']}}" type="text">
                                                    <span class="msg_error_form" id="error_otros_actividad"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <?php 
                                        $display_cuenta_personal='display:none';
                                        $display_cuenta_tercero='display:none';
                                      
                                        switch ($customer['id_bank_account']) {
                                            case 1:
                                                $display_cuenta_personal='display:flex';
                                                break;
                                            case 2:
                                                $display_cuenta_tercero='display:flex';
                                                break;
                                           
                                        }

                                        ?>

                                        <h5>Cuenta bancaria para desembolso</h5>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Cuenta bancaria</label>
                                                <select onchange="seleccionarCuentaBancaria();" class="form-select"
                                                    id="cuenta_bancaria" >
                                                    <option value="">Seleccione---</option>
                                                    @foreach ($banks_accounts as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $customer['id_bank_account'] ? 'selected' : '' }}>{{ $item->name }}</option>    
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_cuenta_bancaria"></span>
                                            </div>
                                        </div>
                                        <br>
                                      
                                        <div style="{{$display_cuenta_personal}}" id="div_cuenta_personal" class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Número de cuenta</label>
                                                <input class="form-control" id="numero_cuenta" value="{{$customer['account_number']}}" type="text">
                                                <span class="msg_error_form" id="error_numero_cuenta"></span>
                                            </div>
                                            

                                            <div class="col-md-4">
                                                <label class="form-label">Tipo de cuenta</label>
                                                <select class="form-select" id="tipo_cuenta">
                                                    <option value="">Seleccione---</option>
                                                    <option value="Cuenta corriente" {{$customer['account_type'] == "Cuenta corriente" ? 'selected' : '' }}>Cuenta corriente</option>
                                                    <option value="Cuenta de ahorros" {{$customer['account_type'] == "Cuenta de ahorros" ? 'selected' : '' }}>Cuenta de ahorros</option>
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_cuenta"></span>
                                            </div>

                                        </div>

                                        <div style="{{$display_cuenta_personal}}" id="div_cuenta_personal_2" class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Banco</label>
                                                <select class="form-select" id="nombre_banco">
                                                    <option value="">Seleccione---</option>
                                                    @foreach ($banks as $item)
                                                        <option value="{{ $item->name }}" {{$item->name == $customer['bank_name'] ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_nombre_banco"></span>
                                            </div>

                                            <?php 
                                                $icon_cuenta =  '';
                                                if(($customer['account_certificate']) <> ''){

                                                    $icon_cuenta = "<div class='input-group-prepend'>
                                                            <div class='input-group-text'>
                                                                <span style='color:#7366ff' class='material-icons-outlined'>image</span></div>
                                                    </div>";
                                                }

                                            ?>

                                            <div class="col-md-4">
                                                <label class="form-label">Certificado de cuenta</label>
                                                <div class="input-group mb-2">
                                                    <input class="form-control" id="certificado_cuenta" accept=".pdf, .png, .jpg, .jpeg" type="file">
                                                    <input type="hidden" id="certificado_cuenta_txt" value="{{$customer['account_certificate']}}" >
                                                    <span class="msg_error_form" id="error_certificado_cuenta"></span>
                                                    <?= $icon_cuenta ?>
                                                </div>
                                            </div>

                                        </div>

                                        <div style="{{$display_cuenta_tercero}}" id="div_cuenta_tercero" class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label">Cédula</label>
                                                <input class="form-control" id="cedula_tercero" value="{{$customer['document_third']}}" type="text">
                                                <span class="msg_error_form" id="error_cedula_tercero"></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Nombre</label>
                                                <input class="form-control" id="nombre_tercero" value="{{$customer['name_third']}}" type="text">
                                                <span class="msg_error_form" id="error_nombre_tercero"></span>
                                                
                                            </div>


                                        </div>

                                        <div style="{{$display_cuenta_tercero}}" id="div_cuenta_tercero_2" class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Relación con el cliente</label>
                                                <input class="form-control" id="parentesco" value="{{$customer['kinship_third']}}" type="text">
                                                <span class="msg_error_form" id="error_parentesco"></span>
                                            </div>
                                            
                                            <?php 
                                                $icon_cuenta_tercero =  '';
                                                if(($customer['account_certificate']) <> ''){

                                                    $icon_cuenta_tercero = "<div class='input-group-prepend'>
                                                            <div class='input-group-text'>
                                                                <span style='color:#7366ff' class='material-icons-outlined'>image</span></div>
                                                    </div>";
                                                }

                                            ?>

                                            <div class="col-md-5">
                                                <label class="form-label">Certificado bancario</label>
                                                <div class="input-group mb-2"> 
                                                    <input class="form-control" id="certificado_bancario_tercero" accept=".pdf, .png, .jpg, .jpeg"
                                                        type="file">
                                                    <input type="hidden" id="certificado_bancario_tercero_txt" value="{{$customer['account_certificate']}}" >    
                                                    <span class="msg_error_form" id="error_certificado_bancario_tercero"></span>
                                                    <?= $icon_cuenta_tercero ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div style="{{$display_cuenta_tercero}}" id="div_cuenta_tercero_3" class="row g-3">
                                            <?php 
                                                $icon_carta_tercero =  '';
                                                if(($customer['letter_authorization_third']) <> ''){

                                                    $icon_carta_tercero = "<div class='input-group-prepend'>
                                                            <div class='input-group-text'>
                                                                <span style='color:#7366ff' class='material-icons-outlined'>image</span></div>
                                                    </div>";
                                                }

                                            ?>
                                            
                                            <div class="col-md-4">
                                                <label class="form-label">Carta de autorización</label>
                                                <div class="input-group mb-2"> 
                                                    <input class="form-control" id="carta_tercero" accept=".pdf, .png, .jpg, .jpeg" type="file">
                                                    <input type="hidden" id="carta_tercero_txt" value="{{$customer['letter_authorization_third']}}">    
                                                    <span class="msg_error_form" id="error_carta_tercero"></span>
                                                    <?= $icon_carta_tercero ?>
                                                </div>
                                                
                                            </div>
                                            
                                            <?php 
                                                $icon_rut_tercero =  '';
                                                if(($customer['rut_third']) <> ''){

                                                    $icon_rut_tercero = "<div class='input-group-prepend'>
                                                            <div class='input-group-text'>
                                                                <span style='color:#7366ff' class='material-icons-outlined'>image</span></div>
                                                    </div>";
                                                }

                                            ?>

                                            <div class="col-md-5">
                                                <label class="form-label">RUT</label>
                                                <div class="input-group mb-2"> 
                                                    <input class="form-control" id="rut_tercero" accept=".pdf, .png, .jpg, .jpeg" type="file">
                                                    <input type="hidden" id="rut_tercero_txt" value="{{$customer['rut_third']}}"> 
                                                    <span class="msg_error_form" id="error_rut_tercero"></span>
                                                    <?= $icon_rut_tercero ?>
                                                </div>
                                                
                                            </div>

                                        </div>
                                        <!--<div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Estado</label>
                                                
                                                <select class="form-select" id="estado_cliente">
                                                    <option value="0" {{$customer['status'] == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                                    <option value="1" {{$customer['status'] == 'Activo' ? 'selected' : '' }}>Activo</option>
                                                </select>
                                               
                                                <span class="msg_error_form" id="error_nombre_banco"></span>
                                            </div>

                                        </div> -->
                     

                                        <br><br>
                                        <div class="mb-4">
                                            <button class="btn btn-primary" id="btn_actualizar_cliente" type="button" onclick="actualizarCliente({{$customer['id']}})">Actualizar Cliente</button>
                                        </div>
                                        <br>
                                </div>
                              

                            </div>

                            <!-- <div class="mb-3">
                                <div class="form-check">
                                    <div class="checkbox p-0">
                                        <input class="form-check-input" id="invalidCheck" type="checkbox" >
                                        <label class="form-check-label" for="invalidCheck"></label>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div> -->
                           
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    </div>
    <!-- footer start-->

    </div>
    </div>
@stop
