<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar ">
    <a class="sidebar-brand" href="index.html">
  <img class="mb-2" src="/img/si-TIPEL.png" width="170px" alt="">
  <span class="align-middle fs-5 fw-semibold text-white-80"><br>Dinas Lingkungan Hidup</span>
  <span class=" align-middle fs-5 fw-semibold text-white-80"><br >Kabupaten Mojokerto</span>
    </a>

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
          <i class="align-middle" data-feather="edit"></i> <span class="align-middle">Buat Laporan Aduan</span>
        </a>
      </li>

      <li class="sidebar-item {{ Request::is('dashboard/laporan') || Request::is('dashboard/laporan/') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard/laporan">
          <i class="align-middle" data-feather="book"></i> <span class="align-middle">List Laporan Aduan Saya</span>
        </a>
      </li>
      
      <li class="sidebar-item {{ Request::is('dashboard/history') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard/history">
          <i class="align-middle" data-feather="clock"></i> <span class="align-middle">history Notifikasi</span>
        </a>
      </li>

      <li class="sidebar-item {{ Request::is('dashboard/map') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard/map">
          <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
        </a>
      </li>

      <li class="sidebar-item {{ Request::is('dashboard/downloadable') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard/downloadable">
          <i class="align-middle" data-feather="download"></i> <span class="align-middle">Downloadable</span>
        </a>
      </li>

      <li class="sidebar-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="sidebar-link" href="/" target="blank">
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
            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Laporan Aduan</span>
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

      <li class="sidebar-item {{ Request::is('dashboard/admindownloadable') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard/admindownloadable">
          <i class="align-middle" data-feather="download-cloud"></i> <span class="align-middle">Setting Downloadable</span>
        </a>
      </li>
      @endcan

      <li class="sidebar-header">
        Setting Pages
      </li>
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
            <div class="position-relative ">
              <i class="feather align-middle mt-1" style="width: 23px; height: 30px"  data-feather="bell"></i>
              <span class="indicator">4</span>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="notifDropdown">
            <div class="dropdown-menu-header">
              4 New Notifications
            </div>
            <div class="list-group">
              <a href="#" class="list-group-item">
                <div class="row g-0 align-items-center">
                  <div class="col-2">
                    <i class="text-danger" data-feather="alert-circle"></i>
                  </div>
                  <div class="col-10">
                    <div class="text-dark">Update completed</div>
                    <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                    <div class="text-muted small mt-1">30m ago</div>
                  </div>
                </div>
              </a>
              <a href="#" class="list-group-item">
                <div class="row g-0 align-items-center">
                  <div class="col-2">
                    <i class="text-warning" data-feather="bell"></i>
                  </div>
                  <div class="col-10">
                    <div class="text-dark">Lorem ipsum</div>
                    <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                    <div class="text-muted small mt-1">2h ago</div>
                  </div>
                </div>
              </a>
              <a href="#" class="list-group-item">
                <div class="row g-0 align-items-center">
                  <div class="col-2">
                    <i class="text-primary" data-feather="home"></i>
                  </div>
                  <div class="col-10">
                    <div class="text-dark">Login from 192.186.1.8</div>
                    <div class="text-muted small mt-1">5h ago</div>
                  </div>
                </div>
              </a>
              <a href="#" class="list-group-item">
                <div class="row g-0 align-items-center">
                  <div class="col-2">
                    <i class="text-success" data-feather="user-plus"></i>
                  </div>
                  <div class="col-10">
                    <div class="text-dark">New connection</div>
                    <div class="text-muted small mt-1">Christina accepted your request.</div>
                    <div class="text-muted small mt-1">14h ago</div>
                  </div>
                </div>
              </a>
            </div>
            <div class="dropdown-menu-footer">
              <a href="#" class="text-muted">Show all notifications</a>
            </div>
          </ul>
        </li>
        
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