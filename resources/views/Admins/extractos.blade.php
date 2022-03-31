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

            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>EXTRACTOS</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    @include(
                                        'Admins/componentes/enlance_navegacion'
                                    )
                                    <li class="breadcrumb-item active">Extractos</li>
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
                                    <h5>Extractos mensuales</h5><span></span>
                                </div>

                                <div class="card-body">

                                    <section class="welcome-wrap welcome-login documentation-wrap">
                                        <div class="welcome-box-wrap">

                                            <div class="mb-3">
                                              <label class="form-label">Tipo de cliente</label>
                                              <select class="form-select" id="tipo_cliente">
                                                <option selected>Seleccione---</option>
                                                @foreach($customer_types as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                            <div class="mb-3">
                                              <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Nombre o número de documento del cliente" id="busqueda_cliente_extractos">
                                                <button onclick="buscarClientePorParametros()" style="display: flex; align-items: center" class="btn btn-outline-primary" type="button"><span class="material-icons-outlined">
                                                  search
                                                  </span></button>
                                              </div>
                                            </div>
                                            
                                           
                                            <div class="row">
                                                <div class="col-lg-9 col-md-9">
                                                 
                                                
                                                    <div class="doc-menu">
                                                        <ul>
                                                          
                                                           
                                                            <li ng-repeat="option in documentationControl.menuOptions"
                                                                ng-class="{'active': documentationControl.currentDoc[0] === $index}"
                                                                class="ng-scope">
                                                                <div ng-click="documentationControl.selectedDoc($index,$event);"
                                                                    class="ng-binding">
                                                                   
                                                                </div>
                                                               
                                                            </li>
                                                          
                                                            <li ng-repeat="option in documentationControl.menuOptions"
                                                                ng-class="{'active': documentationControl.currentDoc[0] === $index}"
                                                                class="ng-scope">
                                                                <div ng-click="documentationControl.selectedDoc($index,$event);"
                                                                    class="ng-binding">
                                                                 
                                                                </div>
                                                               
                                                            </li>
                                                           
                                                            <li ng-repeat="option in documentationControl.menuOptions"
                                                                ng-class="{'active': documentationControl.currentDoc[0] === $index}"
                                                                class="ng-scope">
                                                                <div ng-click="documentationControl.selectedDoc($index,$event);"
                                                                    class="ng-binding">
                                                                  
                                                                </div>
                                                              
                                                            </li>
                                                          
                                                            <li ng-repeat="option in documentationControl.menuOptions"
                                                                ng-class="{'active': documentationControl.currentDoc[0] === $index}"
                                                                class="ng-scope">
                                                                <div ng-click="documentationControl.selectedDoc($index,$event);"
                                                                    class="ng-binding">
                                                                    <span
                                                                        ng-if="option.children"
                                                                        ng-class="{'active': documentationControl.currentDoc[0] !== $index}"
                                                                        class="menu-arrow icon-chevron-thin-down ng-scope active"></span>
                                                                   
                                                                    <span ng-if="option.children"
                                                                        ng-class="{'active': documentationControl.currentDoc[0] === $index}"
                                                                        class="menu-arrow icon-chevron-thin-up ng-scope"></span>
                                                                 
                                                                </div>
                                                              
                                                            </li>
                                                                                                                   
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9">
                                                    <preview-documentation documenttype="[0]">
                                                        <section class="doc-preview-wrap">
                                                            <div >
                                                                <h2 class="ng-binding"> Extractos </h2>
                                                                <p class="doc-intro ng-binding"> </p>
                                                                <div id="content-clientes"></div>
                                                                <!--<div class="doc-select-wrap">
                                                                    <div class="row">
                                                                       
                                                                        <div ng-if="previewDocumentationControl.hasSelectYear"
                                                                            class="col col-lg-3 col-md-3 ng-scope"> <select
                                                                                ng-model="previewDocumentationControl.selectedYear"
                                                                                ng-options="option for option in previewDocumentationControl.optionsYear track by option"
                                                                                ng-change="previewDocumentationControl.defineNewArrayMonth()"
                                                                                class="ng-pristine ng-untouched ng-valid ng-not-empty">
                                                                                <option label="2018" value="2018">2018
                                                                                </option>
                                                                                <option label="2019" value="2019">2019
                                                                                </option>
                                                                                <option label="2020" value="2020">2020
                                                                                </option>
                                                                                <option label="2021" value="2021">2021
                                                                                </option>
                                                                                <option label="2022" value="2022"
                                                                                    selected="selected">2022</option>
                                                                            </select> </div>
                                                                       
                                                                        <div ng-if="previewDocumentationControl.hasSelectMonth"
                                                                            class="col col-lg-3 col-md-3 ng-scope"> <select
                                                                                ng-model="previewDocumentationControl.selectedMonth"
                                                                                ng-options="option for option in previewDocumentationControl.optionsMonth track by option"
                                                                                class="ng-pristine ng-untouched ng-valid ng-not-empty">
                                                                                <option label="Enero" value="Enero"
                                                                                    selected="selected">Enero</option>
                                                                                <option label="Febrero" value="Febrero">
                                                                                    Febrero</option>
                                                                            </select> </div>
                                                                        
                                                                        <div ng-if="!previewDocumentationControl.downloadDoc &amp;&amp; !previewDocumentationControl.notButtons"
                                                                            class="col col-lg-3 col-md-3 ng-scope">
                                                                            <div class="button-web negative ng-binding"
                                                                                ng-click="previewDocumentationControl.generateDoc();">
                                                                                Generar </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>-->
                                                            </div>
                                                           
                                                        </section>
                                                    </preview-documentation>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
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
