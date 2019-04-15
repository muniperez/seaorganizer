@extends('layouts.frontend.master')
@section('page-title','Contact Us')

@section('content')

<div class="m-t-60 p-t-40">
	<section class="p-b-75">
		<div class="container">
			
			<h1 class="text-center ">Contact Us</h1>

			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">

					<p class="text-center">Have any questions or need anything?</p>

					<p class="text-center">Just send us a message or talk to us on the chat. We will get back to you as soon as possible!</p>
            
		            <div class="panel" id="contact-panel">
					    
					    <form role="form" autocomplete="off" class="m-t-15" id="contact-form" action="/contact-us" method="post">

					    	{{csrf_field()}}

					        <div class="row">
					            <div class="col-sm-12">
					                <div class="form-group form-group-default required">
					                    <label class="control-label">Name</label>
					                    <input type="text" name="name" class="form-control" placeholder="Your name" required>
					                </div>
					            </div>
					        </div>
					        <div class="form-group form-group-default required">
					            <label class="control-label">Email</label>
					            <input type="email" name="email" placeholder="Insert your e-mail" class="form-control" required>
					        </div>
					        
					        <div class="form-group form-group-default required">
					            <label class="control-label">Subject</label>
					            <input type="subject" name="subject" placeholder="Write your subject" class="form-control" required>
					        </div>

					        <div class="form-group form-group-default required">
					            <label class="control-label">Message</label>
					            <textarea name="message" placeholder="Type the message you wish to send" style="height:100px" class="form-control" required></textarea>
					        </div>
					        <div class="sm-p-t-10 clearfix">
					            <button class="btn btn-primary font-montserrat all-caps fs-12 pull-right xs-pull-left">Submit</button>
					        </div>
					        <div class="clearfix"></div>
					    </form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

@endsection

@section('local-head')
<!-- Start of Async Drift Code -->
<script>
!function() {
  var t;
  if (t = window.driftt = window.drift = window.driftt || [], !t.init) return t.invoked ? void (window.console && console.error && console.error("Drift snippet included twice.")) : (t.invoked = !0, 
  t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
  t.factory = function(e) {
    return function() {
      var n;
      return n = Array.prototype.slice.call(arguments), n.unshift(e), t.push(n), t;
    };
  }, t.methods.forEach(function(e) {
    t[e] = t.factory(e);
  }), t.load = function(t) {
    var e, n, o, i;
    e = 3e5, i = Math.ceil(new Date() / e) * e, o = document.createElement("script"), 
    o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + i + "/" + t + ".js", 
    n = document.getElementsByTagName("script")[0], n.parentNode.insertBefore(o, n);
  });
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('x7zbbfur5vru');
</script>
<!-- End of Async Drift Code -->
@endsection