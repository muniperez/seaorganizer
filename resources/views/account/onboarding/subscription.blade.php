@extends('layouts.onboarding.master')
@section('page-title','Start your subscription')

@section('content')
<div class="row my-3">
    <div class="col">
        
        <payment-form></payment-form>

    </div>
</div>
@endsection

@section('before-footer')
    
    <script>
        var AppData = {
            
            stripeKey: '{{ config('services.stripe.key') }}',
            logo: '/images/logos/icon_blue.png'
        }
    </script>

@endsection