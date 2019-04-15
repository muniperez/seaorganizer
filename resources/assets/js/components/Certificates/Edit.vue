<template>
	
	<div>

		<div class="alert alert-success my-2" v-show="isUpdated">
			Certificate updated! <a href="#" @click="isUpdated = false" >dismiss</a>
		</div>

		<div class="alert alert-default my-2" v-show="isProcessing">
			<i class="fa fa-spinner fa-spin"></i> Loading
		</div>

		<div class="card card-default">
			<div class="card-block">
				<div class="row">
					<div class="col">
						<div class="form-group form-group-default required" >
							<label for="label">Certificate name *</label>
							<input type="text" name="label" v-model="currentCertificate.label"class="form-control" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="form-grouprequired" >
							<label for="expiration">Expiration date *</label>
							<datepicker v-bind="expirationOptions" v-model="currentCertificate.expiration" ></datepicker>
						</div>
					</div>
					<div class="col">
						<div class="form-group" >
							<label for="issued">Date of issue</label>
							<datepicker v-bind="issuedOptions" v-model="currentCertificate.issued" ></datepicker>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col">
						<div class="form-group form-group-default" >
							<label for="issuer">Issuer</label>
							<input type="text" name="issuer" class="form-control" placeholder="Type the issuer" v-model="currentCertificate.issuer" >
						</div>
					</div>
	                <div class="col">   
	                    <div class="form-group form-group-default" >
	                        <label for="remarks">Remarks</label>
	                        <input type="text" name="remarks" v-model="currentCertificate.remarks" class="form-control" >
	                    </div>
	                </div>
				</div>

	            <div class="row">
	                <div class="col" >
	                    <div class="form-group form-group-default">
	                        <label>Current flag</label>
	                        <p>
	                            <span v-html="currentCertificate.flag.icon"></span> {{currentCertificate.flag.name}} <a href="#" @click="showFlagChange()" >change</a>
	                        </p>
	                    </div>
	                </div>
	            </div>

	            <div class="row" v-show="changeFlag">
	                <div class="col" >
	                    <div class="form-group form-group-default" v-if='newFlagSelected'>
	                        <label>New flag</label>
	                        <p>
	                            <span v-html="newFlag.icon" class="mr-2" ></span> {{newFlag.name}} <a href="#" @click="showFlagChange()" >change</a>
	                        </p>
	                    </div>
	                    <div class="form-group form-group-default" v-else>
	                        <label>New flag</label>
	                        <input type="text" v-model="flagSearch" class="form-control" >
	                    </div>

	                    <div class="list-group my-2" v-show="flagSearch">
	                        <a href="#" class="list-group-item" v-for="flag in searchResults" @click="selectFlag(flag.flagIndex)">
	                            <div class="mr-2" v-html="flag.flagIcon"></div> {{flag.flagName}}
	                        </a>
	                    </div>
	                </div>
	            </div>
				
				<div class="row my-3">
					<div class="col">
						<ul class="list-inline">
							<li>
								<button type="button" class="btn btn-success" :disabled="isProcessing" @click="update" >
									<i class="fa fa-save"></i> Save changes 

									<i class="fa fa-spinner fa-spin" v-show="isProcessing" ></i>
								</button>
							</li>
							<li class="pull-right">
								<div class="btn-group">
									<a :href="'/currentCertificates/' + currentCertificate.id" class="btn btn-default" >
									<i class="fa fa-times"></i> Cancel
									</a>
									<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
										
									</a>
									<ul class="dropdown-menu">
										<li class="text-danger">
											<a :href="'/currentCertificates/' + currentCertificate.id + '/delete'"><i class="fa fa-trash-o"></i> Delete
											</a>
										</li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker';

export default	{

	props: ['certificate'],

	components: {vSelect, Datepicker},

	data()	{

		return {

			isUpdated: false,

			currentCertificate: {},

			isProcessing: false,

            options: [],
            flags: [],

            newFlag: {
				
				country_id: null,
				name: null,
	            code: null,
	            icon: null,          	
            },

            changeFlag: false,

            selectedFlag: '',
            flagSearch: null,
            newFlagSelected: null,

            issuedOptions: {

            	'input-class' : 'form-control',
            	placeholder: 'Select a date',
            },

            expirationOptions: {

            	'input-class' : 'form-control',
            	placeholder: 'Select a date',
            }
		}
	},

	computed: {

        searchResults: function()   {

            var self = this;

            return this.flags.filter( function(flag) {

                if(self.flagSearch)   {

                    return flag.flagName.toLowerCase().indexOf( self.flagSearch.toLowerCase() ) >= 0
                }
            })
        }
    },

    methods: {

    	update()	{

    		this.isProcessing = true

    		let payload = this.currentCertificate
    		
    		//payload.hasNewFlag = this.newFlagSelected

    		if(this.newFlagSelected)	{

    			payload.newFlag =  this.newFlag
    		}

    		let url = '/api/certificate/' + this.certificate.id

    		axios.patch(url, payload).then(

    			response => {

    				this.isUpdated = true
    				this.isProcessing = false

    				if(this.newFlagSelected) {

    					this.currentCertificate.flag = this.newFlag
    					this.changeFlag = false
    				}
    			},

    			response => {

    				this.isUpdated = true
    				this.isProcessing = false
    				alert(response)
    			}
    		)

    	},

        selectFlag(sel) {

            if(sel) {

                this.newFlag.name = this['flags'][sel]['flagName']
                this.newFlag.code = this['flags'][sel]['flagCode']
                this.newFlag.icon = this['flags'][sel]['flagIcon']
                this.newFlag.country_id = this['flags'][sel]['country_id']

                this.flagSearch = null
                this.newFlagSelected = true
            }
            else {

                this.changeFlag = false

                this.newFlag.name = null
                this.newFlag.code = null
                this.newFlag.icon = null
                this.newFlag.country_id = null
                this.newFlagSelected = false
            }
            
        },

        clearFlag()	{

            this.selectedFlag = null
        },

        showFlagChange()	{

            this.selectFlag()

        	this.changeFlag = true
            this.newFlagSelected = false
        }
    },

    beforeMount: function() {

        this.isProcessing = true
        this.currentCertificate = this.certificate
        this.flag = this.certificate.flag

        axios.get('/api/data/countries').then( 

        	response => {

	            this.flags = response.data.map( function(country, key) {

	                return {

	                    flagIndex: key,
	                    flagName: country.name,
	                    flagCode: country.cca2,
	                    flagIcon: country.flag_icon,
	                    country_id: country.id,
	                }
	            })

            	this.options = response.data.map( function(country, key) {

	                return {

	                    value: key,
	                    label: country.name
	                }

            	})

            	this.isProcessing = false
        	}
        )
	}
}

</script>