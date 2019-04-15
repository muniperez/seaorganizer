@extends('layouts.frontend.master')
@section('page-title','Subscribe to plan')

@section('content')

<form method="post" id="payment-form" action="/subscribe">
	{{csrf_field()}}

	<div class="card full-width">
		<div class="card-block">
			
			<div class="row">
	            <div class="col">
	                <div class="d-flex">
	                    <div class="flex-1 full-width overflow-ellipsis">
	                        <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">
	                            Subscription
	                        </p>
	                        <h5 class="no-margin overflow-ellipsis">
	                            {{$planLabel}}
	                        </h5>
	                    </div>
	                </div>
	            </div>
	            <div class="col">
	                <div class="d-flex">
	                    <div class="flex-1 full-width overflow-ellipsis">
	                        <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">
	                            Amount to be paid
	                        </p>
	                        <h5 class="no-margin overflow-ellipsis ">
	                            ${{$amount}} / {{$period}}
	                        </h5>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="card-block">
	    	<input id="plan" name="plan" type="hidden" value="{{$plan}}" />
	    	<input id="nonce" name="payment_method_nonce" type="hidden" />
			<div id="dropin-container"></div>
	    </div>
		<div class="card-footer">
			<button id="submit-button" class="btn btn-success btn-lg">Complete subscription</button>
		</div>
	</div>
</form>

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