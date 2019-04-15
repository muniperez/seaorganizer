<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to SeaOrganizer. Please verify your e-mail address</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

  </head>

  <body>

    <div class="container my-5">

      <div class="my-3 text-center">
        <a href="//www.seaorganizer.com" >
          <img src="https://www.seaorganizer.com/images/logos/retina.png" height="30" >
        </a>
      </div>

      <div class="card my-3">
        <div class="card-body">

          <h2>Welcome to SeaOrganizer!</h2>

          <p class="lead">Plase click the link below to verify your e-mail address</p>
        
          <p>
              <a href="{{url('account/validateEmail')}}/{{$user->email_token}}" class="btn btn-primary" >Validate e-mail</a>
          </p>

        </div>
      </div>

      <p>
        Thank you! <br/>
        Sincerely, SeaOrganizer Team.
      </p>

    </div><!-- /.container -->

  </body>
</html>