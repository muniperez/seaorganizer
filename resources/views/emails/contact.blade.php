<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contact form: {{$request->subject}}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

  </head>

  <body>

    <div class="container">

      <div class="card">
        <div class="card-body">
          <h1>We received a new e-mail message</h1>
          
          <p>From: <b>{{$request->name}}</b> ({{$request->email}})</p>
          <p>When: {{date('d/m/Y - h:i')}}</p>

          <p>Message:</p>
          <p><h3>{{$request->subject}}</h3></p>
          <p>{{$request->message}}</p>
        
        </div>
      </div>

    </div><!-- /.container -->

  </body>
</html>