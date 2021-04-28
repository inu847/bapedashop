@extends('layouts.buyer')

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
								<input type="hidden" value="{{$banyak_rating = $data->suggestion->count('rating')}}">
								<input type="hidden" value="{{$jumlah_rating = $data->suggestion->sum('rating')}}">
								<input type="hidden" value="{{$total_rating = $jumlah_rating / $banyak_rating}}">
								<input type="hidden" value="{{$pembulatan_rating = round($total_rating)}}">
								<p class="lead text-white">{{ $data->nama_toko }}</p>
								<p class="text-small text-white">{{ $data->name }}</p>
							</div>
						</div>
						<div>
							<div class="col-12 col-xs-6">
								<div class="form-group mb-1">
									<select class="rating" data-current-rating="{{$pembulatan_rating}}" data-readonly="true">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>		
		
		<div class="modal fade" id="exampleModalContent" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 50px;">
						<h5 class="mt-3">Masukkan Data Pemesan</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{ route('verivikasi.password', [$data->id])}}" method="POST">
								@csrf
								<div class="form-group">
									<label for="" class="col-form-label">Nama</label>
									<input name="buyer" type="text" class="form-control">
								</div>
								
								<div class="form-group">
									<label for="" class="col-form-label">Nomor Meja</label>
									<input name="meja" type="text" class="form-control">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
				</div>
			</div>
		</div>	
	@endforeach

	
@endsection