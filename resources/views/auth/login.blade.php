@extends('layouts.app')

@section('content')
<section class="vh-100 d-flex align-items-center justify-content-center"
  style="background-image: url('iconos/carne.jpeg'); background-size: cover; background-position: center;">
  
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-md-6 col-lg-5 col-xl-4 bg-white text-black p-4 rounded shadow-lg"
        style="max-width: 400px; border-radius: 15px;">

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="text-center mb-4">
            <h4 class="fw-bold">Ingresar al sistema</h4>
          </div>

          <!-- Email input -->
          <div class="mb-3">
            <label class="form-label" for="email"><strong>Correo Electrónico</strong></label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
              value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- Password input -->
          <div class="mb-3">
            <label class="form-label" for="password"><strong>Contraseña</strong></label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
              name="password" required autocomplete="current-password">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- Botón de acceso -->
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg w-100">Acceder</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
