@extends('layouts.master')

@section('page-title')
Edit Certificate
@endsection

@section('content')

<div class="row my-3">
    <div class="col">
        <edit-certificate :certificate="{{$certificate->toJson()}}" ></edit-certificate>
    </div>
</div>

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