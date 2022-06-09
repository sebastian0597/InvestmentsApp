@can('admin.inicio','admin.inversiones.editar')
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
    <div class="tap-top"></div>
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
                                <h3>INVERSIONES</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include('Admins/componentes/enlance_navegacion')
                                    <li class="breadcrumb-item active">Editar inversion</li>
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
                                <div style="display:flex; align-items:center; padding-right: 0px;" class="card-header">
                                    <div style="width:100%" class="row">
                                        <div class="col-6">
                                            <h5>Formulario para editar inversión</h5>
                                        </div>
                                        <div class="col-6">
                                        
                                            <ol style="float:right;" class="breadcrumb">
                                                @include(
                                                    'Admins/componentes/modal_busqueda_inversiones'
                                                )
        
                                                    
                                            </ol>

                                        </div>
                                    </div> 
                                </div>
                             
                                <div class="card-body">
                                    
                                    <form class="needs-validation" novalidate="" accept-charset="UTF-8" enctype="multipart/form-data">
                                        
                                        <input type="hidden" id="id_cliente" value="{{$customer['id']}}">
                                        <input type="hidden" id="nombre_cliente" value="{{$customer['name']}} {{$customer['last_name']}}">
                                        <input type="hidden" id="email_cliente" value="{{$customer['email']}}">
                                        <input type="hidden" id="id_inversion" value="{{$investment['id']}}">
                                        <h4>Datos del cliente</h4>

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Nombres</label>
                                                <input class="form-control" value="{{$customer['name']}}" disabled>
                                                <span class="msg_error_form" id="error_nombres"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Apellidos</label>
                                                <input class="form-control" value="{{$customer['last_name']}}"  disabled>
                                                <span class="msg_error_form" id="error_apellidos"></span>
                                            </div>
                                        </div>

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Tipo de cliente</label>
                                                <input  class="form-control" value="{{$customer['customer_type']}}" disabled>
                                                <span class="msg_error_form" id="error_tipo_cliente"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Número de documento</label>
                                                <input class="form-control" id="numero_documento" value="{{$customer['document_number']}}" disabled>
                                                <span class="msg_error_form" id="error_numero_documento"></span>
                                            </div>

                                        </div>
                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Correo electrónico</label>
                                                <input class="form-control" value="{{$customer['email']}}" disabled>
                                                <span class="msg_error_form" id="error_correo"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Teléfono</label>
                                                <input class="form-control" value="{{$customer['phone']}}" disabled>
                                                <span class="msg_error_form" id="error_telefono"></span>
                                            </div>

                                        </div>
                                        <div class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label">Fecha inversión</label>
                                                <input class="form-control" value="{{$investment['investment_date']}}" disabled>
                                                <span class="msg_error_form" id="error_correo"></span>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Valor inversión</label>
                                                <input class="form-control" value="{{$investment['amount']}}" disabled>
                                                <span class="msg_error_form" id="error_telefono"></span>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Porcentaje rentabilidad</label>
                                                <input class="form-control" value="{{$investment['percentage_investment']}}" disabled>
                                                <span class="msg_error_form" id="error_telefono"></span>
                                            </div>

                                        </div>
                                        
                                        <br>
                                        <h4>Inversión</h4>
                                        
                                        <div class="row g-3">
                                        
                                            <div class="col-md-3">
                                                <label>Tipo de inversión</label>
                                                
                                                <select onchange="seleccionarTipoInversion()" class="form-select" id="tipo_inversion" >
                                                    <option value="">Seleccione--</option>
                                                    @foreach ($investments_types as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $investment['id_investment_type'] ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_inversion"></span>
                                                
                                            </div>
                                        </div>
                                        <?php 
                                            $display_nueva_inversion = $investment['id_investment_type'] == 2 ? 'display: flex' : 'display: none';
                                            $display_reinversion = $investment['id_investment_type'] == 1 ? 'display: flex' : 'display: none';
                                            $display_btn = $investment['id_investment_type'] == 1 ? 'display: none' : '';
                                        ?>
                                        <br>
                                        <div style="{{$display_reinversion}}" id="div_reinversion" class="row g-3">
                                            <div class="col-md-3" id="content_reinversion">
                                               
                                                <label>Monto reinversión</label>
                                                <input id="monto_reinversion" disabled class="form-control" value="{{$investment['amount']}}" type="text">
                                                <span class="msg_error_form" id="error_monto_reinversion"></span>
                                            
                                            </div>
                                           
                                        </div>

                                        <div style="{{$display_nueva_inversion}}" id="div_inversion" class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Tipo de moneda</label>
                                                <select class="form-select" onchange="validarMontoMinimo();" id="tipo_moneda">
                                                    <option value="">Seleccione---</option>
                                                    @foreach ($currencies as $item)
                                                        <option value="{{ $item->code }}" {{ $item->code == $investment['currency'] ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_tipo_moneda"></span>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Método de pago</label>
                                                <select class="form-select" id="metodo_pago" >
                                                    @foreach ($payment_methods as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $investment['id_payment_method'] ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="msg_error_form" id="error_metodo_pago"></span>
                                            </div>

                                            <div class="col-md-3">
                                               
                                                <label>Monto de inversión</label>
                                                <input id="base_monto_inversion" onblur="validarMontoMinimo()" onkeyup="convertirAformatoMoneda(this)" value="{{$investment['base_amount']}}"  class="form-control" type="text">
                                                <span class="msg_error_form" id="error_base_monto_inversion"></span>
                                            
                                            </div>

                                            <div class="col-md-3">
                                                <label>Inversión en pesos</label>
                                                <input disabled id="monto_inversion" class="form-control" type="text" value="{{$investment['amount']}}">
                                                <span class="msg_error_form" id="error_monto_inversion"></span>
                                                
                                            </div>
                                        </div>

                                        <div style="{{$display_nueva_inversion}}" class="row g-3" id="div_inversion_2">
                                      
                                            <div class="col-md-4">
                                                <label>Documento de consignación</label>
                                                <input class="form-control" id="archivo_consignacion" accept=".pdf, .png, .jpg, .jpeg" type="file">
                                                <span class="msg_error_form" id="error_archivo_consignacion"></span>
                                                <input type="hidden" id="archivo_consignacion_txt" value="{{$investment['consignment_file']}}" >
                                            </div>
                                        </div>
                                        
                                        <br><br>
                                        <div class="mb-4 placeholder-glow">
                                            <button style="{{$display_btn}}" class="btn btn-primary" id="btn_editar_inversion" type="button" onclick="actualizarInversion()">Actualizar Inversión</button>
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
    @include('Admins.componentes.footer')
    </div>
    </div>

@stop
@endcan
@cannot('admin.inicio')
    @include('unauthorized')
@endcannot