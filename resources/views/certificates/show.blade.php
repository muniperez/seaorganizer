@extends('layouts.master')
@section('page-title')
{{$certificate->label}} - View Certificate
@endsection

@section('breadcrumb')
<div class="bg-white">
    <div class="container">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item"><a href="/certificates">Certificates</a></li>
        <li class="breadcrumb-item active">View</li>
      </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row my-3">
    <div class="col">
		<view-certificate :certificate="{{$certificate->toJson()}}" ></view-certificate>
	</div>
</div>

@endsection