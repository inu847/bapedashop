<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> @yield('title')</title>
    <meta name="keywords" content="HTML5, Bootstrap 3, Admin Template, UI Theme"/>
    <meta name="description" content="AdminK - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="ThemeREX">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{asset('img/LOGO 4.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/skin/css/angular-material.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/fonts/icomoon/icomoon.css')}}">    
    <link rel="stylesheet" type="text/css" href="{{asset('admin/fonts/animatedsvgicons/css/codropsicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/js/plugins/c3charts/c3.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/allcp/forms/css/forms.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/js/utility/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/skin/default_skin/less/theme.css')}}">
    
    <!-- IE8 HTML5 support -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="sales-stats-page sb-top sb-top-lg">

<!-- Body Wrap -->
<div id="main">

    <!-- Header  -->
    <header class="navbar navbar-fixed-top bg-info phn">
        <div class="navbar-logo-wrapper">
            <a class="navbar-logo-img" href="{{ route('admin.index') }}">
                <img src="{{asset('img/LOGO 4.png')}}" alt="" height="40px">
            </a>
        </div>
        <span id="sidebar_top_toggle" class="ad ad-lines navbar-nav navbar-left showing-sm"></span>
        <ul class="nav navbar-nav navbar-left">
            <li class="dropdown dropdown-fuse hidden-xs">
                <div class="navbar-btn btn-group phn">
                    <button class="btn-hover-effects dropdown-toggle btn bg-light" data-toggle="dropdown" aria-expanded="false">
                        <span class="fa fa-chevron-down"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>
            </li>
            <li class="hidden-xs">
                <div class="navbar-btn btn-group">
                    <button class="btn-hover-effects navbar-fullscreen toggle-active btn si-icons si-icons-default">
                        <span class="si-icon si-icon-maximize-rotate default" data-icon-name="maximizeRotate"></span>
                    </button>
                </div>
            </li>
        </ul>
        <form class="navbar-form navbar-left search-form square" role="search">
            <div class="input-group add-on">

                <input type="text" class="form-control btn-hover-effects bg-light" placeholder="Search..." onfocus="this.placeholder=''"
                       onblur="this.placeholder='Search...'">
                <button class="btn btn-default text-info hidden-xs hidden-sm" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                </button>

            </div>
        </form>
        <ul class="nav navbar-nav navbar-right bg-info darker mn pv10">
            <li class="dropdown dropdown-fuse navbar-user">
                @if (Auth::guard("admin")->user()->name)
                    <a href="#" class="dropdown-toggle mln" data-toggle="dropdown">
                        @if (Auth::guard("admin")->user()->profil)
                            <img src="{{asset('storage'. Auth::guard("admin")->user()->profile)}}" alt="avatar">
                        @else
                            <img src="{{asset('img/image-not-found.png')}}" alt="avatar">
                        @endif
                        
                        <span class="hidden-xs">
                            <span class="name">{{Auth::guard("admin")->user()->name}}</span>
                        </span>
                        <span class="fa fa-caret-down hidden-xs"></span>
                    </a>
                @endif
                <ul class="dropdown-menu list-group keep-dropdown w230" role="menu">
                    <li class="dropdown-header clearfix">
                        <div class="pull-left">
                            <select id="user-status">
                                <optgroup label="Current Status:">
                                    <option value="1-1">Away</option>
                                    <option value="1-2">Busy</option>
                                    <option value="1-3" selected="selected">Online</option>
                                    <option value="1-4">Offline</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="pull-right">
                            <select id="user-role">
                                <optgroup label="Logged in As:">
                                    <option value="1-1" selected="selected">Admin</option>
                                    <option value="1-2">Editor</option>
                                    <option value="1-3">User</option>
                                </optgroup>
                            </select>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="fa fa-envelope"></span>
                        <a href="#" class="">
                            Messages
                            <span class="label label-info">3</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="fa fa-user"></span>
                        <a href="#" class="">
                            Friends
                            <span class="label label-info">6</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="fa fa-cog"></span>
                        <a href="#" class="">
                            Account Settings 
                        </a>
                    </li>
                    <li class="list-group-item">
                        <span class="fa fa-bell"></span>
                        <a href="#" class="">
                             Activity
                        </a>
                    </li>
                    <li class="dropdown-footer text-center">
                        <a href="#" class="btn btn-warning">
                            logout 
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right pr15">
            <li class="hidden-xs">
                <div class="navbar-btn btn-group phn">
                    <button class="btn-hover-effects topbar-dropmenu-toggle btn bg-light">
                        <span class="fa fa-magic fs20 text-dark"></span>
                    </button>
                </div>
            </li>
            <li class="dropdown dropdown-fuse">
                <div class="navbar-btn btn-group">
                    <button class="btn-hover-effects dropdown-toggle btn of-v bg-light" data-toggle="dropdown">
                        <span class="fa fa-envelope fs20 text-danger"></span>
                        <span class="fs14 visible-xl">
                            6
                        </span>
                    </button>
                    <div class="navbar-activity dropdown-menu keep-dropdown w375" role="menu">
                        <div class="panel mbn">
                            <div class="panel-menu">
                                <div class="btn-group btn-group-justified btn-group-nav" role="tablist">
                                    <a href="#nav-tab1" data-toggle="tab"
                                       class="btn btn-sm active">Activity</a>
                                    <a href="#nav-tab2" data-toggle="tab"
                                       class="btn btn-sm br-l-n br-r-n">Messages</a>
                                    <a href="#nav-tab3" data-toggle="tab" class="btn btn-sm">Notifications</a>
                                </div>
                            </div>
                            <div class="panel-body pn">
                                <div class="tab-content br-n pn">
                                    <div id="nav-tab1" class="tab-pane active" role="tabpanel">
                                        <ul class="media-list" role="menu">
                                            <li class="media">
                                                <a class="media-left" href="#"> 
                                                    <img src="assets/img/avatars/1.png" class="br3" alt="avatar">
                                                </a>

                                                <div class="media-body">
                                                    <h5 class="media-heading">New post
                                                        <span class="text-muted">- 09/01/16</span>
                                                    </h5>
                                                    Last Updated 5 days ago by
                                                    <a class="" href="#"> Anna Smith </a>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <a class="media-left" href="#"> 
                                                    <img src="assets/img/avatars/2.png" class="br3" alt="avatar">
                                                </a>

                                                <div class="media-body">
                                                    <h5 class="media-heading">New post
                                                        <span class="text-muted">- 09/01/16</span>
                                                    </h5>
                                                    Last Updated 5 days ago by
                                                    <a class="" href="#"> John Doe </a>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <a class="media-left" href="#"> 
                                                    <img src="assets/img/avatars/3.png" class="br3" alt="avatar">
                                                </a>

                                                <div class="media-body">
                                                    <h5 class="media-heading">New post
                                                        <span class="text-muted">- 09/01/16</span>
                                                    </h5>
                                                    Last Updated 5 days ago by
                                                    <a class="" href="#"> John Doe </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="nav-tab2" class="tab-pane chat-widget" role="tabpanel">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" alt="64x64" src="assets/img/avatars/1.png">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <span class="media-status online"></span>
                                                <h5 class="media-heading">Anna Smith
                                                    <span> - 3:16 am</span>
                                                </h5>
                                                Sed egestas ligula eget dictum posuere. Maecenas feugiat in enim.
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <span class="media-status offline"></span>
                                                <h5 class="media-heading">Mike Adams
                                                    <span> - 3:36 am</span>
                                                </h5>
                                                Etiam facilisis ultrices fringilla. Vivamus sit amet elementum ipsum
                                            </div>
                                            <div class="media-right">
                                                <a href="#">
                                                    <img class="media-object" alt="64x64" src="assets/img/avatars/3.png">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" alt="64x64" src="assets/img/avatars/1.png">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <span class="media-status online"></span>
                                                <h5 class="media-heading">Anna Smith
                                                    <span> - 4:27 am</span>
                                                </h5>
                                                Sed egestas ligula eget dictum posuere. Maecenas feugiat in enim.
                                            </div>
                                        </div>
                                    </div>
                                    <div id="nav-tab3" class="tab-pane alerts-widget" role="tabpanel">
                                        <div class="media">
                                            <a class="media-left" href="#"> <span
                                                    class="fa fa-shopping-cart"></span> </a>

                                            <div class="media-body">
                                                <h5 class="media-heading">New Product Order
                                                    <span class="text-muted"></span>
                                                </h5>
                                                <a href="#">iPad Air</a>
                                                <span class="text-muted-alt">- 3 hours ago</span>
                                            </div>
                                            <div class="media-right">
                                                <div class="media-response"> Confirm?</div>
                                                <div class="btn-group">
                                                    <button type="button"
                                                            class="btn btn-info btn-sm">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-default btn-sm">
                                                        <i class="fa fa-cog"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <a class="media-left" href="#"> 
                                                <span class="fa fa-comments"></span>
                                            </a>

                                            <div class="media-body">
                                                <h5 class="media-heading">New User Comment
                                                    <span class="text-muted"></span>
                                                </h5>
                                                <span class="text-muted-alt">Sam Fisher - I'd like to read more!</span>
                                            </div>
                                            <div class="media-right">
                                                <div class="media-response text-right"> Moderate?</div>
                                                <div class="btn-group">
                                                    <button type="button"
                                                            class="btn btn-info btn-sm">
                                                        <i class="fa fa-check "></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-default btn-sm">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <a class="media-left" href="#"> 
                                                <span class="fa fa-eye"></span>
                                            </a>

                                            <div class="media-body">
                                                <h5 class="media-heading">New User Review
                                                    <span class="text-muted"></span>
                                                </h5>
                                                <span class="text-muted-alt">Sebastian Jones - 5 hours ago</span>
                                            </div>
                                            <div class="media-right">
                                                <div class="media-response"> Approve?</div>
                                                <div class="btn-group">
                                                    <button type="button"
                                                            class="btn btn-info btn-sm">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-default btn-sm">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-center">
                                <a href="#" class="btn btn-warning"> View All </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown dropdown-fuse">
                <div class="navbar-btn btn-group">
                    <button class="btn-hover-effects dropdown-toggle btn of-v bg-light" data-toggle="dropdown">
                        <span class="fa fa-bell fs20 text-info"></span>
                        <span class="fs14 visible-xl">
                            8
                        </span>
                    </button>
                    <div class="navbar-activity dropdown-menu keep-dropdown w375" role="menu">
                        <div class="panel mbn">
                            <div class="panel-menu">
                                <div class="btn-group btn-group-nav" role="tablist">
                                    <a href="#nav-tab4" data-toggle="tab"
                                       class="btn btn-primary btn-sm active">Activity</a>
                                </div>
                                <button class="btn btn-xs" type="button"><i
                                        class="fa fa-refresh"></i>
                                </button>
                            </div>
                            <div class="panel-body pn">
                                <div class="tab-content br-n pn">
                                    <div id="nav-tab4" class="tab-pane active" role="tabpanel">
                                        <ol class="timeline-list">
                                            <li class="timeline-item">
                                                <div class="timeline-icon light">
                                                    <span class="fa fa-envelope"></span>
                                                </div>
                                                <div class="timeline-desc">
                                                    <b>John Doe <span>-</span> <span class="timeline-date">3:16 am</span></b>
                                                    Sent you a message.
                                                    <a href="#">View now</a>
                                                </div>
                                            </li>
                                            <li class="timeline-item">
                                                <div class="timeline-icon">
                                                    <span class="fa fa-info-circle"></span>
                                                </div>
                                                <div class="timeline-desc">
                                                    <b>Admin <span>-</span> <span class="timeline-date">6:26 pm</span></b> 
                                                    Сreated invoice for:
                                                    <a href="#">iPad Air</a>
                                                </div>
                                            </li>
                                            <li class="timeline-item">
                                                <div class="timeline-icon">
                                                    <span class="fa fa-info-circle"></span>
                                                </div>
                                                <div class="timeline-desc">
                                                    <b>Admin <span>-</span> <span class="timeline-date">11:45 am</span></b> 
                                                    Сreated invoice for:
                                                    <a href="#">iPhone 5s</a>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer text-center">
                                <a href="#" class="btn btn-warning btn-sm"> View All </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown dropdown-fuse">
                <div class="navbar-btn btn-group">
                    <button class="btn-hover-effects dropdown-toggle btn bg-light" data-toggle="dropdown">
                        <img src="assets/img/sprites/uk.png" alt="">
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="javascript:void(0);"> English </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"> Spanish </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"> Italian </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </header>
    <!-- /Header -->

        <!-- Sidebar  -->
    <aside id="sidebar_left" class="">

        <!-- Sidebar Left Wrapper  -->
        <div class="sidebar-left-content nano-content">

            <!-- Sidebar Menu  -->
            <ul class="nav sidebar-menu">

                <li class="active">
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-dashboard"></span>
                        <span class="sidebar-title">Dashboards</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="index.html">
                                Layout 1 
                            </a>
                        </li>
                        <li class="active">
                            <a href="index2.html">
                                Layout 2 
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-bar-chart-o"></span>
                        <span class="sidebar-title">Sales stats</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="index2.html">
                                Overview 
                            </a>
                        </li>
                        <li class="">
                            <a href="sales-stats-products.html">
                                Products 
                            </a>
                        </li>
                        <li class="">
                            <a href="sales-stats-purchases.html">
                                Purchases 
                            </a>
                        </li>
                        <li class="">
                            <a href="sales-stats-clients.html">
                                Clients 
                            </a>
                        </li>
                        <li class="">
                            <a href="sales-stats-general-settings.html">
                                General Settings 
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-desktop"></span>
                        <span class="sidebar-title">Templates</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Sidebars
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="sidebar-left-static.html">
                                        Left Static 
                                    </a>
                                </li>
                                <li>
                                    <a href="sidebar-left-fixed.html">
                                        Left Fixed 
                                    </a>
                                </li>
                                <li>
                                    <a href="sidebar-left-minified.html">
                                        Left Minified 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Navigation
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="navigation-static.html">
                                        Static 
                                    </a>
                                </li>
                                <li>
                                    <a href="navigation-fixed.html">
                                        Fixed 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Top Panel
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="top-panel.html">
                                        Default 
                                    </a>
                                </li>
                                <li>
                                    <a href="top-panel-menu.html">
                                        With Menu 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Content
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="content-blank.html">
                                        Blank 
                                    </a>
                                </li>
                                <li>
                                    <a href="content-fixed.html">
                                        Fixed 
                                    </a>
                                </li>
                                <li>
                                    <a href="content-hero.html">
                                        Hero Content 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Content Chutes
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="chute-left.html">
                                        Left Static 
                                    </a>
                                </li>
                                <li>
                                    <a href="chute-left-fixed.html">
                                        Left Fixed 
                                    </a>
                                </li>
                                <li>
                                    <a href="chute-right.html">
                                        Right Static 
                                    </a>
                                </li>
                                <li>
                                    <a href="chute-right-fixed.html">
                                        Right Fixed 
                                    </a>
                                </li>
                                <li>
                                    <a href="chute-both.html">
                                        Left &amp; Right Static 
                                    </a>
                                </li>
                                <li>
                                    <a href="chute-both-fixed.html">
                                        Left &amp; Right Fixed 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Boxed Frontpage
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="boxed-default.html">
                                        Default 
                                    </a>
                                </li>
                                <li>
                                    <a href="horizontal-navigation-boxed.html">
                                        Optional Navigation 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="">
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Horizontal Navigation
                            </a>
                            <ul class="nav sub-nav">
                                <li class="">
                                    <a href="horizontal-navigation-small-menu.html">
                                        Small Menu
                                    </a>
                                </li>
                                <li class="">
                                    <a href="horizontal-navigation-medium-menu.html">
                                        Medium Menu
                                    </a>
                                </li>
                                <li class="">
                                    <a href="horizontal-navigation-large-menu.html">
                                        Large Menu
                                    </a>
                                </li>
                                <li class="">
                                    <a href="horizontal-navigation-top-panel.html">
                                        With Top panel
                                    </a>
                                </li>
                                <!-- <li class="">
                                    <a href="horizontal-navigation-collapsing-top-panel.html">
                                        Collapsing Top panel
                                    </a>
                                </li> -->
                                <li class="">
                                    <a href="horizontal-navigation-boxed.html">
                                        Boxed Layout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-wrench"></span>
                        <span class="sidebar-title">Tools</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="management-tools-panels.html">
                                Panels 
                            </a>
                        </li>
                        <li>
                            <a href="management-tools-modals.html">
                                Modals 
                            </a>
                        </li>
                        <li>
                            <a href="management-tools-dock.html">
                                Dock 
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-check-square-o"></span>
                        <span class="sidebar-title">Forms</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="forms-elements.html">
                                Elements 
                            </a>
                        </li>
                        <li>
                            <a href="forms-widgets.html">
                                Widgets 
                            </a>
                        </li>
                        <li>
                            <a href="forms-layouts.html">
                                Layouts 
                            </a>
                        </li>
                        <li>
                            <a href="forms-wizard.html">
                                Wizard 
                            </a>
                        </li>
                        <li>
                            <a href="forms-validation.html">
                                Validation 
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-cogs"></span>
                        <span class="sidebar-title">Widgets</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="widgets-panels.html">
                                Panels 
                            </a>
                        </li>
                        <li>
                            <a href="widgets-scrollers-tiles.html">
                                Scrollers &amp; Tiles
                            </a>
                        </li>
                        <li>
                            <a href="widgets-tools.html">
                                Tools 
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-user"></span>
                        <span class="sidebar-title">User Interface</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="{{ route('admin.seller') }}">
                                 Seller
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.customer') }}">
                                Customer
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.admin') }}">
                                Admin
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-file-text-o"></span>
                        <span class="sidebar-title">User Forms</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="user-forms-standart-inputs.html">
                                Standart Inputs 
                            </a>
                        </li>
                        <li>
                            <a href="user-forms-additional-inputs.html">
                                Additional Inputs
                            </a>
                        </li>
                        <li>
                            <a href="user-forms-editors.html">
                                Editors 
                            </a>
                        </li>
                        <li>
                            <a href="user-forms-treeview.html">
                                Treeview 
                            </a>
                        </li>
                        <li>
                            <a href="user-forms-nestable.html">
                                Nestable 
                            </a>
                        </li>
                        <li>
                            <a href="user-forms-image-tools.html">
                                Image Tools
                            </a>
                        </li>
                        <li>
                            <a href="user-forms-file-uploaders.html">
                                File Uploaders 
                            </a>
                        </li>
                        <li>
                            <a href="user-forms-notifications.html">
                                Notifications 
                            </a>
                        </li>
                        <li>
                            <a href="user-forms-content-sliders.html">
                                Content Sliders 
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-sitemap"></span>
                        <span class="sidebar-title">Plugins</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Maps
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="maps-basic.html">
                                        Basic
                                    </a>
                                </li>
                                <li>
                                    <a href="maps-vector.html">
                                        Vector
                                    </a>
                                </li>
                                <li>
                                    <a href="maps-full.html">
                                        Full
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Charts
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="charts-highcharts.html">
                                        Highcharts
                                    </a>
                                </li>
                                <li>
                                    <a href="charts-d3.html">
                                        D3 Charts
                                    </a>
                                </li>
                                <li>
                                    <a href="charts-flot.html">
                                        Flot Charts
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Tables
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="tables-basic.html"> 
                                        Basic 
                                    </a>
                                </li>
                                <li>
                                    <a href="tables-datatables.html"> 
                                        Data 
                                    </a>
                                </li>
                                <li>
                                    <a href="tables-sortable.html"> 
                                        Sortable 
                                    </a>
                                </li>
                                <li>
                                    <a href="tables-pricing.html"> 
                                        Pricing 
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-book"></span>
                        <span class="sidebar-title">Pages</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Utility
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="utility-confirmation.html" target="_blank"> 
                                        Confirmation 
                                    </a>
                                </li>
                                <li>
                                    <a href="utility-login.html" target="_blank"> 
                                        Login 
                                    </a>
                                </li>
                                <li>
                                    <a href="utility-register.html" target="_blank"> 
                                        Register 
                                    </a>
                                </li>
                                <li>
                                    <a href="utility-forgot-password.html" target="_blank"> 
                                        Forgot Password 
                                    </a>
                                </li>
                                <li>
                                    <a href="utility-coming-soon.html" target="_blank"> 
                                        Coming Soon
                                    </a>
                                </li>
                                <li>
                                    <a href="utility-404-error.html"> 
                                        404 Error 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="accordion-toggle" href="#">
                                <span class="caret"></span>
                                Basic
                            </a>
                            <ul class="nav sub-nav">
                                <li>
                                    <a href="basic-search-results.html">
                                        Search Results 
                                    </a>
                                </li>
                                <li>
                                    <a href="basic-profile.html"> 
                                        Profile 
                                    </a>
                                </li>
                                <li>
                                    <a href="basic-timeline.html"> 
                                        Timeline 
                                    </a>
                                </li>
                                <li>
                                    <a href="basic-faq-page.html"> 
                                        FAQ Page 
                                    </a>
                                </li>
                                <li>
                                    <a href="basic-messages.html"> 
                                        Messages 
                                    </a>
                                </li>
                                <li>
                                    <a href="basic-gallery.html"> 
                                        Gallery 
                                    </a>
                                </li>
                                <li>
                                    <a href="basic-invoice.html"> 
                                        Invoice 
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="new-email" href="email-layouts.html">
                                <span class="sidebar-title">New Emails</span>
                            </a>
                        </li>
                        <li>
                            <a href="basic-calendar.html">
                                <span class="sidebar-title">Calendar</span>
                            </a>
                        </li>
                        <li>
                            <a href="doc/index.html">
                                <span class="sidebar-title">Documentation</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <section id="content_wrapper" class="mb80">
            

        <section class="content_container">
            
        <!-- Topbar Menu Wrapper -->
        <div id="topbar-dropmenu-wrapper">
            <div class="topbar-menu row">
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-danger">
                        <span class="fa fa-music"></span>
                        <span class="service-title">Audio</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-success">
                        <span class="fa fa-picture-o"></span>
                        <span class="service-title">Images</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-primary">
                        <span class="fa fa-video-camera"></span>
                        <span class="service-title">Videos</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-alert">
                        <span class="fa fa-envelope"></span>
                        <span class="service-title">Messages</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-system">
                        <span class="fa fa-cog"></span>
                        <span class="service-title">Settings</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="service-box bg-dark">
                        <span class="fa fa-user"></span>
                        <span class="service-title">Users</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Topbar Menu Wrapper -->

        <!-- Topbar -->
        <header id="topbar" class="breadcrumb_style_2">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="breadcrumb-icon breadcrumb-active">
                        <a href="index.html">
                            <span class="fa fa-circle-o"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-icon breadcrumb-link">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-current-item">Dashboard</li>
                </ol>
            </div>
            <div class="topbar-right">
                <div class="ib topbar-dropdown">
                    <label for="topbar-multiple" class="control-label">Reporting Period</label>
                    <select id="topbar-multiple" class="hidden">
                        <optgroup label="Filter By:">
                            <option value="1-1">Last 30 Days</option>
                            <option value="1-2" selected="selected">Last 60 Days</option>
                            <option value="1-3">Last Year</option>
                        </optgroup>
                    </select>
                </div>
                <div class="ml15 ib va-m" id="sidebar_right_toggle">
                    <div class="navbar-btn btn-group btn-group-number mv0">
                        <button class="btn btn-sm prn pln">
                            <i class="fa fa-bar-chart fs22 text-default"></i>
                        </button>

                    </div>
                </div>
            </div>
        </header>

            <section id="content" class="animated fadeIn pt35 pb45">
                <div class="content-left">
                    <ul class="nav nav-content">
                        <li class="">
                            <a href="sales-stats-products.html">
                                <i class="fa fa-folder"></i>
                                <span>Products</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="index2.html">
                                <i class="fa fa-check-square"></i>
                                <span>Overview</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="sales-stats-purchases.html">
                                <i class="fa fa-briefcase"></i>
                                <span>Orders</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="sales-stats-clients.html">
                                <i class="fa fa-group"></i>
                                <span>Clients</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="sales-stats-general-settings.html">
                                <i class="fa fa-gear"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>

        {{-- MAIN --}}
                <div class="content-right table-layout">
                    <div class="chute chute-center pbn">

                        <div class="row mn">
                            <div class="col-xs-12">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <footer id="content-footer">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <span class="footer-legal">© 2016 All rights reserved. <a href="#">Therms of use</a> and <a href="#">Privacy policy</a></span>
                    </div>
                </div>
            </footer>
        </section>
    </section>


</div>

{{-- <script src="{{asset('admin/js/jquery/jquery-1.12.3.min.js')}}"></script> --}}
<script src="{{asset('admin/js/jquery/jquery_ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('admin/fonts/animatedsvgicons/js/snap.svg-min.js')}}"></script>
<script src="{{asset('admin/fonts/animatedsvgicons/js/svgicons-config.js')}}"></script>
<script src="{{asset('admin/fonts/animatedsvgicons/js/svgicons.js')}}"></script>
<script src="{{asset('admin/fonts/animatedsvgicons/js/svgicons-init.js')}}"></script>
<script src="{{asset('admin/js/utility/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('admin/js/plugins/highcharts/highcharts.js')}}"></script>
<script src="{{asset('admin/js/plugins/c3charts/d3.min.js')}}"></script>
<script src="{{asset('admin/js/plugins/c3charts/c3.min.js')}}"></script>
<script src="{{asset('admin/js/plugins/circles/circles.js')}}"></script>
<script src="{{asset('admin/js/plugins/jvectormap/jquery.jvectormap.min.js')}}"></script>
<script src="{{asset('admin/js/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js')}}"></script>
<script src="{{asset('admin/js/plugins/jvectormap/assets/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('admin/js/utility/utility.js')}}"></script>
<script src="{{asset('admin/js/demo/demo.js')}}"></script>
<script src="{{asset('admin/js/main.js')}}"></script>
<script src="{{asset('admin/js/demo/widgets_sidebar.js')}}"></script>
<script src="{{asset('admin/js/pages/dashboard2.js')}}"></script>
<script src="{{asset('admin/js/demo/charts/highcharts.js')}}"></script>
</body>

</html>


