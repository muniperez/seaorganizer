@extends('layouts.frontend.master')
@section('page-title','FAQ')

@section('content')

<div class="m-t-60 p-t-40">
	<section class="p-b-75">
		<div class="container">
			
			<h1 class="text-center ">FAQ</h1>

			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<p class="text-center">Have questions? No problem, we are here to answer them!</p>
					
					<h4>How does it work?</h4>

					<p>
						You will insert your certificates information such as name, expiration date and flag. Our system will then keep track of how many months are left before they expire.
					</p>

					<p>
						You will receive alerts when your certificates have 12 months, 6 months, 3 months, 1 month and a few weeks before they expire, via text and e-mail.
					</p>


					<h4>Can I sync this information with my calendar app?</h4>
					<p>
						Sure! There's a button on the dashboard to integrate with your calendar.
					</p>

					<h4>What happens when a certificate expires?</h4>

					<p>
						We will let you know ahead of time when it is about to expire. After that, you have to manually renew them on the website. We will send an e-mail and text alert with a direct link to mark the certificate as renewed. Also, we will gather seafarers in the same region to obtain discounts for larger groups so they can renew their certificates at a lower cost.
					</p>

					<h4>Do I get anything by inviting my friends?</h4>

					<p>Yes! If you invite someone, you both get 2 months off in your subscriptions. There's more: you can invite as many friends you want, and your discount will acumulate.</p>

					<p>Please note that your discounts will be applied in your next billing period.</p>

				</div>
			</div>
		</div>
	</section>
</div>

@endsection