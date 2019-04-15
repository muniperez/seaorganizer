@extends('layouts.onboarding.master')
@section('page-title','Change phone number')

@section('content')

<div class="row my-3">
    <div class="col col-md-8 offset-md-2">

                <div class="text-center">
                    <p>You will receive a code to validate your new phone number.</p>
                </div>
    
                <phone-validation></phone-validation>

            </div>
        </div>
    </div>
</div>

@endsection