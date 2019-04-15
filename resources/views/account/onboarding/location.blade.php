@extends('layouts.onboarding.master')
@section('page-title','Phone validation')

@section('content')
<div class="row my-3">
    <div class="col">

        <p class="text-center">Please provide your location and phone number so we can send you alerts about your expiring certificates.</p>
                
        <phone-validation/>
                
    </div>
</div>


@endsection

@section('local-head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/css/flag-icon.css" integrity="sha256-uNjm68xPD+6gnVc/JWO6c0TgsEu/PqsXTc9djrPqhOw=" crossorigin="anonymous" />
@endsection