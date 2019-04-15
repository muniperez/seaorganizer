<div class="card-header clearfix" @click="loadCertificate({{$key}})" >
    <h5>{{ $certificate->label }}</h5>
    <h6 class="text-{{$certificate->class()}}">
        <small><i class="fa fa-circle"></i></small> Expires in {{$certificate->expires()->diffForHumans()}}
    </h6>
</div>