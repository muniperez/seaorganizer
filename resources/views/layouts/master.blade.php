<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>@yield('page-title') - SeaOrganizer</title>
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
    
    @include('layouts.head')


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

    @include('layouts.menu')

    <!-- START PAGE-CONTAINER -->

    <div class="page-container ">
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content">
          @yield('breadcrumb')
          
          <!-- START CONTAINER FLUID -->
          <div class="py-2 container container-fixed-lg sm-padding-10">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->

            @if(!Cookie::get('hide_invite_alert') && Route::currentRouteName() != 'inviteFriends')

              <div class="form-group">
                <div class="alert alert-success">
                  <h4>Invite your friends!</h4>
                  <p>For each friend that signs up, both of you get <b>2 months off</b>!</p>

                  <div class="my-2">
                    <a href="{{route('invite.view')}}" class="btn btn-success">Send invites</a>
                    <small class="float-right"><a href="{{route('invite.hide')}}"><i class="fa fa-times"></i> hide</a></small>
                  </div>

                </div>
              </div>

            @endif
          
            @if(count($errors))

            <div class="form-group">
              <div class="alert alert-danger">
                @each('layouts.error', $errors->all(), 'error')
              </div>
            </div>

            @endif

            @if(request()->session()->has('message'))
              <div class="form-group">
                <div class="alert alert-success">
                @component('layouts.message', ['message' => session('message')]) @endcomponent
                </div>
              </div>
            @endif
            
            @if(!auth()->user()->verified)
              @include('components.alerts.verification')
            @endif

            @if(Route::currentRouteName() != 'certificates.add')
            <div class="row my-3 d-block d-lg-none">
              <div class="col-sm-12">
                <a class="btn btn-primary btn-block" href="{{route('certificates.add')}}" >
                    <i class="fa fa-plus"></i> New certificate
                </a>
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
              <span class="sm-block">
                
                <a href="/tos" class="mx-2">Terms Of Service</a> 
                
                <span class="muted">|</span> 
                
                <a href="/privacy" class="mx-2">Privacy Policy</a></span>
                
                <span class="muted">|</span> 
                
                <a href="/contact-us" class="mx-2">Contact &amp; Support</a></span>

            </p>
            
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- END COPYRIGHT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->

    @include('components.dialogs')

    @yield('before-footer')
    
    @include('layouts.footer')
    @include('layouts.vars')
    
    @yield('local-footer')

  </body>
</html>