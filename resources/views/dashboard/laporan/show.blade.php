

@extends('dashboard.layouts.main')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
      
</head>
@section('container')
@auth
    @if ($laporan->user->id !== auth()->user()->id)
        <p class="alert alert-danger">You are not authorized to view this page.</p>
        <p class="alert alert-danger">Jangan nackal ya :D</p>
    @else

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


                <a href="/dashboard/laporan" class="w-30 mb-2 btn btn-lg btn-outline-primary" >
                    <span data-feather="arrow-left"></span> Kembali
                </a>
                @foreach ($statuses as $status)
                    @if ($laporan->status == $status->kode_status)
                        <span class="w-30 mb-2 ms-2 btn btn-lg btn-outline-primary text-white bg-{{ $status->warna }}">{{ $status->name }}</span>

                    @endif
                @endforeach
                <div class="d-flex justify-content-between align-items-center">
                    <p class="h3 mb-3 fs-1 fw-bold">Laporan Aduan {{ $laporan->user->name }} </p>
                    
                </div>

                    <p class="fs-1"><strong>{{ $laporan->judul }}</strong></p>
                    <p>Dibuat pada : <strong>{{ $laporan->created_at->format('d F Y')  }}</strong></p>
                    <p>Nomor Tiket : <strong>{{ $laporan->nomor_tiket  }}</strong></p>
                    <p>Nama Pelapor : <strong>{{ $laporan->nama  }}</strong></p>
                    <p>Nomor Hp : <strong>{{ $laporan->telpon  }}</strong></p>
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
                            width: 200px; /* set the width you want */
                            height: 200px; /* set the height you want */
                            object-fit: cover; /* adjust the image aspect ratio to fit the container */
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
                     <p class="mt-0 mb-1">Alamat : </p>
                     <p><strong>{{ $laporan->address }}</strong></p>
                 </div>
                 
         <!-- Maps button -->
         <div class=" col-12 d-flex justify-content-center ">
             <a href="https://www.google.com/maps/search/?api=1&query={{ $laporan->coordinates }}" target="blank">
          
                 <button type="submit"  class="w-150 btn btn-lg btn-outline-primary"> <span class="" data-feather="map" ></span> Lihat Google Maps</button>
             </a>
             
         </div>

                 <script>
                     // initialize the map
                     var map = L.map('map').setView([{{ $laporan->coordinates }}], 12);

                     // add the tile layer
                     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                         attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
                         maxZoom: 18,
                     }).addTo(map);

                     // add a marker to the initial location
                     var marker = L.marker([{{ $laporan->coordinates }}]).addTo(map);

                     // disable click events
                     map.doubleClickZoom.disable();
                 </script>
                
            </div>
        </form>
        </div>
        
        <div class="me-5 ms-3 mb-3 col-11">
            <p class="fs-3" ><strong>Histori Respon Petugas</strong></p>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="col-2">Waktu</th>
                        <th class="col-6">Aktivitas</th>
                        <th class="col-2">Status</th>
                        <th class="col-2">File</th>
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
                              <td>
                                @if ($komen->file)
                                <a href="{{ asset('komentar_file/' . $komen->file) }}" class="btn btn-sm btn-primary" download> <span data-feather="download"></span>  Download file</a>
                              @else
                                Tidak ada file
                              @endif
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada komentar petugas</td>
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
@endif
@endauth
@endsection

	

	