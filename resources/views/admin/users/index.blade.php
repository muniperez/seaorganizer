@extends('layouts.admin.master')
@section('page-title','Users')

@section('content')

<card-widget card-title="Add new user">
	<card-widget-content>
		<form method="post" action="{{url('panel/users')}}" >
			
			{{csrf_field()}}

			<div class="row">

				<div class="col">
					<div class="form-group">
						<input type="text" name="name" class="form-control" placeholder="Name" required>
					</div>
				</div>

				<div class="col">
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="E-mail" required>
					</div>
				</div>

				<div class="col">
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
				</div>

				<div class="col">
					<div class="checkbox ">
	              		<input id="is_admin" type="checkbox" name="is_admin" value="1" checked/>
	              		<label for="is_admin">Admin</label>
	              	</div>
				</div>

				<div class="col">
					<div class="form-group">
						<button type="submit" class="btn btn-success" >Save</button>
					</div>
				</div>
			</div>
		</form>
	</card-widget-content>
</card-widget>

<app-list>

	@foreach($users as $user)
		
		<app-list-item>

			<div>
				<h4>
					{{$user->name}} 

					@if($user->level > 1)
					<span class="badge badge-success">admin</span>
					@endif
				</h4>
				{{$user->email}} (Reg {{$user->registration_step}})
			</div>

		</app-list-item>

	@endforeach

</app-list>

@endsection