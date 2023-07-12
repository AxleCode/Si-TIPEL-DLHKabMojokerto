@extends('dashboard.layouts.main')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

</head>

@section('container')
<main class="content">
    <div class="container-fluid p-0">
        <p class="h3 mb-3 text-danger-emphasis fs-1 fw-bold">Formulir Pelayanan</p>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="fs-3"><strong>Isi Formulir</strong></p>
                        <form id="laporan-form" action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="p-1 py-1">
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

                                <!-- Nama Pembuat Aduan -->
                                <div class="mb-4 col-lg-8">
                                    <label for="nama">Nama Pembuat Laporan</label>
                                    <input readonly type="text" name="nama" class="mt-2 form-control rounded-top rounded-top @error('nama') is-invalid @enderror" id="nama" required value="{{ old('nama',$user->name) }}">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Nomor Telpon -->
                                <div class="mb-4 col-lg-8">
                                    <label for="telpon">Nomor Telpon</label>
                                    <input readonly type="text" name="telpon" class="mt-2 form-control rounded-top rounded-top @error('telpon') is-invalid @enderror" id="telpon" required value="{{ old('telpon',$user->nohp) }}">
                                    @error('telpon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-4 col-lg-8">
                                    <label for="email">Email</label>
                                    <input readonly type="text" name="email" class="mt-2 form-control rounded-top rounded-top @error('email') is-invalid @enderror" id="email" required value="{{ old('email',$user->email) }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Judul Aduan -->
                                <div class="mb-4 col-lg-8">
                                    <label for="judul">Judul Laporan</label>
                                    <input type="text" name="judul" class="mt-2 form-control rounded-top rounded-top @error('judul') is-invalid @enderror" id="judul" placeholder="Masukkan Judul Laporan" required value="{{ old('judul') }}">
                                    @error('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="mb-4 col-lg-8">
                                    <label for="category" class="form-label">Kategori Pelayanan</label>
                                    <select class="form-select" name="category">
                                        @foreach ($category as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Kecamatan -->
                                <div class="mb-4 col-lg-8">
                                    <label for="kecamatan" class="form-label">Pilih Kecamatan</label>
                                    <select class="form-select" name="kecamatan" id="kecamatan">
                                        <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                    </select>
                                </div>

                                <!-- Desa -->
                                <div class="mb-4 col-lg-8">
                                    <label for="desa" class="form-label">Pilih Desa</label>
                                    <select class="form-select" name="desa" id="desa">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <!-- Peta -->
                                <div class="mb-2 col-lg-12">
                                    <label for="map" class="form-label">Koordinat Titik Lokasi Laporan</label>
                                    <div id="map" class="col-lg-12" style="height: 500px;"></div>
                                    <div class="mt-2">
                                        <input type="text" id="coordinates" name="coordinates" class="form-control" placeholder="Koordinat" readonly>
                                        <input type="text" id="address" name="address" class="form-control mt-2" placeholder="Alamat">
                                    </div>
                                    <p class="mt-1"><span style="width: 14px" class="text-danger" data-feather="alert-triangle"></span> 
                                        Silahkan klik lokasi tempat laporan anda. Pastikan koordinat lokasi berada di wilayah kabupaten mojokerto dan apabila berada diluar wilayah mojokerto maka <strong class="text-danger">aduan tidak akan diproses oleh petugas</strong>. Form alamat dapat diubah silahkan tambahkan patokan atau detail lainnya</p>
                                </div>

                                <!-- Script -->
                                <script>
                                    $(document).ready(function() {
                                        // Mengambil data kecamatan dan desa dari file JSON
                                        $.getJSON('/json/kecamatandesamojokerto.json', function(data) {
                                            var kecamatanOptions = '<option value=""></option>';
                                            var desaOptions = '<option value=""></option>';
                                
                                            // Mengisi opsi kecamatan
                                            $.each(data.kecamatan, function(index, kecamatan) {
                                                kecamatanOptions += '<option value="' + kecamatan.id + '">' + kecamatan.nama + '</option>';
                                            });
                                
                                            // Menampilkan opsi kecamatan
                                            $('#kecamatan').html(kecamatanOptions);
                                
                                            // Menampilkan opsi desa berdasarkan kecamatan yang dipilih
                                            $('#kecamatan').change(function() {
                                                var selectedKecamatanId = $(this).val();
                                                desaOptions = '<option value=""></option>';
                                
                                                // Mengisi opsi desa berdasarkan kecamatan yang dipilih
                                                $.each(data.kecamatan, function(index, kecamatan) {
                                                    if (kecamatan.id == selectedKecamatanId) {
                                                        $.each(kecamatan.desa, function(index, desa) {
                                                            desaOptions += '<option value="' + desa.id + '">' + desa.nama + '</option>';
                                                        });
                                                    }
                                                });
                                
                                                // Menampilkan opsi desa
                                                $('#desa').html(desaOptions);
                                            });
                                
                                            // Mengupdate koordinat pada peta saat desa dipilih
                                            $('#desa').change(function() {
                                                var selectedKecamatanId = $('#kecamatan').val();
                                                var selectedDesaId = $(this).val();
                                                var selectedKecamatan = data.kecamatan.find(function(kecamatan) {
                                                    return kecamatan.id == selectedKecamatanId;
                                                });
                                                var selectedDesa = selectedKecamatan.desa.find(function(desa) {
                                                    return desa.id == selectedDesaId;
                                                });
                                                updateMap(selectedDesa);
                                            });
                                        });
                                    });
                                
                                    var mymap = L.map('map').setView([-7.520188637328168, 112.55842759283786], 13);
                                
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                                        maxZoom: 18,
                                    }).addTo(mymap);
                                
                                    // Tambahkan layer satelit
                                    var satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                                        attribution: '&copy; <a href="https://www.arcgis.com/">ArcGIS</a> contributors',
                                        maxZoom: 18,
                                    });
                                
                                    // Menambahkan opsi satelit pada peta
                                    var baseLayers = {
                                        'OpenStreetMap': L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                                            maxZoom: 18,
                                        }),
                                        'Satellite': satelliteLayer,
                                    };
                                
                                    L.control.layers(baseLayers).addTo(mymap);
                                
                                    // Menambahkan keterangan pada opsi satelit
                                    var layerControl = $('.leaflet-control-layers-selector');
                                    layerControl.each(function() {
                                        var input = $(this);
                                        var label = input.next('span');
                                        var labelText = label.html();
                                        if (labelText === 'Satellite') {
                                            label.attr('title', 'Tampilkan peta satelit');
                                        }
                                    });
                                
                                    var marker;
                                
                                    function updateMap(selectedDesa) {
                                        if (marker) {
                                            mymap.removeLayer(marker);
                                        }
                                
                                        var lat = selectedDesa.koordinat.latitude;
                                        var lng = selectedDesa.koordinat.longitude;
                                
                                        marker = L.marker([lat, lng], { draggable: true }).addTo(mymap);
                                        mymap.setView([lat, lng], 15);
                                
                                        // Memperbarui koordinat saat pin dipindahkan
                                        marker.on('dragend', function(event) {
                                            var marker = event.target;
                                            var position = marker.getLatLng();
                                            var lat = position.lat;
                                            var lng = position.lng;
                                
                                            $('#coordinates').val(lat + ', ' + lng);
                                            getAddress(lat, lng);
                                        });
                                
                                        // Memperbarui alamat saat peta diklik
                                        mymap.on('click', function(event) {
                                            var lat = event.latlng.lat;
                                            var lng = event.latlng.lng;
                                
                                            marker.setLatLng([lat, lng]);
                                            $('#coordinates').val(lat + ', ' + lng);
                                            getAddress(lat, lng);
                                        });
                                    }
                                
                                    function getAddress(lat, lng) {
                                        axios
                                            .get('https://nominatim.openstreetmap.org/reverse', {
                                                params: {
                                                    lat: lat,
                                                    lon: lng,
                                                    format: 'json',
                                                },
                                            })
                                            .then(function(response) {
                                                var address = response.data.display_name;
                                                $('#address').val(address);
                                            })
                                            .catch(function(error) {
                                                console.log(error);
                                            });
                                    }
                                </script>



                                <!-- Upload Foto -->
                                <div class="col-lg-11 mb-4">
                                    <div class="user-image mb-3 mt-3 text-center">
                                        <div class="imgPreview"></div>
                                    </div>
                                    <div class="custom-file">
                                        <div class="input-group control-group increment">
                                            <input type="file" name="imageFile[]" class="form-control custom-file-input" id="images" multiple="multiple" required>
                                            <div class="input-group-btn">
                                                <label class="custom-file-label btn btn-success" for="images"><i class="glyphicon glyphicon-plus"></i>Tambahkan Bukti Foto Laporan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-1"><span style="width: 14px" class="text-danger" data-feather="alert-triangle"></span> Maximal total ukuran file 5MB</p>
                                </div>

                                <!-- Isi Laporan -->
                                <div class="form-outline mb-4 form-floating col-lg-12">
                                    @error('body')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="body" type="hidden" name="body" placeholder="Isi Laporan" value="{{ old('body') }}">
                                    <trix-editor input="body" placeholder="Isi Laporan" data-trix-allowed-tags="null"></trix-editor>
                                    <p class="mt-1"><span style="width: 14px" class="text-danger" data-feather="alert-triangle"></span>Berisi deskripsi atau penjelasan detail</p>
                                </div>

                                <!-- Submit button -->
                                <div class="mt-4 col-12 d-flex justify-content-center">
                                    <button type="submit" id="submit-btn" class="w-50 mt-4 btn btn-lg btn-outline-success">
                                        <span style="width: 18px; height: 20px" class="" data-feather="save"></span> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>

   

    document.getElementById('laporan-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting immediately
        Swal.fire({
            title: 'Apakah Data Sudah Benar?',
            text: 'Mohon pastikan semua data yang dimasukkan sudah benar dan bisa dipertanggung jawabkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, submit',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Submit the form
            }
        });
    });
</script>
@endsection