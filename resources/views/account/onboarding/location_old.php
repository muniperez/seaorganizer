@extends('layouts.onboarding.master')
@section('page-title','Sign Up')

@section('content')
<div class="m-t-60" >
    <section class="container container-fixed-lg p-t-65 p-b-100  sm-p-b-30 sm-m-b-30">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <div class="text-center">
                    <h2>Phone validation</h2>

                    <p>Please provide your location and phone number so we can send you alerts about your expiring certificates.</p>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-body">       
                        
                        <h5>Select your country</h5>
                        <v-select :on-change="selectCountry" :options="options"></v-select>

                        @if ($errors->has('country'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                        <form method="POST" action="/onboarding/location" v-if="selected">
                            
                            {{ csrf_field() }}

                            <div class="form-group m-t-15" >
                                
                                <h5>Phone number</h5>

                                <input type="hidden" name="country" :value="selected.countryCode" >
                                <input type="hidden" name="phone_country" :value="selected.callingCode" >

                                <div class="input-group" >
                                    <span class="input-group-addon"><span v-html="selected.flag"></span> +@{{selected.callingCode}}</span>
                                    <input id="phone" type="text" class="form-control" name="phone" placeholder="Only numbers: 1231231234" required>
                                </div>
                                <span class="help-block">
                                    <strong>Only numbers!</strong>
                                </span>

                                @if ($errors->has('phone'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
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
    </div>
</div>
@endsection

@section('local-footer')
    
    <script src="https://unpkg.com/vue-select@latest"></script>

    <script>

        Vue.component('v-select', VueSelect.VueSelect);

        new Vue({

            el: '#app',

            data: {
                selected: null,
                countries: [],
                options: []
            },

            beforeMount: function() {

                const vm = this;

                axios.get('/api/data/countries').then( function( response ) {


                    vm.countries = response.data.map( function(country, key) {

                        return {
                            
                            name: country['name'],
                            countryCode: country['cca2'],
                            flag: country['flag']['flag-icon'],
                            callingCode: country['callingCode'][0]
                        };

                    });

                    vm.options = response.data.map( function(country, key) {

                        return {

                            value: key,
                            label: '+' + country['callingCode'] + ' ' + country['name']

                        };

                    });
                });
            },

            methods: {

                selectCountry(val)  {

                    if(val) {

                        this.selected = this['countries'][val.value];
                    }
                    else {

                        this.selected = null;
                    }
                }
            }

        });

    </script>
@endsection

@section('local-head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/css/flag-icon.css" integrity="sha256-uNjm68xPD+6gnVc/JWO6c0TgsEu/PqsXTc9djrPqhOw=" crossorigin="anonymous" />
@endsection