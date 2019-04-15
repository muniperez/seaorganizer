@extends('layouts.onboarding.master')
@section('page-title','Sign Up')

@section('content')
<div class="row my-3">
    <div class="col">

        <p class="text-center">
            Let us know you a little better. This information is <b>optional</b> and will be kept private.
        </p>
        
        <div class="card card-default">
            <div class="card-block">
                        
                <form method="POST" action="/onboarding/personal" >
                    
                    {{ csrf_field() }}

                    <div class="form-group form-group-default m-t-15" >
                        
                        <h5>Rank</h5>

                        <div class="input-group" >
                            <input id="rank" type="text" class="form-control" name="rank" placeholder="Ex.: Third Mate, A/B" >
                        </div>
                    </div>

                    <div class="form-group form-group-default m-t-15" >
                        
                        <h5>Type of Vessel</h5>

                        <div class="input-group" >
                            <input id="vessel" type="text" class="form-control" name="vessel" placeholder="Ex.: Tanker, AHTS, PSV" >
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group m-t-15 form-group-default" >
                        
                        <h5>Country</h5>
                        
                        <select name="country_id" class="form-control" id="select2" >

                            @foreach($countries as $country)

                            <option value="{{$country->id}}">{{$country->name}}</option>

                            @endforeach
                        </select>


                    </div>

                    <div class="form-group m-t-15 form-group-default" >
                        <h5>City</h5>
                        <input id="city" type="text" class="form-control" name="city" placeholder="Your city" >
                    </div>

                    <div class="form-group m-t-15 form-group-default" >
                        <h5>State / Region</h5>
                        <input id="state" type="text" class="form-control" name="state" placeholder="Your state or region" >
                    </div>

                    <div class="form-group m-t-15">
                        <button type="submit" class="btn btn-success btn-lg">
                            Continue
                        </button>
                    </div>
                </form>
                    
            </div>
        </div>
    </div>
</div>
@endsection

@section('local-footer')
<script>
    $(document).ready(  function()  {

            $('#select2').select2();
        }
    );
</script>
@endsection