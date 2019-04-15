<!DOCTYPE html>
	<html>
  		<head>

		    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		    <meta charset="utf-8" />
		    <title>@yield('page-title') - SeaOrganizer</title>
		    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		    <!-- CSRF Token -->
    		<meta name="csrf-token" content="{{ csrf_token() }}">

    		<meta name="description" content="We keep track of your certificates so you don't have to worry about their expiration date. We will send you alerts via text and e-mail when it is time to renew them. You can also store a copy of each document on our secure cloud server." >

    		<meta content="SeaOrganizer" name="author" />

    		<meta name="keywords" content="certificates, certificate, seafarer, maritime, shipping, marine, certification, documents, expiration date, training, marine training, maritime training, organization" >

    		<meta name="robots" content="index, follow" >

		    @include('layouts.frontend.head')


    		@yield('local-head')

		</head>
	  	<body class="pace-dark">
		    
		    @include('layouts.frontend.menu')

		    <div class="page-wrappers" id="app">

		    	@if(request()->session()->has('message'))
			    	<div class="m-t-60 p-t-60">
						<section class="">
							<div class="container">
								<div class="form-group">
					                <div class="alert alert-success">
					                @component('layouts.message', ['message' => session('message')]) @endcomponent
					                </div>
					            </div>
							</div>
						</section>
					</div>
	            @endif

	            @if(count($errors))
			    	<div class="m-t-60">
						<section class="p-t-60 p-b-10">
							<div class="container">
								<div class="form-group">
					              <div class="alert alert-danger">
					                @each('layouts.error', $errors->all(), 'error')
					              </div>
					            </div>
							</div>
						</section>
					</div>
	            @endif

		    	@yield('jumbotron')

		    	@yield('content')

			    @include('layouts.frontend.footer-section')

		    </div>

		    @yield('before-footer')
		    
			@include('layouts.frontend.footer')

			@yield('local-footer')

		</body>
	</html>