<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content">
    <a class="sidebar-brand" href="/dashboard">
      
  <img class="mb-2" src="/{{ $logo_kedua }}" width="170px" alt="">
  <span class="align-middle fs-5 fw-semibold text-white-80"><br>Dinas Lingkungan Hidup</span>
  <span class=" align-middle fs-5 fw-semibold text-white-80"><br >Kabupaten Mojokerto</span>
    </a>
    <div style=" overflow-y: 100px;">
      <ul class="sidebar-nav">
        <li class="sidebar-header">
          User Pages
        </li>

        <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard">
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
          </a>
        </li>

        <li class="sidebar-item {{ Request::is('dashboard/laporan/create') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/laporan/create">
            <i class="align-middle" data-feather="edit"></i> <span class="align-middle">Isi Formulir </span>
          </a>
        </li>

        <li class="sidebar-item {{ Request::is('dashboard/laporan') || Request::is('dashboard/laporan/') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/laporan">
            <i class="align-middle" data-feather="book"></i> <span class="align-middle">List Laporan Saya</span>
          </a>
        </li>
        
        <li class="sidebar-item {{ Request::is('dashboard/notifikasi') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/notifikasi">
            <i class="align-middle" data-feather="clock"></i> <span class="align-middle">Histori Notifikasi</span>
          </a>
        </li>

        <li class="sidebar-item {{ Request::is('dashboard/map') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/map">
            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
          </a>
        </li>
{{-- 
        <li class="sidebar-item {{ Request::is('dashboard/downloadable') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/downloadable">
            <i class="align-middle" data-feather="download"></i> <span class="align-middle">Downloadable</span>
          </a>
        </li> --}}

        <li class="sidebar-item {{ Request::is('/') ? 'active' : '' }}">
          <a class="sidebar-link" href="/" target="_blank">
            <i class="align-middle" data-feather="globe"></i> <span class="align-middle">Website si-TIPEL</span>
          </a>
        </li>


        
        {{-- <li class="sidebar-item has-submenu">
          <a class="sidebar-link nav-link" href="#"><i class="align-middle" data-feather="edit-3"></i> <span class="align-middle">Laporan</span>  </a>
          <ul class="submenu collapse bg-white">
            <li ><a class="nav-link ms-2 mb-2 mt-3" href="#"><i class="align-middle" data-feather="edit"></i> <span class="align-middle">Buat Laporan</span>  </a></li>
            <li ><a class="nav-link ms-2 mb-2 mt-3" href="#"><i class="align-middle" data-feather="book"></i> <span class="align-middle">List Laporan Saya</span>  </a></li>
            
          </ul>
        </li> --}}

        

        @can('admin')
        <li class="sidebar-header">
          Administator

          <li class="sidebar-item {{ Request::is('dashboard/laporanadmin*') ? 'active' : '' }}">
            <a class="sidebar-link" href="/dashboard/laporanadmin">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Laporan</span>
            </a>
          </li>

        </li>
        <li class="sidebar-item {{ Request::is('dashboard/pengumuman*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/pengumuman">
            <i class="align-middle" data-feather="square"></i> <span class="align-middle">Pengumuman</span>
          </a>
        </li>

        <li class="sidebar-item {{ Request::is('dashboard/kategori*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/kategori">
            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Kategori</span>
          </a>
        </li>

        <li class="sidebar-item {{ Request::is('dashboard/status*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/status">
            <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Status</span>
          </a>
        </li>

        {{-- <li class="sidebar-item {{ Request::is('dashboard/admindownloadable') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/admindownloadable">
            <i class="align-middle" data-feather="download-cloud"></i> <span class="align-middle">Setting Downloadable</span>
          </a>
        </li> --}}

        <li class="sidebar-item {{ Request::is('dashboard/user*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/user">
            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Setting User</span>
          </a>
        </li>

        <li class="sidebar-item {{ Request::is('dashboard/website*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/website">
            <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Setting Website</span>
          </a>
        </li>

        @endcan

        <li class="sidebar-item {{ Request::is('dashboard/profile') ? 'active' : '' }}">
          <a class="sidebar-link" href="/dashboard/profile">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
          </a>
        </li>
    

        <li class="sidebar-item">
          <a class="sidebar-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i  class="align-middle" data-feather="log-out"></i> <span class="align-middle">Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="main">
  <nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
      <i class="hamburger align-self-center"></i>
    </a>   

    <div class="navbar-collapse collapse">
      <div class="fs-3 ms-3 container d-flex align-items-center justify-content-start mt-3" style="height: 20px;">
        <p>Selamat datang kembali <strong>{{ auth()->user()->name }}</strong></p>
      </div>
      
      <ul class="navbar-nav ">

          <li class="nav-item dropdown">
            <a class="nav-icon dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="position-relative">
                    <i class="feather align-middle mt-2" style="width: 23px; height: 30px" data-feather="bell"></i>
                    <span class="indicator">{{ $jumlahnotif }}</span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="notifDropdown">
                <div class="dropdown-menu-header">
                    {{ $jumlahnotif }} Notifikasi Baru
                </div>
                <div class="list-group" id="notification-list">
                    @php $count = 0; @endphp
                    @foreach($notifikasi as $notif)
                        @if($count < 4)
                            @if ($notif->status)

                                    <a onclick="event.preventDefault(); document.getElementById('notif-form-{{ $notif->id }}').submit();" class="list-group-item bg-primary" style="">
                                      <form id="notif-form-{{ $notif->id }}" action="{{ route('notif-update', $notif->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf  
                                      <div class="row align-items-center">
                                            <div class="col-2">
                                                <i class="text-white ms-2" data-feather="{{ $notif->logo }}"></i>
                                            </div>
                                            <div class="col-10">
                                                @if ($notif->status)
                                                    <div class="text-white">{{ $notif->judul }}</div>
                                                    <div class="text-white small mt-1">{{ Str::limit($notif->pesan, 80) }}</div>
                                                    <div class="text-white small mt-1">{{ $notif->created_at->locale('id_ID')->diffForHumans() }}</div>
                                                @else
                                                    <div class="text-dark">{{ $notif->judul }}</div>
                                                    <div class="text-muted small mt-1">{{ Str::limit($notif->pesan, 80) }}</div>
                                                    <div class="text-muted small mt-1">{{ $notif->created_at->locale('id_ID')->diffForHumans() }}</div>
                                                @endif
                                            </div>
                                        </div>
                                      </form>
                                    </a>
   
                            @else
                                <a href="{{ $notif->link }}" class="list-group-item ">
                                    <div class="row align-items-center ">
                                        <div class="col-2">
                                            <i class="{{ $notif->textlogo }} ms-2" data-feather="{{ $notif->logo }}"></i>
                                        </div>
                                        <div class="col-10">
                                            @if ($notif->status)
                                                <div class="text-white ">{{ $notif->judul }}</div>
                                                <div class="text-white small mt-1">{{ Str::limit($notif->pesan, 80) }}</div>
                                                <div class="text-white small mt-1">{{ $notif->created_at->locale('id_ID')->diffForHumans() }}</div>
                                            @else
                                                <div class="text-dark">{{ $notif->judul }}</div>
                                                <div class="text-muted small mt-1">{{ Str::limit($notif->pesan, 80) }}</div>
                                                <div class="text-muted small mt-1">{{ $notif->created_at->locale('id_ID')->diffForHumans() }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endif
                            @php $count++; @endphp
                        @endif
                    @endforeach
                </div>
                <div class="dropdown-menu-footer">
                    <a href="/dashboard/notifikasi" class="text-muted">Tampilkan Semua Notifikasi</a>
                </div>
            </ul>
        </li>
        
        <!-- Include the JavaScript file -->
        <script src="{{ asset('js/notification.js') }}"></script>
   
        
        <li class="nav-item dropdown me-4">
          <a class="nav-icon dropdown-toggle d-inline-block d-sm-none " href="#" data-bs-toggle="dropdown">
            <i class="align-middle" data-feather="settings"></i>
          </a>

          <a class="nav-link dropdown-toggle d-none d-sm-inline-block " href="#" data-bs-toggle="dropdown">
            <img src="/img/user.png" class="avatar img-fluid rounded me-2 ms-3" alt="" /> <span class="text-dark fs-4">Profile</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="/dashboard/profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
            <a class="dropdown-item" href="/"><i class="align-middle me-1" data-feather="globe"></i> Website Si-TIPEL</a>
            
            <div class="dropdown-divider"></div>
            <form action="/logout" method="POST">
              @csrf
            <button type="submit" class="dropdown-item bg-danger text-white" href="#"><i class="align-middle me-1" data-feather="log-out"></i> Log out</button>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <script>
    document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
      
      element.addEventListener('click', function (e) {

        let nextEl = element.nextElementSibling;
        let parentEl  = element.parentElement;	

          if(nextEl) {
              e.preventDefault();	
              let mycollapse = new bootstrap.Collapse(nextEl);
              
              if(nextEl.classList.contains('show')){
                mycollapse.hide();
              } else {
                  mycollapse.show();
                  // find other submenus with class=show
                  var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                  // if it exists, then close all of them
                  if(opened_submenu){
                    new bootstrap.Collapse(opened_submenu);
                  }
              }
          }
      }); // addEventListener
    }) // forEach
  }); 
  </script>

  