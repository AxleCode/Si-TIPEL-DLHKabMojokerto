@extends('dashboard.layouts.main')

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
</head>
@section('container')


      @if(session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      
      <main class="content mb-6">
        <div class="container-fluid p-0 mb-6">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
            
                            <div class="p-3 py-5">
                                @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                            </div>
                            @endif

                            @if(session('swal'))
                                        <script>
                                            Swal.fire({
                                                icon: '{{ session('swal') }}',
                                                title: '{{ session('success') }}',
                                                showConfirmButton: false,
                                                timer: 1500
                                            });
                                        </script>
                                    @endif
                                    
                                    <p class="fs-3">Histori Notifikasi <strong>{{ auth()->user()->name }}</strong></p>
                            
                                    <div class="list-group">
                                      @foreach($notifikasi as $notif)
                                      <button type="button" class="mb-2 list-group-item list-group-item-action {{ $notif->status ? 'active' : '' }}">
                                        <p class="ms-2 fs-4 fw-medium">{{ $notif->pesan }} &nbsp<p>
                                        <p class="fw-bold fs-6">{{ $notif->created_at->locale('id_ID')->format('[H:i] d M Y') }}</p>
                                      </button>
                                    @endforeach
                                    </div>
                                
                    </div>
                   
                </div>
            </div>

        </div>
       
    </main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    

  <style>
    /* Change the color of the active page link */
    .pagination .page-item.active .page-link {
        background-color: #ffffff;
        border-color: #007bff;
    }

    /* Change the color of the page links */
    .pagination .page-link {
        color: #007bff;
    }

  </style>

@endsection
	

	