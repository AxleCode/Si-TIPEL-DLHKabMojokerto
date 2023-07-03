@extends('layouts.main', ['title' => 'Register - Si-TIPEL '])

@section('container')
  @php
  $logo = \App\Models\Logo::find(2);
  $logo_kedua = $logo->image_path;
  $logo3 = \App\Models\Logo::find(3);
  $logo_dlh = $logo3->image_path;    
  @endphp
<div class="container mb-5 mt-3 ">
    <div class="container d-flex align-items-center">

      <div class="me-1 ">
        <img src="{{ $logo_dlh }}" width="60" alt="">
      </div>
      <h3 class="logo me-auto fs-5 mt-3 fw-bolder">Dinas Lingkungan Hidup <p>Kabupaten Mojokerto</h3>
    </div>
        
    <div class="row d-flex align-items-center justify-content-center mt-4 ">
      <div class="col-md-8 col-lg-7 col-xl-5 ">
        <img src="{{ $logo_kedua }}" 
          class="img-fluid" width="600" alt="si-TIPEL">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-4 offset-xl-1">

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h1 class="h3 mb-4 fw-normal text-center fs-1 fw-bolder">Silahkan Registrasi</h1>
            <p class="text-center mb-4">Registrasi Sistem Ticketing Pelayanan Online Dinas Lingkungan Hidup Kabupaten Mojokerto</p>
              
          <!-- Email input -->
          <div class="form-outline mb-4 form-floating">
            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="email" required value="{{ old('email') }}"/>
            <label class="form-label"  for="email">Email</label>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror  
        </div>

          <!-- Nama input -->
          <div class="form-outline mb-4 form-floating">
            <input type="name" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="name" required value="{{ old('name') }}"/>
            <label class="form-label" for="name">Nama</label>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror  
          </div>

          <!-- Alamat input -->
          <div class="form-outline mb-4 form-floating">
            <input type="text" name="alamatpemohon" class="form-control form-control-lg @error('alamatpemohon') is-invalid @enderror" placeholder="alamatpemohon" required value="{{ old('alamatpemohon') }}"/>
            <label class="form-label" for="alamat">Alamat Pemohon</label>
            @error('alamatpemohon')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror  
          </div>

          <!-- No HP input -->
          <div class="form-outline mb-4 form-floating">
            <input type="number" name="nohp" class="form-control form-control-lg @error('nohp') is-invalid @enderror"  placeholder="nohp" required value="{{ old('nohp') }}"/>
            <label class="form-label" for="nohp">Nomor HP/WA</label>
            @error('nohp')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror  
          </div>

           <!-- Password input -->
           <div class="form-outline mb-4 form-floating">
              <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password"/>
              <label class="form-label" for="password">Password</label>
              @error('password')
              <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror  
          </div>

           <!-- Confirm Password input -->
           <div class="form-outline mb-4 form-floating">
              <input type="password" id="password-confirm" name="password_confirmation" class="form-control form-control-lg" placeholder="Password" required autocomplete="new-password"/>
              <label class="form-label" for="password">Konfirmasi Password</label>
           
          </div>
          


          <!-- Submit button -->
          <button type="submit" class="w-100 btn btn-lg btn-outline-primary ">Registrasi</button>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-muted">Sudah Registrasi? Silahkan </p>
          </div>

          <a href="/login"class="w-100 btn btn-lg btn-outline-success" >Masuk</a>
          

        </form>
      </div>
    </div>
  </div>
@endsection