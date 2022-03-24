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
                                        <!-- nombre-->
                                        <h5>Datos de inicio</h5>

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom01">Primer nombre</label>
                                                <input class="form-control" id="validationCustom01" type="text" value=""
                                                    required="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom02">Segundo
                                                    nombre</label>
                                                <input class="form-control" id="validationCustom02" type="text" value=""
                                                    required="">
                                            </div>
                                        </div>

                                        <!-- apellido-->
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom01">Primer
                                                    apellido</label>
                                                <input class="form-control" id="validationCustom01" type="text" value=""
                                                    required="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom02">Segundo
                                                    apellido</label>
                                                <input class="form-control" id="validationCustom02" type="text" value=""
                                                    required="">
                                            </div>
                                        </div>





                                        <div class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label" for="validationCustom04">Tipo de documento de
                                                    identidad</label>
                                                <select class="form-select" id="validationCustom04" required="">
                                                    <option>Nit</option>
                                                    <option>Cédula de ciudanía</option>
                                                    <option> Cédula de extranjería</option>
                                                    <option> Pasaporte</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="validationCustom03">Numero de
                                                    identificación</label>
                                                <input class="form-control" id="validationCustom03" type="text"
                                                    required="">

                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label" for="validationCustom05">lugar de
                                                    expedición</label>
                                                <input class="form-control" id="validationCustom05" type="text"
                                                    required="">
                                            </div>
                                        </div>
                                        <br>
                                        <h5>Actividad económica</h5>

                                        <div class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label" for="validationCustom04">Tipo de actividad
                                                    economica</label>
                                                <select class="form-select" id="validationCustom04" required="">
                                                    <option>Empreado</option>
                                                    <option>Pensionado</option>
                                                    <option> independiente</option>
                                                    <option> otros</option>
                                                </select>
                                            </div>




                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Si tiene RUT + subir archivo (5 Mb)
                                                    PDF, jpg (Opcional)</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="file">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom01">Parametro 1</label>
                                                <input class="form-control" id="validationCustom01" type="text" value=""
                                                    required="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom02">Parametro 2</label>
                                                <input class="form-control" id="validationCustom02" type="text" value=""
                                                    required="">
                                            </div>
                                        </div>


                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom01">Parametro 3</label>
                                                <input class="form-control" id="validationCustom01" type="text" value=""
                                                    required="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom02">Parametro 4</label>
                                                <input class="form-control" id="validationCustom02" type="text" value=""
                                                    required="">
                                            </div>
                                        </div>

                                        <br>
                                        <h5>Cuenta bancaria para desembolso</h5>
                                        <br>
                                        <h6>Cuenta bancaria personal: </h6>



                                        <div class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label" for="validationCustom04">Tipo de cuenta
                                                </label>
                                                <select class="form-select" id="validationCustom04" required="">
                                                    <option>Cuenta corriente</option>
                                                    <option>Cuenta de ahorros</option>

                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="validationCustom03">Nombre de identida
                                                    bancaria</label>
                                                <input class="form-control" id="validationCustom03" type="text"
                                                    required="">

                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label" for="validationCustom05">Numero de
                                                    cuenta</label>
                                                <input class="form-control" id="validationCustom05" type="text"
                                                    required="">
                                            </div>
                                        </div>
                                        <br>

                                        <h6>Cuenta bancaria de tercero: </h6>



                                        <div class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label" for="validationCustom04">Tipo de cuenta
                                                </label>
                                                <select class="form-select" id="validationCustom04" required="">
                                                    <option>Cuenta corriente</option>
                                                    <option>Cuenta de ahorros</option>

                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="validationCustom03">Nombre de identida
                                                    bancaria</label>
                                                <input class="form-control" id="validationCustom03" type="text"
                                                    required="">

                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label" for="validationCustom05">Numero de
                                                    cuenta</label>
                                                <input class="form-control" id="validationCustom05" type="text"
                                                    required="">
                                            </div>
                                        </div>


                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom01">Nombre</label>
                                                <input class="form-control" id="validationCustom01" type="text" value=""
                                                    required="">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="validationCustom04">Tipo de documento de
                                                    identidad</label>
                                                <select class="form-select" id="validationCustom04" required="">
                                                    <option>Nit</option>
                                                    <option>Cédula de ciudanía</option>
                                                    <option> Cédula de extranjería</option>
                                                    <option> Pasaporte</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom02">Numero de
                                                    identificación</label>
                                                <input class="form-control" id="validationCustom02" type="text" value=""
                                                    required="">
                                            </div>

                                        </div>


                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom02">Parentesco</label>
                                                <input class="form-control" id="validationCustom02" type="text" value=""
                                                    required="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="validationCustom02">Rut opcional</label>
                                                <input class="form-control" id="validationCustom02" type="text" value="">
                                            </div>
                                        </div>
                                        <br><br>

                                        <div class="row g-3">


                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Certificado bancario (subir archivo
                                                    (5 Mb), PDF, jpg)</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="file">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Carta de autorización para
                                                    desembolsar al tercero + (5 Mb), PDF, jpg)</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="file">
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>

                                        <h4>Inversión realizada</h4>
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label" for="validationCustom04">Tipo de
                                                    moneda</label>
                                                <select class="form-select" id="validationCustom04" required="">
                                                    <option>COP</option>
                                                    <option>USD</option>
                                                    <option> EUR</option>

                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label" for="validationCustom04">Método de
                                                    pago</label>
                                                <select class="form-select" id="validationCustom04" required="">
                                                    <option>Consignación de Bancolombia</option>
                                                    <option>Consignación otros bancos</option>
                                                    <option> Consignación cheque de otros bancos</option>
                                                    <option> Transferencia Billetera Virtual</option>

                                                </select>
                                            </div>

                                            <div>
                                                <label>Monto de inversión</label>
                                                <div class="input-group mb-3"><span class="input-group-text">$ </span>
                                                    <input class="form-control" type="text"
                                                        aria-label="Amount (to the nearest dollar)"><span
                                                        class="input-group-text">.00 </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="mb-3 row g-3">
                                                <label class="col-sm-3 col-form-label text-end">Fecha de inversión</label>
                                                <div class="col-xl-5 col-sm-7 col-lg-8">
                                                    <div class="input-group date" id="dt-date" data-target-input="nearest">
                                                        <input class="form-control datetimepicker-input digits" type="date"
                                                            data-target="#dt-date">
                                                        <div class="input-group-text" data-target="#dt-date"
                                                            data-toggle="datetimepicker"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <div class="checkbox p-0">
                                        <input class="form-check-input" id="invalidCheck" type="checkbox" required="">
                                        <label class="form-check-label" for="invalidCheck"></label>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Crear Cliente</button>
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
