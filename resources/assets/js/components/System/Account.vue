<template>
	<div>

        <div class="row">
            <div class="col-sm-12 col-lg-6 ">
                
                <card-widget card-title="Personal information" >
                    
                    <card-widget-content>
                        <h2 class="no-margin p-b-5">{{account.name}}</h2>
                        
                        <span>
                            {{account.email}}
                        </span>

                        <span>
                            {{account.profile.location}}
                        </span>
                    </card-widget-content>

                    <card-widget-content v-if="account.profile.rank">
                        Rank
                        <h4 class="m-t-0" >{{account.profile.rank}}</h4>
                    </card-widget-content>

                    <card-widget-content v-if="account.profile.vessel">
                        Vessel
                        <h4 class="m-t-0" >{{account.profile.vessel}}</h4>
                    </card-widget-content>

                    <card-widget-content>
                        <a href="/account/edit" >Edit information</a>
                    </card-widget-content>
                </card-widget>

                <card-widget card-title="Subscription" >
                    <card-widget-content>
                        <div v-if="subscription" >
                            <h3 class="no-margin p-b-5 text-success">
                                Active <span class="badge badge-success">{{subscription.stripe_plan}}</span>
                            </h3>
                        </div>

                        <div v-else>
                            <h3 class="text-danger">
                                Not subscribed
                            </h3>
                        </div>
                    </card-widget-content>

                    <card-widget-content>
                        <a href="/account/subscription">
                            Manage subscription &amp; invoices
                        </a>
                    </card-widget-content>
                </card-widget>

            </div>

            <div class="col-sm-12 col-lg-6">
                
                <card-widget card-title="Phone" >
                    <card-widget-content>
                        <h3 class="no-margin p-b-5">+{{account.phone_country}} {{account.phone}}</h3>
                    </card-widget-content>

                    <card-widget-content>
                        <a href="/account/changePhone">
                            Change phone
                        </a>
                    </card-widget-content>
                </card-widget>

            </div>
        </div>

	</div>
</template>

<script>

export default {

    props: ['user', 'subscription'],

	data()	{

		return {

            editMode: false,
            account: {}
		}
	},

	methods: {

		enterEditMode()   {

            this.editMode = true
        },

        update()    {

            let payload = {}
            let url = '/api/account'

            axios.patch()
        }

    },

    beforeMount() {

    	this.account = this.user
    }
}
</script>