<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="app_url" content="{{ env('APP_URL') }}">
    <meta name="description" content="Gaurakshashala">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/images/favicon.png') }}">

    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('backend/css2.css?family=Poppins:wght@300;400;500;600&display=swap') }}" >
    <link rel="stylesheet" href="{{ asset('backend/assets/dist/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/dist/css/bootstrap-docs.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/slick/slick.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/slick/slick-theme.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('backend/assets/dist/css/app.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/datatable/datatables.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @vite(['resources/js/backend.js'])

    @yield('styles')

</head>

<body class="dark">

    <div class="preloader">
        <img src="{{ asset('backend/assets/images/logo.png') }}" style="border-radius: 50%;"  alt="logo">
        <div class="preloader-icon"></div>
    </div>
    <!-- sidebars -->
    @php
     $admin = auth('admin')->user();
    @endphp
    {{-- Menubar --}}
    @include('backend.layouts.menu')


    <!-- layout-wrapper -->
    <div class="layout-wrapper">

        <!-- header -->
        <div class="header">
            <div class="menu-toggle-btn"> <!-- Menu close button for mobile devices -->
                <a href="#">
                    <i class="bi bi-list"></i>
                </a>
            </div>
            <!-- Logo -->
            <a href="{{ url('/admin') }}" class="logo">
                <img width="100" src="{{ asset('backend/assets/images/logo.png') }}" alt="logo">
            </a>
            <!-- ./ Logo -->

            {{-- <div class="page-title">Dashboard</div> --}}

            <div class="header-bar ms-auto">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item dropdown">

                        @if ($unreadNotf > 0)
                            <a href="#" class="nav-link nav-link-notify"
                                    data-count="@if ($unreadNotf >= 99){{'+99'}}@else {{$unreadNotf }} @endif"
                                    data-bs-toggle="dropdown">
                                <i class="bi bi-bell icon-lg"></i>
                            </a>
                        @else
                            <a href="#" class="nav-link "
                                    data-bs-toggle="dropdown">
                                <i class="bi bi-bell icon-lg"></i>
                            </a>
                        @endif


                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                            <h6 class="m-0 px-4 py-3 border-bottom">Notifications</h6>
                            <div class="dropdown-menu-body notifications" tabindex="3" style="overflow: hidden; outline: none;">
                                @forelse ($notifications as $items)
                                    <div class="list-group list-group-flush list-group-item @if($items->unread()) unread @else  read @endif">
                                            <a href="{{ $items->data['link'] }}"  class="d-flex notification-item @if($items->unread()) mark-as-read @endif" data-id="{{ $items->id }}">

                                            <div class="flex-shrink-0">
                                                <figure class="avatar avatar-info me-3">
                                                        <span class="avatar-text rounded-circle">
                                                            @if ($items->data['category'] == 'Order')
                                                                <i class="bi bi-cart-check"></i>
                                                            @elseif($items->data['category'] == 'Review')
                                                                <i class="bi bi-star"></i>
                                                            @else
                                                                <i class="bi bi-user"></i>
                                                            @endif
                                                        </span>
                                                </figure>
                                            </div>

                                            <div class="flex-grow-1">
                                                <p class="mb-0 fw-bold d-flex justify-content-between">
                                                    {{ $items->total }}
                                                    {!! htmlspecialchars_decode($items->data['header']) !!}
                                                </p>
                                                <span class="text-muted small">
                                                    <i class="bi bi-clock me-1"></i>
                                                    {{ Carbon\Carbon::parse($items->created_at)->diffForHumans() }}
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <a href="#" class="text-reset notification-item ">
                                        <div class="d-flex" style="justify-content: center;">
                                            <p class="mb-0 text-danger text-center"> No new notifications </p>
                                        </div>
                                    </a>
                                @endforelse
                            </div>
                            @if ($notifications->count() > 5)
                            <div class="tab-pane-footer d-flex justify-content-center">
                                <a class="btn btn-sm btn-link font-size-14 text-center"
                                        href="{{ route('admin.notifications') }}">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                </a>
                            </div>
                            @endif
                        <div id="ascrail2002" class="nicescroll-rails nicescroll-rails-vr" style="width: 8px; z-index: 1000; cursor: default; position: absolute; top: 0px; left: -8px; height: 0px; display: none;"><div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 6px; height: 0px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;"></div></div><div id="ascrail2002-hr" class="nicescroll-rails nicescroll-rails-hr" style="height: 8px; z-index: 1000; top: -8px; left: 0px; position: absolute; cursor: default; display: none;"><div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 6px; width: 0px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;"></div></div></div>

                    </li>

                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown">
                            <div class="avatar me-3">

                                @if(isset($admin->profile))
                                    <img width="100" class="rounded-pill" src="{{asset('storage/'. $admin->profile  )}}" alt="...">
                                @else
                                    <img width="100" class="rounded-pill" src="{{asset( Avatar::create($admin->name)->toBase64() )}}" alt="...">
                                @endif

                            </div>
                            <div>
                                <div class="fw-bold">{{ auth('admin')->user()->name }}</div>
                                <small class="text-muted">Admin</small>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{ url('admin/settings/profile') }}" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-person dropdown-item-icon"></i> Profile
                            </a>
                            <a href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="dropdown-item d-flex align-items-center text-danger">
                                <i class="bi bi-box-arrow-right dropdown-item-icon"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

                </ul>
            </div>
            <!-- Header mobile buttons -->
            <div class="header-mobile-buttons">
                <a href="#" class="search-bar-btn">
                    <i class="bi bi-search"></i>
                </a>
                <a href="#" class="actions-btn">
                    <i class="bi bi-three-dots"></i>
                </a>
            </div>
            <!-- ./ Header mobile buttons -->
        </div>
        <!-- ./ header -->



        <!-- content -->
        <div class="content ">

            @yield('content')

        </div>
        <!-- ./ content -->

        <!-- content-footer -->
        <footer class="content-footer">
            <div>© <?=date('Y')?> <a href="javascipt:void(0)">{{ config('app.name') }}</a></div>
        </footer>

    </div>
    <!-- ./ layout-wrapper -->

    <!-- Bundle scripts -->
    <script src="{{ asset('backend/assets/libs/bundle.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/slick/slick.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/charts/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/rating/jquery.rating.min.js') }}"></script>
    <script src="{{ asset('backend/assets/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatable/datatables.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('backend/assets/dist/js/examples/sweet-alert.js')}}"></script>


    <script type="text/javascript">
        let base_url = $('meta[name="app_url"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.mark-as-read').click(function(e) {
            $.ajax({ type: 'POST', url: base_url+ '/admin/mark-as-read',  data: $(this).data('id'), });
        });


    </script>

    @stack('scripts')

    @yield('scripts')

</body>

</html>
