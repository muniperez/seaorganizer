@extends('layouts.master')
@section('page-title','Validate phone number')

@section('content')

<form method="post" id="payment-form" action="/account/getPhone">
	{{csrf_field()}}
	
	<div class="row">
		<div class="col-lg-6 col-md-12">
			<div class="card full-width">
				<div class="card-block">
					<p>Please confirm your phone number. You will receive a code to validate this number so you can receive alerts on your phone.</p>
				</div>
				<div class="card-block">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group" >
								<label for="country_code" >Country code</label>
								<div class="input-group">
									<span class="input-group-addon">
										+
									</span>
									<input type="text" name="country_code" class="form-control" placeholder="Country code" >
								</div>
							</div>
						</div>
						<div class="col-sm-8">
							
							<div class="form-group" >
								<label for="phone" >Phone (only numbers)</label>
								<input type="text" name="phone" class="form-control" placeholder="Only numbers" >
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary" >Send code</button>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection