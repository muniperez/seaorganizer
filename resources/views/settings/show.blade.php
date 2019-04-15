@extends('layouts.master')
@section('page-title','System Settings')

@section('content')

<div class="row">
	<div class="col">

    <user-settings></user-settings>
		
		<!-- <div class="card no-border widget-loader-bar m-b-20">
      <div class="container-xs-height full-height">
        <div class="row-xs-height">
          <div class="col-xs-height col-top">
            <div class="card-header  top-left top-right">
              <div class="card-title">
                <span class="fs-11 all-caps">Export Data</span>
              </div>
            </div>
          </div>
        </div>
        <div class="row-xs-height">
          <div class="col-xs-height col-top">
            <div class="p-l-20 p-t-50 p-r-20">
              <p>You can download a list of all your certificates in CSV format so you can insert in a spreadsheet.</p>

              <p><a href="/certificates/export" target="_blank" ><i class="fa fa-download"></i> Download</a></p>
            </div>
          </div>
        </div>
      </div>
    </div> -->

  </div>
</div>

@endsection