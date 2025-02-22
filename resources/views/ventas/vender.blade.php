@extends('layout.app')
@section('content')
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-0 my-5">
                            <div class="px-2 row">
                                <div class="col-lg-12">
                                    @include('flash::message')
                                </div>
                                <div class="col-md-6 col-6">
                                <h3 class="p-2 bold">Registrar Venta</h3>

                                </div>

                            </div>
                            <div class="card-body">

                                <div class="card shadow-lg p-4 rounded-3  mb-4">
                                    <div class="card-body">
                                 
                                        <div class="d-flex justify-content-between text-center">
                                            <!-- Monto Total en Dólares -->
                                            <div class="flex-fill border-end">
                                                <i class="fas fa-dollar-sign fa-2x text-success mb-2"></i>
                                                <h5 class="text-success mb-1">Monto Total ($)</h5>
                                                <h3 id="total-dolar" class="fw-bold">0</h3>
                                            </div>

                                            <!-- Monto Total en Bolívares -->
                                            <div class="flex-fill border-end">
                                                <i class="fas fa-coins fa-2x text-dark mb-2"></i>
                                                <h5 class="text-dark mb-1">Monto Total (BS)</h5>
                                                <h3 id="total-bs" class="fw-bold">0</h3>
                                            </div>

                                            <!-- Monto Restante en Bolívares -->
                                            <div class="flex-fill">
                                                <i class="fas fa-wallet fa-2x text-danger mb-2"></i>
                                                <h5 class="text-danger mb-1">Restante (BS)</h5>
                                                <h3 id="restante" class="fw-bold">0</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-6">
                                        @include('ventas.datatableProductos') 
                               </div>
                                    <div class="col-6">

                                        @include('ventas.fields_venta') 
                               </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main> <!--end::App Main--> <!--begin::Footer-->
@endsection