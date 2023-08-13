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

      

<main class="content mb-7">
<div class="container rounded bg-white  ">
    <div class="row">
        
        <div class="col-md-7 border-right">
            
            <div class="p-3 py-5">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            <a href="/dashboard/petugas" class="w-30  mb-3 btn btn-lg btn-outline-primary" >
                <span data-feather="arrow-left"></span> Kembali
            </a>
            <a href="" class="w-30 ms-2 mb-3 btn btn-lg btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                <span data-feather="edit"></span> Update Laporan
            </a>
            @foreach ($statuses as $status)
                @if ($laporan->status == $status->kode_status)
                    <span class="w-30 mb-3 ms-2 btn btn-lg btn-outline-primary text-white bg-{{ $status->warna }}">{{ $status->name }}</span>

                @endif
            @endforeach

            <div class="d-flex justify-content-between align-items-center">
                <p class="h3 mb-1 fs-1 fw-bold">Laporan {{ $userName }} </p>
            </div>                    
              
                

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Update Laporan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="laporan_id" value="{{ $laporan->id }}">
                            <div class="modal-body">

                                <!-- Status -->
                                    <div class="mb-3 col-lg-10">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                            @foreach($statuses as $status)
                                            <option value="{{ $status->kode_status }}" class="bg-{{ $status->warna }} text-white"  {{ $laporan->status == $status->kode_status ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                    </div>

                                    <div class="mb-3 col-lg-10">
                                        <label for="file" class="form-label">Upload Gambar (Jika ada) </label>
                                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".pdf, .jpg, .jpeg, .png">
                                        <p>*<small>Format jpeg,jpg,png,pdf Max ukuran file 1MB</small></p>
                                        @error('file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                    </div>

                                    
                            <!-- Koordinat -->
                            <div class="mb-4 col-lg-10">
                                <label for="koordinat_surveyor">Koordinat Surveyor</label>
                                <input type="text" name="koordinat_surveyor" class="mt-2 form-control rounded-top @error('koordinat_surveyor') is-invalid @enderror" id="koordinat_surveyor" placeholder="Masukkan koordinat_surveyor" value="" readonly>
                                @error('koordinat_surveyor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="mb-4 col-lg-10">
                                <label for="alamat_surveyor">Alamat Surveyor</label>
                                <input type="text" name="alamat_surveyor" class="mt-2 form-control rounded-top @error('alamat_surveyor') is-invalid @enderror" id="alamat_surveyor" placeholder="Masukkan alamat_surveyor" value="" readonly>
                                @error('alamat_surveyor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <script>
                                // Fungsi untuk mendapatkan data koordinat dan alamat dari Nominatim
                                function getCoordinatesAndAddress() {
                                    if ("geolocation" in navigator) {
                                        navigator.geolocation.getCurrentPosition(function(position) {
                                            var latitude = position.coords.latitude;
                                            var longitude = position.coords.longitude;
                            
                                            // Mengisi nilai input koordinat_surveyor
                                            document.getElementById("koordinat_surveyor").value = latitude + ", " + longitude;
                            
                                            // Menggunakan API Nominatim untuk mendapatkan alamat dari koordinat
                                            var url = "https://nominatim.openstreetmap.org/reverse?lat=" + latitude + "&lon=" + longitude + "&format=json";
                                            fetch(url)
                                                .then(response => response.json())
                                                .then(data => {
                                                    var address = data.display_name;
                                                    document.getElementById("alamat_surveyor").value = address;
                                                })
                                                .catch(error => {
                                                    console.error("Error fetching address:", error);
                                                });
                                        });
                                    } else {
                                        alert("Geolocation tidak didukung oleh browser ini.");
                                    }
                                }
                            
                                // Memanggil fungsi saat halaman dimuat
                                window.onload = getCoordinatesAndAddress;
                            </script>

                                    <!-- Transportasi -->
                                    <div class="mb-4 col-lg-10">
                                        <label for="transportasi">Transportasi (Status : Survey Lokasi dan Eksekusi Lokasi)</label>
                                        <input type="text" name="transportasi" class="mt-2 form-control rounded-top @error('transportasi') is-invalid @enderror" id="transportasi" placeholder="Masukkan Transportasi" value="{{ old('transportasi') }}">
                                        @error('transportasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Komentar Status -->
                                    <div class="form-outline mb-4 form-floating col-lg-10">
                                        <textarea type="name" name="komentar" style="height: 150px" class="mt-2 form-control rounded-top rounded-top @error('komentar') is-invalid @enderror" id="komentar" placeholder="" required></textarea>
                                        <label class="form-label" for="komentar">Masukkan Komentar</label>
                                        @error('komentar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div> 

                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>


                    <p class="fs-1"><strong>{{ $laporan->judul }}</strong></p>
                    <p>Dibuat pada : <strong>{{ $laporan->created_at->format('d F Y')  }}</strong></p>
                    <p>ID Ticketing Laporan : <strong>{{ $laporan->nomor_tiket  }}</strong></p>
                    <p>Nama Pelapor : <strong>{{ $laporan->nama  }}</strong></p>
                    <p>Nomor Hp : <strong>{{ $laporan->telpon }}</strong></p>
                    <p>Email : <strong>{{ $laporan->email  }}</strong></p>
                    <p>Kategori : <strong>{{ $laporan->categoryAduan->name }}</strong></p>
                    @foreach ($statuses as $status)
                                        @if ($laporan->status == $status->kode_status)
                                        <p>Keterangan : {{ $status->deskripsi }}</p>
                                        @endif
                                      @endforeach
                    <p class="fs-3" > <strong>Bukti Foto Aduan</strong> </p>
                       
                    @foreach ($images as $image)
                        <a href="{{ asset($image->image_path) }}" data-lightbox="image-{{ $image->id }}" target="_blank">
                        <img src="{{ asset($image->image_path) }}" class="image-class">
                        </a>
                    @endforeach

                    <p class="fs-3 mt-4" > <strong>Deskripsi Aduan</strong> </p>
                    <p class="mt-0">{!! $laporan->body !!}</p>
                    <style>
                        .image-class {
                            width: 200px; 
                            height: 200px; 
                            object-fit: cover; 
                        }
                    </style>

            </div>
        </div>


     
        <div class="col-md-4">
           
            <div class="p-3 py-5 mt-6">
                @if(session()->has('successpass'))
                <div class="alert alert-success" role="alert">
                    {{ session('successpass') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-success" role="alert">
                    {{ session('error') }}
                </div>
            @endif
                 {{-- Peta Koordinat --}}
                 <label for="map" class="form-label">Koordinat Titik Lokasi Aduan</label>
                 <div id="map" class="col-lg-12" style="height: 400px;"></div>

                 <div class="mb-2 col-lg-12">
                     <p class="mt-2 mb-1">Koordinat : </p>
                     <p><strong>{{ $laporan->coordinates }}</strong> </p>
                     <p class="mt-2 mb-1">Koordinat Pelapor : </p>
                     <p><strong>{{ $laporan->posisi }}</strong> </p>
                     <p class="mt-0 mb-1">Alamat : </p>
                     <p><strong>{{ $laporan->address }}</strong></p>
                 </div>
                 
         <!-- Maps button -->
         <div class=" col-12 d-flex justify-content-center ">
             <a href="https://www.google.com/maps/search/?api=1&query={{ $laporan->coordinates }}" target="blank">
          
                 <button type="submit"  class="w-150 btn btn-lg btn-outline-primary mt-3"> <span class="" data-feather="map" ></span> Lihat Google Maps</button>
             </a>
             
         </div>

         <script>
            // Initialize the map
            var map = L.map('map').setView([{{ $laporan->coordinates }}], 12);
            // Add the tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(map);
    
            // Add a marker to the initial location
            var marker = L.marker([{{ $laporan->coordinates }}]).addTo(map);
            
            // Add a marker for user's position with a blue circle icon
            var gpsMarker = L.circleMarker([{{ $laporan->posisi }}], { color: 'blue', radius: 5 }).addTo(map);
            gpsMarker.bindTooltip("Posisi Pelapor", { permanent: true, direction: 'right' });
    
            // Disable click events
            map.doubleClickZoom.disable();
        </script>
                
            </div>
        </form>
        </div>
        
        <div class="me-5  mb-3 col-12">
            <p class="fs-3 ms-2" ><strong>Histori Respon Petugas</strong></p>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="col-2">Waktu</th>
                        <th class="d-none d-xl-table-cell">Komentar</th>
                        <th class="d-none d-sm-table-cell">Status</th>
                        <th class="col-2">Petugas</th>
                        <th class="col-2">Transportasi</th>
                        <th class="d-none d-sm-table-cell">Aksi</th>
                    </tr>
                </thead>
                @if(count($komentar) > 0)
                    <tbody>
                        @foreach ($komentar as $komen)
                            <tr>
                                <td><small>[{{ date('H:i', strtotime($komen->updated_at)) }}] {{ date('d F Y', strtotime($komen->updated_at)) }}</small></td>
                                <td>{!! $komen->komentar !!}</td>
                                @foreach ($statuses as $s)
                                @if ($komen->status == $s->kode_status)
                                  <td><span class="badge bg-{{ $s->warna }}">{{ $s->name }}</span></td>
                                @endif
                              @endforeach        
                              <td>{!! $komen->petugas !!}</td>
                              <td>{!! $komen->transportasi !!}</td>                   
                                <td class="">
                                    @if ($komen->file)
                                    
                                    
                                    <button type="submit" class="badge bg-warning border-0 " data-bs-toggle="modal" data-bs-target="#editModal{{ $komen->id }}" >
                                        <span data-feather="edit" ></span> Edit</button>

                                      <!-- Edit Modal -->
                                      <div class="modal fade" id="editModal{{ $komen->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="editModalLabel"> <span data-feather="grid" ></span><strong> Nama Kategori</strong></h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('komentar.update', $komen->id) }}" method="POST" enctype="multipart/form-data">
                                              @csrf
                                              @method('PUT')
                                              <div class="modal-body">
                                                <div class="ms-3">

                                            <!-- Status komentar -->
                                            <div class="mb-3 col-lg-10">
                                                <label for="status" class="form-label">Status komentar</label>
                                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" >
                                                    @foreach($statuses as $status)
                                                    <option value="{{ $status->kode_status }}" class="bg-{{ $status->warna }} text-white" {{ $komen->status == $status->kode_status ? 'selected' : '' }}>
                                                        {{ $status->name }}
                                                    </option>
                                                @endforeach
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>

                                            <!-- komentar -->
                                             <div class="form-outline mb-4 form-floating col-lg-10">
                                                <textarea type="name" name="komentar" style="height: 150px" class="mt-2 form-control rounded-top rounded-top @error('komentar') is-invalid @enderror" id="komentar" placeholder="" required>{!! old('komentar', $komen->komentar) !!}</textarea>
                                                <label class="form-label" for="komentar">Masukkan Komentar</label>
                                                @error('komentar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div> 
                                            
                                            <!-- Transportasi -->
                                            <div class="mb-4 col-lg-10">
                                                <label for="transportasi">Transportasi </label>
                                                <input type="text" name="transportasi" class="mt-2 form-control rounded-top @error('transportasi') is-invalid @enderror" id="transportasi" placeholder="Masukkan Transportasi" value="{!! old('komentar', $komen->transportasi) !!}">
                                                @error('transportasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                              <!-- File -->
                                              <div class="col-lg-10">
                                                <label class="form-label" for="name">Ubah File</label>
                                                <input type="file" name="file" placeholder="Ganti file" class="mt-1 form-control rounded-top @error('file') is-invalid @enderror" id="file" >
                                                <p style="font-size: 12px" class="mt-1">*Jangan isi file jika ingin menggunakan file sebelumnya</p>
                                                @error('file')
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

                                      <!-- Delete Komentar-->
                                    <form action="{{ route('komentar.destroy', $komen->id) }}" method="POST" class="delete-form d-inline" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="badge bg-danger border-0 n" >
                                          <span data-feather="delete" ></span> Hapus</button>
                                      </form>
                                      <a href="{{ asset('komentar_file/' . $komen->file) }}" class="btn btn-sm btn-primary mt-1" download> <span data-feather="download"></span>  Download file</a>
                                @else
                                    
                                  <button type="submit" class="badge bg-warning border-0 text-right " style="" data-bs-toggle="modal" data-bs-target="#editModal{{ $komen->id }}" >
                                    <span data-feather="edit" ></span> Edit</button>

                                  <!-- Edit Modal -->
                                  <div class="modal fade" id="editModal{{ $komen->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="editModalLabel"> <span data-feather="grid" ></span><strong> Nama Kategori</strong></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('komentar.update', $komen->id) }}" method="POST" enctype="multipart/form-data">
                                          @csrf
                                          @method('PUT')
                                          <div class="modal-body">
                                            <div class="ms-3">

                                        <!-- Status komentar -->
                                        <div class="mb-3 col-lg-10">
                                            <label for="status" class="form-label">Status komentar</label>
                                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" >
                                                @foreach($statuses as $status)
                                                <option value="{{ $status->kode_status }}" class="bg-{{ $status->warna }} text-white" {{ $komen->status == $status->kode_status ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>

                                        <!-- komentar -->
                                         <div class="form-outline mb-4 form-floating col-lg-10">
                                            <textarea type="name" name="komentar" style="height: 150px" class="mt-2 form-control rounded-top rounded-top @error('komentar') is-invalid @enderror" id="komentar" placeholder="" required>{{ old('komentar', $komen->komentar) }}</textarea>
                                            <label class="form-label" for="komentar">Masukkan Komentar</label>
                                            @error('komentar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div> 

                                        <!-- Transportasi -->
                                        <div class="mb-4 col-lg-10">
                                            <label for="transportasi">Transportasi (Status : Survey Lokasi dan Eksekusi Lokasi)</label>
                                            <input type="text" name="transportasi" class="mt-2 form-control rounded-top @error('transportasi') is-invalid @enderror" id="transportasi" placeholder="Masukkan Transportasi" value="{{ old('transportasi', $komen->transportasi) }}">
                                            @error('transportasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                          <!-- File -->
                                          <div class="col-lg-10">
                                            <label class="form-label" for="name">Ubah File</label>
                                            <input type="file" name="file" placeholder="Ganti file" class="mt-1 form-control rounded-top @error('file') is-invalid @enderror" id="file">
                                            <p style="font-size: 12px" class="mt-1">*Jangan isi file jika ingin menggunakan file sebelumnya</p>
                                            @error('file')
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

                                  <!-- Delete Komentar-->
                                <form action="{{ route('komentar.destroy', $komen->id) }}" method="POST" class="delete-form d-inline " >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="badge bg-danger border-0 " >
                                      <span data-feather="delete" ></span> Hapus</button>
                                  </form>


                                @endif
                            </td>

                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="8" class="text-center">Belum ada komentar petugas</td>
                        </tr>
                    </tbody>
                @endif
            </table>
            
        </div>

    </div>
    
</div>
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

<script>
    // Delete confirmation with SweetAlert2
    $('.delete-form').on('submit', function(e) {
      e.preventDefault();
      var form = this;
      Swal.fire({
        title: "Apakah ingin menghapus Komentar?",
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

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to show location permission alert
        function showLocationPermissionAlert() {
            Swal.fire({
                title: "Izin Lokasi Diperlukan",
                text: "Untuk melihat posisi pelapor, izinkan akses lokasi pada perangkat Anda.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Izinkan",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Request location permission
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            // Do nothing, permission granted
                        },
                        function(error) {
                            Swal.fire("Izin Ditolak", "Anda telah menolak izin lokasi.", "error");
                        }
                    );
                }
            });
        }

        // Check for location permission and show alert if needed
        navigator.permissions.query({ name: "geolocation" }).then((result) => {
            if (result.state !== "granted") {
                showLocationPermissionAlert();
            }
            });
        });
</script>
           
</main>
@endsection

	

	