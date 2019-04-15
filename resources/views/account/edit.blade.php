@extends('layouts.master')
@section('page-title','Edit account')

@section('content')

<div class="row">
  
  <div class="col">
    <p>
      <a href="/account" class="btn btn-default" >Cancel</a>
    </p>

    <form method="post" action="/account/edit" >
    
      {{csrf_field()}}
      {{method_field('PATCH')}}
    
    
    		
      <card-widget title="Personal" >

        <card-widget-content>
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{auth()->user()->name}}" class="form-control" >
          </div>
        </card-widget-content>

        <card-widget-content>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{auth()->user()->email}}" class="form-control" >
          </div>
        </card-widget-content>

        <card-widget-content>
          <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" value="{{auth()->user()->profile->location}}" class="form-control" >
          </div>
        </card-widget-content>
      </card-widget>

      <card-widget title="Professional" >
        
        <card-widget-content>
          <div class="form-group">
            <label>Rank</label>
            <input type="text" name="rank" value="{{auth()->user()->profile->rank}}" class="form-control" >
          </div>
        </card-widget-content>

        <card-widget-content>
          <div class="form-group">
            <label>Vessel</label>
            <input type="text" name="vessel" value="{{auth()->user()->profile->vessel}}" class="form-control" >
          </div>
        </card-widget-content>

      </card-widget>

      <div class="form-group">
        <button type="submit" class="btn btn-success" >Save</button>
      </div>
    </form>
  </div>
</div>
@endsection