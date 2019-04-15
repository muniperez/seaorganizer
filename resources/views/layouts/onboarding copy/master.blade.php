<!DOCTYPE html>
	<html>
  		<head>

		    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		    <meta charset="utf-8" />
		    <title>@yield('page-title') - SeaOrganizer</title>
		    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		    <!-- CSRF Token -->
    		<meta name="csrf-token" content="{{ csrf_token() }}">

		    @include('layouts.onboarding.head')


    		@yield('local-head')

		</head>
	  	<body class="pace-dark">
		    
		    @include('layouts.onboarding.menu')

		    <div class="page-wrappers" id="app">

		    	@yield('content')

			    @include('layouts.onboarding.footer-section')

		    </div>

		    @yield('before-footer')

			@include('layouts.onboarding.footer')

			@yield('local-footer')

	</body>
</html>