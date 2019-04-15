@extends('layouts.onboarding.master')
@section('page-title','Payment')

@section('content')

<div class="m-t-60" >
    <section class="container container-fixed-lg p-t-65 p-b-100  sm-p-b-30 sm-m-b-30">
    	<div class="row">
    		<div class="col-lg-8 col-lg-offset-2">
				<form method="post" id="payment-form" action="/onboarding/subscribe">
					{{csrf_field()}}

					<div class="text-center">
	                    <h2>Payment</h2>
	                </div>

					<div class="panel panel-default m-t-60">
						<div class="panel-body">
			
							<div class="row">
					            <div class="col-lg-6 col-md-6 text-center">                
			                        <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">
			                            Subscription
			                        </p>
			                        <h5 class="no-margin overflow-ellipsis">
			                            {{$planLabel}}
			                        </h5>
					            </div>
					            <div class="col-lg-6 col-md-6 text-center">
					                <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">
					                    Amount to be paid
									</p>
			                        <h5 class="no-margin overflow-ellipsis ">
			                            ${{$amount}} / {{$period}}
			                        </h5>
					            </div>
					        </div>
	    				</div>
					    <div class="panel-body">
					    	<input id="plan" name="plan" type="hidden" value="{{$plan}}" />
					    	<input id="nonce" name="payment_method_nonce" type="hidden" />
							<div id="dropin-container"></div>
					    </div>
					</div>

					<button id="submit-button" class="btn btn-success btn-lg">Complete subscription</button>

				</form>
			</div>
		</div>
	</section>
</div>

@endsection

@section('local-footer')

<script src="https://js.braintreegateway.com/web/dropin/1.7.0/js/dropin.min.js"></script>
  
<script>
	var button = document.querySelector('#submit-button');
	var form = document.querySelector('#payment-form');

	braintree.dropin.create({
	  authorization: '{{$clientToken}}',
	  container: '#dropin-container',
	  paypal: {
			    flow: 'vault'
			  },

	}, function (createErr, instance) {

	  button.addEventListener('click', function () {
	    instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
	      // Submit payload.nonce to your server

	      	if (requestPaymentMethodErr) {
                console.log('Error', requestPaymentMethodErr);
                return;
              }
              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              
              form.submit();

	    });

	  });

	});
</script>

@endsection