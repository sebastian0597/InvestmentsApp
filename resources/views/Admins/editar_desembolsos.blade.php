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
                                <h3>DESEMBOLSOS</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include(
                                        'Admins/componentes/enlance_navegacion'
                                    )
                                    <li class="breadcrumb-item active">Actualizar desembolso</li>
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
                                            <h5>Formulario actualizar desembolso</h5>
                                        </div>
                                        <div class="col-6">

                                            <ol style="float:right;" class="breadcrumb">
                                                @include(
                                                    'Admins/componentes/modal_busqueda_desembolsos'
                                                )

                                            </ol>

                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <form class="needs-validation" novalidate="" accept-charset="UTF-8"
                                        enctype="multipart/form-data">

                                        <h4>Datos del cliente</h4>

                                        <input type="hidden" id="id_cliente" value="{{ $customer['id'] }}">
                                        <input type="hidden" id="id_desembolso" value="{{ $disbursement['id'] }}">

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Nombres</label>
                                                <input class="form-control" value="{{ $customer['name'] }}" disabled>
                                                <span class="msg_error_form" id="error_nombres"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Apellidos</label>
                                                <input class="form-control" value="{{ $customer['last_name'] }}" disabled>
                                                <span class="msg_error_form" id="error_apellidos"></span>
                                            </div>
                                        </div>

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Tipo de cliente</label>
                                                <input class="form-control" value="{{ $customer['customer_type'] }}"
                                                    disabled>
                                                <span class="msg_error_form" id="error_tipo_cliente"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Número de documento</label>
                                                <input class="form-control" id="numero_documento"
                                                    value="{{ $customer['document_number'] }}" disabled>
                                                <span class="msg_error_form" id="error_numero_documento"></span>
                                            </div>

                                        </div>
                                        <br><br>

                                        <h4>Desembolso</h4>

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Tipo de desembolso</label>
                                                <input class="form-control"
                                                    value="{{ $disbursement['disbursement_type'] }}" disabled>
                                                <span class="msg_error_form"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Fecha creación</label>
                                                <input class="form-control" value="{{ $disbursement['created_at'] }}"
                                                    disabled>
                                                <span class="msg_error_form"></span>
                                            </div>


                                        </div>

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Estado</label>
                                                <input class="form-control" value="{{ $disbursement['status'] }}"
                                                    disabled>
                                                <span class="msg_error_form"></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Valor a consignar</label>
                                                <input class="form-control"
                                                    value="${{ number_format($disbursement['value_consign'], 0, ',', '.') }}"
                                                    disabled>
                                                <span class="msg_error_form"></span>
                                            </div>


                                        </div>

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label">Archivo desembolso</label>
                                                <input class="form-control" id="archivo_desembolso"
                                                    accept=".pdf, .png, .jpg, .jpeg" type="file">

                                                <input class="form-control" id="archivo_desembolso_txt"
                                                    type="hidden" value="{{$disbursement['disbursetment_file']}}">

                                                <span class="msg_error_form" id="error_archivo_desembolso"></span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row g-3">
                                            <?php 
                                                $checked = '';
                                               
                                                if($disbursement['ind_done'] == 1){
                                                    $checked = 'checked';
                                                  
                                                }
                                                
                                            ?>

                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input {{$checked}} type="checkbox" class="form-check-input" id="check_done">
                                                    <label class="form-check-label">Desembolsado</label>
                                                </div>
                                            </div>

                                        </div>
                                        <br><br>
                                        <?php  if($disbursement['ind_done'] <> 1){ ?>

                                            <button type="button" onclick="actualizarDesembolso()" class="btn btn-primary">Actualizar desembolso</button>

                                        <?php } ?>
                                         
                                    </form>
                                </div>
                            </div>
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
