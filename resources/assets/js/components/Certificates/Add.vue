<template>
	
    <div class="card card-default">     
        
        <div class="card-block" v-show="certificates.length > 0">

            <h5>Current certificates</h5>

            <div class="list-group list-group-flush" >

                <div class="list-group-item" v-for="certificate in certificates" >
                    
                    <div>
                        <h6>{{certificate.label}}</h6>
                        <span v-html="certificate.flag.icon"></span> <span :class=" 'text-' + certificate.expires_within_class " >{{certificate.expires_within}}</span>
                    </div>

                </div>
            </div>

        </div>

        <div class="card-block">

            <h5>Add new certificate</h5>

            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="label">Certificate name</label>
                        <input type="text" class="form-control" v-model="currentCertificate.label">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="expiration">Expiration date</label>
                        <datepicker v-bind="datepickerOptions" v-model="currentCertificate.expiration" ></datepicker>
                    </div>
                </div>

                <div class="col-12 col-md-4">

                	<div class="alert alert-danger" v-if="countriesLoadError">
	            		<p><b>Error loading flags</b></p>
	            		<p>
	            			<button type="button" class="btn btn-danger" @click="fetchCountries" >Click to reload</button>
	            		</p>
	            	</div>
	            	<div v-else>
                        
                        <div class="form-group" v-if='loading'>
                            <label>Flag</label>
                            <p><i class="fa fa-spinner fa-spin"></i> Loading...</p>
                        </div>
                        
                        <div class="form-group" v-else>
                            <label>Flag</label>
                            <multiselect v-model="selectedCountry" track-by="value" label="label" :options="options" placeholder="Choose a flag"  ></multiselect>
                        </div>

                    </div>
                </div>
            </div>

            <button type="button" @click="addCertificate" class="btn btn-success" >Insert certificate</button>

        </div>
    </div>

</template>
<script>

import Multiselect from 'vue-multiselect'
import Datepicker from 'vuejs-datepicker'

export default {

	components: { Multiselect, Datepicker },

	data()	{

		return {

			loading: false,
            certificates: [],
            options: [],
            countries: [],

            currentCertificate: {
                
                label: null,
                expiration: null,
                flag: null
            },

            selectedCountry: null,

            countriesLoadError: false,

            datepickerOptions: {

            	'input-class' : 'form-control',
            	placeholder: 'Select a date',
            }

		}
	},

    watch:  {

        selectedCountry(country)    {

            if(country) {

                this.currentCertificate.flag = this['countries'][country.value]
            }
            else {

                this.currentCertificate.flag = null
            }
        }

    },

	methods: {

		fetchCountries()	{

			this.loading = true
			this.countriesLoadError = false

	        axios.get('/api/data/countries').then(

	        	response => {

	        		this.countries = response.data.map( function(country, key) {

		                return {
		                    
                            country_id: country['id'],
		                    name: country['name'],
		                    code: country['cca2'],
		                    icon: country['flag_icon'],
		                }

		            })

	        		this.options = response.data.map( function(country, key) {

		                return {

		                    value: key,
		                    label: country['name']

		                }

		            })

		            this.loading = false

	        	},

	        	() => {

	        		this.countriesLoadError = true
	        		this.loading = false
	        	}
	        )
		},

        addCertificate()  {

            if(this.currentCertificate.label && this.currentCertificate.expiration ) {
                
                axios.post('/api/certificate', this.currentCertificate).then(

                	response => {
	                    
	                    this.certificates.push(response.data)

	                    this.emitChange(response.data)

	                    this.currentCertificate.label = null
	                    this.currentCertificate.expiration = null
	                    
	                    this.clearFlag()
                })
            }
            
            else {

                alert('Plase provide at least a name and an expiration date for your certificate')
            }
        },

        emitChange(data)	{

        	this.$emit('added', data)
        },

        // selectCountry() {

        //     if(this.selectedCountry)    {


        //     }

        //     if(sel) {

        //         this.currentCertificate.flag_country_name = this['countries'][sel.value]['countryName'];
        //         this.currentCertificate.flag_country_code = this['countries'][sel.value]['countryCode'];

        //         this.currentCertificate.flag_icon = this['countries'][sel.value]['flagIcon'];
        //         this.currentCertificate.flag_svg = this['countries'][sel.value]['flagSvg'];    
        //     }
        //     else {

        //         this.currentCertificate.flag_country_name = null;
        //         this.currentCertificate.flag_country_code = null;

        //         this.currentCertificate.flag_svg = null;
        //         this.currentCertificate.flag_icon = null;
        //     }
            
        // },

        clearFlag() {

            this.selectedCountry = null;
        },
    },

    beforeMount() {

    	this.fetchCountries()
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>