@if(!auth()->user()->email_verified)

  <div class="alert alert-danger my-3">
    <i class="fa fa-envelope-o"></i> Your e-mail haven't been verified. Please <a href="{{url('account/sendVerification/email')}}" >click here</a> to resend the verification code.
  </div>

@endif

@if(!auth()->user()->phone_verified)
  <div class="alert alert-danger my-3">
    <i class="fa fa-phone"></i> Your phone haven't been verified. Please <a href="{{url('account/getPhone')}}" >click here</a> to send a verification code.
  </div>
@endif