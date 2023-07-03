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
                                    

                                <div class="d-flex justify-content-between align-items-center mb-3 ms-2">
                                    <h4 class="text-right">Status Settings</h4>
                                </div>

                                <div class="">
                                  <button type="button" class="w-30 ms-2 mb-2 btn btn-lg btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                      <span data-feather="plus"></span> Tambah Status
                                  </button>
                              </div>
                              
                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lm">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel"><span data-feather="grid"></span> Tambah Status</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form action="{{ route('status.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                          <div class="modal-body">
                                            <div class="ms-3">
                                    
                                         <!-- Kode Status -->
                                         <div class="form-outline mb-4 form-floating col-lg-10">
                                          <input type="number" name="kode" class="mt-2 form-control rounded-top rounded-top @error('kode') is-invalid @enderror" id="kode" placeholder="Nama Status" required value="{{ old('kode') }}">
                                          <label class="form-label" for="kode">Masukkan Kode Status</label>
                                          @error('kode')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                          @enderror
                                      </div> 
                                              
                                              <!-- Nama Status -->
                                         <div class="form-outline mb-4 form-floating col-lg-10">
                                            <input type="name" name="name" class="mt-2 form-control rounded-top rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Nama Status" required value="{{ old('name') }}">
                                            <label class="form-label" for="name">Masukkan Nama Status</label>
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div> 

                                        <!-- Pilih Warna -->
                                        <div class="form-outline mb-4 form-floating col-lg-10">
                                          <select name="color" class="mt-2 form-select @error('color') is-invalid @enderror" id="color" required>
                                            @foreach ($colors as $key => $value)
                                              <option value="{{ $key }}" class="bg-{{ $key }}">{{ $value }}</option>
                                          @endforeach
                                          </select>
                                          <label class="form-label" for="color">Pilih Warna</label>
                                          @error('color')
                                              <div class="invalid-feedback">
                                                  {{ $message }}
                                              </div>
                                          @enderror
                                        </div>
                                                  
                                                 <!-- Deskripsi -->
                                        <div class="form-outline mb-4 form-floating col-lg-10">
                                          <textarea type="text" name="deskripsi" style="height: 150px;" class="mt-2 form-control rounded-top rounded-top @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="Masukkan Deskripsi" required ></textarea>
                                            <label class="form-label" for="deskripsi">Masukkan Deskripsi</label>
                                            @error('deskripsi')
                                            <div class="invalid-feedback">
                                              {{ $message }}
                                            </div>
                                        @enderror
                                        </div> 

                                      </div>
                                       
								                    </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button id="submit1" type="submit"  type="button" class="btn btn-primary">Tambah Kategori</button>
                                          </div>
                                        </form>
                                      </div>
                                  </div>
                              </div>
                            
                                <table class="table table-hover my-0">
                                  <thead>
                                    <tr>
                                      <th class="d-none d-sm-table-cell">Kode Status</th>
                                      <th>Nama Status</th>
                                      <th>Deskripsi</th>
                                      <th>Jumlah Laporan</th>
                                      <th class="d-none d-md-table-cell">Aksi</th>
                                    </tr>
                                  </thead>
                                  @foreach ($statuses as $status)

                                  <tbody>
                                    <tr>
                                      <td>{{ $status->kode_status }}</td> 
                                      <td class="badge mt-2 bg-{{ $status->warna }}">{{ $status->name }}</td>
                                      <td>{!! Str::limit($status->deskripsi, 40,) !!}</td>
                                      <td class="">{{ $status->laporan_count }}</td>
                                      <td class="d-none d-md-table-cell">
                                        <a href="{{ route('status.show', $status->kode_status) }}" class="badge bg-info">
                                          <span data-feather="eye" ></span> Lihat
                                          </a>

                                          <button type="submit" class="badge bg-warning border-0 " data-bs-toggle="modal" data-bs-target="#editModal{{ $status->id }}" >
                                            <span data-feather="edit" ></span> Edit</button>

                                          <!-- Edit Modal -->
                                          <div class="modal fade" id="editModal{{ $status->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="editModalLabel"> <span data-feather="grid" ></span><strong> Nama Kategori</strong></h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('status.update', $status->id) }}" method="POST" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('PUT')
                                                  <div class="modal-body">
                                                    <div class="ms-3">
                                        
                                                      
                                                      <!-- Nama Status -->
                                                 <div class="form-outline mb-4 form-floating col-lg-10">
                                                    <input type="name" name="name" class="mt-2 form-control rounded-top rounded-top @error('name') is-invalid @enderror" id="name" placeholder="" required value="{{ old('name', $status->name) }}">
                                                    <label class="form-label" for="name">Masukkan Nama Status</label>
                                                    @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div> 
        
                                               <!-- Pilih Warna -->
                                               <div class="form-outline mb-4 form-floating col-lg-10">
                                                <select name="color" class="mt-2 form-select  @error('color') is-invalid @enderror" id="color" required>
                                                    @foreach ($colors as $key => $value)
                                                        <option value="{{ $key }}" class="bg-{{ $key }}" @if($status->warna == $key) selected @endif>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                <label class="form-label" for="color">Pilih Warna</label>
                                                @error('color')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            
                                                 <!-- Deskripsi -->
                                                 <div class="form-outline mb-4 form-floating col-lg-10">
                                                  <textarea type="text" name="deskripsi" style="height: 150px;" class=" mt-2 form-control rounded-top rounded-top @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="" required value="{!! $status->deskripsi !!}">{!! $status->deskripsi !!}</textarea>
                                                  <label class="form-label" for="deskripsi">Masukkan Deskripsi</label>
                                                  @error('deskripsi')
                                                  <div class="invalid-feedback">
                                                      {{ $message }}
                                                  </div>
                                                  @enderror
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
                                          
                                          <form action="{{ route('status.destroy', $status) }}" method="POST" class="delete-form d-inline" >
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="badge bg-danger border-0 n" >
                                              <span data-feather="delete" ></span> Hapus</button>
                                          </form>
                                          
                                      </td>
                                    </tr>
                                  </tbody>

                                  @endforeach
                                </table>
                                
                    </div>
                   
                </div>
            </div>

        </div>
       
    </main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
      $('.delete-form').submit(function(e) {
          e.preventDefault();
          var form = this;
          Swal.fire({
              title: 'Apakah anda yakin ingin menghapus status ini?',
              text: "Data tidak bisa dikembalikan lagi setelah dihapus!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Hapus!'
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
	

	