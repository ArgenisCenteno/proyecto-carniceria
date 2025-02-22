<div class="card shadow-sm">
  <div class="card-body p-5">
    <div class="container">
      <div class="row mb-4">
        <div class="col-lg-8">
          <h2 class="mb-0">CARNICERÍA CABARA</h2>
          <p class="text-muted">Comprobante de Venta</p>
        </div>
        <div class="col-lg-4 text-end">
          <h4 class="text-primary mb-0">VENTA #{{ str_pad($venta->id, 4, '0', STR_PAD_LEFT) }}</h4>
          <p class="text-muted mb-0">{{ $venta->created_at->format('d/m/Y H:i') }}</p>
        </div>
      </div>

      <hr class="my-4">

      <div class="row mb-5">
        <div class="col-md-6">
          <h5 class="text-muted mb-3">Cliente</h5>
          <p class="mb-1"><strong>{{$venta->user->name}}</strong></p>
          <p class="mb-1">Calle Nueva Sector Centro, Punta de Mata</p>
          <p>Monagas, Venezuela</p>
        </div>
        <div class="col-md-6 text-md-end">
          <h5 class="text-muted mb-3">Detalles</h5>
          <p class="mb-1">Venta #{{ str_pad($venta->id, 4, '0', STR_PAD_LEFT) }}</p>
          <p class="mb-1">Fecha: {{ $venta->created_at->format('d/m/Y') }}</p>
          <p>Estado: <span class="badge bg-success">{{ $venta->status }}</span></p>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="bg-light">
            <tr>
              <th scope="col" class="text-center">#</th>
              <th scope="col">NOMBRE</th>
              <th scope="col" class="text-center">CANTIDAD</th>
              <th scope="col" class="text-end">PRECIO UNIT.</th>
              <th scope="col" class="text-end">IMPUESTOS</th>
              <th scope="col" class="text-end">SUBTOTAL</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($venta->detalleVentas as $index => $producto)
            <tr>
              <td class="text-center">{{ $index + 1 }}</td>
              <td>{{ $producto->producto->nombre }}</td>
              <td class="text-center">{{ $producto->cantidad }}</td>
              <td class="text-end">{{ number_format($producto->precio_producto, 2) }}</td>
              <td class="text-end">{{ number_format($producto->impuesto, 2) }}</td>
              <td class="text-end">{{ number_format($producto->cantidad * $producto->precio_producto, 2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="row justify-content-end mt-5">
        <div class="col-lg-4 col-sm-5">
          <table class="table table-clear">
            <tbody>
              <tr>
                <td class="left"><strong>Subtotal</strong></td>
                <td class="right">{{number_format($venta->pago->monto_neto, 2)}}</td>
              </tr>
              <tr>
                <td class="left"><strong>IVA (16%)</strong></td>
                <td class="right">{{number_format($venta->pago->impuestos, 2)}}</td>
              </tr>
              <tr>
                <td class="left"><strong>Total</strong></td>
                <td class="right"><strong>{{number_format($venta->pago->monto_total, 2)}}</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <hr class="my-4">

      <div class="row">
        <div class="col-md-12 text-center">
          <p class="text-muted mb-0">Gracias por su compra</p>
        </div>
      </div>
    </div>
  </div>
</div>