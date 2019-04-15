@extends('layouts.master')

@section('page-title')
Add Certificates
@endsection

@section('content')

<div class="row my-3">
    <div class="col">

        <add-certificates></add-certificates>

        <p>
        	<a href="/certificates" class="btn btn-success" ><i class="fa fa-check"></i> Done</a>
        </p>

    </div>
</div>

@endsection

@section('breadcrumb')
<div class="bg-white">
    <div class="container">
        <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item"><a href="/certificates">Certificates</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </div>
</div>
@endsection