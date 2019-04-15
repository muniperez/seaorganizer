@extends('layouts.master')
@section('page-title','Invite your friends')

@section('content')

<div class="row">
	<div class="col">

		<card-widget>
			<card-widget-content>
				<p class="lead">
					Every time a friend you invited subscribes, both of you <b>get 2 months free</b>! Your discount will be applied on your next billing cycle.
				</p>
			</card-widget-content>
		</card-widget>

		<card-widget>

			<card-widget-content>
				<h4>Invite your friends!</h4>
				<div 	class="sharethis-inline-share-buttons" 
						data-url="{{$url}}" 
						data-title="Certificate Management For Seafarers - SeaOrganicer.com"
						data-description="With SeaOrganicer you don't have to worry about when your certificates will expire. Join with this invitation and get 2 months off!"
					>
					
					</div>
			</card-widget-content>

			<card-widget-content>
				<h4>Share via e-mail</h4>
				
				<form method="post" action="/account/invite" >
					{{csrf_field()}}

					<div class="form-group">
						<input type="text" name="name" placeholder="Person's name" class="form-control" required>
					</div>

					<div class="form-group">
						<input type="email" name="email" placeholder="Person's email" class="form-control" required>
					</div>

					<div class="form-group">
						<button class="btn btn-success" type="submit" >Send invite</button>
					</div>
				</form>
			</card-widget-content>
			
			<card-widget-content>
				<h4>Invitation link</h4>
				 
				<a href="{{$url}}" target="_blank" >
					{{$url}}
				</a>

			</card-widget-content>

		</card-widget>

	</div>
</div>

@endsection

@section('local-head')
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a236eb031a4050013671287&product=inline-share-buttons' async='async'></script>
@endsection