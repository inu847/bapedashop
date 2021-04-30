@extends('layouts.global')

@section('title')
    Lowongan Pekerjaan
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-warning rounded" role="alert">
            {{session('success')}}
        </div>
    @endif
    @if(session('fail'))
        <div class="alert alert-danger rounded" role="alert">
            {{session('fail')}}
        </div>
    @endif   

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Jobs</h5>
                </div>
                <div class="col-md-6">
                    <div class="col-7 ml-auto">
                        <a href="{{ route('manage-job.create')}}" class="btn btn-primary"><i class="simple-icon-plus"> Tambahkan Lowongan Pekerjaan</i></a>
                    </div>
                </div>
            </div>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Job Title</th>
                        <th>Perusahaan</th>
                        <th>Tipe</th>
                        <th>Deksripsi</th>
                        <th>Skill</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $val =>$job)
                        <tr>
                            <td>{{$val+1}}</td>
                            <td>{{$job->job_title}}</td>
                            <td>{{$job->perusahaan}}</td>
                            <td>{{$job->type_work}}</td>
                            <td>{{$job->deskripsi}}</td>
                            <td>{{$job->skill}}</td>
                            <td>
                                @if ($job->status == 'active')
                                    <span class="badge badge-pill badge-success">{{ Str::upper($job->status) }}</span>
                                @elseif ($job->status == 'inactive')
                                    <span class="badge badge-pill badge-danger">{{ Str::upper($job->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('job.status', [$job->id]) }}" method="POST" enctype="multipart/form-data">
                                    @if ($job->status == 'active')
                                        @csrf
                                        <input type="hidden" value="inactive" name="status">
                                        <button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Update Status Inactive"><i class="iconsminds-download-1"></i></button>
                                    @elseif ($job->status == 'inactive')
                                        @csrf
                                        <input type="hidden" value="active" name="status">
                                        <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Update Status Active"><i class="iconsminds-upload-1"></i></button>
                                    @endif
                                </form>
                                <form
                                    onsubmit="return confirm('Delete this Job??')"
                                    action="{{route('manage-job.destroy', [$job->id])}}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">

                                    <a href="{{route('manage-job.show', [$job->id])}}" class="btn btn-primary btn-sm"><i class="simple-icon-list mb-2"></i></a>
                                    <a href="{{route('manage-job.edit', [$job->id])}}" class="btn btn-info btn-sm"><i class="simple-icon-pencil"></i></a>
                                    <button type="submit" value="Delete" class="btn btn-danger btn-sm"><i class="simple-icon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection