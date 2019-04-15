@extends('layouts.frontend.master')
@section('page-title','Sign Up')

@section('content')
<div class="m-t-60">
    <section class="container container-fixed-lg p-t-65 p-b-100  sm-p-b-30 sm-m-b-30">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <div class="text-center">
                    <h2>Sign Up for an account</h2>

                    <p>And never worry about an expiring certificate!</p>
                </div>

                
                <div class="m-b-15" >
                    <a href="/login/facebook" class="btn btn-primary btn-block" ><i class="fa fa-facebook"></i> Connect with Facebook</a>
                </div>

                <div class="text-center m-b-20 m-t-15">
                    - or -
                </div>

                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    
                    {{ csrf_field() }}

                    <div class="form-group form-group-default ">
                        
                        <label for="name" class="control-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group form-group-default m-t-15">
                        <label for="email" class="control-label">E-Mail Address</label>

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group form-group-default m-t-15">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group form-group-default m-t-15">
                        <label for="password-confirm" class="control-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="form-group m-t-15">
                        <div class="checkbox ">
                            <input id="tos" type="checkbox" name="tos" value="1" checked/>
                            <label for="tos">I accept the <a href="{{url('tos')}}">Terms of Service</a>. I agree on receiving occasional marketing e-mails.</label>
                        </div>
                    </div>


                    <div class="form-group m-t-15">
                        <button type="submit" class="btn btn-success btn-lg">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
