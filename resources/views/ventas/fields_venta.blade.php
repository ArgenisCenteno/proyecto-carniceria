<form action="{{ route('ventas.generarVenta') }}" id="venta-form" method="POST">
    @csrf <!-- Agrega el token CSRF para seguridad -->
    <section>



        <div class="row">



        <div class="col-md-12 bg-light rounded shadow-sm p-4 mb-4">
    <h3 class="mb-4 text-primary">Métodos de Pago</h3>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="number" step="any" value="0" class="form-control" id="efectivo" placeholder="Efectivo" name="Efectivo">
                <label for="efectivo"><i class="fas fa-money-bill-wave me-2"></i>Efectivo</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="number" step="any" value="0" class="form-control" id="punto" placeholder="Punto" name="Punto de Venta">
                <label for="punto"><i class="fas fa-credit-card me-2"></i>Punto</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="number" step="any" value="0" class="form-control" id="transferencia" placeholder="Transferencia" name="Transferencia">
                <label for="transferencia"><i class="fas fa-exchange-alt me-2"></i>Transferencia</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="number" step="any" value="0" class="form-control" id="pagoMovil" placeholder="Pago móvil" name="Pago Movil">
                <label for="pagoMovil"><i class="fas fa-mobile-alt me-2"></i>Pago móvil</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="number" step="any" value="0" class="form-control" id="divisa" placeholder="Divisa" name="Divisa">
                <label for="divisa"><i class="fas fa-dollar-sign me-2"></i>Divisa</label>
            </div>
        </div>
    </div>

    <!-- Hidden inputs -->
    <input type="hidden" readonly step="any" class="form-control" placeholder="Divisa" name="dollar" value="{{ $dollar }}" id="dollar-tasa">
    <input type="hidden" readonly step="any" class="form-control" name="pagado" value="0" id="pagado">
    <input type="hidden" readonly step="any" class="form-control" name="pagado" value="0" id="totalBolivares">
    <div id="productos-hidden-fields"></div> <!-- Hidden fields for products -->
</div>

            <div class="col-md-12">
                <h3 class="p-2 bold">Cliente</h3>
                <select name="user_id" id="user_id" class="form-control select2 mb-2 mt-2" required>
                    <option value="">Seleccione una opción</option>
                    @foreach($users as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr />

        <button type="submit" id="submitBtn" class="btn btn-success" style="width: 100%" disabled>Finalizar</button>
        </div>

    </section>

</form>