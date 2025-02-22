<!-- Info boxes -->
<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-danger">
      <div class="inner">
        <h3>{{$productos}}</h3>
        <p>Productos</p>
      </div>
      <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"></path>
        <path clip-rule="evenodd" fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"></path>
      </svg>
      <a href="{{route('almacen')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
        Ver más <i class="bi bi-link-45deg"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-primary">
      <div class="inner">
        <h3>{{$ventas}}</h3>
        <p>Ventas</p>
      </div>
      <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
      </svg>
      <a href="{{route('ventas.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
        Ver más <i class="bi bi-link-45deg"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-warning">
      <div class="inner">
        <h3>{{$usuarios}}</h3>
        <p>Usuarios</p>
      </div>
      <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
      </svg>
      <a href="{{route('usuarios.index')}}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
        Ver más <i class="bi bi-link-45deg"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-secondary">
      <div class="inner">
        <h3>{{$dolar}}</h3>
        <p>Dollar</p>
      </div>
      <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M12 3L2 9l10 6 10-6-10-6zm0 7l8.485-4.909L12 8 3.515 5.091 12 10zM2 19v-2l10 6 10-6v2l-10 6-10-6zm10-4l10-6v4l-10 6-10-6v-4l10 6z"></path>
      </svg>
      <a href="{{route('categorias.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
        Ver más <i class="bi bi-link-45deg"></i>
      </a>
    </div>
  </div>
</div>

<!-- Summary Card -->
<div class="row mt-3">
  <div class="col-12">
    <div class="card mb-4 bg-dark text-white">
      <div class="card-footer">
        <div class="row">
          <div class="col-lg-4 col-4">
            <div class="text-center border-end">
              <h5 class="fw-bold  ">{{$ventasMonto}}</h5>
              <span class="text-uppercase">TOTAL VENTAS</span>
            </div>
          </div>
         
          <div class="col-lg-4 col-4">
            <div class="text-center border-end">
              <h5 class="fw-bold ">{{$pagosMonto}}</h5>
              <span class="text-uppercase">TOTAL PAGADO</span>
            </div>
          </div>
          <div class="col-lg-4 col-4">
            <div class="text-center">
              <h5 class="fw-bold ">{{$recibos}}</h5>
              <span class="text-uppercase">RECIBOS GENERADOS</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
