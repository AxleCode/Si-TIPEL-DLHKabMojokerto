<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Si-TIPEL - Dinas Lingkungan Hidup Kabupaten Mojokerto</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ $logo_kedua->image_path }}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/vendor/aos/aos.css" rel="stylesheet">
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/css/style.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!-- =======================================================
  * Template Name: Arsha
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  	{{-- leaflet --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
	<!-- Axios JavaScript -->
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-fullscreen@1.4.5/dist/leaflet.fullscreen.min.css" />
<script src="https://cdn.jsdelivr.net/npm/leaflet-fullscreen@1.4.5/dist/Leaflet.fullscreen.min.js"></script>


</head>

<body>
  
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
   
    <div class="container d-flex align-items-center">


      <div class="me-1 ">
        <img src="{{ $logo_dlh->image_path }}" width="60" alt="">
      </div>
      
      <h3 class="logo me-auto fs-5 mt-3"><a href="index.html"> Dinas Lingkungan Hidup <p>Kabupaten Mojokerto</a></h3>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active fs-6" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto fs-6" href="#about">Tentang Kami</a></li>
          <li><a class="nav-link scrollto fs-6" href="#why-us">Alur Pelayanan</a></li>
          <li><a class="nav-link scrollto fs-6" href="#services">Jenis Pelayanan</a></li>
          <li><a class="nav-link scrollto fs-6" href="#portfolio">Peta</a></li>
         
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <ul class="navbar-nav ms-auto">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome Back, {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu bg-dark">
            <li><a class="dropdown-item text-white"  href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item bg-danger text-white" ><i class="bi bi-box-arrow-right "></i> Logout</button>
              </form>

          </ul>
        </li>

        @else
        <li class="nav-item">
          <a href="/login" class="nav-link text-white "><i class="bi bi-box-arrow-in-right"></i> Login </a>
        </li>
        @endauth
      </ul>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
 
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-3  pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">

          @auth
          <h1>Selamat Datang </h1>
          <h1>{{ auth()->user()->name }} </h1>
          <h1>Di Website si-Tipel</h1>
          <h2 class="" style="font-weight: 1000px;">Sistem Ticketing Pelayanan Online DLH Kabupaten Mojokerto</h2>
          <div class="d-flex justify-content-center justify-content-lg-start mt-5">
            <a href="/dashboard" class="btn-get-started scrollto" ><i class="bi bi-box-arrow-in-up-right"></i> Dashboard Saya</a>
            <a href="/dashboard" class="btn-get-started bg-success scrollto ms-3" ><i class="bi bi-pencil-square"></i> Isi Formulir</a>
            
            </div>
  
          @else
          <h1>Selamat Datang Di Website si-Tipel</h1>
          <h2 class="" style="font-weight: 1000px;">Sistem Ticketing Pelayanan Online DLH Kabupaten Mojokerto</h2>
          <div class="d-flex justify-content-center justify-content-lg-start mt-5">
            <a href="/login" class="btn-get-started scrollto"><i class="bi bi-box-arrow-in-up-right"></i> Isi Formulir</a>
            <a href="#about" class="btn-get-started scrollto ms-3" ></i>Selengkapnya</a>
          </div>
          @endauth
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="{{ $logo_utama->image_path }}" class="img-fluid" width="530" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->
    <div class="w-100 mb-5" style="height: 1px" >
    <div class="alert bg-warning" style="height: 100px" role="alert">
       <strong><i class="bi bi-exclamation-triangle-fill"></i> Perhatian!</strong>
       <p style=" font-size: 12.5pt">Mohon maaf Website masih dalam tahap Pengembangan belum dapat melayani laporan/aduan yang sebenarnya namun silahkan uji coba website kami untuk user experience mohon isi form link berikut 
        <a href="https://www.google.com/?hl=ID" target="blank" class="link-underline-info text-light"><i class="bi bi-box-arrow-in-up-right"></i> Link Form User Experience Si-Tipel</a></p>
  </div>
    </div>
  <main id="main">


    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      
      <div class="container" >
        

        <div class="section-title mt-3">
          <h2>Sistem Pelayanan Ticketing Online <p>Dinas Lingkungan Hidup Kabupaten Mojokerto</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
              Dengan Aplikasi ticketing berbasis website dapat mempercepat waktu antrian masyarakat dan aduan masyarakat Kabupaten Mojokerto akan ditampung dan ditangani 
              oleh petugas DLH Kabupaten Mojokerto
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Laporan gangguan tumbuhan, timbulan sampah hingga limbah air dan udara</li>
              <li><i class="ri-check-double-line"></i> Pemantauan kondisi lingkungan sekitar Area Kabupaten Mojokerto</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              Website Si-TIPEL adalah sebuah website yang dikembangkan untuk memenuhi kebuthan UPT Dinas Lingkungan Hidup kabupaten Mojokerto dalam memberikan pelayanan 
            bagi masyarakat yang ingin membuat laporan atau aduan terkait dengan masalah lingkungan yang ada disekitar tempat tinggal warga area Kabupaten Mojokerto.
      
            </p>
            <a href="https://dlh.mojokertokab.go.id/" class="btn-learn-more"><i class="bi bi-globe"></i> Website DLH Kab Mojokerto</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-6 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3>Alur Pelayanan Si-TIPEL</h3>
              <p>
               Berikut Alur Pelayanan Si-TIPEL 
              </p>
            </div>

            <div class="accordion-list">
              <ul>
                @foreach ($pelayanan as $layanan)
                <li>
                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>{{ $layanan->nomor }}</span>{{ $layanan->slug }}<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                      {!! $layanan->body !!}
                    </p>
                  </div>
                </li>
                @endforeach

              </ul>
            </div>

          </div>

          <div class="col-lg-6 align-items-stretch order-1 order-lg-2 img" style='background-image: url("{{ $logo_alur->image_path }}");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
        </div>

      </div>
    </section><!-- End Why Us Section -->


    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Pelayanan</h2>
          <p>
            Berikut jenis pelayanan kami
          </p>
        </div>

        
        <div class="row">
          @foreach ($category as $cate)
            <div class="col-xl-3 col-md-6 mb-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box">
                <img src="{{ asset($cate->image) }}" class="image-thumbnail" alt="">
                <h4 class="mt-2">{{ $cate->name }}</h4>
                <p>{{ $cate->deskripsi }}</p>
              </div>
            </div>
            @endforeach
          </div>

          <style>
            .image-thumbnail {
                max-width: 250px;
                max-height: 200px;
            }
          </style>
         

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Peta Lokasi Semua Laporan Aduan</h2>
          <p>Berikut kami tampilkan koordinat laporan aduan beserta detail kategori, status serta foto bukti dari masyarakat yang telah ditampung oleh sistem kami</p>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-12 col-md-6 portfolio-item filter-app">
            
            <div class="col-12">
								<div class="">
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
    </section><!-- End Portfolio Section -->   

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Si-Tipel </h3>
            <h5>Dinas Lingkungan Hidup Kabupaten Mojokerto</h5>
            <p>
              Jl. Pemuda No 55B<br>
              Kecamatan Mojosari<br>
              Kabupaten Mojokerto <br><br>
              <strong>Telpon:</strong> (0321) 593178<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">Tentang Kami</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#why-us">Alur Pelayanan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Jenis Pelayanan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#portfolio">Peta</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Pelayanan Kami</h4>
            <ul>
              @foreach ($category->take(5) as $cate)
              <li><i class="bx bx-chevron-right"></i> <a href="#services">{{ $cate->name }}</a></li>
              @endforeach
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Social Media</h4>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Si-TIPEL 2023</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">AXLEJ</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/vendor/aos/aos.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/js/main.js"></script>

</body>

</html>