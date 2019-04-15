<template>

	<div class="social-wrapper">
		<div class="social">
			<div class=" container    container-fixed-lg sm-p-l-0 sm-p-r-0">
				<div class="feed">
					<div class="day">

						<div class="row">
						    <div class="col col-sm-12">

						    	<card-widget>
					    			<card-widget-content>
					    				
					    				<div class="d-flex justify-content-between">
				    						<a class="btn btn-success d-none d-md-block" href="/certificates/add"  >
				    							<i class="fa fa-plus"></i> 	Add Certificates
				    						</a>

				    						<a class="btn btn-success d-none d-xs-block d-sm-block d-md-none" href="/certificates/add"  >
				    							<i class="fa fa-plus"></i>
				    						</a>

					    					<a class="btn btn-default" href="/calendar"  ><i class="fa fa-calendar-o"></i> Calendar</a>
						    			</div>

									</card-widget-content>
								</card-widget>

								<div v-if="certificatesLoaded" >
						    		<card-widget card-title="Expiring soon" card-color="danger" v-if="certificatesExpiring.expiringSoon.count > 0" >
						    			<card-widget-content>
						    				<h3 class="no-margin p-b-5 text-white">{{certificatesExpiring.expiringSoon.count}} certificates</h3>
											<span class="small hint-text pull-left">expiring within 1 month</span>
										</card-widget-content>
									</card-widget>

									<card-widget card-title="Keep an eye" card-color="warning" v-if="certificatesExpiring.expiring.count > 0" >
						    			<card-widget-content>
						    				<h3 class="no-margin p-b-5 text-white">{{certificatesExpiring.expiring.count}} certificates</h3>
											<span class="small hint-text pull-left">expiring within 6 months</span>
										</card-widget-content>
									</card-widget>

									<card-widget card-title="All good" card-color="success" v-if="certificatesExpiring.allGood.count > 0" >
						    			<card-widget-content>
						    				<h3 class="no-margin p-b-5 text-white">{{certificatesExpiring.allGood.count}} certificates</h3>
											      <span class="small hint-text pull-left">expiring in more than a year</span>
										</card-widget-content>
									</card-widget>

									<card-widget >
						    			<card-widget-content>
						    				<a href="/certificates">
						    					<h5><i class="fa fa-bars"></i> View all</h5>
						    				</a>
										</card-widget-content>
									</card-widget>

									<card-widget >
						    			<card-widget-content  >
						    				<a href="/account/invite" >
						    					<h5>
						    						<i class="fa fa-share-square-o"></i> Invite friends, get 2 months off
						    					</h5>
						    				</a>
										</card-widget-content>
									</card-widget>

								</div>

						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</template>

<script>
	
	export default {
		
		data() {

			return {
				
				newsFeed: [],

				flags: [],

				certificatesExpiring: [],
				certificatesLoaded: false
			}
		},

		beforeMount()	{

			axios.get('/api/data/dashboard/certificates').then( 

				response =>	{

						this.certificatesExpiring = response.data
						this.certificatesLoaded = true
					}
			)

			axios.get('/api/data/dashboard/flags').then( response => this.flags = response.data )

			//axios.get('/api/data/newsFeed').then( response => this.newsFeed = response.data )
		},

		methods: {

			flagsGraph() {

				return this.flags.flags.map( 

					flag => {

						return {label: flag.name, value: flag.counter}

					})
			}
		}
	}
</script>