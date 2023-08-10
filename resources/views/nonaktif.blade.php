@extends('layouts.app')

@section('content')
<div class="alert alert-danger" role="alert">
    Akun Anda Dinonaktifkan. Silakan hubungi administrator.
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
@endsection
