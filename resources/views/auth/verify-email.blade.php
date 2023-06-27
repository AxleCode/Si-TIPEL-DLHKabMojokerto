@extends('layouts.app', ['title' => 'Verify Email Address - Si-TIPEL DLH Kab Mojokerto'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifikasi Alamat Email Anda') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </div>
                    @endif

                    {{ __('Mohon Maaf anda belum bisa masuk ke dashboard karena email anda belum terverifikasi, Silahkan cek inbox email yang sudah anda daftarkan untuk verifikasi') }}
                    {{ __('Jika anda belum menerima email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Klik disini untuk kirim email verifikasi lagi') }}</button>.
                        <p>Atau</p>
                        <a href="/"class="btn btn-primary" >Kembali ke Home</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection