@extends('dashboard.layouts.main')
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
@section('container')
<main class="content">
				<div class="container-fluid p-0">

					<p class="h3 mb-3 text-danger-emphasis fs-1 fw-bold">Pengumuman</p>
					@foreach ($pengumumans as $umum)
						
					<div class="row">

						<div class="col-12">
							<div class="card">
								<div class="me-3 ms-4 mt-3">
									<p class="fs-3"><strong>{{ $umum->judul }}</strong></p>
									<p class="card-title fs-6 m-0">Update pada {{ $umum->updated_at->format('d F Y ') }}</p>
								</div>
								<div class="me-3 ms-4 mt-3 mb-3">
									{!! $umum->body !!}
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<ul class="pagination mt-4 pagination d-flex justify-content-center align-items-center"> 
				{{ $pengumumans->links() }}
				</ul>
				
			</main>

			@endsection
	

	