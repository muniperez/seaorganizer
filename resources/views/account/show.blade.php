@extends('layouts.master')
@section('page-title','My Account')

@section('content')

<user-account :user="{{$user}}" :subscription="{{$subscription}}" ></user-account>

@endsection