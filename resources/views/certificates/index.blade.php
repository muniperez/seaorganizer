@extends('layouts.master')
@section('page-title','Certificates')

@section('content')

<div class="row my-3">
    <div class="col">

        <a class="btn btn-primary d-none d-md-inline-block" href="/certificates/add" >
            <i class="fa fa-plus"></i> New certificate
        </a>

        <a class="btn btn-default float-right" href="/calendar" >
            <i class="fa fa-calendar"></i> Add Calendar
        </a>

    </div>
</div>

<certificates-list></certificates-list>

@endsection