<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- loader-->
    {{-- <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" /> --}}
    {{-- <script src="{{ asset('assets/js/pace.min.js') }}"></script> --}}

    <!--plugins-->
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!--Theme Styles-->
    <link href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/header-colors.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    @php
        $current_page_link = Request::path();
        $segments = '';
        foreach (Request::segments() as $key => $segment) {
            $segments .= '/' . $segment;
            $page = ucwords(str_replace('-', ' ', $segment));
        }
        $desired_path = substr($segments, strpos($segments, '/', 1) + 1);
        $current_page = ucwords(str_replace('/', ' ', $desired_path));

    @endphp
    <title>{{ Auth::check() && Auth::user()->type == 'admin' ? 'Admin' : 'Moderator' }} | {{ $page ?? '' }}</title>
    @notifyCss
    <style>
        #laravel-notify {
            position: relative;
            z-index: 999999 !important;
        }
    </style>
</head>

<body>

    <!--start wrapper-->
    <div class="wrapper">
        <x-notify::notify />

        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{ asset('assets/images/logo-icon-2.png') }}" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h4 class="logo-text">Blackdash</h4>
                </div>
                <div class="toggle-icon ms-auto">
                    <ion-icon name="menu-sharp"></ion-icon>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <div class="parent-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories') }}">
                        <div class="parent-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div class="menu-title">Feedback Category</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('feedbacks') }}">
                        <div class="parent-icon">
                            <i class="bi bi-printer"></i>
                        </div>
                        <div class="menu-title">Feedbacks</div>
                    </a>
                </li>
                <li>
                    <a href="pages-to-do.html">
                        <div class="parent-icon">
                            <i class="bi bi-check2-square"></i>
                        </div>
                        <div class="menu-title">Feedbacks</div>
                    </a>
                </li>
            </ul>
            <!--end navigation-->
        </aside>
        <!--end sidebar -->

        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-menu-button">
                    <i class="bi bi-list"></i>
                </div>
                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown dropdown-user-setting">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                data-bs-toggle="dropdown">
                                <div class="user-setting">{{ Auth::user()->name }}
                                    <img src="https://via.placeholder.com/110X110/212529/fff" class="user-img"
                                        alt="">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--end top header-->


        <!-- start page content wrapper-->
        <div class="page-content-wrapper">
            <!-- start page content-->
            <div class="page-content">
                <div class="page-breadcrumb d-flex justify-content-between align-items-center mb-3">
                    <h3>{{ $page }}</h3>
                    {{-- @dd($current_page_link) --}}
                    @if ($current_page_link == 'admin/categories')
                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                            data-bs-target="#add_edit_category_modal" id="add_category">Add</button>
                    @endif
                </div>
                @yield('content')
            </div>
            <!-- end page content-->
        </div>
        <!--end page content wrapper-->


        <!--start footer-->
        <footer class="footer">
            <div class="footer-text">
                Copyright © 2021. All right reserved.
            </div>
        </footer>
        <!--end footer-->


        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top">
            <ion-icon name="arrow-up-outline"></ion-icon>
        </a>
        <!--End Back To Top Button-->



        <!--start overlay-->
        {{-- <div class="overlay nav-toggle-icon"></div> --}}
        <!--end overlay-->

    </div>
    <!--end wrapper-->

    @notifyJs
    <!-- JS Files-->
    {{-- <script src="assets/js/jquery.min.js"></script> --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    {{-- <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/index.js') }}"></script> --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function SendAjaxRequestToServer(requestType = 'GET', url, data, dataType = 'json', callBack = '') {
            // console.log(data, url, dataType);
            $.ajax({
                type: requestType,
                url: url,
                data: data,
                dataType: dataType,
                processData: false,
                contentType: false,

                success: function(response) {
                    if (typeof callBack === 'function') {
                        callBack(response);
                    } else {
                        console.log('error');
                    }
                },
                error: function(response) {
                    if (typeof callBack === 'function') {
                        callBack(response);
                    } else {
                        console.log('error');
                    }
                }
            })
        }
    </script>
    @stack('javascript')

</body>

</html>
