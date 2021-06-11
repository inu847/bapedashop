@extends('layouts.admin')

@section('title')
    Chat
@endsection

@section('content')
    <aside class="chute chute-left chute-icon-style chute290 bg-info" data-chute-height="match">
        <div class="chute-icon"></div>
        <div class="chute-container">
            <!-- New Message -->
            <button id="quick-compose" type="button" class="btn btn-dark light btn-block fw600">New message
            </button>

            <!-- Message Menu -->
            <div class="list-group list-group-links in-bg-chute mt20">
                <div class="list-group-header"> Mail</div>
                <a href="#" class="list-group-item">
                    <i class="fa fa-envelope-o"></i>
                    Inbox
                    <span class="label badge-warning">4</span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-save"></i>
                    Drafts
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-file-o"></i>
                    Sent Items
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-times-circle-o"></i>
                    Spam
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-trash-o"></i>
                    Trash
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-spinner"></i>
                    Email Settings
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-smile-o"></i>
                    Contacts
                    <span class="label badge-dark">3</span>
                </a>
            </div>
        </div>

    </aside>
    <!-- /Column Left -->

    <!-- Column Center -->
    <div class="chute chute-center pn bg-light">

        <div class="panel m40">

            <!-- Toolbar Header -->
            <div class="panel-menu br-n pn mtn">
                <div class="row">
                    <div class="hidden-xs hidden-sm col-md-3">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default light text-dark">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <button type="button" class="btn btn-default light text-dark">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-9 text-right ta-l-xs">
                        <button type="button" class="btn btn-dark light visible-xs-inline-block mr10">
                            Compose
                        </button>
                        <span class="hidden-xs va-m text-muted mr15"> <strong>9</strong> messages
                        </span>

                        <div class="btn-group mr10">
                            <button type="button" class="btn btn-default light text-dark hidden-xs">
                                <i class="fa fa-star"></i>
                            </button>
                            <button type="button" class="btn btn-default light text-dark hidden-xs">
                                <i class="fa fa-calendar"></i>
                            </button>
                            <button type="button" class="btn btn-default light text-dark">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        <div class="btn-group mr10">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default light text-dark dropdown-toggle ph8"
                                        data-toggle="dropdown">
                                    <span class="fa fa-tags"></span>
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="#">Submenu #1</a>
                                    </li>
                                    <li>
                                        <a href="#">Submenu #2</a>
                                    </li>
                                    <li>
                                        <a href="#">Submenu #3</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-plus pr5"></span> Create New</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="btn-group">
                                <button type="button"
                                        class="btn btn-default light text-dark dropdown-toggle ph8 br-tp-left"
                                        data-toggle="dropdown">
                                    <span class="fa fa-folder"></span>
                                    <span class="caret ml5"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="#">Submenu #1</a>
                                    </li>
                                    <li>
                                        <a href="#">Submenu #2</a>
                                    </li>
                                    <li>
                                        <a href="#">Submenu #3</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-plus pr5"></span> Create New</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default light text-dark">
                                <i class="fa fa-chevron-left"></i>
                            </button>
                            <button type="button" class="btn btn-default light text-dark">
                                <i class="fa fa-chevron-right"></i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Body -->
            <div class="table-responsive">
                <table id="message-table" class="table tc-checkbox-1 allcp-form theme-warning br-t btn-gradient-grey">
                    <thead>
                    <tr class="">
                        <th class="text-center hidden-xs">Select</th>
                        <th class="hidden-xs">Star</th>
                        <th>Sender</th>
                        <th>Subject</th>
                        <th class="hidden-xs">Attachement</th>
                        <th class="text-center">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($chats as $chat)
                            <tr class="message-unread message-show" data-id="{{$chat->user_id}}">
                                <td class="hidden-xs">
                                    <label class="option block mn">
                                        <input type="checkbox" name="inputname" value="FR">
                                        <span class="checkbox mn"></span>
                                    </label>
                                </td>
                                <td class="hidden-xs">
                                    <span class="rating block mn pull-left">
                                        <input class="rating-input" id="r2" type="radio" name="custom">
                                        <label class="rating-star" for="r2">
                                            <i class="fa fa-star va-m"></i>
                                        </label>
                                    </span>
                                </td>
                                <td class="">{{ App\Models\User::findOrFail($chat->user_id)->name }}</td>
                                @if ($chat->message_seller)
                                    <td class="">{{ $chat->message_seller }}</td>
                                @elseif($chat->message_admin)
                                    <td class="">{{ $chat->message_admin }}</td>
                                @endif
                                
                                <td class="hidden-xs">
                                    <i class="fa fa-paperclip fs15 text-muted va-b"></i>
                                </td>
                                <td class="text-center">{{ $chat->created_at->diffForHumans()}}</td>
                            </tr>                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script>
        $(document).ready(function (){
            $(".message-show").click(function(e) { 
                let getid = e.currentTarget.dataset.id;
                var redirect = 'chat/show?user_id='+getid
                // console.log(redirect)
                window.location.href = redirect;
            })
        })
    </script>