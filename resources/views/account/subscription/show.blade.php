@extends('layouts.master')
@section('page-title','Manage subscription')

@section('content')

<div class="row">
  	<div class="col">

  		<card-widget card-title="Subscription" >

        	<card-widget-content>
          		Subscription type
            	
            	<h4 class="m-0">{{$subscription->stripe_plan}}</h4>
        	</card-widget-content>

        </card-widget>

        <card-widget card-title="Invoices" >
        	
        	<card-widget-content>

        		<ul>
        			
        			@foreach($user->invoices() as $invoice)

        			<li>
        				{{ $invoice->date()->toFormattedDateString() }} - 
        				US$ {{ $invoice->total() }} - 
        				<a href="/account/subscription/invoice/{{ $invoice->id }}">Download</a>
        			</li>

        			@endforeach

        		</ul>

        	</card-widget-content>

        </card-widget>

        <card-widget card-title="Cancel subscription" >

        	<card-widget-content>

        		<form method="post" action="/account/subscription" >
        			
        			{{csrf_field()}}
		    		{{method_field('DELETE')}}

        			<p>If you cancel your subscription, your account will still work until the end of your billing period.</p>

        			<p>
    					<button class="btn btn-danger" type="subscription" >Cancel</button>
    				</p>

    			</form>

        	</card-widget-content>

        </card-widget>

	</div>
</div>

@endsection