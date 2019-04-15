<!-- START User Info-->
<div class="pull-left p-r-10 fs-14 font-heading hidden-md-down text-white">
	<span class="semi-bold">{{auth()->user()->name}}</span>
</div>
<div class="dropdown pull-right">
	<button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  	<span class="thumbnail-wrapper d32 circular inline sm-m-r-5">
	    	<img src="{{auth()->user()->profile->avatar}}" alt="" data-src="{{auth()->user()->profile->avatar}}" data-src-retina="{{auth()->user()->profile->avatar}}" width="32" height="32">
		</span>
	</button>
	<div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
		<a href="/settings" class="dropdown-item"><i class="pg-settings_small"></i> Settings</a>
		<a href="/account" class="dropdown-item"><i class="fa fa-user"></i> Account</a>
		<a href="/contact-us" class="dropdown-item"><i class="fa fa-life-ring"></i> Support</a>

	  	<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="clearfix bg-master-lighter dropdown-item">
	    	<span class="pull-left">Logout</span>
	    <span class="pull-right"><i class="pg-power"></i></span>
	  </a>
	  	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	        {{ csrf_field() }}
	    </form>
	</div>
</div>
<!-- END User Info-->