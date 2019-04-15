<div class="card share  col1" data-social="item">

  <div class="card-header clearfix">
    <div class="pull-right text-{{$certificate->class()}}">
      <small><i class="fa fa-circle"></i>
    </div>

    <a href="/certificates/{{$certificate->id}}" >
      <h5>
        {{ $certificate->label }}
      </h5>
      <h6>
        Expires in {{$certificate->expires()->diffForHumans()}}
      </h6>
    </a>
  </div>

  @if($certificate->remarks || $certificate->issuer)
  <div class="card-description">
    
    @if($certificate->remarks)
        <p>{{ $certificate->remarks }}</p>
    @endif

    @if($certificate->issuer)
        <div class="via">Issued by {{ $certificate->issuer }}</div>
    @endif
  </div>
  @endif
</div>