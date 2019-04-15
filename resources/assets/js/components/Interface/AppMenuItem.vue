<template>
	
	<a class="list-group-item justify-content-between" :href="url" >
        <div>
        	<span v-show="icon" >
        		<i :class=" 'fa fa-' + icon"></i> 
        	</span>

        	<slot></slot>
        </div>

        <i class="fa fa-angle-right"></i>
    </a>

</template>

<script>
	
	export default {
		name: 'app-menu-item',
		props: {

			url: {
				type: String,
				default: '#'
			},

			icon: {
				type: String,
				required: false
			}
		}
	}
</script>