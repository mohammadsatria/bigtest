<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- icon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.ico') }}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Uswah Mart</title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    {{-- Datepicker --}}
    <link href="{{ asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

    {{-- Scrollbar --}}
    <link href="{{ asset('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet"/>

    {{-- datatable --}}
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendors/jstree/dist/themes/default/style.min.css') }}" />


    <!-- Notification -->
    <link href="{{ asset('vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    @if (isset($importCss))
        @foreach ($importCss as $name)
            <link href="{{ asset($name) }}.css" rel="stylesheet">
        @endforeach
    @endif

    <style>

    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

          <div id="loader">
              <div class="preloader">
              </div>
              <div class="loading">
                  <img src="{{ asset('images/loading.gif') }}" width="80">
                  <br>
                  <span class="loading-message">
                  </span>
              </div>
          </div>

          <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
              <div class="navbar nav_title" style="border: 0;">
                <a href="index.html" class="site_title"><i class="fa fa-shopping-cart"></i> <span>Uswah Mart</span></a>
              </div>

              <div class="clearfix"></div>

              <!-- menu profile quick info -->
              <div class="profile clearfix">
                <div class="profile_pic">
                  <img src="{{ empty(Auth::user()->img) ?  asset('images/admin-default.png') : asset('uploads/user/'. Auth::id(). '.'. Auth::user()->img) }}" alt="..." class="img-circle profile_img">
                </div>
                <div class="profile_info">
                  <span>Welcome,</span>
                  <h2>{{ Auth::user()->name }}</h2>
                </div>
              </div>
              <br />

              <!--MENU  -->
              @include('layouts.menu')

            </div>
          </div>

         @include('layouts.topnavigation')

        <!-- page content -->
        <section class="content">
            <div class="right_col" role="main">
              <div class="">
                <div class="page-title">
                  <div class="title_left">
                      <h3>
                          @if ( isset($title) )
                            {{ $title }}
                          @endif
                      </h3>
                      <span class="breadcrumb">
                          <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a>
                          @if (isset($breadCrumb))
                                @foreach ($breadCrumb as $menu => $url)
                                        @if (!empty($url))
                                            &#9900; <a href="{{ route($url) }}"> {{ $menu }} </a>
                                        @else
                                            &#9900; {{ $menu }}
                                        @endif
                                @endforeach
                          @endif
                      </span>
                  </div>
                </div>
                <div class="clearfix"></div>
                 <div id="content-data">
                    @yield('content')
                </div>
              </div>
            </div>
        </section>

        <!-- modal  -->
        <div class="modal fade modal-medium" id="modal-medium" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body" style="overflow-x: auto; height: 400px;">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div>

        <!-- ajax url  -->
        @if (isset($ajaxUrl))
            @foreach ($ajaxUrl as $name => $url)
                <input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ $url }}"  />
            @endforeach
        @endif
        <!-- footer -->
        @include('layouts.footer');
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('vendors/skycons/skycons.js') }}"></script>
    {{-- datatable --}}
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    {{-- hotekey --}}
    <script src="{{ asset('vendors/hotkeys-master/dist/hotkeys.min.js') }}"></script>
    <!-- Notification  -->
    <script src="{{ asset('vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('vendors/jstree/dist/jstree.min.js') }}"></script>

    <!-- library js  -->
    <script src="{{ asset('js/libs.js') }}"></script>
    <!-- jQuery custom content scroller -->
    <script src="{{ asset('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('js/custom.js') }}"></script>

    @if (isset($importJs))
        @foreach ($importJs as $name)
    <script src="{{ asset($name) }}.js"></script>
        @endforeach
    @endif

    <script type="text/javascript">
            $('#html1').jstree({
                "core" : {
                  "themes" : {
                    "variant" : "large"
                  }
                },
                 "plugins" : [ "wholerow", "checkbox", "html_data" ]
            });

    </script>

    @if (isset($userAccess))
        <script type="text/javascript">
            @foreach ($userAccess as $key => $val)
            $('#html1').jstree(true).select_node('{{ $val }}');

            @endforeach
        </script>
    @endif
    @if (isset($indexName))
    <script>
        LIBS._goToPage('<?php echo route($indexName)?>');
    </script>
    @endif

    @if (isset($menuAccessable[$accessRight['level']][$accessRight['id']]) &&
    $menuAccessable[$accessRight['level']][$accessRight['id']] == 'R')
        <style media="screen">
            #add-button {
                display: none;
            }

            #action {
                display: none;
            }
        </style>
    @endif

  </body>
</html>
