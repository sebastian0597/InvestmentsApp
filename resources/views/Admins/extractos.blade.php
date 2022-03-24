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
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
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
                  <h3>Extractos</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
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
                    <h5>LISTA DE CLIENTES VINCULADOS</h5><span></span>
                  </div>
                  
                  <div class="card-body">
                   
                    <section class="welcome-wrap welcome-login documentation-wrap"> <div class="welcome-box-wrap"> <div class="row"> <div class="col-lg-3 col-md-3"><input type="" name="seleción de cliente"> <div class="doc-menu"> <ul> <!-- ngRepeat: option in documentationControl.menuOptions --><li ng-repeat="option in documentationControl.menuOptions" ng-class="{'active': documentationControl.currentDoc[0] === $index}" class="ng-scope active"> <div ng-click="documentationControl.selectedDoc($index,$event);" class="ng-binding">Extractos<!-- ngIf: option.children --><!-- ngIf: option.children --></div> <!-- ngIf: option.children && documentationControl.currentDoc[0] === $index && documentationControl.isActivated(0,$index) --> </li><!-- end ngRepeat: option in documentationControl.menuOptions --><li ng-repeat="option in documentationControl.menuOptions" ng-class="{'active': documentationControl.currentDoc[0] === $index}" class="ng-scope"> <div ng-click="documentationControl.selectedDoc($index,$event);" class="ng-binding"><!-- ngIf: option.children --><!-- ngIf: option.children --></div> <!-- ngIf: option.children && documentationControl.currentDoc[0] === $index && documentationControl.isActivated(0,$index) --> </li><!-- end ngRepeat: option in documentationControl.menuOptions --><li ng-repeat="option in documentationControl.menuOptions" ng-class="{'active': documentationControl.currentDoc[0] === $index}" class="ng-scope"> <div ng-click="documentationControl.selectedDoc($index,$event);" class="ng-binding"><!-- ngIf: option.children --><!-- ngIf: option.children --></div> <!-- ngIf: option.children && documentationControl.currentDoc[0] === $index && documentationControl.isActivated(0,$index) --> </li><!-- end ngRepeat: option in documentationControl.menuOptions --><li ng-repeat="option in documentationControl.menuOptions" ng-class="{'active': documentationControl.currentDoc[0] === $index}" class="ng-scope"> <div ng-click="documentationControl.selectedDoc($index,$event);" class="ng-binding"><!-- ngIf: option.children --><!-- ngIf: option.children --></div> <!-- ngIf: option.children && documentationControl.currentDoc[0] === $index && documentationControl.isActivated(0,$index) --> </li><!-- end ngRepeat: option in documentationControl.menuOptions --><li ng-repeat="option in documentationControl.menuOptions" ng-class="{'active': documentationControl.currentDoc[0] === $index}" class="ng-scope"> <div ng-click="documentationControl.selectedDoc($index,$event);" class="ng-binding"><!-- ngIf: option.children --><span ng-if="option.children" ng-class="{'active': documentationControl.currentDoc[0] !== $index}" class="menu-arrow icon-chevron-thin-down ng-scope active"></span><!-- end ngIf: option.children --><!-- ngIf: option.children --><span ng-if="option.children" ng-class="{'active': documentationControl.currentDoc[0] === $index}" class="menu-arrow icon-chevron-thin-up ng-scope"></span><!-- end ngIf: option.children --></div> <!-- ngIf: option.children && documentationControl.currentDoc[0] === $index && documentationControl.isActivated(0,$index) --> </li><!-- end ngRepeat: option in documentationControl.menuOptions --><li ng-repeat="option in documentationControl.menuOptions" ng-class="{'active': documentationControl.currentDoc[0] === $index}" class="ng-scope"> <div ng-click="documentationControl.selectedDoc($index,$event);" class="ng-binding">Movimientos del mes<!-- ngIf: option.children --><!-- ngIf: option.children --></div> <!-- ngIf: option.children && documentationControl.currentDoc[0] === $index && documentationControl.isActivated(0,$index) --> </li><!-- end ngRepeat: option in documentationControl.menuOptions --> </ul> </div> </div> <div class="col-lg-9 col-md-9"> <preview-documentation documenttype="[0]"><section class="doc-preview-wrap"> <div> <h2 class="ng-binding"> Extractos </h2> <p class="doc-intro ng-binding">  </p> <div class="doc-select-wrap"> <div class="row"> <!-- ngIf: previewDocumentationControl.hasSelectYear --><div ng-if="previewDocumentationControl.hasSelectYear" class="col col-lg-3 col-md-3 ng-scope"> <select ng-model="previewDocumentationControl.selectedYear" ng-options="option for option in previewDocumentationControl.optionsYear track by option" ng-change="previewDocumentationControl.defineNewArrayMonth()" class="ng-pristine ng-untouched ng-valid ng-not-empty"><option label="2018" value="2018">2018</option><option label="2019" value="2019">2019</option><option label="2020" value="2020">2020</option><option label="2021" value="2021">2021</option><option label="2022" value="2022" selected="selected">2022</option></select> </div><!-- end ngIf: previewDocumentationControl.hasSelectYear --> <!-- ngIf: previewDocumentationControl.hasSelectMonth --><div ng-if="previewDocumentationControl.hasSelectMonth" class="col col-lg-3 col-md-3 ng-scope"> <select ng-model="previewDocumentationControl.selectedMonth" ng-options="option for option in previewDocumentationControl.optionsMonth track by option" class="ng-pristine ng-untouched ng-valid ng-not-empty"><option label="Enero" value="Enero" selected="selected">Enero</option><option label="Febrero" value="Febrero">Febrero</option></select> </div><!-- end ngIf: previewDocumentationControl.hasSelectMonth --> <!-- ngIf: previewDocumentationControl.hasSelectLoan --> <!-- ngIf: !previewDocumentationControl.downloadDoc && !previewDocumentationControl.notButtons --><div ng-if="!previewDocumentationControl.downloadDoc &amp;&amp; !previewDocumentationControl.notButtons" class="col col-lg-3 col-md-3 ng-scope"> <div class="button-web negative ng-binding" ng-click="previewDocumentationControl.generateDoc();"> Generar </div> </div><!-- end ngIf: !previewDocumentationControl.downloadDoc && !previewDocumentationControl.notButtons --> <!-- ngIf: previewDocumentationControl.downloadDoc --> <!-- ngIf: previewDocumentationControl.swearDoc --> <!-- ngIf: previewDocumentationControl.dontSwearDoc --> </div> </div> </div> <!-- ngIf: !previewDocumentationControl.waitFile && !previewDocumentationControl.showErrorGenerateFile && !previewDocumentationControl.downloadDoc --> <!-- ngIf: previewDocumentationControl.showErrorGenerateFile --> <!-- ngIf: previewDocumentationControl.showErrorCostTotal --> </section></preview-documentation> </div> </div> </div> </section>
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