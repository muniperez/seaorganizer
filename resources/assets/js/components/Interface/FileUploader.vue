<template>
	<vue-clip :options="options" :on-complete="handleUploadedFile">
	    <template slot="clip-uploader-action">
	      <div>
	        <div class="dz-message"><h2> Click or Drag and Drop files here upload </h2></div>
	      </div>
	    </template>
	</vue-clip>
</template>

<script>
	
	import VueClip from 'vue-clip'

	export default {
		
		components: { VueClip },

		props: ['options'],

		methods: {
			
			handleUploadedFile(file, status, xhr)	{

				this.$emit('file-uploaded', xhr)
			}
        }
	}
</script>

<style>
  .upload-action.is-dragging {
    background: #AEE96C;
  }
</style>