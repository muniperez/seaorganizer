<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Sign In - SeaOrganizer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />

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

    <link href="/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="pages/css/themes/modern.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    window.onload = function()
    {
      // fix for windows 8
      if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
        document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="/pages/css/windows.chrome.fix.css" />'
    }
    </script>
</head>

    <body class="fixed-header ">
        <div class="login-wrapper ">
        <!-- START Login Background Pic Wrapper-->
            <div class="bg-pic">
                <!-- START Background Pic-->
                <img src="/images/backgrounds/1.jpg" data-src="/images/backgrounds/1.jpg" data-src-retina="/images/backgrounds/1.jpg" alt="" class="lazy">
                <!-- END Background Pic-->
                <!-- START Background Caption-->
                <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
                  <h2 class="semi-bold text-white">
                            SeaOrganizer makes it easy to manage your certificates.</h2>
                  <p class="small">
                    &copy; {{date('Y')}} SeaOrganizer.
                  </p>
                </div>
            <!-- END Background Caption-->
            </div>
            <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
            <div class="login-container bg-white">
                <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
                    <a href="/">
                        <img src="/images/logos/text.png" alt="logo" data-src="/images/logos/text.png" data-src-retina="/images/logos/retina.png" height="22">
                    </a>
                  
                    <h3 class="p-t-35">Sign into your account</h3>

                    <form class="p-t-15" method="POST" action="{{ route('login') }}">

                        {{ csrf_field() }}

                        <div class="m-b-15" >
                            <a href="/login/facebook" class="btn btn-primary btn-block" ><i class="fa fa-facebook"></i> Connect with Facebook</a>
                        </div>

                        <div class="text-center m-b-20 m-t-15">
                            - or -
                        </div>

                            <!-- <div class="col">
                                <a href="#" class="btn btn-primary btn-block" ><i class="fa fa-linkedin"></i></a>
                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-primary btn-block" ><i class="fa fa-google"></i></a>
                            </div> -->

                        <div class="form-group form-group-default">
                            <label for="email" >E-Mail Address</label>

                            <div class="controls">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group form-group-default">
                            <label for="password" >Password</label>

                            <div class="controls">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6 no-padding sm-p-l-10">
                                <div class="checkbox ">
                                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">Keep Me Signed in</label>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-end">
                                <a href="{{ route('password.request') }}" class="text-info small">Forgot your password?</a>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-cons m-t-10" type="submit">Sign in</button>
                    </form>
                    <!--END Login Form-->
                </div>

                <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40 text-center">
                    <h2>Don't have an account?</h2>
                    
                    <a href="{{route('register')}}" class="btn btn-success btn-lg">Click here to sign up!</a>
                </div>
            </div>
        </div>
    
    <!-- BEGIN VENDOR JS -->
    <script src="/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/tether/js/tether.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/classie/classie.js"></script>
    <script src="/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <!-- END VENDOR JS -->
    <script src="/pages/js/pages.min.js"></script>
    <script>
    $(function()
    {
      $('#form-login').validate()
    })
    </script>
  </body>
</html>