@extends('layouts.admin')

@section('title')
    User Customer
@endsection

@section('content')
    @if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <div class="panel">
        <div class="panel-heading ">
            <span class="panel-title ptn">Akun Customer</span>
        </div>
        <div class="panel-body pn mt15">
            <div class="table-responsive">
                <table class="table allcp-form theme-warning tc-checkbox-1 table-style-2 btn-gradient-grey fs13">
                    <thead>
                    <tr class="">
                        <th class="">Username</th>
                        <th class="">Nama Toko</th>
                        <th class="">Status</th>
                        <th class="">Action</th>
                        <th>Todo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td class="">
                            <span>{{$customer->name}}</span>
                        </td>
                        <td class=""><span>{{$customer->email}}</td>
                        <td><span class="btn btn-warning br2 btn-xs fs10 fw700">{{$customer->status}}</span></td>
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
                        <td>
                            <form action="{{ route('active.customer', [$customer->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="PUT" name="_method">
                                <button type="submit">Aktifkan Akun</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection