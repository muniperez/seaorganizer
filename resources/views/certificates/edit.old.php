@extends('layouts.master')

@section('page-title')
Edit Certificate
@endsection

@section('content')

<form method="post" action="/certificates/{{$certificate->id}}/" enctype="multipart/form-data" >

	{{csrf_field()}}

	{{method_field('PATCH')}}
	
	<div class="card card-default">
		<div class="card-block">
			<div class="row">
				<div class="col">
					<div class="form-group form-group-default required" >
						<label for="label">Certificate name *</label>
						<input type="text" name="label" v-model="certificate.label"class="form-control" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group form-group-default required" >
						<label for="expiration">Expiration date *</label>
						<input type="text" name="expiration" class="form-control datepicker" v-model="certificate.expires_on" required>
					</div>
				</div>
				<div class="col">
					<div class="form-group form-group-default" >
						<label for="issued">Date of issue</label>
						<input type="text" name="issued" class="form-control datepicker" v-model="certificate.issued_on" >
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col">
					<div class="form-group form-group-default" >
						<label for="issuer">Issuer</label>
						<input type="text" name="issuer" class="form-control" placeholder="Type the issuer" v-model="certificate.issuer" >
					</div>
				</div>
                <div class="col">   
                    <div class="form-group form-group-default" >
                        <label for="remarks">Remarks</label>
                        <input type="text" name="remarks" v-model="certificate.remarks" class="form-control" >
                    </div>
                </div>
			</div>

            <div class="row">
                <div class="col" >
                    <div class="form-group form-group-default">
                        <label>Current flag</label>
                        <p>
                            {!! $certificate->flag->icon !!} {{$certificate->flag->name}} <a href="#" @click="showFlagChange()" >change</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row" v-show="changeFlag">
                <div class="col" >
                    <div class="form-group form-group-default" v-if='newFlagSelected'>
                        <label>New flag</label>
                        <p>
                            <span v-html="flagIcon" class="mr-2" ></span> @{{flagName}} <a href="#" @click="showFlagChange()" >change</a>
                        </p>
                    </div>
                    <div class="form-group form-group-default" v-else>
                        <label>New flag</label>
                        <input type="text" v-model="flagSearch" class="form-control" >
                    </div>

                    <div class="list-group my-2" v-show="flagSearch">
                        <a href="#" class="list-group-item" v-for="flag in searchResults" @click="selectFlag(flag.flagIndex)">
                            <div class="mr-2" v-html="flag.flagIcon"></div> @{{flag.flagName}}
                        </a>
                    </div>
                </div>
            </div>
			
			<div class="row">
				<div class="col">
					<div class="form-group form-group-default" >
						<label for="file">File</label>
						<input type="file" name="file" class="form-control" accept="application/pdf" >
					</div>
				</div>
			</div>
			
			<div class="row my-3">
				<div class="col">
					<ul class="list-inline">
						<li>
							<button type="submit" class="btn btn-success" >
								<i class="fa fa-save"></i> Save changes
							</button>
						</li>
						<li class="pull-right">
							<div class="btn-group">
								<a href="/certificates/{{$certificate->id}}" class="btn btn-default" >
								<i class="fa fa-times"></i> Cancel
								</a>
								<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
									
								</a>
								<ul class="dropdown-menu">
									<li class="text-danger">
										<a href="/certificates/{{$certificate->id}}/delete"><i class="fa fa-trash-o"></i> Delete
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <input type="hidden" name="flag_new" v-model="newFlagSelected" >
	<input type="hidden" name="flag_name" v-model="flagName" >
	<input type="hidden" name="flag_code" v-model="flagCode" >
	<input type="hidden" name="flag_icon" v-model="flagIcon" >
	<input type="hidden" name="flag_svg" v-model="flagSvg" >

</form>


@endsection

@section('breadcrumb')
<div class="bg-white">
    <div class="container">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item"><a href="/certificates">Certificates</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </div>
</div>
@endsection

@section('local-footer')
    
    <script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="https://unpkg.com/vue-select@latest"></script>

    <script>

        Vue.component('v-select', VueSelect.VueSelect);
        
        new Vue({

            el: '#app',

            data: {
                
                loading: false,

                options: [],
                flags: [],
				
				certificate: [],

                flagName: null,
                flagCode: null,
                flagIcon: null,
                flagSvg: null,

                changeFlag: false,

                selectedFlag: '',
                flagSearch: null,
                newFlagSelected: null,
            },

            computed: {

                searchResults: function()   {

                    var self = this;

                    return this.flags.filter( function(flag) {

                        if(self.flagSearch)   {

                            return flag.flagName.toLowerCase().indexOf( self.flagSearch.toLowerCase() ) >= 0;
                        }
                    });
                }
            },

            methods: {

                selectFlag(sel) {

                    if(sel) {

                        this.flagName = this['flags'][sel]['flagName'];
                        this.flagCode = this['flags'][sel]['flagCode'];
                        this.flagIcon = this['flags'][sel]['flagIcon'];
                        this.flagSvg = this['flags'][sel]['flagSvg'];

                        this.flagSearch = null;
                        this.newFlagSelected = true;
                    }
                    else {

                        this.changeFlag = false;

                        this.flagName = null;
                        this.flagCode = null;
                        this.flagIcon = null;
                        this.flagSvg = null;
                        this.newFlagSelected = false;
                    }
                    
                },

                clearFlag()	{

                    this.selectedFlag = null;
                },

                showFlagChange()	{

                    this.selectFlag();

                	this.changeFlag = true;
                    this.newFlagSelected = false;
                },

                checkCertificates() {

                    if(Object.keys(this.certificates).length > 0)   {

                        $('#certificatesForm').submit();
                    }
                    else {

                        alert('Please inform at least one certificate');
                    }
                },
            },

            beforeMount: function() {

                const vm = this;
                this.loading = true;

                axios.get('/api/data/countries').then( function( response ) {

                    vm.flags = response.data.map( function(flag, key) {

                        return {

                            flagIndex: key,
                            flagName: flag['name']['common'],
                            flagCode: flag['cca2'],
                            flagIcon: flag['flag']['flag-icon'],
                            flagSvg: flag['flag']['svg'],
                        };

                    });

                    vm.options = response.data.map( function(flag, key) {

                        return {

                            value: key,
                            label: flag['name']['common'],

                        };

                    });

                    vm.loading = false;
                });

                axios.get('/api/certificate/{{$certificate->id}}').then( function( response ) {

                vm.certificate = response.data;
                vm.flag = response.data.flag;
            });
            },

            mounted: function() {

                const vm = this;

                $('#expiration').datepicker().on("changeDate", function() {vm.currentCertificate.expiration = $('#expiration').val();});
            },

        });

    </script>
@endsection