<template>
	
	<div>
		<div class="card widget-loader-bar my-2" :class="cardColor ? cardClasses : null " >

          	<div class="container-xs-height full-height" :class="{ 'text-white' : cardColor }">
            
	            <div class="row-xs-height" v-if="cardTitle">
	              	<div class="col-xs-height col-top">
	                
	                	<div class="card-header">
	                  		<div class="card-title">
	                    		<span class="fs-11 all-caps">{{cardTitle}}</span>
	                  		</div>
	                	</div>

	              	</div>
	            </div>

	            <slot></slot>

          	</div>
        </div>

	</div>

</template>

<script>
	
	export default {

		props: {
			
			cardTitle: {
				type: String,
				required: false
			},

			cardColor: {
				type: String,
				required: false
			},

			cardBorder: {
				type: Boolean,
				required: false
			},
		},

		data()	{
			return {
				cardTextWhite: false,
				cardClasses: null
			}
		},

		beforeMount()	{

			if(this.cardColor)	this.cardClasses = 'bg-' + this.cardColor

			if(this.cardTitle) this.cardClasses += ' pb-2'

			if(!this.cardBorder) this.cardClasses += ' no-border'
		}

	}
</script>