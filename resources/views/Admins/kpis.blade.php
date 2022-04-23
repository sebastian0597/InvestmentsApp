@extends('Admins.layout')
@section('title', 'VIP WORLD TRADING')
@section('content')

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
 
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>

    <div class="page-wrapper compact-wrapper" id="pageWrapper">
    
        @include('Admins.componentes.barra_superior')
        
        <div class="page-body-wrapper">
           
            @include('Admins/componentes/barra_lateral')

            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>KPI'S</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                  @include(
                                    'Admins/componentes/enlance_navegacion'
                                )
    
                                    <li class="breadcrumb-item active">Kpis</li>
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
                                        <h5>KPI'S </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 row g-3">
                                        <label class="col-sm-3 col-form-label text-sm-end">GENERAR BUSQUEDA</label>
                                        <div class="col-xl-5 col-sm-9">
                                            <div class="input-group">
                                                <input name="fecha-de-busqueda"  type="month" />
                                                <button class="btn btn-secondary" id="Bookmark" onclick="submitBookMark()" type="submit">Generar informe</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                                        <div class="table-responsive add-project">
                                            <h4 class="card-title mb-0">Clientes Activos:</h4>
                                            <br><br>
                                            <table class="table card-table table-vcenter text-nowrap">
                                                <thead>
                                                    <tr>
                                                    <th>N° CLIENTES</th>
                                                    <th>TIPO DE CLIENTE</th>
                                                    <th>TOTAL INVERSION</th>
                                                    <th>TOTAL RENTABILIDAD</th>
                                                    <th>TOTAL DESEMBOLSADO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- AQUI VAN LOS RESULTADOS DE LA BUSQUEDA-->
                                                    <tr>
                                                    <td>20</td>
                                                    <td> Standar</td>
                                                    <td>$5.000.000,00</td>
                                                    <td>$9.000.000,00</td>
                                                    <td>$7.000.000,00</td>
                                                    </tr>
                                                    <tr>
                                                    <td>20</td>
                                                    <td> Vip</td>
                                                    <td>$5.000.000,00</td>
                                                    <td>$9.000.000,00</td>
                                                    <td>$7.000.000,00</td>
                                                    </tr>
                                                    <tr>
                                                    <td>20</td>
                                                    <td> Premiun</td>
                                                    <td>$5.000.000,00</td>
                                                    <td>$9.000.000,00</td>
                                                    <td>$7.000.000,00</td>
                                                    </tr>
                                                <thead>
                                                    <tr>
                                                    <th>TOTAL</th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                    <th>60</th>
                                                    <th></th>
                                                    <th>$15.000.000,00</th>
                                                    <th>$27.000.000,00</th>
                                                    <th>$21.000.000,00</th>
                                                    </tr>
                                                </thead>
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                                        <div class="table-responsive add-project">
                                            <h4 class="card-title mb-0">Clientes Inativos:</h4>
                                            <br><br>
                                            <table class="table card-table table-vcenter text-nowrap">
                                                <thead>
                                                    <tr>
                                                    <th>N° CLIENTES</th>
                                                    <th>TIPO DE CLIENTE</th>
                                                    <th>TOTAL INVERSION</th>
                                                    <th>TOTAL RENTABILIDAD</th>
                                                    <th>TOTAL DESEMBOLSADO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- AQUI VAN LOS RESULTADOS DE LA BUSQUEDA-->
                                                    <tr>
                                                    <td>20</td>
                                                    <td> Standar</td>
                                                    <td>$5.000.000,00</td>
                                                    <td>$9.000.000,00</td>
                                                    <td>$7.000.000,00</td>
                                                    </tr>
                                                    <tr>
                                                    <td>20</td>
                                                    <td> Vip</td>
                                                    <td>$5.000.000,00</td>
                                                    <td>$9.000.000,00</td>
                                                    <td>$7.000.000,00</td>
                                                    </tr>
                                                    <tr>
                                                    <td>20</td>
                                                    <td> Premiun</td>
                                                    <td>$5.000.000,00</td>
                                                    <td>$9.000.000,00</td>
                                                    <td>$7.000.000,00</td>
                                                    </tr>
                                                <thead>
                                                    <tr>
                                                    <th>TOTAL</th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                    <th>60</th>
                                                    <th></th>
                                                    <th>$15.000.000,00</th>
                                                    <th>$27.000.000,00</th>
                                                    <th>$21.000.000,00</th>
                                                    </tr>
                                                </thead>
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop