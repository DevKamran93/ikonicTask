  <!doctype html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <!-- Mirrored from htmldemo.net/merier/merier/login-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2023 05:37:52 GMT -->

  <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <meta name="robots" content="noindex, follow" />
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

      <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->

      <!-- Font CSS -->
      <link rel="preconnect" href="https://fonts.googleapis.com/">
      <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
      <link
          href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,400&amp;display=swap"
          rel="stylesheet">
      <link
          href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&amp;display=swap"
          rel="stylesheet">

      <!-- Vendor CSS (Bootstrap & Icon Font) -->
      <link rel="stylesheet" href="{{ asset('assets2/css/vendor/bootstrap.min.css') }}">

      <!-- Plugins CSS (All Plugins Files) -->
      <link rel="stylesheet" href="{{ asset('assets2/css/plugins/swiper-bundle.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets2/css/plugins/font-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets2/css/plugins/fancybox.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets2/css/plugins/nice-select.css') }}">

      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('assets2/css/style.css') }}">


      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
      <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      <!-- Scripts -->
      <link rel="stylesheet" href="{{ asset('assets2/summernote/summernote-bs4.min.css') }}" />
      @vite(['resources/sass/app.scss', 'resources/js/app.js'])
      @notifyCss
      @php
          $current_page_link = Request::path();
          $segments = '';
          foreach (Request::segments() as $key => $segment) {
              $segments .= '/' . $segment;
              $page = ucwords(str_replace('-', ' ', $segment));
          }
          $desired_path = substr($segments, strpos($segments, '/', 1) + 1);
          $current_page = ucwords(str_replace('/', ' ', $desired_path));
          if (intval($segment) > 0) {
              $current_page = 'Feedback Detail';
          }

      @endphp
      <title>{{ $current_page ?? 'Ikonic' }}</title>
      <style>
          #laravel-notify {
              position: relative;
              z-index: 999999 !important;
          }

          .is-invalid {
              border: 1px solid red !important;
          }

          .submit_btn {
              font-size: 14px;
              border-radius: 3px;
              color: #ffffff;
              background-color: #ff5a5a;
              border: none;
              line-height: 1;
              text-align: center;
              padding: 13px 32px 11px;
              text-transform: uppercase;
              transition: all 0.3s ease-in-out;
              -webkit-transition: all 0.3s ease-in-out;
              -moz-transition: all 0.3s ease-in-out;
              -ms-transition: all 0.3s ease-in-out;
              -o-transition: all 0.3s ease-in-out;
          }

          .submit_btn:hover {
              background-color: #1d3557;
          }

          .note-editor {
              margin: 15px 0px;
          }
      </style>
  </head>

  <body>
      <x-notify::notify />

      <!--== Wrapper Start ==-->
      <div class="wrapper">

          <!--== Start Header Wrapper ==-->
          <header class="header-area shadow">
              <div class="container">
                  <div class="row align-items-center justify-content-between">
                      <div class="col-auto">
                          <div class="header-logo">
                              <a href="{{ route('user.home') }}">
                                  {{-- <img class="logo-main" src="{{ asset('assets2/images/logo.png') }}" width="153"
                                      height="30" alt="Logo"> --}}
                                  IKONIC TASK
                              </a>
                          </div>
                      </div>
                      <div class="d-none d-lg-block col-auto ms-auto">
                          <div class="header-navigation">
                              <ul class="main-nav">
                                  @auth
                                      <li><a href="{{ route('user.home') }}">Home</a></li>

                                      <li class="has-submenu"><a href="javascript:void(0)">Feedbacks</a>
                                          <ul class="submenu-nav">
                                              <li><a href="{{ route('user.add_feedback') }}">Add Feedback</a></li>
                                              <li><a href="{{ route('user.feedbacks') }}">All Feedbacks</a></li>
                                          </ul>
                                      </li>
                                  @endauth


                                  <!-- Authentication Links -->
                                  @guest
                                      @if (Route::has('login'))
                                          <li>
                                              <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                          </li>
                                      @endif

                                      @if (Route::has('register'))
                                          <li>
                                              <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                          </li>
                                      @endif
                                  @else
                                      <li class="has-submenu"><a href="#" v-pre>{{ Auth::user()->name }}</a>
                                          <ul class="submenu-nav">
                                              <li>
                                                  <a href="{{ route('logout') }}"
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
                                  @endguest
                              </ul>
                          </div>
                      </div>
                      <div class="col-auto">
                          <div class="header-action">
                              <button class="btn-menu bg-danger d-lg-none" type="button" data-bs-toggle="offcanvas"
                                  data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                                  <i class="fa fa-bars"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </header>
          <section class="page-header-area" data-bg-color="#e2FAEE">
              <div class="container">
                  <div class="page-header-content">
                      <h2 class="page-header-title">{{ $current_page }}</h2>
                  </div>
              </div>
          </section>
          <x-notify::notify />

          <main class="main-content">
              @yield('content')
          </main>
          <footer class="footer-area shadow-lg">

              <!--== Start Footer Bottom ==-->
              <div class="footer-bottom">
                  <div class="container pb-0 pt-0">
                      <div class="footer-bottom-content">
                          <a href="shop.html"><img src="assets/images/shop/payment.png" alt="Image-HasTech"></a>
                          <p class="copyright">© 2021 Merier. Made with <i class="fa fa-heart"></i> by <a
                                  target="_blank"
                                  href="https://themeforest.net/user/codecarnival/portfolio">Codecarnival.</a></p>
                      </div>
                  </div>
              </div>
              <!--== End Footer Bottom ==-->
          </footer>
          <aside class="aside-side-menu-wrapper off-canvas-area offcanvas offcanvas-end" data-bs-scroll="true"
              tabindex="-1" id="offcanvasWithBothOptions">
              <div class="offcanvas-header" data-bs-dismiss="offcanvas">
                  <h5>Menu</h5>
                  <button type="button" class="btn-close">×</button>
              </div>
              <div class="offcanvas-body">
                  <!-- Start Mobile Menu Wrapper -->
                  <div class="res-mobile-menu">
                      <nav id="offcanvasNav" class="offcanvas-menu">
                          <ul>
                              <li><a href="{{ route('user.home') }}">Home</a>
                              </li>

                              <li><a href="javascript:void(0)">Feedbacks</a>
                                  <ul>
                                      <li><a href="{{ route('user.add_feedback') }}">Add Feedback</a></li>
                                      <li><a href="{{ route('user.feedbacks') }}">All Feedbacks</a></li>
                                  </ul>
                              </li>
                              <!-- Authentication Links -->
                              @guest
                                  @if (Route::has('login'))
                                      <li>
                                          <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                      </li>
                                  @endif

                                  @if (Route::has('register'))
                                      <li>
                                          <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                      </li>
                                  @endif
                              @else
                                  <li class="nav-item dropdown">
                                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                          role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                          aria-expanded="false" v-pre>
                                          {{ Auth::user()->name }}
                                      </a>

                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                          <a class="dropdown-item" href="{{ route('logout') }}"
                                              onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                              {{ __('Logout') }}
                                          </a>

                                          <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              class="d-none">
                                              @csrf
                                          </form>
                                      </div>
                                  </li>
                              @endguest
                          </ul>
                      </nav>
                  </div>
                  <!-- End Mobile Menu Wrapper -->
              </div>
          </aside>
      </div>
      @notifyJs
      <script src="{{ asset('assets2/js/vendor/jquery-3.6.0.min.js') }}"></script>
      <script src="{{ asset('assets2/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
      <script src="{{ asset('assets2/js/vendor/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets2/js/vendor/modernizr-3.11.7.min.js') }}"></script>

      <!-- Plugins JS -->
      <script src="{{ asset('assets2/js/plugins/swiper-bundle.min.js') }}"></script>
      <script src="{{ asset('assets2/js/plugins/fancybox.min.js') }}"></script>
      <script src="{{ asset('assets2/js/plugins/jquery.nice-select.min.js') }}"></script>

      <!-- Custom Main JS -->
      <script src="{{ asset('assets2/js/main.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <script src="{{ asset('assets2/summernote/summernote-bs4.min.js') }}"></script>
      <script>
          //   $(document).ready(function() {
          toastr.options = {
              "closeButton": true,
              "progressBar": true,
              "showDuration": 300,
              "timeOut": 2000,
              "hideDuration": 1000,
              "preventDuplicates": true,
          }
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          function SendAjaxRequestToServer(requestType = 'GET', url, data, dataType = 'json', callBack = '') {
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
          //   });
      </script>

      @stack('javascript')

  </body>

  </html>
