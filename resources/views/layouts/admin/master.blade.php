<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>@yield('page-title') - SeaOrganizer Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/png" href="/images/logos/icon60.png">

    <link rel="apple-touch-icon" href="/images/logos/icon60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/logos/icon76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/logos/icon120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/logos/icon152.png">
   
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Certificate management for seafarers." name="description" />
    <meta content="SeaOrganizer" name="author" />
    
    @include('layouts.admin.head')


    @yield('local-head')

    <!--[if lte IE 9]>
        <link href="/pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
    window.onload = function()
    {
      // fix for windows 8
      if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
        document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="/pages/css/windows.chrome.fix.css" />'
    }
    </script>
  </head>
  <body class="fixed-header horizontal-menu horizontal-app-menu ">

    @include('layouts.admin.menu')

    <!-- START PAGE-CONTAINER -->

    <div class="page-container ">
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content">
          @yield('breadcrumb')
            
            <div class="py-2 container container-fixed-lg sm-padding-10">
              
            @if(count($errors))

            <div class="form-group">
              <div class="alert alert-danger">
                @each('layouts.admin.error', $errors->all(), 'error')
              </div>
            </div>

            @endif

            @if(request()->session()->has('message'))
              <div class="form-group">
                <div class="alert alert-success">
                @component('layouts.admin.message', ['message' => session('message')]) @endcomponent
                </div>
              </div>
            @endif
            
            <h3 class="page-title" >@yield('page-title')</h3>

            <div id='app' >
              @yield('content')
            </div>

            <!-- END PLACE PAGE CONTENT HERE -->
          </div>
          <!-- END CONTAINER FLUID -->
        </div>
        
        <!-- END PAGE CONTENT -->
        
        <!-- END PAGE CONTENT WRAPPER -->

        <!-- START COPYRIGHT -->

        <!-- START CONTAINER FLUID -->
        <div class=" container   container-fixed-lg footer">
          <div class="copyright sm-text-center">
            <p class="no-margin pull-left sm-pull-reset">
              <span class="hint-text">Copyright © <?php echo date('Y') ?></span>
              <span class="font-montserrat">SeaOrganizer</span>.
              <span class="hint-text">All rights reserved. </span>
            </p>
            
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- END COPYRIGHT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->

    @yield('before-footer')
    
    @include('layouts.admin.footer')
    
    @yield('local-footer')

  </body>
</html>