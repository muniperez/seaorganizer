@extends('layouts.master')
@section('page-title','Choose subscription')

@section('content')

<div class="row">
  	<div class="col">

  		<card-widget>

        	<card-widget-content>
          		<h3>Choose your subscription</h3>

                Current: <b>{{ $subscription->stripe_plan }}</b>
        	</card-widget-content>
        
        </card-widget>

        <form method="post" action="/account/subscription" >

            {{csrf_field()}}
            {{method_field('PATCH')}}

            <input type="hidden" name="plan" value="month" >

            <card-widget>
                <card-widget-content>
                    Monthly - $2.99 / month
                </card-widget-content>

                <card-widget-content>
                    <button type="submit" class="btn btn-success btn-sm" >Select</button>
                </card-widget-content>
            </card-widget>
        </form>

        <form method="post" action="/account/subscription" >

            {{csrf_field()}}
            {{method_field('PATCH')}}
            
            <input type="hidden" name="plan" value="year" >

            <card-widget>
                
                <card-widget-content>
                    Yearly - $29.99 / year
                </card-widget-content>

                <card-widget-content>
                    <button type="submit" class="btn btn-success btn-sm" >Select</button>
                </card-widget-content>

            </card-widget>

        </form>

        <card-widget>

        	<card-widget-content>
        		<a href="/account/subscription"><i class="fa fa-times"></i> Cancel</a>
        	</card-widget-content>

        </card-widget>

	</div>
</div>

@endsection