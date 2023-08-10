@extends('dashboard.layouts.main')
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
@section('container')
<main class="content">
				<div class="container-fluid p-0">

					<p class="h3 mb-2 text-danger-emphasis fs-1 fw-bold">Peta Lokasi Semua Laporan Aduan</p>

					<div class="row">

						<div class="col-12">
							<div class="card">
								<div class="me-3 ms-4 mt-3">
               {{-- Peta Koordinat --}}
               <div id="map" class="col-lg-12" style="height: 600px;"></div>
               
       <!-- Maps button -->
       <div class=" col-12 d-flex justify-content-center ">
       </div>

       <script>
        // initialize the map
        var map = L.map('map').setView([-7.48989679257064, 112.56462304272291], 12);

        // add the tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

         // add markers from database
         @foreach($laporan as $lapor)
             @if($lapor->status != 100)
             var marker = L.marker([{{$lapor->coordinates}}]).addTo(map);
                 
                 // get the category data for the current marker
                 var laporData = {!! json_encode($lapor) !!};
                 var categoryData = {!! json_encode($lapor->categoryAduan) !!};

                 var laporKomen = {!! json_encode($komentar->where('laporan_id', $lapor->id)->where('status', 99)->first()) !!};
                 var laporKomenImageSrc = (laporKomen && laporKomen.file) ? '{{ asset('') }}' + laporKomen.file: '';

                 var statusData = {!! json_encode($status) !!}.find(function(status) {
                     return status.kode_status === {{$lapor->status}};
                 });

                 var imageData = {!! json_encode($lapor->laporanImages) !!};
             
                 // create the tooltip HTML content with all data from the category data
                 var tooltipContent = '<div class="custom-tooltip" style="background-color: ;">' +
                         '<h5>' + categoryData.name + '</h5>' +
                         '<h6>Status : <span class="badge bg-'+statusData.warna+'" >' + statusData.name + '</span></h6>' +
                         '<h6>Dilaporkan '+ moment(laporData.created_at).format('DD MMMM YYYY') +'</h6>' +
                         '<div class="row">';
                     @foreach($lapor->laporanImages->take(6) as $image)
                         tooltipContent += '<div class="col-4"><img src="{{ asset( $image->image_path) }}" style="width: 200px; height: 150px; object-fit: cover;"></div>';
                     @endforeach

                     @if($lapor->status == 99)
                       tooltipContent += '<h5 class="mt-2">Bukti Penanganan</h5>';
                       tooltipContent += '<div class="col-6"><img src="/komentar_file/' + laporKomenImageSrc + '" style="width: 200px; height: 150px; object-fit: cover;"></div>';
                     @endif

                     tooltipContent += '</div></div>';
             
                 // add the tooltip to the marker with the HTML content
                 marker.bindTooltip(tooltipContent, {className: 'custom-tooltip-class'});
             @endif
     @endforeach

        // disable click events
        map.doubleClickZoom.disable();
    </script>
              
            
              <style>
                .custom-tooltip {
                    min-width: 650px; /* set a minimum width */
                }

                .custom-tooltip .row {
                    display: flex;
                    flex-wrap: wrap;
                }

                .custom-tooltip .col-6 {
                    width: calc(100% / 2); /* divide into 4 columns */
                }

                </style>
								</div>
								<div class="me-3 ms-4 mt-3 mb-3">
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</main>

			@endsection
	

	