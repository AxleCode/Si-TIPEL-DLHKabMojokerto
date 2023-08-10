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

      
      <main class="content">
        <div class="container-fluid p-0 ">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
            
                            <div class="p-3 py-5">
                            
                            <div class="d-flex justify-content-between align-items-center ms-2">
                              <strong><h2 class="text-right">List Laporan Status Diterima dan Survey</h2></strong>
                              <div class="form-group">
                                  <h4><label for="filterStatus">Filter Status :</label></h4>
                                  <select class="form-control mt-1" id="filterStatus">
                                      <option value="0">Semua</option>
                                      <option value="1">Diterima</option>
                                      <option value="2">Survey Lokasi</option>
                                  </select>
                              </div>
                            </div>

                            <script>
                              // Delete confirmation with SweetAlert2
                              $('.delete-form').on('submit', function(e) {
                                  // ...
                              });
                          
                              // Filter laporan berdasarkan status yang dipilih
                              $('#filterStatus').on('change', function() {
                                  var selectedStatus = $(this).val();
                                  $('.laporan-row').hide(); // Sembunyikan semua baris laporan
                          
                                  if (selectedStatus === '0') {
                                      $('.laporan-row').show(); // Tampilkan semua baris laporan jika "Semua" dipilih
                                  } else {
                                      $('.laporan-row[data-status="' + selectedStatus + '"]').show(); // Tampilkan hanya baris laporan dengan status yang dipilih
                                  }
                              });
                          </script>
                          
                          
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>No Tiket</th>
                                        <th>Judul</th>
                                        <th class="d-none d-xl-table-cell">Di Laporkan</th>
                                        <th>Status</th>
                                        <th class="d-none d-md-table-cell">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($laporan as $lapor)
                                      @if ($lapor->status == 1 || $lapor->status == 2)
                                          <tr class="laporan-row" data-status="{{ $lapor->status }}">
                                              <td>{{ $lapor->nomor_tiket }}</td>
                                              <td>{{ Str::limit($lapor->judul, 35) }}</td>
                                              <td class="d-none d-xl-table-cell">{{ $lapor->updated_at->format('d F Y') }}</td>
                                              <td>
                                                  @foreach ($statuses as $status)
                                                      @if ($lapor->status == $status->kode_status)
                                                          <span class="badge bg-{{ $status->warna }}">{{ $status->name }}</span>
                                                      @endif
                                                  @endforeach
                                              </td>
                                              <td class="d-none d-md-table-cell">
                                                  <a href="{{ route('surveyor.edit',$lapor->id) }}" class="badge bg-primary">
                                                      <span data-feather="edit" ></span> Tindakan </a>
                                              </td>
                                          </tr>
                                      @endif
                                  @endforeach
                              </tbody>
                              
                            </table>
                            
                    </div>
                   
                </div>
            </div>

        </div>
        <ul class="pagination mt-4 pagination d-flex justify-content-center align-items-center"> 
            {{ $laporan->links() }}
            </ul>
    </main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
      // Delete confirmation with SweetAlert2
      $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var lapor_id = form.getAttribute('data-lapor-id');
        Swal.fire({
          title: "Apakah ingin menghapus Laporan Id " + lapor_id + "?",
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
	

	