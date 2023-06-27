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
                                    <h4 class="text-right">Pengumuman Settings</h4>
                                </div>

                              <div class="">
                                <button type="button" class="w-30 ms-2 mb-2 btn btn-lg btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambahpengumumanModal"> 
                                    <span data-feather="plus" ></span> Tambah Pengumuman</button>
                            </div>
                          
                              <!-- Tambah Pengumuman Modal -->
                              <div class="modal fade" id="tambahpengumumanModal" tabindex="-1" aria-labelledby="tambahpengumumanModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lm">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="tambahpengumumanModal"><span data-feather="grid"></span> Tambah Pengumuman</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                          <div class="modal-body">
                                            <div class="ms-3">
                                    
                                         <!-- Judul Pengumuman -->
                                         <div class="form-outline mb-3 form-floating col-lg-10">
                                            <input type="text" name="judul" class="mt-2 form-control rounded-top rounded-top @error('judul') is-invalid @enderror" id="judul" placeholder="Nama Kategori" required value="{{ old('judul') }}">
                                            <label class="form-label" for="judul">Masukkan Judul Pengumuman</label>
                                            @error('judul')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div> 

                                        <!-- Isi Pengumuman -->
                                        <div class="col-lg-12">
                                          <div class="form-floating mb-4">
                                            @error('body')
                                              <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            <input id="trix-input" type="hidden" name="body" value="{{ old('body') }}">
                                            <trix-editor input="trix-input" style="background-color: white;" data-trix-placeholder="Masukkan Isi Pengumuman"></trix-editor>
                                          </div>
                                        </div>

                                         <!-- Status -->
                                         <div class="form-outline form-floating col-lg-10">
                                          <div class="mb-4 col-lg-9">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status">
                                                <option value="1">Aktif</option>
                                                <option value="0">Nonaktif</option>
                                            </select>
                                          </div>
                                        </div> 
                                      </div>
                                       
								                    </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button  id="submit" type="submit" name="submit_type" value="password" class="btn btn-primary">Tambah Kategori</button>
                                          </div>
                                        </form>
                                      </div>
                                  </div>
                              </div>
                
                                <table class="table table-hover my-0">
                                  <thead>
                                    <tr>
                                      <th>Judul</th>
                                      <th class="d-none d-xl-table-cell">Update</th>
                                      <th>Status</th>
                                      <th class="d-none d-md-table-cell">Aksi</th>
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
                                           {{-- <!-- lihat Pengumuman Modal -->
                                          <div class="modal fade" id="lihatpengumumanModal" tabindex="-1" aria-labelledby="lihatpengumumanModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="lihatpengumumanModal"><span data-feather="grid"></span>Lihat Pengumuman</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('pengumuman.show',$umum->id) }}" method="POST" enctype="multipart/form-data">
                                                      @csrf
                                                    <div class="modal-body">
                                                      <div class="ms-3">
                                              
                                                  <!-- Judul Pengumuman -->
                                                  <div class="form-outline mb-3 form-floating col-lg-10">
                                                      <input type="text" name="judul" class="mt-2 form-control rounded-top rounded-top @error('judul') is-invalid @enderror" id="judul" placeholder="Nama Kategori" required value="{{ $umum->judul }}">
                                                      <label class="form-label" for="judul">Judul Pengumuman</label>
                                                      @error('judul')
                                                      <div class="invalid-feedback">
                                                          {{ $message }}
                                                      </div>
                                                      @enderror
                                                  </div> 

                                                  <!-- Isi Pengumuman -->
                                                  <div class="col-lg-12">
                                                    <div class="form-floating mb-4">
                                                      @error('body')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                                   <textarea >{!! $umum->body !!}</textarea>
                                                    </div>
                                                  </div>

                                                  <!-- Status -->
                                                  <div class="form-outline form-floating col-lg-10">
                                                    <div class="mb-4 col-lg-9">
                                                      <label for="status" class="form-label">Status</label>
                                                      <select class="form-select" name="status">
                                                          <option value="1">Aktif</option>
                                                          <option value="0">Nonaktif</option>
                                                      </select>
                                                    </div>
                                                  </div> 
                                                </div>
                                                
                                              </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button  id="submit" type="submit" name="submit_type" value="password" class="btn btn-primary">Tambah Kategori</button>
                                                    </div>
                                                  </form>
                                                </div>
                                            </div>
                                        </div> --}}

                                          <a href="{{ route('pengumuman.edit',$umum->id) }}" class="badge bg-warning">
                                            <span data-feather="edit" ></span> Edit
                                          
                                        </a>

                                        {{-- <button type="submit" class="badge bg-warning border-0" data-bs-toggle="modal" data-bs-target="#editModal{{ $umum->id }}">
                                            <span data-feather="edit"></span> Edit
                                        </button> --}}
{{-- 
                                        <!-- Edit Pengumuman Modal -->
                                        <div class="modal fade" id="editModal{{ $umum->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">
                                                            <span data-feather="grid"></span>
                                                            <strong>Edit Pengumuman</strong>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('pengumuman.update', $umum->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <!-- Judul Pengumuman -->
                                                            <div class="form-outline mb-3 form-floating col-lg-10">
                                                                <input type="text" name="judul" class="mt-2 form-control rounded-top @error('judul') is-invalid @enderror" id="judul" placeholder="Nama Kategori" required value="{{ old('judul', $umum->judul) }}">
                                                                <label class="form-label" for="judul">Masukkan Judul Pengumuman</label>
                                                                @error('judul')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <!-- Isi Pengumuman -->
                                                            <div class="col-lg-12">
                                                                <div class="form-floating mb-4">
                                                                    @error('body')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                    <input id="trix-input" type="hidden" name="body" value="{{ old('body', $umum->body) }}">
                                                                    <trix-editor input="trix-input" style="background-color: white;" data-trix-placeholder="Masukkan Isi Pengumuman">{!! $umum->body !!}</trix-editor>
                                                                </div>
                                                            </div>

                                                            <!-- Status -->
                                                            <div class="form-outline form-floating col-lg-10">
                                                                <div class="mb-4 col-lg-9">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select class="form-select" name="status">
                                                                        <option value="1" {{ old('status', $umum->status) == 1 ? 'selected' : '' }}>Aktif</option>
                                                                        <option value="0" {{ old('status', $umum->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
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
                                        </div> --}}
                                          
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
	

	