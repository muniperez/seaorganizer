<template>
	<div>
		
		<div class="card card-success" v-if="phoneVerified">
        	<div class="card-block text-center">
        		<h5><i class="fa fa-check"></i> Phone verified</h5>

        		<p>Your phone has been verified!</p>

        		<p>
        			<a href="/onboarding" class="btn btn-success" >Continue</a>
        		</p>
        	</div>
        </div>
		<div class="card card-default" v-else>
	        <div class="card-block">

	        	<div v-if="!selected"	>

	            	<h5>Select your country</h5>
	            	
	            	<div class="alert alert-danger" v-if="countriesLoadError">
	            		<p><b>Error loading countries</b></p>
	            		<p>
	            			<button type="button" class="btn btn-danger" @click="fetchCountries" >Click to reload</button>
	            		</p>
	            	</div>

	            	<div v-else>
	            		<multiselect track-by="value" label="label" :options="options" v-model="selectedCountry" placeholder="Choose a country" ></multiselect>
	            	</div>
	            </div>

	            <div v-else>

	            	<div v-if="phoneIsSent" >

	            		<h5>Validation code</h5>
	            		<p>
	            			We sent a code to your phone number (+{{selected.CallingCode}} {{phone}})
	            		</p>

	            		<div class="form-group">
							<input type="text" v-model="validation_code" class="form-control" placeholder="4-digit code">
						</div>

						<div class="form-group">
		                    <button type="button" @click="submitCode" class="btn btn-success btn-lg">
		                        <i class="fa fa-check"></i> Validate 
		                        <i class="fa fa-spinner fa-spin" v-show="isProcessing"></i>
		                    </button>
		                </div>

		                <p>
		                	Not your phone or did not get the message? <a href="#" @click="resetPhone" >Click here</a>
		                </p>

					</div>

					<div v-else>
	                
		                <div class="form-group m-t-15" >
		                    
		                    <h5>Phone number</h5>
		                    <p>
		                    	We will send a code to verify your phone number. This is necessary so we can send you alerts about your certificates.
		                    </p>

		                    <div class="input-group my-2" >
		                    	<span v-html="selected.flag"></span> {{selected.name}}
		                    </div>
		                    
		                    <div class="input-group my-2" >
		                        <span class="input-group-addon">+{{selected.callingCode}}</span>
		                        <input type="text" class="form-control" v-model="phone" placeholder="Only numbers: 1231231234" >
		                    </div>
		                    <span class="help-block">
		                        <strong>Only numbers!</strong>
		                    </span>
		                </div>


		                <div class="form-group m-t-15">
		                    <button type="button" @click="submitPhone" class="btn btn-success btn-lg">
		                        <i class="fa fa-smartphone"></i> Send code 
		                        <i class="fa fa-spinner fa-spin" v-show="isProcessing"></i>
		                    </button>
		                </div>

		                <p class="small pull-right">
		                    <a href="#" @click="selected = null" >Change country</a>
		                </p>

		            </div>
		        </div>
		    </div>
		</div>
	</div>

</template>

<script>
	
	import Multiselect from 'vue-multiselect'

	export default {
		
		components: {Multiselect},

		data() {

			return {
			
				selected: null,

				countries: [],
				countriesLoadError: false,

				options: [],

				country_code: null,
				country_calling_code: null,
				phone: null,

				isProcessing: false,
				phoneIsSent: false,
				
				validation_code: null,
				validationCodeIsSent: false,

				phoneVerified: false,

				selectedCountry: null
			}

		},

		beforeMount: function() {

			this.fetchCountries()
        },

        watch: {

        	selectedCountry(country)	{

        		if(country)	{

        			this.selected = this['countries'][country.value]
                }
                else {

                    this.selected = null
        		}
        	}
        },

        methods: {

        	fetchCountries()	{

        		axios.get('/api/data/countries').then( 

                	response => {

                		this.countriesLoadError = false

                		this.countries = response.data.map( function(country, key) { 

                			return {
                						id: country.id,
                						name: country.name,
                						countryCode: country.cca2,
                						flag: country.flag_icon,
                						callingCode: country.calling_code
                					}
                				})

						this.options = response.data.map( function(country, key) { 

							return {
										value: key,
										label: '+' + country['calling_code'] + ' ' + country['name']
									}
								})
                	},

                	data => {

                		this.countriesLoadError = true
                	}
                )
        	},

            selectCountry(val)  {

                if(val) {

                    this.selected = this['countries'][val.value]
                }
                else {

                    this.selected = null
                }
            },

            submitPhone()	{

            	if(this.selected && this.phone)	{

            		this.isProcessing = true

            		let payload = {country_id: this.selected.id , phone_country: this.selected.callingCode , phone: this.phone}

            		axios.post('/onboarding/location', payload).then(

            			data => {

            				this.phoneIsSent = true
            				this.isProcessing = false

            			},

            			data => {
            				
            				alert(data.message)
            				this.isProcessing = false
            			}
            		)

            	}
            },

            submitCode()	{

            	if(this.phoneIsSent && this.validation_code)	{

            		this.isProcessing = false
            		this.validationCodeIsSent = true

            		let payload = {code: this.validation_code}

            		axios.post('/onboarding/validatePhone', payload).then(

            			data => {

            				this.phoneVerified = true
            				this.isProcessing = false

            			},

            			data => {
            				alert(data.message)
            				this.isProcessing = false
            			}
            		)
            	}
            },

            resetPhone()	{

            	this.phoneIsSent = false
            	this.isProcessing = false
            }
        }
	}

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>