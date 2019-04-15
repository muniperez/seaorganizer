<div class="header bg-primary p-r-0">
    <div class="header-inner header-md-height">
      	<a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu text-white" data-toggle="horizontal-menu"></a>
  		<div class="">
    		<div class="brand inline no-border hidden-xs-down">
      			<a href="/">
        			<img src="/images/logos/text_white.png" alt="logo" data-src="/images/logos/text_white.png" data-src-retina="/images/logos/retina_white.png" height="22" >
      			</a>
    		</div>

  		</div>

  		<div class="d-flex align-items-center">

        <div class="pull-left  m-r-10">
          <a class="btn btn-success text-white" href="{{route('dashboard')}}" >Dashboard</a>
    		</div>
        @include('components.user-info')

  		</div>
	</div>

	<div class="bg-white">
  		<div class="container">
    		<div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="4">
      			
      			<a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu"></a>
      
      			<ul>
        			<li>
          				<a href="{{route('admin')}}">Home</a>
        			</li>            
        			
        			<li>
          				<a href="{{url('panel/users')}}"><span class="title">Users</span></a>
        			</li>
        
        			<li>
          				<a href="{{url('panel/coupons')}}"><span class="title">Coupons</span></a>
        			</li>

        			<li>
          				<a href="{{url('panel/user_settings')}}"><span class="title">User settings</span></a>
        			</li>

      			</ul>

      			<!-- <a href="#" class="search-link d-flex justify-content-between align-items-center hidden-lg-up" data-toggle="search">
      				Tap here to search <i class="pg-search float-right"></i>
      			</a> -->
    		</div>
  		</div>
	</div>
</div>