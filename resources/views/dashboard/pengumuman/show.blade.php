@extends('dashboard.layouts.main')

@section('container')
<main class="content">
				<div class="container-fluid p-0">

					<p class="h3 mb-3 text-danger-emphasis fs-1 fw-bold">Pengumuman</p>
				
					<div class="row">

						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<p class="fs-3"><strong>{{ $pengumuman->judul }}</strong></p>
									<p class="card-title fs-6 mb-0">Update pada {{ $pengumuman->updated_at->format('d F Y ') }}</p>
								</div>
								<div class="card-body">
									{!! $pengumuman->body !!}
								</div>
								<div class="">
									<a href="{{ route('pengumuman.index') }}" class="ms-3 mt-3 mb-3 btn btn-lg btn-outline-info">
										<span data-feather="arrow-left-circle" ></span> Kembali
										</a>
								</div>
								
							</div>
						</div>
					</div>
                    
				</div>
			</main>

			@endsection
	

	