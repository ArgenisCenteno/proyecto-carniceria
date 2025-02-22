<div class="container-fluid py-4">
    <!-- Información de Apertura -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body d-flex flex-column align-items-start">
                    <h6 class="card-subtitle mb-2 text-white-50">Apertura</h6>
                    <p class="card-text display-6">{{ $apertura->apertura }}</p>
                    <i class="material-icons mt-auto">calendar_today</i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-secondary text-white h-100">
                <div class="card-body d-flex flex-column align-items-start">
                    <h6 class="card-subtitle mb-2 text-white-50">Caja</h6>
                    <p class="card-text display-6">{{ $caja->nombre }}</p>
                    <i class="material-icons mt-auto">store</i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body d-flex flex-column align-items-start">
                    <h6 class="card-subtitle mb-2 text-white-50">Monto Inicial (Bs)</h6>
                    <p class="card-text display-6">{{ number_format($apertura->monto_inicial_bolivares, 2) }}</p>
                    <span class="mt-auto fw-bold">BS</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body d-flex flex-column align-items-start">
                    <h6 class="card-subtitle mb-2 text-white-50">Monto Inicial ($)</h6>
                    <p class="card-text display-6">{{ number_format($apertura->monto_inicial_dolares, 2) }}</p>
                    <span class="mt-auto fw-bold">$</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Totales Generales -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card bg-danger text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-white-50">Total Bolívares</h6>
                        <p class="card-text display-5">{{ number_format($montoBs, 2) }}</p>
                    </div>
                    <span class="display-1 opacity-50">BS</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-white-50">Total Dólares</h6>
                        <p class="card-text display-5">{{ number_format($montoDolar, 2) }}</p>
                    </div>
                    <span class="display-1 opacity-50">$</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Totales por Método de Pago -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 ">Total Transferencia</h6>
                    <p class="card-text display-6">{{ number_format($transaferencia, 2) }}</p>
                    <i class="material-icons text-white">credit_card</i>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-warning h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2  ">Total Pago Móvil</h6>
                    <p class="card-text display-6">{{ number_format($pagoMovil, 2) }}</p>
                    <i class="material-icons text-black">payment</i>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2  ">Total Efectivo</h6>
                    <p class="card-text display-6">{{ number_format($efectivo, 2) }}</p>
                    <i class="material-icons text-white">money</i>
                </div>
            </div>
        </div>
    </div>

    <!-- Otros Totales -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card bg-info h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 ">Total Divisa</h6>
                    <p class="card-text display-6">{{ number_format($divisa, 2) }}</p>
                    <i class="material-icons text-white">currency_exchange</i>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card bg-success h-100">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 ">Total Punto de Venta</h6>
                    <p class="card-text display-6">{{ number_format($punto, 2) }}</p>
                    <i class="material-icons text-white">point_of_sale</i>
                </div>
            </div>
        </div>
    </div>
</div>

 
@if($apertura->estatus !== 'Finalizado')

<!-- Botón para cerrar caja -->
<form class="btn-apertura" action="{{ route('aperturas.update', $apertura->id) }}" method="POST">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success mt-3" style="width: 50%">Cerrar Caja</button>
</form>
@endif

@section('js') 
<script>
    $(document).ready(function() {
        $('#movimientosTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.3/i18n/es-ES.json'
            }
        });
    });
</script>
@endsection
<script>
    $(document).ready(function() {
        $('.btn-apertura').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Está seguro?',
                text: "Una vez cerrada debe abrir ora para seguir operando.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgba(13, 172, 85)',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí se envía el formulario si se confirma la eliminación
                    $(this).off('submit').submit();
                }
            });
        });
    });
</script>
