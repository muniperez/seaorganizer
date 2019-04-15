@extends('layouts.onboarding.master')
@section('page-title','Add certificates')

@section('content')
<div class="row my-3">
    <div class="col">

        <div class="text-center mb-3">
            <p>Let's get started! Insert the certificates you want to keep track and add their expiration date. Oh, you can also upload a file to our secure Amazon Cloud!</p>
        </div>
        
        <onboarding-certificates></onboarding-certificates>

    </div>
</div>
@endsection