@extends('layouts.global')

@section('title')
    Bapeda Shop
@endsection

@section('content')
	@foreach ($user as $data)

		<div class="col-lg-12">
			<a href="{{ route('user.show', [$data->id])}}">
				<div class="card mb-4 progress-banner" style="height: 120px;">
					<div class="card-body justify-content-between d-flex flex-row align-items-center">
						<div class="row">
							<div class="col-4">
								<i class="iconsminds-shop-4 mr-2 text-white align-text-bottom d-inline-block"></i>
							</div>
							<div class="col-8">
								<p class="lead text-white">{{ $data->nama_toko }}</p>
								<p class="text-small text-white">{{ $data->name }}</p>
							</div>
						</div>
						<div>
							{{-- <div role="progressbar"
								class="progress-bar-circle progress-bar-banner position-relative" data-color="white"
								data-trail-color="rgba(255,255,255,0.2)" aria-valuenow="4" aria-valuemax="6"
								data-show-percent="false">
							</div> --}}
						</div>
					</div>
				</div>
			</a>
		</div>
					
					
	@endforeach
@endsection