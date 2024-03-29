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
                                <div class="d-flex justify-content-between align-items-center mb-3 ms-3">
                                    <h4 class="text-right">User Setting</h4>
                                </div>

                                <table class="table table-hover my-0">
                                  <thead>
                                    <tr>
                                      <th class="col-1 text-center">ID</th>
                                      <th class="col-3 ">Nama User</th>
                                      <th class="col-2">Email</th>
                                      <th class="col-2 ">Telpon</th>
                                      <th class="col-1 ">Status</th>
                                      <th class="col-3 ">Aksi</th>
                                    </tr>
                                  </thead>
                                  @foreach ($users as $user)

                                  <tbody>
                                    <tr>
                                      <td class="fw-semibold  text-center">{{ $user->id }}</td>
                                      <td>{{ $user->name }}</td>
                                      <td class="">{{ $user->email }}</td>
                                      <td class="">{{ $user->nohp }}</td>
                                      <td class="">
                                        <span class="badge {{ $user->active ? 'bg-success' : 'bg-danger' }}">
                                          {{ $user->active ? 'Active' : 'Nonactive' }}
                                      </span>
                                      </td>
                                      <td class="">
                                        <button type="submit" class="badge bg-warning border-0 " data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}" >
                                          <span data-feather="edit" ></span> Edit</button>    
                                          <!-- Edit Modal -->
                                          <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="editModalLabel"> <span data-feather="grid" ></span><strong> Nama Kategori</strong></h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('user.status', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('PUT')
                                                  <div class="modal-body">
                                                    <div class="ms-3">
                                        
                                                      <div class="form-group">
                                                        <label for="active" class="mb-2">Status</label>
                                                        <select class="form-control" id="active" name="active">
                                                            <option value="1" {{ $user->active ? 'selected' : '' }}>Aktifkan</option>
                                                            <option value="0" {{ !$user->active ? 'selected' : '' }}>Nonaktifkan</option>
                                                        </select>
                                                    </div>
                                              </div>
                                            </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>                              
                                      </td>
                                    </tr>
                                  </tbody>

                                  @endforeach
                                </table>
                                
                    </div>
                    <ul class="pagination mt-4 pagination d-flex justify-content-center  align-items-center"> 
                      {{ $users->links() }}
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
          title: "Apakah ingin menghapus user ini?",
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
	

	