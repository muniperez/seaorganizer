<div class="header bg-primary p-r-0">
    <div class="header-inner header-md-height">
      	<a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu text-white" data-toggle="horizontal-menu"></a>
  		<div class="">
    		<div class="brand inline no-border hidden-xs-down">
      			<a href="/">
        			<img src="/images/logos/text_white.png" alt="logo" data-src="/images/logos/text_white.png" data-src-retina="/images/logos/retina_white.png" height="22" >
      			</a>
    		</div>

    		<!-- START NOTIFICATION LIST -->
    		<ul class="hidden-md-down notification-list no-margin hidden-sm-down b-grey b-l b-r no-style p-l-30 p-r-20">
      
      			<li class="p-r-10 inline">
        			<a href="/certificates/add" class="header-icon" ><i class="fa fa-plus"></i> New certificate</a>
      			</li>
    		</ul>
    		
    		<!-- END NOTIFICATIONS LIST -->
    		
    		<!-- <a href="#" class="search-link hidden-md-down" data-toggle="search"><i class="pg-search"></i>Type anywhere to <span class="bold">search</span></a> -->
  		</div>

  		<div class="d-flex align-items-center">
    		@include('components.user-info')
  		</div>
	</div>

	<div class="bg-white">
  		<div class="container">
    		<div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="4">
      			
      			<a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu"></a>
      
      			<ul>
        			<li>
          				<a href="/dashboard">Home</a>
        			</li>            
        			
        			<li>
          				<a href="/certificates"><span class="title">Certificates</span></a>
        			</li>
        
        			<li>
          				<a href="/account"><span class="title">Account</span></a>
        			</li>

        			<li>
          				<a href="/settings"><span class="title">Settings</span></a>
        			</li>

      			</ul>

      			<!-- <a href="#" class="search-link d-flex justify-content-between align-items-center hidden-lg-up" data-toggle="search">
      				Tap here to search <i class="pg-search float-right"></i>
      			</a> -->
    		</div>
  		</div>
	</div>
</div>