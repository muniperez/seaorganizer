      <!-- BEGIN HEADER -->
        <nav class="header md-header light-solid " data-pages="header" >
          <div class="container relative">
            <!-- BEGIN LEFT CONTENT -->
            <div class="pull-left">
              <!-- .header-inner Allows to vertically Align elements to the Center-->
              <div class="header-inner">
                <!-- BEGIN LOGO -->
                <a href="/">
                  <img src="/images/logos/text.png" height="21" data-src-retina="/images/logos/retina.png" class="logo" alt="SeaOrganizer">
                  <img src="/images/logos/text_white.png" height="21" data-src-retina="/images/logos/retina_white.png" class="alt" alt="">
                </a>
              </div>
            </div>
            <!-- BEGIN HEADER TOGGLE FOR MOBILE & TABLET -->
            <div class="pull-right">
              <div class="header-inner">
                
                <div class="visible-sm-inline visible-xs-inline menu-toggler pull-right p-l-10" data-pages="header-toggle" data-pages-element="#header">
                  <div class="one"></div>
                  <div class="two"></div>
                  <div class="three"></div>
                </div>
              </div>
            </div>
            <!-- END HEADER TOGGLE FOR MOBILE & TABLET -->
            <!-- BEGIN RIGHT CONTENT -->
            <div class="menu-content mobile-dark pull-right clearfix" data-pages-direction="slideRight" id="header">
              <!-- BEGIN HEADER CLOSE TOGGLE FOR MOBILE -->
              <div class="pull-right">
                <a href="#" class="padding-10 visible-xs-inline visible-sm-inline pull-right m-t-10 m-b-10 m-r-10" data-pages="header-toggle" data-pages-element="#header">
                  <i class=" pg-close_line"></i>
                </a>
              </div>
              <!-- END HEADER CLOSE TOGGLE FOR MOBILE -->
              <!-- BEGIN MENU ITEMS -->
              <div class="header-inner">
                <ul class="menu">
                    <li>
                        <a href="/" class="active">Home </a>
                    </li>
                    
                    <li>
                        <a href="/features" >Features </a>
                    </li>

                    <li>
                        <a href="/pricing" >Pricing </a>
                    </li>

                    <li>
                        <a href="/contact-us">Contact Us</a>
                    </li>

                    @auth
                      <li>
                          <a href="/dashboard" class="btn btn-sm btn-success" >Dashboard</a>
                      </li>
                    @else

                      <li>
                          <a href="/login">Login</a>
                      </li>

                      <li>
                          <a href="/register" class="btn btn-sm btn-success" >Sign Up</a>
                      </li>
                    @endauth

                </ul>
              </div>
              <!-- END MENU ITEMS -->
            </div>
          </div>
        </nav>
      <!-- END HEADER -->