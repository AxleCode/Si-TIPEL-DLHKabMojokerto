@extends('layouts.app', ['title' => 'Forgot Password - Si-Tipel DLH Kab Mojokerto'])

@section('content')
<div class="col-md-5">
    <div class="card">

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <div class="text-center">
                        <img src="img/si-TIPEL.png" 
                        class="img-fluid " width="300" alt="si-TIPEL">
                    </div>
                    <label class="font-weight-bold text-uppercase mb-3 mt-3">Email Address</label>
                    <input id="email" type="email" class="form-control mb-3 @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Masukkan Alamat Email">

                    @error('email')
                    <div class="alert alert-danger mt-2">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success btn-block">SEND PASSWORD RESET LINK</button>
                <a href="/login" class="btn btn-primary btn-block">BACK TO LOGIN PAGE</a>
            </form>
        </div>
    </div>
</div>
@endsection