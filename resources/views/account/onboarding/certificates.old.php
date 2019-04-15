@extends('layouts.onboarding.master')
@section('page-title','Add certificates')

@section('content')
<div class="m-t-60" >
    <section class="container container-fixed-lg p-t-65 p-b-100  sm-p-b-30 sm-m-b-30">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="text-center">
                    <h2>Insert your certificates</h2>
                    <p>Let's get started! Insert the certificates you want to keep track and add their expiration date. Oh, you can also upload a file to our secure Amazon Cloud!</p>
                </div>
                
                <onboarding-certificates></onboarding-certificates>

                <div class="m-t-60">
                    <form method="post" action="/onboarding/certificates" id="certificatesForm" >
                        {{csrf_field()}}
                        <p class="text-center" >
                            <button type="button" @click="checkCertificates" class="btn btn-primary btn-lg" >Finish my registration</button>
                        </p>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@section('local-footer')
    
    <script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="https://unpkg.com/vue-select@latest"></script>

    <script>

        Vue.component('v-select', VueSelect.VueSelect);
        
        new Vue({

            el: '#app',

            data: {
                loading: false,
                certificates: [],
                options: [],
                countries: [],

                currentCertificate: {
                    
                    label: null,
                    expiration: null,
                    
                    flag_country_name: null,
                    flag_country_code: null,
                    flag_icon: null,
                    flag_svg: null,
                },

                selectedCountry: '',
            },

            methods: {

                addCertificate()  {

                    const vm = this;

                    if(this.currentCertificate.label && this.currentCertificate.expiration ) {
                        axios.post('/api/certificate', vm.currentCertificate).then( function(response) {

                            vm.certificates.push(response.data);

                            vm.currentCertificate.label = null;
                            vm.currentCertificate.expiration = null;
                            
                            vm.currentCertificate.flag_country_name = null;
                            vm.currentCertificate.flag_country_code = null;
                            vm.currentCertificate.flag_icon = null;
                            vm.currentCertificate.flag_svg = null;
                            
                            vm.clearFlag();

                        });
                    }
                    else {

                        alert('Plase provide at least a name and an expiration date for your certificate');
                    }
                },

                selectCountry(sel) {

                    if(sel) {

                        this.currentCertificate.flag_country_name = this['countries'][sel.value]['countryName'];
                        this.currentCertificate.flag_country_code = this['countries'][sel.value]['countryCode'];

                        this.currentCertificate.flag_icon = this['countries'][sel.value]['flagIcon'];
                        this.currentCertificate.flag_svg = this['countries'][sel.value]['flagSvg'];    
                    }
                    else {

                        this.currentCertificate.flag_country_name = null;
                        this.currentCertificate.flag_country_name = null;

                        this.currentCertificate.flag_svg = null;
                        this.currentCertificate.flag_icon = null;
                    }
                    
                },

                clearFlag() {

                    this.selectedCountry = null;
                },

                checkCertificates() {

                    if(Object.keys(this.certificates).length > 0)   {

                        $('#certificatesForm').submit();
                    }
                    else {

                        alert('Please inform at least one certificate');
                    }
                }
            },

            beforeMount: function() {

                const vm = this;
                this.loading = true;

                axios.get('/api/data/countries').then( function( response ) {

                    vm.countries = response.data.map( function(country, key) {

                        return {
                            
                            countryName: country['name'],
                            countryCode: country['cca2'],
                            flagIcon: country['flag']['flag-icon'],
                            flagSvg: country['flag']['svg'],
                        };

                    });

                    vm.options = response.data.map( function(country, key) {

                        return {

                            value: key,
                            label: country['name'],

                        };

                    });

                    vm.loading = false;
                });
            },

            mounted: function() {

                const vm = this;

                $('#expiration').datepicker().on("changeDate", function() {vm.currentCertificate.expiration = $('#expiration').val();});
            }

        });

    </script>
@endsection