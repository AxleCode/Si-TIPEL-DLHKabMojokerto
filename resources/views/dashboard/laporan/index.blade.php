@extends('dashboard.layouts.main')

<head>
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

      
      <main class="content">
        <div class="container-fluid p-0 mb-2">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
            
                            <div class="p-3 py-5 ">
                               
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">List Laporan {{ auth()->user()->name }} </h4>
                                </div>

                                <div class="mb-4">
                                  <a href="{{ route('laporan.create') }}" class="w-30 ms-2 mb-2 btn btn-lg btn-outline-success"> 
                                    <span data-feather="edit" ></span> Isi Formulir</a>
                            </div>

                           {{-- <table class="table table-hover my-0">
                                  <thead>
                                    <tr>
                                        <th>ID Aduan</th>
                                      <th>Judul</th>
                                      
                                      <th class="d-none d-xl-table-cell">Di Laporkan</th>
                                      <th>Status</th>
                                      <th class="d-none d-md-table-cell">Aksi</th>
                                    </tr>
                                  </thead>
                                  @foreach ($laporan as $lapor)

                                  <tbody>
                                    <tr>
                                    <td> {{ $lapor->id }}</td>
                                      <td>{{ Str::limit($lapor->judul, 35) }}</td>
                                      <td class="d-none d-xl-table-cell">{{ $lapor->updated_at->format('d F Y') }}</td>
                                      @foreach ($statuses as $status)
                                        @if ($lapor->status == $status->kode_status)
                                          <td><span class="badge bg-{{ $status->warna }}">{{ $status->name }}</span></td>
                                        @endif
                                      @endforeach
                                      <td class="d-none d-md-table-cell">
                                        <a href="{{ route('laporan.show',$lapor->id) }}" class="badge bg-info">
                                          <span data-feather="eye" ></span> Lihat
                                          </a>
                                          @if ($lapor->status == '0')
                                            <form action="{{ route('laporan.destroy', $lapor->id) }}" method="POST" class="delete-form d-inline" 
                                              data-bs-toggle="tooltip" data-bs-placement="top"
                                              data-bs-custom-class="custom-tooltip"
                                              data-bs-title="Anda hanya dapat membatalkan aduan saat berada di status Dalam Antrian">
                                              @csrf
                                              @method('delete')
                                              <button type="submit" class="badge bg-danger border-0 n" >
                                                <span data-feather="x-circle" ></span> Batalkan Aduan
                                              </button>
                                            </form>
                                          @endif
                                          
                                          
                                          </a>
                                      </td>
                                    </tr>
                                  </tbody>

                                  @endforeach
                                </table> --}}

                                              
                                <div class="container">
                                  <div class="row" id="laporan-list">
                                    @foreach ($laporan as $lapor)
                                      <div class="col-md-4 mb-3">
                                        <div class="card">
                                          <div id="carousel-{{ $lapor->id }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                              @foreach($lapor->laporanImages as $image)
                                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                  <img src="{{ asset($image->image_path) }}" class="d-block w-100 card-img-top" alt="...">
                                                </div>
                                              @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $lapor->id }}" data-bs-slide="prev">
                                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                              <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $lapor->id }}" data-bs-slide="next">
                                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                              <span class="visually-hidden">Next</span>
                                            </button>
                                          </div>
                                          <div class="card-body" style="height: 250px; overflow-y: hidden;">
                                            <h3 class="card-title fs-4" >{!! Str::limit($lapor->judul, 55) !!}</h3>
                                            <p class="card-text">Nomor Tiket : {{ $lapor->nomor_tiket }}</p>
                                            @foreach ($statuses as $status)
                                            @if ($lapor->status == $status->kode_status)
                                              <p><span class="badge bg-{{ $status->warna }}">{{ $status->name }}</span></p>
                                            @endif
                                          @endforeach
                                          <td class="d-none d-xl-table-cell">Update Pada {{ $lapor->updated_at->format('[H:i] d F Y') }}</td>

                                          <div class="mt-1 text-center card-footer">
                                            <a href="{{ route('laporan.show',$lapor->id) }}" class="fs-5 w-30 ms-2 mb-2 btn btn-lg btn-outline-primary">
                                              <span ></span> Lihat Detail
                                              </a>
                                              @if ($lapor->status == '0' || $lapor->status == '100')
                                                <form action="{{ route('laporan.destroy', $lapor->id) }}" method="POST" class="delete-form d-inline" 
                                                  data-bs-toggle="tooltip" data-bs-placement="top"
                                                  data-bs-custom-class="custom-tooltip"
                                                  data-bs-title="Anda hanya dapat membatalkan laporan saat berada di status Dalam Antrian dan Ditolak">
                                                  @csrf
                                                  @method('delete')
                                                  <button type="submit" class="fs-5 w-30 ms-2 mb-2 btn btn-lg btn-outline-danger mt-1" >
                                                    Batalkan Laporan
                                                  </button>
                                                </form>
                                              @endif
                                          </div>

                                          </div>
                                        </div>
                                      </div>
                                    @endforeach
                                   
                                  </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                  {{ $laporan->links('pagination::bootstrap-5') }}
                                </div>
                                
                      <style>
                        .card-img-top {
                          width: 100%;
                          height: 260px; /* adjust as needed */
                          object-fit: cover;
                        }


                        </style>
                                
                                <script>
                                  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                                  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                                      return new bootstrap.Tooltip(tooltipTriggerEl)
                                  })
                            </script>
                            <style>
                              .tooltip {
                                    background-color: yellow;
                                }
                            </style>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
      // Delete confirmation with SweetAlert2
      $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        Swal.fire({
          title: "Apakah ingin memembatalkan Laporan?",
          text: "Data yang dihapus tidak bisa dikembalikan",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } 
        });
      });
    </script>
    
    

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
	

	