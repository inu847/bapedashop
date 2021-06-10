@extends('layouts.admin')

@section('title')
    Chat
@endsection

@section('content')
    @foreach ($chats as $chat)
 
                        <div class="clearfix"></div>
                            <div class="card d-inline-block mb-3 float-right mr-2">
                                <div class="position-absolute pt-1 pr-2 r-0">
                                    <span class="text-extra-small text-muted">{{ $chat->message_seller }}</span>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-row pb-2">
                                        <a class="d-flex" href="#">
                                            {{-- @if (Auth::guard('admin')->user()->profil)
                                                <img alt="Profile Picture" src="{{asset('storage/'. Auth::guard('admin')->user()->profil)}}" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall"/>
                                            @else 
                                                <img alt="Profile Picture" src="{{ asset('img/image-not-found.png')}}" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall"/>
                                            @endif --}}
                                        </a>
                                        <div class=" d-flex flex-grow-1 min-width-zero">
                                            <div
                                                class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                <div class="min-width-zero">
                                                    <p class="mb-0 truncate list-item-heading">{{ Auth::guard('admin')->user()->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
@endsection