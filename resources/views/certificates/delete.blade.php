@extends('layouts.master')

@section('page-title')
Deleting certificate {{$certificate->label}}
@endsection

@section('content')

    <div class="card card-default">
        <div class="card-block">

            <h3>Are you sure you want to delete this certificate?</h3>

            <p>Please be aware of the following:</p>

            <ul>
                <li class="text-danger" >This action cannot be undone.</li>
                <li>Any stored file for this certificate will be permanently deleted.</li>
                <li>Instead, you can archive this item so we will stop tracking it.</li>
            </ul>

        </div>

        <div class="card-block">
            <form method="post" action="/certificates/{{$certificate->id}}" >
                {{csrf_field()}}
                {{method_field('DELETE')}}

                <button type="submit" class="btn btn-danger" ><i class="fa fa-times"></i> Yes, delete</button>
                <a href="/certificates/{{$certificate->id/archive" class="btn btn-default" ><i class="fa fa-archive"></i> Archive instead</a>

                <a href="/certificates/{{$certificate->id" class="btn btn-default float-right" ><i class="fa fa-times"></i> Cancel</a>
            </form>
        </div>
    </div>
@endsection