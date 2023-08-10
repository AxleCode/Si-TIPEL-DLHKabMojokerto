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

      

<main class="content mb-7">
<div class="container rounded bg-white  ">
    <div class="row">
        
        <div class="d-flex justify-content-between align-items-center mb-3 mt-3 ms-3">
            <h4 class="text-right">Logo Settings</h4>
        </div>
        <div class="col-md-6 border-right">
          <table class="table table-hover my-0">
            @foreach ($logos1 as $logo1)

            <tbody>
              <tr>
                <td class="fw-semibold  text-center col-8">{{ $logo1->name }} <img src="{{ asset($logo1->image_path) }}" width="250" alt=""></td>
                <td class="col-4">
                  <button type="submit" class="badge bg-warning border-0 " data-bs-toggle="modal" data-bs-target="#editModal{{ $logo1->id }}" >
                    <span data-feather="edit" ></span> Edit</button>

                  <!-- Edit Logo Modal -->
                  <div class="modal fade" id="editModal{{ $logo1->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel"> <span data-feather="grid" ></span><strong> {{ $logo1->name }}</strong></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('logo1-update', $logo1->id) }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="modal-body">

                          <!-- Image -->
                          <div class="col-lg-10">
                            <img src="{{ asset($logo1->image_path) }}" alt="Image" style="max-width: 200px;">
                            <input type="file" name="image" class="mt-2 form-control rounded-top @error('image') is-invalid @enderror" id="image" required>
                            @error('image')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
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

        <div class="col-md-6 border-right">
            
            <table class="table table-hover my-0">
                @foreach ($logos2 as $logo2)

                <tbody>
                  <tr>
                    <td class="fw-semibold  text-center col-8">{{ $logo2->name }} <img src="{{ asset($logo2->image_path) }}" width="230" alt=""></td>
                    <td class="col-4">
                      <button type="submit" class="badge bg-warning border-0 " data-bs-toggle="modal" data-bs-target="#editModal{{ $logo2->id }}" >
                        <span data-feather="edit" ></span> Edit</button>

                      <!-- Edit Logo Modal -->
                      <div class="modal fade" id="editModal{{ $logo2->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel"> <span data-feather="grid" ></span><strong> {{ $logo2->name }}</strong></h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('logo1-update', $logo2->id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              <div class="modal-body">

                              <!-- Image -->
                              <div class="col-lg-10">
                                <img src="{{ asset($logo2->image_path) }}" alt="Image" style="max-width: 200px;">
                                <input type="file" name="image" class="mt-2 form-control rounded-top @error('image') is-invalid @enderror" id="image" required>
                                @error('image')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
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
    </div>
</div>

<div class="container rounded bg-white  mt-3">
    <div class="row">
        
        <div class="d-flex justify-content-between align-items-center mb-3 mt-3 ms-3">
            <h4 class="text-right">Alur Pelayanan Settings</h4>
        </div>
          <div class="">
              <button type="button" class="w-30 ms-2 mb-2 btn btn-lg btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <span data-feather="plus"></span> Tambah Pelayanan
              </button>
          </div>
          
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span data-feather="grid"></span> Tambah Alur Pelayanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('buat-pelayanan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="ms-3">

                                <!-- Nomor Pelayanan -->
                                <div class="mb-4 col-lg-8">
                                  <label for="nomor" class="form-label">Nomor Alur Pelayanan</label>
                                  <select class="form-select" name="nomor" id="nomor">
                                    @for ($i = 1; $i <= 5; $i++)
                                      @if (!in_array($i, $nomor_pelayanan))
                                        <option value="{{ $i }}">{{ $i }}</option>
                                      @endif
                                    @endfor
                                  </select>
                                </div>

                                <!-- Slug Pelayanan -->
                                <div class="form-outline mt-3 form-floating col-lg-10">
                                    <input type="text" name="slug" class="mt-3 form-control rounded-top rounded-top @error('slug') is-invalid @enderror" id="slug" placeholder="Nama Kategori" required value="{{ old('slug') }}">
                                    <label class="form-label" for="slug">Masukkan Judul Alur Pelayanan</label>
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
        
                                <!-- Body Pelayanan -->
                                <div class="form-outline mt-3 form-floating col-lg-10">
                                    <input type="text" name="body" class="mt-3 form-control rounded-top rounded-top @error('body') is-invalid @enderror"id="body" placeholder="Nama Kategori" required value="{{ old('body') }}">
                                    <label class="form-label" for="body">Masukkan Body Alur Pelayanan</label>
                                    @error('body')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button id="submitpelayanan" type="submit" class="btn btn-primary">Tambah Alur Pelayanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
          document.getElementById('submitpelayanan').addEventListener('click', function() {
            var nomorPelayanan = document.getElementById('nomor').value;
            if (nomorPelayanan === '') {
              alert('Maksimal hanya 5 alur pelayanan tidak boleh lebih!');
            } else {
              document.getElementById('pelayananForm').submit();
            }
          });
        </script>
        

        <div class="col-md-12 border-right">
          <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Slug</th>
                    <th>Body</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelayanan as $layanan)
                <tr>
                    <td>{!! Str::limit($layanan->nomor) !!}</td>
                    <td>{!! Str::limit($layanan->slug, 30) !!}</td>
                    <td class="col-6">{!! Str::limit($layanan->body, 300) !!}</td>
                    <td class="col-3">
                         <button type="submit" class="badge bg-warning border-0 " data-bs-toggle="modal" data-bs-target="#editModallayanan{{ $layanan->id }}" >
                                <span data-feather="edit" ></span> Edit</button>
        
                              <!-- Edit Pelayanan Modal -->
                              <div class="modal fade" id="editModallayanan{{ $layanan->id }}" tabindex="-1" aria-labelledby="editmodallabellayanan" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="editmodallabellayanan"> <span data-feather="grid" ></span><strong> {{ $layanan->name }}</strong></h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pelayanan-update', $layanan->id) }}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      @method('PUT')
                                      <div class="modal-body">
                                        
                                        <!-- Nomor Pelayanan -->
                                        <div class="mb-4 col-lg-8" hidden>
                                          <label for="nomor" class="form-label">Nomor Pelayanan</label>
                                          <select class="form-select" name="nomor" id="nomor">
                                            @for ($i = 1; $i <= 5; $i++)
                                              <option value="{{ $i }}" {{ (old('nomor') == $i || $layanan->nomor == $i) ? 'selected' : '' }}>
                                                {{ $i }}
                                              </option>
                                            @endfor
                                          </select>
                                        </div>                                       
        
                                        <!-- Slug Pelayanan -->
                                        <div class="form-outline mt-3 form-floating col-lg-10">
                                          <input type="text" name="slug" class="mt-3 form-control rounded-top rounded-top @error('slug') is-invalid @enderror" id="slug" placeholder="Nama Kategori" required value="{{ old('slug', $layanan->slug) }}">
                                          <label class="form-label" for="slug">Masukkan Slug Pelayanan</label>
                                          @error('slug')
                                              <div class="invalid-feedback">
                                                  {{ $message }}
                                              </div>
                                          @enderror
                                      </div>
              
                                      <!-- Body Pelayanan -->
                                      <div class="form-outline mt-3 form-floating col-lg-10">
                                          <input type="text" name="body" class="mt-3 form-control rounded-top rounded-top @error('body') is-invalid @enderror"id="body" placeholder="Nama Kategori" required value="{{ old('body', $layanan->body) }}">
                                          <label class="form-label" for="body">Masukkan Body Pelayanan</label>
                                          @error('body')
                                              <div class="invalid-feedback">
                                                  {{ $message }}
                                              </div>
                                          @enderror
                                      </div>
                                                                           
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
        
                        <form action="{{ route('layanan-hapus', $layanan) }}" method="POST" class="delete-form d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="badge bg-danger border-0 n">
                                <span data-feather="delete"></span> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        

        </div>
    </div>
</div>

<script>
  $('.delete-form').submit(function(e) {
      e.preventDefault();
      var form = this;
      Swal.fire({
          title: 'Apakah anda yakin ingin menghapus alur layanan ini?',
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
.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 14px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

{{-- <script>
    // Listen for form submission event
    const form = document.querySelector('#profile-form');
    const submitButton = document.querySelector('#profile-submit');
    form.addEventListener('submit', function(e) {
      // Prevent the default form submission behavior
      e.preventDefault();
      // Display SweetAlert2 confirmation dialog
      Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to submit this form',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'No, cancel',
      }).then((result) => {
        if (result.isConfirmed) {
          // If user confirms, submit the form
          submitButton.disabled = true;
          form.submit();
        }
      });
    });
  </script> --}}

  
	

            

           
</main>

@endsection
	

	