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
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Downloadable Setting</h4>
                                </div>

                                <div class="">
                                  <a href="" class="w-30 ms-2 mb-2 btn btn-lg btn-outline-success"> 
                                    <span data-feather="plus" ></span> Tambah File</a>
                            </div>
                
                                <table class="table table-hover my-0">
                                  <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th class="d-none d-xl-table-cell">Nama File</th>
                                      <th>Format</th>
                                      <th class="d-none d-md-table-cell">Ukuran</th>
                                    </tr>
                                  </thead>
                                  @foreach ($pengumumans as $umum)

                                  <tbody>
                                    <tr>
                                      <td>{{ Str::limit($umum->judul, 40) }}</td>
                                      <td class="d-none d-xl-table-cell">{{ $umum->updated_at->format('d F Y') }}</td>
                                      @if ($umum->status == '1')
                                      
                                        <td><span class="badge bg-success">Aktif</span></td>
                                      
                                      @elseif ($umum->status == '0')
                                      
                                        <td><span class="badge bg-warning">Nonaktif</span></td>
                                      
                                          
                                      @endif
                                      <td class="d-none d-md-table-cell">
                                        <a href="{{ route('pengumuman.show',$umum->id) }}" class="badge bg-info">
                                          <span data-feather="eye" ></span> Lihat
                                         
                                          </a>
                                          <a href="{{ route('pengumuman.edit',$umum->id) }}" class="badge bg-warning">
                                              <span data-feather="edit" ></span> Edit
                                            
                                          </a>
                                          
                                          <form action="{{ route('pengumuman.destroy', $umum->id) }}" method="POST" class="delete-form d-inline" >
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="badge bg-danger border-0 n" >
                                              <span data-feather="delete" ></span> Hapus</button>
                                          </form>
                                          
                                          </a>
                                      </td>
                                    </tr>
                                  </tbody>

                                  @endforeach
                                </table>
                                
                    </div>
                    <ul class="pagination mt-4 pagination d-flex justify-content-center  align-items-center"> 
                      {{ $pengumumans->links() }}
                      </ul>
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
          title: "Apakah ingin menghapus pengumuman?",
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
	

	