@extends('dashboard.layouts.main')
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
</head>
@section('container')
<main class="content">
				<div class="container-fluid p-0">
                    <p class="h3 mb-3 text-danger-emphasis fs-1 fw-bold">Formulir Aduan</p>
					<div class="row">

						<div class="col-10">
							<div class="card">
								
								<div class="card-body">
                                    <p class="fs-3"><strong>Buat Aduan</strong></p>
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

                                         <!-- Judul Aduan -->
                                         <div class=" mb-4 col-lg-8">
                                            <label for="judul">Judul Aduan</label>
                                            <input type="text" name="judul" class="mt-2 form-control rounded-top rounded-top @error('judul') is-invalid @enderror" id="judul" placeholder="Judul Aduan" required value="{{ old('judul') }}">
                                            
                                            @error('judul')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                        
                                        <!-- Kategori -->
                                    <div class=" mb-4  col-lg-8">
                                        <label for="category" class="form-label">Kategori Aduan</label>
                                        <select class="form-select" name="category">
                                            @foreach ($category as $cate)
                                                <option value="{{ $cate->id }}" >{{ $cate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    

                                     <!-- Peta -->
                                     <label for="map" class="form-label">Koordinat Titik Lokasi Aduan</label>
                                <div id="map" class=" col-lg-12" style="height: 400px;">
                                
                                </div>
                                
                                 <div class="mb-2 col-lg-12">
                                    
                                    <input type="text" id="coordinates" name="coordinates" class="mt-2 form-control rounded-top rounded-top" placeholder="Click on the map to get coordinates" readonly>
                                  
                                    <input type="text" id="address" name="address" class="mt-2 form-control rounded-top rounded-top" placeholder="Click on the map to get address" >
                                    <p class="mt-1 "> <span style="width: 14px" class="text-danger" data-feather="alert-triangle" ></span> Silahkan klik lokasi tempat aduan anda Pastikan koordinat lokasi berada di wilayah kabupaten mojokerto dan apabila berada diluar 
                                        wilayah mojokerto maka <strong class="text-danger" >aduan tidak akan diproses oleh petugas</strong> koordinat dan alamat otomatis muncul pastikan internet anda stabil</p>
                                   
                                </div>

                               <!-- Upload Foto -->
                                <div class="col-lg-11 mb-4 ">
                                    <div class="user-image mb-3 mt-3 text-center ">
                                        <div class="imgPreview"> </div>
                                    </div>            
                                    <div class="custom-file">
                                        <div class="input-group control-group increment" >
                                        <input type="file" name="imageFile[]" class="form-control custom-file-input" id="images" multiple="multiple" required>
                                        <div class="input-group-btn"> 
                                            <label class="custom-file-label btn btn-success" for="images"><i class="glyphicon glyphicon-plus"></i>Tambahkan Bukti Foto Aduan</label>
                                        </div>
                                    </div>
                                    </div>
                                    <p class="mt-1 "><span style="width: 14px" class="text-danger" data-feather="alert-triangle" ></span> Maximal total ukuran file 5MB </p>
                                 
                                </div>
                                <script>
                                $(function() {
                                    var multiImgPreview = function(input, imgPreviewPlaceholder) {
                                    if (input.files) {
                                        var filesAmount = input.files.length;
                                        var maxSize = 1024 * 1024 * 5; // Maximum file size in bytes (e.g. 5 MB)
                                        var totalSize = 0; // Total size of selected files

                                        for (i = 0; i < filesAmount; i++) {
                                            totalSize += input.files[i].size;
                                        }

                                        var previewTotalSize = 0;
                                        $(imgPreviewPlaceholder).find('img').each(function(){
                                            previewTotalSize += $(this).attr('src').length;
                                        });

                                        if (previewTotalSize + totalSize > maxSize) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Total ukuran foto yang diupload sudah 5 MB tidak bisa upload foto lagi!',
                                                text: 'Silahkan compress ukuran file foto anda'
                                            });
                                            input.value = ''; // Reset the file input to clear the selected files
                                            return;
                                        }

                                        for (i = 0; i < filesAmount; i++) {
                                            var reader = new FileReader();
                                            reader.onload = function(event) {
                                                var imgWrapper = $('<div class="img-wrapper mt-4"></div>');
                                                var img = $('<img>').attr('src', event.target.result).appendTo(imgWrapper);
                                                var closeIcon = $('  <i class="fa fa-times-circle close-icon fa-xl"></i>').appendTo(imgWrapper);
                                                imgWrapper.appendTo(imgPreviewPlaceholder);

                                                closeIcon.on('click', function() {
                                                    imgWrapper.remove();
                                                });
                                            }
                                            reader.readAsDataURL(input.files[i]);
                                        }
                                    }
                                };



                                $('#images').on('change', function() {
                                    multiImgPreview(this, 'div.imgPreview');
                                });
                                });


                                    </script>
                                <style>
                                    .img-wrapper {
                                        position: relative;
                                        display: inline-block;
                                        margin-right: 0px;
                                    }

                                    .close-icon {
                                        position: absolute;
                                        top: -10px;
                                        right: -10px;
                                        color: #f44336;
                                        font-size: 20px;
                                        background-color: #fcfcfc;
                                        padding: 5px;
                                        border-radius: 50%;
                                        cursor: pointer;
                                    }
                                    .imgPreview {
                                        display: flex;
                                        flex-wrap: wrap;
                                        margin-top: 10px;
                                    }

                                    .img-wrapper {
                                        position: relative;
                                        display: inline-block;
                                        margin-right: 10px;
                                        margin-bottom: 10px;
                                        width: 180px;
                                        height: 200px;
                                    }

                                    .img-wrapper img {
                                        width: 100%;
                                        height: 100%;
                                        object-fit: cover;
                                    }
                                </style>


                                 <!-- Isi Aduan -->
                                 <div class="form-outline mb-4 form-floating col-lg-12">
                                    
                                    @error('body')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="body" type="hidden" name="body" placeholder="Isi Aduan" value="{{ old('body') }}">
                                    
                                    <trix-editor input="body"  placeholder="Isi Aduan"
                                        data-trix-allowed-tags="null"
                                    ></trix-editor>
                                    <p class="mt-1 "><span style="width: 14px" class="text-danger" data-feather="alert-triangle" ></span> Isi aduan berisi tentang penjelasan detail tentang masalah apa yang diadukan </p>
                                </div>

                                <!-- Submit button -->
                                <div class="mt-4 col-12 d-flex justify-content-center ">
                                    <button type="submit" id="submit-btn" class=" w-50 mt-4 btn btn-lg btn-outline-success">
                                        <span style="width: 18px; height: 20px" class="" data-feather="save" ></span> Submit</button>
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
                document.addEventListener('trix-file-accept', function(e){
                e.preventDefault(); 
            })


            </script>

    <script>
        var mymap = L.map('map').setView([-7.520188637328168, 112.55842759283786], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(mymap);

        var marker = L.marker([-7.520188637328168, 112.55842759283786]).addTo(mymap);
        var addressInput = document.getElementById('address');
        var coordinateInput = document.getElementById('coordinates');

        if (addressInput.value.trim() !== '') {
            // Use a geocoder to get the latitude and longitude of the address
            axios.get('https://nominatim.openstreetmap.org/search', {
                params: {
                    q: addressInput.value,
                    format: 'json',
                },
            }).then(function(response) {
                var latlng = L.latLng(response.data[0].lat, response.data[0].lon);
                marker = L.marker(latlng).addTo(mymap);
                mymap.setView(latlng, 13);
                coordinateInput.value = latlng.lat + ', ' + latlng.lng;
            }).catch(function(error) {
                console.log(error);
            });
        }

        mymap.on('click', function(e) {
            if (marker) {
                mymap.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(mymap);
            var address = '';
            // Use a reverse geocoder to get the address of the clicked location
            axios.get('https://nominatim.openstreetmap.org/reverse', {
                params: {
                    lat: e.latlng.lat,
                    lon: e.latlng.lng,
                    format: 'json',
                },
            }).then(function(response) {
                address = response.data.display_name;
                addressInput.value = address;
                coordinateInput.value = e.latlng.lat + ', ' + e.latlng.lng;
            }).catch(function(error) {
                console.log(error);
            });
        });
    </script>

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
	

	