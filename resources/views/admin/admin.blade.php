@extends('layouts.admin')

@section('title')
    User Buyer
@endsection

@section('content')
    @if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <div class="panel">
        <div class="panel-heading ">
            <div class="row">
                <div class="col-md-9">
                    <span class="panel-title ptn">Akun Admin</span>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-primary" href="{{ route("admin.registrasi") }}">Tambahkan Admin</a>
                </div>
            </div>
            
        </div>
        <div class="panel-body pn mt15">
            <div class="table-responsive">
                <table class="table allcp-form theme-warning tc-checkbox-1 table-style-2 btn-gradient-grey fs13">
                    <thead>
                    <tr class="">
                        <th class="">Username</th>
                        <th class="">Email</th>
                        <th class="">Phone</th>
                        <th class="">Status</th>
                        <th class="">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td class=""><span>{{$admin->name}}</span></td>
                        <td class=""><span>{{$admin->email}}</td>
                        <td class=""><span>{{$admin->phone}}</td>
                        <td><span class="btn btn-warning br2 btn-xs fs10 fw700">{{$admin->status}}</span></td>
                        <td class="">
                            <div class="btn-group text-right">
                                <button type="button"
                                        class="btn btn-info br2 btn-xs fs10 fw700 dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false"> Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">Detail User</a>
                                    </li>
                                    <li>
                                        <a href="#">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        {{-- <td>
                            <form action="{{ route('active.admin', [$admin->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="PUT" name="_method">
                                <button type="submit">Aktifkan Akun</button>
                            </form>
                        </td> --}}
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection