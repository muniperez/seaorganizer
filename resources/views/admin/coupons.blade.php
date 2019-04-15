@extends('layouts.admin.master')
@section('page-title','Coupons')

@section('content')

<card-widget card-title="Add coupon">
	<card-widget-content>
		<form method="post" action="{{url('panel/coupons')}}" >
			{{csrf_field()}}

			<div class="row">

				<div class="col">
					<div class="form-group">
						<input type="text" name="amount" class="form-control" placeholder="Amount off">
					</div>
				</div>

				<div class="col">
					<div class="form-group">
						<input type="text" name="code" class="form-control" placeholder="Code" value="{{str_random(10)}}" >
					</div>
				</div>

				<div class="col">
					<div class="form-group">
						<button type="submit" class="btn btn-success" >Save</button>
					</div>
				</div>
			</div>
		</form>
	</card-widget-content>
</card-widget>

<app-list>

	@foreach($coupons as $coupon)
		
		<app-list-item>

			<div>
				<h4>{{$coupon->code}}</h4>
				@if($coupon->status > 0)
					<p class="text-success" >${{($coupon->amount/100)}} off | created {{$coupon->created_at->diffForHumans()}}</p>
				@endif
			</div>

			@if($coupon->status == 0)
				<form method="post" action="{{url("panel/coupons/$coupon->code")}}" >
					{{csrf_field()}}
					{{method_field('PATCH')}}

					<button type="submit" class="btn btn-default btn-sm" ><i class="fa fa-bolt"></i> Activate</button>
				</form>

			@else

				<form method="post" action="{{url("panel/coupons/$coupon->code")}}" >
					{{csrf_field()}}
					{{method_field('DELETE')}}

					<button type="submit" class="btn btn-danger btn-xs" ><i class="fa fa-times"></i> delete</button>
				</form>

			@endif

		</app-list-item>

	@endforeach

</app-list>

@endsection