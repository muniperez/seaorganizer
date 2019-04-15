<template>
	
	<div>
		<div class="card widget-loader-bar my-2" :class="menuColor ? menuClasses : null " >

          	<div class="container-xs-height full-height" :class="{ 'text-white' : menuColor }">

          		<div class="list-group list-group-flush">

	            	<slot></slot>

	            </div>

          	</div>
        </div>

	</div>

</template>

<script>

	export default {

		name: 'app-menu',
		
		props: {

			menuColor: {
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
				menuClasses: null
			}
		},

		beforeMount()	{

			if(this.menuColor)	this.menuClasses = 'bg-' + this.menuColor
		}

	}
</script>