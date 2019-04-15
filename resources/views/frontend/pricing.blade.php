@extends('layouts.frontend.master')
@section('page-title','Pricing')

@section('content')
<div class="m-t-60">
	<section class="p-t-40 p-b-75">
		<div class="container p-t-50">
			
			<h1 class="text-center ">Pricing</h1>
			<p class="text-center">For less than a coffee per month, we will manage your certificates expiration so you don't have to worry about them!</p>
			
			<div class="p-l-30 p-r-30 m-t-50">
				<div class="row">

					<div class="col-sm-12 p-l-5 p-r-5">
						<div class="pricing-headingm m-t-45">
							<div class="bg-master-light p-t-60 p-b-60">
								<h1 class="text-center m-b-25 font-montserrat">$2.49 / month</h1>
								
								<p class="text-center">
									<a href="{{route('register')}}" class="btn btn-lg btn-success" >
										Subscribe
									</a>
								</p>
								
							</div>
						</div>
						<div class="pricing-details bg-white p-t-30 p-b-30 p-l-40 p-r-40 md-p-l-20 md-p-r-20 text-center">
							<span class="small text-center">You will be charged per year</span>
						</div>
					</div>

					<!-- <div class="col-sm-6 p-l-5 p-r-5 xs-m-t-40">
						<div class="pricing-heading xs-p-t-10">
							<div class="m-l-15 m-r-15 bg-primary padding-10">
								<h5 class="block-title text-center text-white no-margin">Recommended</h5>
							</div>
							<div class="bg-master-light p-t-60 p-b-60">
								<h1 class="text-center m-b-25 font-montserrat">$28 / year <small>(save 20%)</small></h1>

								<p class="text-center">
									<a href="/subscribe/year" class="btn btn-lg btn-success" >
										Subscribe
									</a>
								</p>
							</div>
							<div class="bg-master-darker p-t-20 p-b-20">
								<h5 class="block-title text-center text-white no-margin">Yearly</h5>
							</div>
						</div>
						<div class="pricing-details bg-white p-t-30 p-b-30 p-l-40 p-r-40 md-p-l-20 md-p-r-20 text-center">
							
						</div>
					</div> -->

				</div>
			</div>
			<div class="p-l-30 p-r-30">
				<div class="row">

					<div class="col-sm-12 p-l-5 p-r-5">
						<div class="pricing-details bg-white p-b-30 p-l-40 p-r-40 md-p-l-20 md-p-r-20 text-center">
							<ul class="no-style">
								<li class="text-black fs-16 normal m-b-25"><span class="bold">Text alerts</span> - Receive updates on your phone</li>
								<li class="text-black fs-16 normal m-b-25"><span class="bold">E-mail alerts</span> - Several ways to keep track of your certificates</li>
								<li class="text-black fs-16 normal m-b-25"><span class="bold">Cloud Upload</span> - Store a copy of each document securely on the cloud</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
</div>
@endsection