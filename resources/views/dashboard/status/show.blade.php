@extends('dashboard.layouts.main')
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
@section('container')
<main class="content">
				<div class="container-fluid p-0">
						
					<div class="col-12">
						<div class="card">
                        
            
                            <div class="p-3 py-5">
                                @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                            {{ session('success') }}
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
                                    

									<div class="d-flex justify-content-between align-items-center mb-3">
										<h4 class="text-right">Laporan Aduan dengan status <span class="badge bg-{{ $status->warna }}">{{ $status->name }}</span></h4>
									</div>

                                <div class="">
                                  <a class="w-30 ms-2 mb-2 btn btn-lg btn-outline-primary" href="/dashboard/status" >
                                      <span data-feather="arrow-left-circle"></span> Kembali
								  </a>
                              </div>
                              
                              <table class="table table-hover my-0">
                                <thead>
                                  <tr>

                                    <th class="d-none d-sm-table-cell">Nomor Tiket Laporan</th>
                                    <th class="d-none d-xl-table-cell">Nama Laporan</th>
                                    <th >Kategori</th>
                                    <th>Dibuat Pada</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($laporans as $lapo)
                                  <tr>
                                    <td>{{ $lapo->nomor_tiket }}</td>
                                    <td>{!! Str::limit($lapo->judul, 60) !!}</td>
                                    <td>{{ $lapo->name }}</td>
                                    <td>{{ $lapo->created_at->format('d F Y ') }}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              
                                
                    </div>
                   
                </div>
					</div>
				</div>
				
			</main>

			@endsection
	

	