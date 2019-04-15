@extends('layouts.admin.master')
@section('page-title','Management panel')

@section('content')

<app-menu>
	<app-menu-item url="{{url('panel/coupons')}}" icon="credit-card" >Coupons</app-menu-item>
	<app-menu-item url="{{url('panel/users')}}" icon="users" >Users</app-menu-item>
</app-menu>

@endsection