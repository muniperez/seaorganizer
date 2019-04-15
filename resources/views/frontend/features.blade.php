@extends('layouts.frontend.master')
@section('page-title','Features')

@section('content')
<div class="m-t-60">
  <section class="p-b-60 p-t-60 bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1 class="m-t-5 text-white">Features</h1>

                <h3 class="text-white">The best cloud platform to manage all your certificates.</h3>
            </div>
        </div>
    </div>
  </section>

  <section class="text-center no-overflow bg-primary">
      <img src="/images/others/mockups/ipad-dashboard.png" alt="" class="image-responsive-width md-image-responsive-height" style="width: 60%;" >
  </section>

  <section class="bg-master-lightest p-b-85 p-t-75 no-overflow">
    <div class="container">
      <div class="md-p-l-20 md-p-r-20 xs-no-padding">
        
        <h5 class="block-title hint-text no-margin">Extremely simple</h5>

        <div class="row">
          <div class="col-sm-6 p-b-10">
            <h1 class="m-t-5 m-b-20">Fire and forget</h1>
            
            <p class="lead">Add your certificates once and let us handle the rest.</p>
            
            <p class="lead">We will keep track of their expiration date and we can even store a copy of each document for you!</p>

            <p class="lead">When it is time to  renew them, we will reach out to you via text and e-mail.</p>

            <p>
              <a href="{{route('register')}}" class="btn btn-success btn-lg btn-block" >Sign-up now!</a>
            </p>

          </div>
          
          <div class="col-sm-6 no-padding xs-p-l-15 xs-p-r-15">
            <div class="content-mask-md">
                <div class="pull-center-inner">
                  <img src="/images/others/mockups/iphone-list.png" alt="" class="md-image-responsive-height" style="" >
                </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="bg-primary p-b-85 p-t-75 no-overflow text-white">
    <div class="container">
      <div class="md-p-l-20 md-p-r-20 xs-no-padding">

        <div class="row">

          <div class="col-sm-6 no-padding xs-p-l-15 xs-p-r-15">
            <div class="content-mask-md">
                <div class="pull-center-inner">
                  <img src="/images/others/mockups/calendars.png" alt="" class="md-image-responsive-height" style="width: 80%" >
                </div>
            </div>
          </div>

          <div class="col-sm-6">
            <h5 class="block-title hint-text no-margin text-white">Stay organized</h5>
            <h1 class="m-t-5 m-b-20 text-white">Sync with your favorite calendar</h1>
            
            <p class="m-b-10">You can add the expiration dates in your favorite calendar service to help you stay even more organized.</p>
            
            <p class="m-b-20">But don't worry, we will still send you texts and e-mails so you won't miss anything.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="p-b-85 p-t-75">
    <div class="container text-center">
      
      <div class="row">
        <div class="col-sm-12">
          <h5 class="block-title hint-text no-margin">On the cloud</h5>
          <h1 class="m-t-5 m-b-20">Access it from anywhere</h1>
          <p class="lead">From your phone, tablet or computer.</p>

          <p class="m-b-20">
            <img src="/images/others/mockups/devices.png" alt="" class="image-responsive-width" style="width: 70%" >
          </p>

          <div class="row">
            <div class="col-sm-12 col-lg-6 col-lg-offset-3 m-t-20">
              <a href="{{route('register')}}" class="btn btn-success btn-lg btn-block" >Sign-up now!</a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

  <section class="p-b-85 p-t-75">
    <div class="container text-center">
      
      <div class="row">
        <div class="col-sm-12">
          <h5 class="block-title hint-text no-margin">Privacy first</h5>
          <h1 class="m-t-5 m-b-20">Your data is secured!</h1>
          <p class="m-b-10">Your personal information is safely stored on the most secure and advanced cloud providers.</p>

          <div class="row m-t-60">
            <div class="col-sm-3 col-sm-offset-1 p-b-20 m-b-20">
              <img src="/images/others/providers/heroku.png" alt="" class="" >
            </div>

            <div class="col-sm-4 p-b-20 m-b-20">
              <img src="/images/others/providers/aws.png" alt="" class="image-responsive-width" style="" >
            </div>

            <div class="col-sm-3 p-b-20 m-b-20">
              <img src="/images/others/providers/ssl.png" alt="" class="image-responsive-width" style="" >
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

</div>
@endsection