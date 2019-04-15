@extends('layouts.master')
@section('page-title','Validate phone number')

@section('content')

<form method="post" id="payment-form" action="/account/validatePhone">
	{{csrf_field()}}
	
	<div class="row">
		<div class="col-lg-6 col-md-12">
			<div class="card full-width">
				<div class="card-block">
					<p>Insert the code you received on your phone to verify it.</p>
				</div>
				<div class="card-block">
					<div class="row">
						<div class="col">
							<div class="form-group" >
								<label for="staticPhone" >Phone number</label>
								<input type="text" readonly class="form-control-plaintext" id="staticPhone" value="+{{auth()->user()->phone_country}} {{auth()->user()->phone}}">
								<small class="form-text text-muted">Not your phone number? <a href="/account/getPhone" >Click here to change</a></small>
							</div>
						</div>
						<div class="col">
							
							<div class="form-group" >
								<label for="code" >Verification code</label>
								<input type="text" name="code" class="form-control" placeholder="4-digit code" >
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