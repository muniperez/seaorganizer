
<!-- START BREADCRUMB -->
<ul class="breadcrumb">

  <li>
    <a href="/">Home</a>
  </li>
  
  @foreach ($crumbs as $crumb)
  	<li>
  		<a href="{{$crumb->path}}" @if ($crumb->status > 0) class="active" @endif >{{$crumb->name}}</a>
  	</li>
  @endforeach
</ul>
<!-- END BREADCRUMB -->


<!-- Crumbs
	name
	path
	status	0,1 -->