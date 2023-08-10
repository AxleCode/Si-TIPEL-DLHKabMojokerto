@extends('dashboard.layouts.main')

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
                                    <input readonly type="text" name="nama" class="mt-2 form-control rounded-top @error('nama') is-invalid @enderror" id="nama" required value="{{ old('nama',$user->name) }}">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Nomor Telpon -->
                                <div class="mb-4 col-lg-8">
                                    <label for="telpon">Nomor Telpon</label>
                                    <input readonly type="text" name="telpon" class="mt-2 form-control rounded-top @error('telpon') is-invalid @enderror" id="telpon" required value="{{ old('telpon',$user->nohp) }}">
                                    @error('telpon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-4 col-lg-8">
                                    <label for="email">Email</label>
                                    <input readonly type="text" name="email" class="mt-2 form-control rounded-top @error('email') is-invalid @enderror" id="email" required value="{{ old('email',$user->email) }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Judul Aduan -->
                                <div class="mb-4 col-lg-8">
                                    <label for="judul">Judul Laporan</label>
                                    <input type="text" name="judul" class="mt-2 form-control rounded-top @error('judul') is-invalid @enderror" id="judul" placeholder="Masukkan Judul Laporan" required value="{{ old('judul') }}">
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
                                    <label for="map" class="form-label">Klik pada area Map Untuk Mendapatkan Alamat Lokasi Laporan</label>
                                    <div id="map" class="col-lg-12" style="height: 500px;"></div>
                                    <div class="mt-2">
                                        <input hidden type="text" id="coordinates" name="coordinates" class="form-control" placeholder="Koordinat" readonly>
                                        <input type="text" id="address" name="address" class="form-control mt-2" placeholder="Alamat">
                                    </div>
                                    <p class="mt-1"><span style="width: 14px" class="text-danger" data-feather="alert-triangle"></span>
                                        Silahkan klik lokasi tempat laporan anda. Pastikan koordinat lokasi berada di wilayah kabupaten mojokerto dan apabila berada diluar wilayah mojokerto maka <strong class="text-danger">laporan tidak akan diproses oleh petugas</strong>. Form alamat dapat diubah silahkan tambahkan patokan atau detail lainnya</p>
                                </div>

                                <!-- Upload Foto -->
                                <div class="col-lg-11 mb-4">
                                    <div class="user-image mb-3 mt-3 text-center">
                                        <div class="imgPreview"></div>
                                    </div>
                                    <div class="custom-file">
                                        <div class="input-group control-group increment">
                                            <input type="file" name="imageFile[]" class="form-control custom-file-input" id="images" multiple required accept="image/*">

                                            <div class="input-group-btn">
                                                <label class="custom-file-label btn btn-success" for="images"><i class="glyphicon glyphicon-plus"></i>Tambahkan Foto Laporan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-1"><span style="width: 14px" class="text-danger " data-feather="alert-triangle">
                                    </span><a href="" class="text-body-secondary" title="Upload banyak foto dalam sekali upload, Tekan Ctrl+Klik foto mana saja yang dipilih"> Multiple upload foto</a> Maximal total ukuran file 5MB</p>

                                    <!-- Preview Foto -->
                                    <div class="mt-3">
                                        <strong>Preview Foto:</strong>
                                        <div id="previewContainer" class="row mt-2"></div>
                                    </div>
                                </div>

                                <!-- Script -->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
                                <script>
                                    // Menampilkan foto yang sudah diupload sebelumnya
                                    var uploadedImages = [];

                                    function showUploadedImages() {
                                        var previewContainer = document.getElementById("previewContainer");
                                        previewContainer.innerHTML = "";

                                        for (var i = 0; i < uploadedImages.length; i++) {
                                            var previewImage = document.createElement("img");
                                            previewImage.className = "col-lg-3";
                                            previewImage.style.marginBottom = "10px";
                                            previewImage.src = uploadedImages[i];

                                            previewContainer.appendChild(previewImage);
                                        }
                                    }

                                    // Menampilkan preview foto saat dipilih
                                    function readURL(input) {
                                    if (input.files && input.files.length > 0) {
                                        var totalSize = 0;

                                        for (var i = 0; i < input.files.length; i++) {
                                            totalSize += input.files[i].size;
                                        }

                                        var maxSize = 5 * 1024 * 1024; // 5MB

                                        if (totalSize > maxSize) {
                                            Swal.fire({
                                                title: 'Peringatan!',
                                                text: 'Total ukuran file melebihi batas 5MB.',
                                                icon: 'warning',
                                                confirmButtonText: 'OK'
                                            });
                                            input.value = ''; // Hapus file yang diunggah
                                            return;
                                        }

                                        // Hapus foto-foto yang sudah ada di preview image sebelumnya
                                        var previewImages = document.querySelectorAll("#previewContainer img");
                                        previewImages.forEach(function(image) {
                                            image.remove();
                                        });

                                        // Ambil daftar foto yang ada di preview image
                                        var previewContainer = document.getElementById("previewContainer");
                                        var fileInput = document.getElementById("images");
                                        var files = fileInput.files;

                                        for (var i = 0; i < files.length; i++) {
                                            var file = files[i];
                                            var reader = new FileReader();

                                            reader.onload = function(e) {
                                                var previewImage = document.createElement("img");
                                                previewImage.className = "col-lg-3";
                                                previewImage.style.marginBottom = "10px";
                                                previewImage.src = e.target.result;

                                                previewContainer.appendChild(previewImage);
                                            }

                                            reader.readAsDataURL(file);
                                        }
                                    }
                                }

                                    // Menjalankan fungsi saat ada perubahan pada input file
                                    document.getElementById("images").addEventListener("change", function() {
                                        readURL(this);
                                    });

                                    // Memanggil fungsi showUploadedImages saat halaman dimuat
                                    window.addEventListener("load", function() {
                                        var existingImages = document.querySelectorAll("#previewContainer img");
                                        existingImages.forEach(function(image) {
                                            uploadedImages.push(image.src);
                                        });
                                        showUploadedImages();
                                    });
                                </script>

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
    // JS untuk map
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

    // End js untuk map

    // JS untuk konfirmasi sebelum submit
    document.getElementById('laporan-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah form untuk langsung disubmit

        Swal.fire({
            title: 'Apakah Data Sudah Benar?',
            text: 'Mohon pastikan semua data yang dimasukkan sudah benar dan bisa dipertanggung jawabkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, submit',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Submit form
            }
        });
    });
</script>
@endsection
