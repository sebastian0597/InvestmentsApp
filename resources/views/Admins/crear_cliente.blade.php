@extends('Admins.layout')
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
                                <h3>Creación de clientes</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>

                                    <li class="breadcrumb-item active"> Creación de clientes</li>
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
                                    <h5>Formulario de registro para clientes nuevos</h5>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" novalidate="">

                                        <h5>Datos de inicio</h5>

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Nombres</label>
                                                <input class="form-control" id="nombres" type="text">
                                                <span class="msg_error_form" id="error_nombres"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Apellidos</label>
                                                <input class="form-control" id="apellidos" type="text">
                                                <span class="msg_error_form" id="error_apellidos"></span>
                                            </div>
                                        </div>

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Tipo de documento</label>
                                                <select class="form-select" id="tipo_documento" >
                                                    @foreach ($documents_types as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_documento"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Número de documento</label>
                                                <input class="form-control" id="numero_documento" type="text">
                                                <span class="msg_error_form" id="error_numero_documento"></span>
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
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach

                                                </select>
                                                <span class="msg_error_form" id="error_actividad_economica"></span>
                                            </div>

                                            <!-- CAMPOS CUANDO ES INDEPENDIENTE -->
                                            <div style="display:none" id="div_independiente" class="row g-3">

                                                <div class="col-md-6">
                                                    <label class="form-label">Descripción</label>
                                                    <textarea class="form-control" id="descripcion_independiente" rows="3"></textarea>
                                                    <span class="msg_error_form" id="error_descripcion_independiente"></span>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">RUT</label>
                                                    <input class="form-control" id="archivo_rut" type="file">
                                                </div>

                                            </div>

                                            <!-- CAMPOS CUANDO ES  EMPLEADO -->
                                            <div style="display:none" id="div_empleado" class="row g-3">

                                                <div class="col-md-3">
                                                    <label class="form-label">Empresa</label>
                                                    <input class="form-control" id="empresa" type="text">
                                                    <span class="msg_error_form" id="error_empresa"></span>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Cargo</label>
                                                    <input class="form-control" id="cargo" type="text">
                                                    <span class="msg_error_form" id="error_cargo"></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Antigüedad</label>
                                                    <input class="form-control" id="antiguedad" type="text">
                                                    <span class="msg_error_form" id="error_antiguedad"></span>
                                                </div>

                                            </div>
                                            <div style="display:none" id="div_empleado_2" class="row g-3">

                                                <div class="col-md-4">
                                                    <label class="form-label">Tipo de contrato</label>
                                                    <select class="form-select" id="tipo_contrato">
                                                        <option value="Indefinido">Indefinido</option>
                                                        <option value="Termino Fijo">Término Fijo</option>
                                                        <option value="Prestacion de servicios">Prestación de servicios
                                                        </option>
                                                    </select>
                                                    <span class="msg_error_form" id="error_tipo_contrato"></span>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label">Certificado laboral</label>
                                                    <input class="form-control" id="certificado_laboral" type="file">
                                                    <span class="msg_error_form" id="error_certificado_laboral"></span>
                                                </div>

                                            </div>
                                            <!-- CAMPOS CUANDO ES  PENSIONADO -->
                                            <div style="display:none" id="div_pensionado" class="row g-3">

                                                <div class="col-md-4">

                                                    <label class="form-label">Fondo de pensión</label>
                                                    <input class="form-control" id="fondo_pension" type="text">
                                                    <span class="msg_error_form" id="error_fondo_pension"></span>
                                                </div>
                                            </div>
                                            <!-- CAMPOS CUANDO TIENE OTRA ACTIVIDAD -->
                                            <div style="display:none" id="div_otros" class="row g-3">

                                                <div class="col-md-4">

                                                    <label class="form-label">Especifique</label>
                                                    <input class="form-control" id="otros_actividad" type="text">
                                                    <span class="msg_error_form" id="error_otros_actividad"></span>
                                                </div>
                                            </div>

                                        </div>

                                        <br>
                                        <h5>Cuenta bancaria para desembolso</h5>

                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Cuenta bancaria</label>
                                                <select onchange="seleccionarCuentaBancaria();" class="form-select"
                                                    id="cuenta_bancaria" >
                                                    <option value="">Seleccione---</option>
                                                    @foreach ($banks_accounts as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_cuenta_bancaria"></span>
                                            </div>
                                        </div>
                                        <br>

                                        <div style="display:none" id="div_cuenta_personal" class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Número de cuenta</label>
                                                <input class="form-control" id="numero_cuenta" type="text">
                                                <span class="msg_error_form" id="error_numero_cuenta"></span>
                                            </div>
                                            

                                            <div class="col-md-4">
                                                <label class="form-label">Tipo de cuenta</label>
                                                <select class="form-select" id="tipo_cuenta">
                                                    <option value="Cuenta corriente">Cuenta corriente</option>
                                                    <option value="Cuenta de ahorros">Cuenta de ahorros</option>
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_cuenta"></span>
                                            </div>

                                        </div>

                                        <div style="display:none" id="div_cuenta_personal_2" class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Nombre del banco</label>
                                                <input class="form-control" id="nombre_banco" type="text">
                                                <span class="msg_error_form" id="error_nombre_banco"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Certificado de cuenta</label>
                                                <input class="form-control" id="certificado_cuenta" type="file">
                                                <span class="msg_error_form" id="error_certificado_cuenta"></span>
                                            </div>

                                        </div>

                                        <div style="display:none" id="div_cuenta_tercero" class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label">Cédula</label>
                                                <input class="form-control" id="cedula_tercero" type="text">
                                                <span class="msg_error_form" id="error_cedula_tercero"></span>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Nombre</label>
                                                <input class="form-control" id="nombre_tercero" type="text">
                                                <span class="msg_error_form" id="error_nombre_tercero"></span>
                                                
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Relación con el cliente (Parentesco)</label>
                                                <input class="form-control" id="parentesco" type="text">
                                                <span class="msg_error_form" id="error_parentesco"></span>
                                            </div>

                                        </div>

                                        <div style="display:none" id="div_cuenta_tercero_2" class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label">Certificado bancario</label>
                                                <input class="form-control" id="certificado_bancario_tercero"
                                                    type="file">
                                                <span class="msg_error_form" id="error_bancario_tercero"></span>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Carta de autorización para desembolsar al
                                                    tercero</label>
                                                <input class="form-control" id="carta_tercero" type="file">
                                                <span class="msg_error_form" id="error_carta_tercero"></span>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">RUT</label>
                                                <input class="form-control" id="rut_tercero" type="file">
                                                <span class="msg_error_form" id="error_rut_tercero"></span>
                                            </div>
                                        </div>

                                        <br><br>

                                        <h4>Inversión</h4>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Tipo de moneda</label>
                                                <select class="form-select" onchange="convertirMoneda();" id="tipo_moneda">
                                                    <option value="">Seleccione---</option>
                                                    @foreach ($currencies as $item)
                                                        <option value="{{ $item->code }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_moneda"></span>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Método de pago</label>
                                                <select class="form-select" id="metodo_pago" >
                                                    @foreach ($payment_methods as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_metodo_pago"></span>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Monto de inversión</label>
                                                <div class="input-group mb-3"><span class="input-group-text">$</span>
                                                    <input id="base_monto_inversion" onblur="validarMontoMinimo()" class="form-control" type="text">
                                                    <span class="msg_error_form" id="error_base_monto_inversion"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Inversión en pesos</label>
                                                <div class="input-group mb-3"><span class="input-group-text">$</span>
                                                    <input disabled id="monto_inversion" class="form-control" type="text">
                                                    <span class="msg_error_form" id="error_monto_inversion"></span>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <div class="checkbox p-0">
                                        <input class="form-check-input" id="invalidCheck" type="checkbox" >
                                        <label class="form-check-label" for="invalidCheck"></label>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="button" onclick="crearCliente()">Crear Cliente</button>
                            <br><br><br>
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
