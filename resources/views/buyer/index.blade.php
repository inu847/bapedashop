@extends('layouts.global')

@section('title')
    Bapeda Shop
@endsection

@section('content')
	@foreach ($user as $data)
		<div class="col-lg-12">
			<a data-toggle="modal" data-target="#exampleModalContent">
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

	<div class="modal fade" id="exampleModalContent" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalContentLabel">Verivikasi Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('verivikasi.password', [$data->id])}}">
						@csrf
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Password Toko</label>
							<input name="enkripsi" type="text" class="form-control" id="recipient-name">
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
				</div>
			</div>
		</div>
	</div>
@endsection