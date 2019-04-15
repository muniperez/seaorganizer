<template>
	
	<a class="list-group-item justify-content-between" :href="url" v-if="url">
        <div>
        	<span v-show="icon" >
        		<i :class=" 'fa fa-' + icon"></i> 
        	</span>

        	<slot></slot>
        </div>

        <i class="fa fa-angle-right"></i>
    </a>

    <div class="list-group-item justify-content-between" v-else>
    	<slot></slot>
    </div>

</template>

<script>
	
	export default {
		name: 'app-list-item',
		
		props: {

			url: {
				type: String,
				required: false
			},

			icon: {
				type: String,
				required: false
			}
		}
	}
</script>