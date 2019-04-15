<template>
	<div>

		<div v-if="settings">
			<card-widget card-title="Notifications" >

				<card-widget-content>
					<div class="checkbox ">
	              		<input id="emailNotificationSettings" type="checkbox" v-model="settings.EMAILNOTIFICATIONS" @change="updateSetting('EMAILNOTIFICATIONS')" />
	              		<label for="emailNotificationSettings" >E-mail</label>
	              	</div>
	            </card-widget-content>
	             
	            <card-widget-content>

	            	<div class="checkbox ">
	              		<input id="smsNotificationSettings" type="checkbox" v-model="settings.TEXTNOTIFICATIONS" @change="updateSetting('TEXTNOTIFICATIONS')" />
	              		<label for="smsNotificationSettings">SMS (text)</label>
	              	</div>

	            </card-widget-content>
	        </card-widget>

	        <card-widget card-title="Calendar integration" >
	        	
	        	<card-widget-content>
	              
	              	<p>Connect and use your favorite calendar.</p>

	              	<div class="checkbox ">
	              		<input id="WEBCALSettings" type="checkbox" v-model="settings.WEBCAL" @change="updateSetting('WEBCAL')" />	
	              		<label for="WEBCALSettings">Webcal Server</label>
	              	</div>

	        	</card-widget-content>

	      	</card-widget>
	    </div>
	</div>
</template>

<script>

export default {

	data()	{

		return {

			settings: {},

			loadableSettings: ['TEXTNOTIFICATIONS', 'EMAILNOTIFICATIONS', 'WEBCAL'],
		}
	},

	methods: {

		updateSetting(setting)	{

			let url = '/api/settings/' + setting
			let payload = {value: this['settings'][setting]}

			axios.patch(url, payload).then( 

				response => {

              		this['settings'][setting] = response.data
            	}
            )
		}
    },

    beforeMount() {

        let parameters = encodeURIComponent(this.loadableSettings.map( function(setting) {	return setting }).join(','))
        let url = '/api/settings?load=' + parameters
        
        axios.get(url).then( 

        	response =>	{
        					let settings = 	{
        										EMAILNOTIFICATIONS: Boolean(parseInt(response.data.EMAILNOTIFICATIONS)),
            									TEXTNOTIFICATIONS: Boolean(parseInt(response.data.TEXTNOTIFICATIONS)),
            									WEBCAL: Boolean(parseInt(response.data.WEBCAL))
        									}

            				this.settings = settings
        				}
			)
      },
}

</script>