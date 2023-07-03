@extends('layouts.main', ['title' => 'Login - Si-TIPEL '])

@section('container')
<div class="container mb-5 mt-3 ">
          {{-- <img  src="img/logo-kementrian.png" width="86" alt="kementrian">
          <img  src="img/logo-dlhkabmjkt.png" width="300" alt="dlh kab mojokerto"> --}}
          {{-- <img  style="margin-left:1000px" src="img/logo-kementrian.png" width="85" alt="kementrian lingkungan hidup"> --}}
          <div class="container d-flex align-items-center">

            <div class="me-1 ">
              <img src="{{ $logo_dlh->image_path }}" width="60" alt="">
            </div>
            <h3 class="logo me-auto fs-5 mt-3 fw-bolder">Dinas Lingkungan Hidup <p>Kabupaten Mojokerto</h3>
          </div>

        
    <div class="row d-flex align-items-center justify-content-center mt-4 ">
      <div class="col-md-8 col-lg-7 col-xl-5 ">
        <img src="{{ $logo_kedua->image_path }}" 
          class="img-fluid" width="600" alt="si-TIPEL">
      </div>

      
      <div class="col-md-7 col-lg-5 col-xl-4 offset-xl-1">
        <div>

            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

        <form action="{{ route('login') }}" method="POST">
          @csrf
            <h1 class="h3 mb-4 fw-normal text-center fs-1 fw-bolder">Selamat Datang</h1>
            <p class="text-center mb-4">Login Sistem Ticketing Pelayanan Online Dinas Lingkungan Hidup Kabupaten Mojokerto</p>
              
          <!-- name input -->
          <div class="form-outline mb-4 form-floating">
            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="email" autofocus required value="{{ old('email') }}"/>
            <label class="form-label" for="name">Email</label>
          </div>
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
          <!-- Password input -->
          <div class="form-outline mb-4 form-floating">
            <input type="password" name="password"  class="form-control form-control-lg" placeholder="Password" autofocus required/>
            <label class="form-label" for="password">Password</label>
          </div>

          

          <!-- Submit button -->
          <button type="submit" class="w-100 btn btn-lg btn-outline-success">Masuk</button>
          <div class="mt-3 " > <a href="/forgot-password" class=" text-decoration-none" >Lupa Password ?</a> </div>
          
          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-muted">Belum Registrasi? Silahkan </p>
          </div>

          <a href="/register"class="w-100 btn btn-lg btn-outline-primary" >Registrasi</a>
          

        </form>
      </div>
    </div>
  </div>
@endsection