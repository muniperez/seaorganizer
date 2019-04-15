@extends('layouts.frontend.master')
@section('page-title','Certificate management for seafarers')

@section('jumbotron')
	<section class="jumbotron full-vh" data-pages="parallax">
        <div class="inner full-height">
          <!-- BEGIN SLIDER -->
          <div class="swiper-container" id="hero">
            <div class="swiper-wrapper">

              <!-- BEGIN SLIDE -->
              <div class="swiper-slide fit">
                <!-- BEGIN IMAGE PARRALAX -->
                <div class="slider-wrapper">
                  <div class="background-wrapper" data-swiper-parallax="30%">
                    <!-- YOUR BACKGROUND IMAGE HERE, YOU CAN ALSO USE IMG with the same classes -->
                    <div  class="background"  data-pages-bg-image="/images/backgrounds/8.jpg"></div>
                  </div>
                </div>
                <!-- END IMAGE PARRALAX -->
                <!-- BEGIN CONTENT -->
                <div class="content-layer">
                	<div class="circular_object bg-primary" 
                        data-pages-animation="custom" 
                        data-attr="scale" 
                        data-start="21" 
                        data-end="0" 
                        data-duration="500" 
                        data-delay="600" 

                        data-lg-attr="scale" 
                        data-lg-start="26" 
                        data-lg-end="0" 
                        data-lg-duration="500" 
                        data-lg-delay="600" 

                        data-vlg-attr="scale" 
                        data-vlg-start="35" 
                        data-vlg-end="0" 
                        data-vlg-duration="500" 
                        data-vlg-delay="600">
                        </div>

                  <div class="inner full-height">
                    <div class="container-xs-height full-height">
                      <div class="col-xs-height col-middle text-left">
                        <div class="container">
                          <div class="col-md-6 no-padding col-xs-10 col-xs-offset-1">
                            <h1 class="dark text-white sm-text-center" data-swiper-parallax="-15%">Certificate Management For Seafarers.</h1>
                            <h4 class="sm-text-center text-white">Never worry again about an expiring certificate!</h4>
                            <p class="sm-text-center m-t-15">
                            	<a href="{{route('register')}}" class="btn btn-success btn-lg" >Sign-up now!</a>
                            </p>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- END CONTENT -->
              </div>
              <!-- END SLIDE -->

            </div>
            <!-- BEGIN ANIMATED MOUSE -->
            <div class="mouse-wrapper">
              <div class="mouse">
                <div class="mouse-scroll"></div>
              </div>
            </div>
            
          </div>
        </div>
        <!-- END SLIDER -->
      </section>
@endsection

@section('content')

      <!-- BEGIN CONTENT SECTION -->
      <section class="bg-primary p-b-85 p-t-75">
        <div class="container">
          <div class="md-p-l-20 md-p-r-20 xs-no-padding">
            
            <div class="row">
              <div class="col-sm-5 col-md-4">
                <h1 class="text-white">A new way to keep track of your certificates.</h1>
              </div>
              <div class="col-sm-7 col-md-8 no-padding xs-p-l-15 xs-p-r-15">
                <div class="p-t-20 p-l-35 md-p-l-5 md-p-t-15">
                	<p>
                		Having your certificates always valid is one of the most important aspects of a seafarer's life. However, remembering when to renew them is not easy.
                	</p>
                	<p class="m-t-20">
                		With <b>SeaOrganizer</b> you can forget about relying on Excel spreadsheets or your own memory.
                	</p>
                  	<p class="m-t-20">
                  		We send you alerts to keep you informed of when you need to take action.
                  	</p>

                  	<p class="m-t-20">
                  		<a href="{{route('register')}}" class="btn btn-success btn" >Sign-up now!</a>
                  	</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- END CONTENT SECTION -->

      <!-- BEGIN CONTENT SECTION -->
      <section class="p-b-85 p-t-75 no-overflow">
        <div class="container">
          <div class="md-p-l-20 md-p-r-20 xs-no-padding">
            <div class="row">
              <div class="col-sm-5">
                <h1 class="m-t-5 m-b-20">How does it work?</h1>
                <p class="m-b-20">With just 3 steps, you are all set:</p>

                  <ol>
                      <li class="lead">Validate your e-mail and phone number</li>
                      <li class="lead">Insert your certificates and their expiration dates.</li>
                      <li class="lead">When a certificate needs attention, we will text and e-mail you.</li>
                  </ol>

                <p>
                	<a href="{{route('register')}}" class="btn btn-success btn-lg" >Sign-up now!</a>
                </p>

              </div>
              <div class="col-sm-7 no-padding xs-p-l-15 xs-p-r-15">
                  <div class="content-mask-md"> 
                    <div class="device_morph pull-center-inner" id="iphone01" data-pages="float"  data-max-top-translate="40"
                        data-max-bottom-translate="300"
                        data-speed = "-0.1"
                        data-delay="1000"
                        data-curve="ease">
                        
                        <img alt="" class="xs-image-responsive-height image-responsive-width" src="/front/assets/images/b_phone.png" >
                        <div class="screen">
                            <div class="iphone-border">
                                <img src="/images/others/phone_1.png" class="image-responsive-height lazy" alt="">
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

    <section class="bg-primary p-b-85 p-t-75">
        <div class="container text-center">
        	<h1 class="text-white" >It is that simple!</h1>

        	<p class="m-t-20">
        		<a href="{{route('register')}}" class="btn btn-success btn-lg" >Sign-up now!</a>
        	</p>

        </div>
    </section>
	<!-- BEGIN CONTENT SECTION -->
	<section class="p-b-85 p-t-75 p-b-65 p-t-55">
        <div class="container text-center">
          	
          	<h1>Features</h1>

          	<p>Check out what we have to offer.</p>

          	<div class="m-t-60">
	          	<div class="md-p-l-20 xs-no-padding clearfix">
					<div class="col-sm-4 no-padding">
					  <div class="p-r-40 md-pr-30">
					    <span class="fa-stack fa-3x">
							<i class="fa fa-circle fa-stack-2x"></i>
						  	<i class="fa fa-lock fa-stack-1x fa-inverse"></i>
						</span>

					    <h6 class="block-title p-b-5">Secure</h6>
					    <p class="m-b-30">Your information is kept private and secure on an enterprise-grade cloud server.</p>
					    <p class="muted font-arial small-text">We host our data on Heroku and Amazon and our connection is encrypted over SSL.</p>
					  </div>
					  <div class="visible-xs b-b b-grey-light m-t-30 m-b-30"></div>
					</div>
					<div class="col-sm-4 no-padding">
					  <div class="p-r-40 md-pr-30">
					    <span class="fa-stack fa-3x">
							<i class="fa fa-circle fa-stack-2x"></i>
						  	<i class="fa fa-smile-o fa-stack-1x fa-inverse"></i>
						</span>

					    <h6 class="block-title p-b-5">Very simple</h6>
					    <p class="m-b-30">Set up once and forget about it! We want you to relax and enjoy your time off.</p>
					    <p class="muted font-arial small-text">We will reach out to you when needed.</p>
					  </div>
					  <div class="visible-xs b-b b-grey-light m-t-30 m-b-30"></div>
					</div>
					<div class="col-sm-4 no-padding">
					  <div class="p-r-40 md-pr-30">
					    <span class="fa-stack fa-3x">
							<i class="fa fa-circle fa-stack-2x"></i>
						  	<i class="fa fa-cloud-download fa-stack-1x fa-inverse"></i>
						</span>

					    <h6 class="block-title p-b-5">Cloud file upload</h6>
					    <p class="m-b-30">Save a copy of each certificate on our Amazon S3 servers and have them ready to send.</p>
					    <p class="muted font-arial small-text">E-mail them from anywhere. All you have to do is log-in and hit "Send".</p>
					  </div>
					</div>
	          	</div>
	        </div>

        </div>
    </section>
      <!-- END CONTENT SECTION -->

@endsection

@section('local-head')
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a236eb031a4050013671287&product=inline-share-buttons' async='async'></script>
@endsection