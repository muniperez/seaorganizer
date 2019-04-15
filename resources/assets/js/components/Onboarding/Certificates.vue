<template>
	
	<div>

		<add-certificates @added="certificate => certificates.push(certificate)" ></add-certificates>

		<div class="mt-5 text-center">
            <button type="button" @click="checkCertificates" class="btn btn-primary btn-lg" >
            	Finish my registration <i class="fa fa-spinner fa-spin" v-show="is_processing"></i>
            </button>
        </div>

    </div>

</template>

<script>

export default {

	data() {

		return {

			certificates: [],

			is_processing: false
		}
	},

	methods: {

		checkCertificates() {

            if(Object.keys(this.certificates).length > 0)   {

            	this.is_processing = true

                axios.post('/onboarding/certificates').then(

                	response => { window.location.href = '/onboarding' },

                	response => {

                		this.is_processing = false

                		alert(response.data.message)
                	}
                )
            }
            else {

                alert('Please add at least one certificate')
            }
        }
	}
}

</script>