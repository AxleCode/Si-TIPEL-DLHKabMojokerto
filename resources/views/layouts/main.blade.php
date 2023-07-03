<!doctype html>
<html lang="en">
  <head>
    @php
    $logo = \App\Models\Logo::find(2);
    $logo_kedua = $logo->image_path;
    $logo3 = \App\Models\Logo::find(3);
    $logo_dlh = $logo3->image_path;    
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }} Sistem Ticketing Pelayanan DLH Kab Mojokerto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
     <!-- Bootstrap icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

     {{-- trix editor --}}
     <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

     <link rel="stylesheet" href="style-login.css">
     <link href="{{ $logo_kedua }}" rel="icon">
  </head>
  <body>


    <div class="container">
      @yield('container')
    </div>

    @include('partial.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
  </body>
  
</html>