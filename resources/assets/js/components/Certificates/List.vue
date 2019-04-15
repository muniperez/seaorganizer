<template>
	
<div class="row">
    <div class="col-sm-3 d-flex flex-column">

        <div class="dropdown dropdown-default my-1">
            <button class="btn btn-secondary btn-block dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter flags
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" @click="loadFlag()" >View all</a>
                <a class="dropdown-item" v-for="(flag, key) in flags" href="#" @click="loadFlag(key)" ><span v-html="flag.icon"></span> {{flag.name}}</a>
            </div>
        </div>

        <div class="input-group my-1">
          <span class="input-group-addon" id="sizing-addon1">
              <i class="fa fa-search"></i>
          </span>
          <input type="text" v-model="searchParameter" class="form-control" placeholder="Filter certificates" >
        </div>

        <div class="card social-card share full-width my-1" data-social="item" >

            <div v-for="(certificate, key) in visibleItems" class="card-header clearfix" @click="loadCertificate(key)" v-bind:class="{'active' : isSelected(key)}" >
                
                <small class="float-right" v-if="certificate.flag" v-html="certificate.flag.icon"></small>

                <h5>{{ certificate.label }}</h5>
                <h6 :class="'text-' + certificate.expires_within_class" >
                    <small><i class="fa fa-circle"></i></small> Expires in {{ certificate.expires_within }}
                </h6>
            </div>
        </div>
    </div>
    <div class="col-sm-9 d-flex flex-column">

        <view-certificate :certificate="certificate" ></view-certificate>

    </div>
</div>
</template>

<script>
	
export default {
	
	data() {

		return {
	        certificates: [],
	        flags: [],
	        certificate: '',

	        selectedCertificate: null,

	        searchParameter: null,
	        flagParameter: false,
	        selectedFlag: null,

	        visibleItems: []
	    }
	},

    watch: {

        searchParameter(val) {

            this.flagParameter = null

            this.visibleItems = this.certificates.filter( 

            	certificate => {

	                if(this.searchParameter)   {

	                    // Search by name

	                    return certificate.label.toLowerCase().indexOf( this.searchParameter.toLowerCase() ) >= 0
	                }
	                
	                else {

	                    return certificate
	                }
            	}
            )
        }
    },

    computed: {

        
    },

    beforeMount: function() {

        axios.get('/api/certificates').then( 

        	response => {

            	this.certificates = response.data
            	this.visibleItems = this.certificates
        	}
        )

        axios.get('/api/flags').then( 

        	response => {

            	this.flags = response.data
        	}
        )
    },

    methods: {

        // filterCertificates: function()  {

        //     console.log(this.searchParameter);
        // },

        loadCertificate(key) {

            this.certificate = this.certificates[key];
            this.selectedCertificate = key;
        },

        isSelected(i)	{

            return i === this.selectedCertificate;
        },

        loadFlag(code)	{

            this.searchParameter = null;

            if(code)    {
                
                //
                this.flagParameter = true;
                //this.selectedFlag = code;

                // Go throug all certificates and map the array returning only those that the flag code matches with the required
                
                var visibleItems = [];

                this.certificates.map( function(item) {

                    if(item.flag)   {

                        if(item.flag.code == code)  {
                            visibleItems.push(item);
                        }
                    }

                });

                this.visibleItems = visibleItems;
            }
            else {

                this.visibleItems = this.certificates;

                this.flagParameter = false;

                //this.selectedFlag = null;
            }
        }
    }
	}
</script>