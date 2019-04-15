<template>
	<div class="card social-card share full-width">
	    <div v-if="certificate" >
            
            <div class="card-block" v-if="filePreview" >

                <div class="btn-toolbar flex-wrap my-2" role="toolbar">
                    
                    <button type="button" class="btn btn-default" @click="filePreview = false" ><i class="fa fa-times"></i> Close</button>

                    <div class="btn-group sm-m-t-10 mr-2 mb-2" v-if="certificateHasFile" >
                        <a :href="'/#certificates/' + certificate.id + '/send'" data-button="send" class="btn btn-default">
                            <i class="fa fa-send"></i> Send
                        </a>
                        <a :href="'/certificates/' + certificate.id + '/file'" target="_blank" data-button="download" class="btn btn-default">
                            <i class="fa fa-download"></i> Download
                        </a>
                        <a :href="'#/certificates/' + certificate.id + '/print'" data-button="print" class="btn btn-default">
                            <i class="fa fa-print"></i> Print
                        </a>
                    </div>
                </div>

                <pdf :src="'certificates/' + certificate.id + '/file'" class="" ></pdf>

            </div>
            <div class="card-block" v-else>
                <div class="btn-toolbar flex-wrap" role="toolbar">
                    <div class="btn-group sm-m-t-10 mr-2 mb-2">
                        <a :href="'/certificates/' + certificate.id + '/edit'" data-button="edit" class="btn btn-default">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        <a :href="'/certificates/' + certificate.id + '/edit'" data-button="renew" class="btn btn-default">
                            <i class="fa fa-refresh"></i> Renew
                        </a>
                    </div>

                    <div class="btn-group sm-m-t-10 mr-2 mb-2" v-if="certificateHasFile" >
                        <!-- <button type="button" @click="filePreview = true" class="btn btn-default">
                            <i class="fa fa-file-pdf-o"></i> View
                        </button> -->
                        <a :href="'/certificates/' + certificate.id + '/file'" target="_blank" data-button="download" class="btn btn-default">
                            <i class="fa fa-download"></i> Download file
                        </a>
                        <!-- <a :href="'#/certificates/' + certificate.id + '/print'" data-button="print" class="btn btn-default">
                            <i class="fa fa-print"></i> Print
                        </a> -->
                    </div>
                    <div class="btn-group sm-m-t-10 mr-2 mb-2" v-else>
                        <a :href="'/certificates/' + certificate.id + '/edit'" data-button="upload" class="btn btn-default">
                            <i class="fa fa-upload"></i> Upload file
                        </a>
                    </div>

                    <div class="btn-group mb-2">
                        <a :href="'/certificates/' + certificate.id + '/ical'" class="btn btn-default">
                            <i class="fa fa-calendar"></i> Send to calendar
                        </a>

                        <div class="btn-group dropdown dropdown-default">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            More
                            </button>
                            <div class="dropdown-menu" >
                                <a class="dropdown-item" :href="'/certificates/' + certificate.id + '/archive'"><i class="fa fa-archive"></i> Archive</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" :href="'/certificates/' + certificate.id + '/delete'"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-block">
                <h3 data-item="label" class="">{{certificate.label}}</h3>
                <p :class="'text-' + certificate.expires_within_class">
                    Expires within {{certificate.expires_within}}
                </p>
            </div>

            <div class="card-block">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex">
                            <div class="flex-1 full-width overflow-ellipsis">
                                <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">
                                    Issued on
                                </p>
                                <h5 class="no-margin overflow-ellipsis ">
                                    <span v-if="certificate.issued_on">
                                    {{certificate.issued_on}}
                                    </span>
                                    <span v-else>--</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex">
                            <div class="flex-1 full-width overflow-ellipsis">
                                <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">
                                    Expires on
                                </p>
                                <h5 class="no-margin overflow-ellipsis ">
                                    <span v-if="certificate.expires_on">
                                    {{certificate.expires_on}}
                                    </span>
                                    <span v-else>--</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex">
                            <div class="flex-1 full-width overflow-ellipsis">
                                
                                <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">
                                    Issued by
                                </p>

                                <h5 class="no-margin overflow-ellipsis ">
                                    <span v-if="certificate.issuer">
                                    {{certificate.issuer}}
                                    </span>
                                    <span v-else>--</span>
                                </h5>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex">
                            <div class="flex-1 full-width overflow-ellipsis">
                                <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">
                                    Flag
                                </p>
                                <h5 class="no-margin overflow-ellipsis ">
                                    <span v-if="certificate.flag">
                                        <span v-html="certificate.flag.icon"></span> {{certificate.flag.name}}
                                    </span>
                                    <span v-else>--</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="d-flex">
                    <div class="flex-1 full-width overflow-ellipsis">
                        <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">
                            Remarks
                        </p>
                        <h5 class="no-margin overflow-ellipsis ">
                            <span v-if="certificate.remarks">
                            {{certificate.remarks}}
                            </span>
                            <span v-else>--</span>
                        </h5>
                    </div>
                </div>
            </div>
            
            <div class="card-block" v-if="certificateHasFile">
                <div class="d-flex">
                    <div class="flex-1 full-width overflow-ellipsis">
                        <p class="hint-text all-caps font-montserrat  small no-margin overflow-ellipsis ">
                            Uploaded file
                        </p>
                        <h5 class="no-margin overflow-ellipsis ">
                             <a :href="'/certificates/' + certificate.id + '/file'" target="_blank" >Click to download</a> <i class="fa fa-download"></i>
                        </h5>

                        <a href="#" @click="deleteFile" class="float-right" ><i class="fa fa-times"></i> Delete file</a>
                    </div>
                </div>
            </div>
            <div class="card-block" v-else>
                
                <h4>Upload a file</h4>

                <p>Your file will be stored in an AWS secure server. Send only <b>PDF</b></p>
                
                <div class="form-group form-group-default" >
                    <label for="file">File</label>
                    <input type="file" name="file" class="form-control" accept="application/pdf" v-on:change="onFileChange" >
                </div>

                <div class="form-group" >
                    <button type="submit" class="btn btn-success" :disabled="disableUploadButton" @click="upload" >
                    	Upload <i class="fa fa-spinner fa-spin" v-show="isProcessing"></i>
                    </button>
                </div>

            </div>

        </div>
        <div v-else>
            <div class="card-block text-center">
                <h5 class="hint-text" >Please select a certificate</h5>
            </div>
        </div>
    </div>
</template>

<script>
	
    //import pdf from 'vue-pdf'

	export default {
	   
        //components: {pdf},

		props: {
					certificate: {

						default: null,
						required: false
					}
				},

		data()	{

			return {
				certificateFile: null,
				isProcessing: false,
                filePreview: false
			}
		},

		computed:	{

			certificateHasFile()	{

				if(this.certificate)	{

					return this.certificate.file ? true : false
				}
				else {

					return false
				}
			},

			disableUploadButton()	{

				if(this.certificateFile)	{
					
					return this.isProcessing
				}
				
				return true
			}

		},

		methods: {
			
			onFileChange(e) {
                
                console.log('creating files')

                let files = e.target.files || e.dataTransfer.files
                
                if (!files.length) {

                	console.log('no files')

                	return
                }

                this.createFile(files[0])
            },

			createFile(file) {
                
                let reader = new FileReader()
                
                reader.onload = (e) => {
                    
                    this.certificateFile = e.target.result
                };

                reader.readAsDataURL(file)
            },

            upload(){
                
                if(this.certificateFile) {

	                this.isProcessing = true

	                let url = '/api/certificate/' + this.certificate.id + '/file'
	                let payload = {file: this.certificateFile}

	                axios.post(url, payload ).then( 

	                	response => {

		                    this.certificateFile = null
		                    this.isProcessing = false
		                    this.certificate.file = response.data.file
	                	},

	                	response => {

	                		this.isProcessing = false
	                		alert(response.data.message)
	                	}
	                )
	            }
	            else {

	            	alert('Please choose a file')
	            }
            },

            deleteFile()	{

            	let url = '/api/certificate/' + this.certificate.id + '/file'

            	axios.delete(url).then(

            		response => {

            			this.certificate.file = null
            		},

            		response => alert(response.data)
            	)
            }
        }
	}
</script>