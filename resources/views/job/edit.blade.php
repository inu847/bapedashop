@extends('layouts.global')

@section('title')
    Lowongan Pekerjaan
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('manage-job.update', [$job->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="PUT" name="_method">
                <div class="form-group">
                    <label for="job_title">Nama Pekerjaan</label>
                    <input type="text" class="form-control" name="job_title" placeholder="Nama Pekerjaan..." id="job_title" value="{{ $job->job_title }}">
                </div>
                <div class="form-group row">
                    <div class="form-group col-md-8">
                        <label for="perusahaan">Perusahaan</label>
                        <input type="text" class="form-control" name="perusahaan" placeholder="Nama Perusahaan..." id="perusahaan" value="{{ $job->perusahaan }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="type_work">Tipe Pekerjaan</label>
                        <select name="type_work" id="type_work" class="form-control">
                            <option value="{{$job->type_work}}">{{$job->type_work}}</option>
                            <option value="fulltime">Fulltime</option>
                            <option value="partime">Partime</option>
                            <option value="contract">Contract</option>
                            <option value="temporary">Temporary</option>
                            <option value="volunter">Volunter</option>
                            <option value="internship">Internship</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5">{{ $job->deskripsi }}</textarea>
                </div>
                <div class="form-group">
                    <label for="skill">Skill</label>
                    <input type="text" class="form-control" name="skill" placeholder="Skill Yang Dibutuhkan..." id="skill" value="{{ $job->skill }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $job->email }}">
                </div>
                <div id="accordion" class="form-group">
                    <div class="border">
                        <input type="hidden" name="location" value="{{ $alamat->id }}">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="false" aria-controls="collapseOne">
                            -> Alamat Toko
                        </button>

                        <div id="collapseOne" class="collapse " data-parent="#accordion">
                            <div class="p-4">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="">Provinsi</label>
                                        <input type="text" class="form-control" id="" value="{{ $alamat->provinsi }}" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">Kota/Kabupaten</label>
                                        <input type="text" class="form-control" id="" value="{{ $alamat->kabupaten }}" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">Desa</label>
                                        <input type="text" class="form-control" id="" value="{{ $alamat->desa }}" disabled>
                                    </div>
                                </div>
                                    
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="">Kode Pos</label>
                                        <input type="text" class="form-control" value="{{ $alamat->kode_pos }}" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Kecamatan</label>
                                        <input type="text" class="form-control" value="{{ $alamat->kecamatan }}" disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">RT</label>
                                        <input type="text" class="form-control" id="" value="{{ $alamat->rt }}" disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">RW</label>
                                        <input type="text" class="form-control" id="" value="{{ $alamat->rt }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" class="form-control" id="" value="{{ $alamat->alamat }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Status</label>
                    <div class="row">
                        <div class="col-md-2">                                    
                            <div class="checkbox checkbox-info checkbox-circle">
                                <input {{$job->status == "inactive" ? "checked" : ""}} value="inactive" id="inactive" type="radio" name="status">
                                <label for="inactive">Inactive</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox checkbox-success checkbox-circle">
                                <input {{$job->status == "active" ? "checked" : ""}} value="active" id="active" type="radio" name="status">
                                <label for="active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="checked">
                    <label for="checked">Check Out Me!!</label>
                </div>
                
                <button class="btn btn-primary" type="submit">Publish</button>
            </form>
        </div>
    </div>
@endsection