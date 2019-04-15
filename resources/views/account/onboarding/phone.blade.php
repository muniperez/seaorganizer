@extends('layouts.onboarding.master')
@section('page-title','Validate phone number')

@section('content')
<div class="row my-3">
    <div class="col">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            	<div class="text-center">
                    <h2>Phone validation</h2>

                    <p>Please insert the code we sent to your phone number.</p>

                    <p><a href="/onboarding/validatePhone" >Didn't get a code? Click here to resend</a></p>
                </div>

				<form method="post" id="payment-form" action="/onboarding/validatePhone">
					
					{{csrf_field()}}
					
					<div class="panel panel-default">
						<div class="panel-body">
							<h5>Phone number</h5>
							<p>+{{auth()->user()->phone_country}} {{auth()->user()->phone}}</p>
							<span class="help-block" class="form-text text-muted"><small>Not your phone number? <a href="/onboarding/location" >Click here to change</a></small></span>

							<h5>Verification code</h5>
							<input type="text" name="code" class="form-control" placeholder="4-digit code" required>

							<div class="form-group m-t-20" >
								<button type="submit" class="btn btn-primary" >Send code</button>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</section>
</div>

@endsection