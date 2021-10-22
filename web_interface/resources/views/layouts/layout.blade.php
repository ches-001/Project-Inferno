<!DOCTYPE html>
<html>
  <head>
    <title>Project INFERNO.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel="stylesheet", href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet", href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet", href="/css/custom-style.css">

    <script src="/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
  <!--Beginning of nav-->
	<nav class="navbar">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="fa fa-bars"></span>
	      </button>
	      <a class="" id="brand-text" href="/">
              <h3> <i class="fa fa-fire"> </i> INFERNO</h3>
        </a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a class="" id="nav-text" href="/">Home</a></li>
          <li><a class="" id="nav-text" href="{{route('/map')}}">Map</a></li>
          <li><a class="" id="nav-text" href="#site-footer">Contact</a></li>
	        <li><a class="" id="nav-text" href="{{route('/about_us')}}">About</a></li>
	      </ul>
	    </div>
	  </div>
	</nav><!--end of nav-->
    @yield('content')
    <!-- Footer -->
    <footer class="site-footer" id="site-footer">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <h6>About Us</h6>
                <p class="text-justify">
                  Project Inferno is a miniature project designed to simply predict the brightness temperature of a 
                  land surface via it's longitude and latitude coordinates with the aid of Feed forward Network
                  in Deep learning.
                  <span class="bolder"><a href="{{route('/about_us')}}">Read more</a></span>
                </p>
              </div>

              <div class="col-xs-6 col-md-3 pull-right">
                <h6>Quick Links</h6>
                <ul class="footer-links">
                  <li><a href="{{route('/about_us')}}"><span class="bolder">About?</span></a></li>
                  <li><a href="#site-footer"><span class="bolder">Contact Us</span></a></li>
                </ul>
              </div>
            </div>
            <hr>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-7 col-sm-6 col-xs-12">
                <p class="copyright-text">Copyright &copy; 2020 All Rights Reserved by 
                  <a href="#">INFERNO</a>.
                </p>
              </div>
              <div class="col-md-5 col-sm-6 col-xs-12">
                <ul class="social-icons">
                  <div class="collapse" id="phone-contacts">
                    <p class="bolder phone-contact-text">+234(0)9057900367 <i class="fa fa-phone"></i></p>
                  </div>
                  <div class="collapse" id="whatsapp-contacts">
                    <p class="bolder whatsapp-contact-text">+234(0)9057900367 <i class="fa fa-whatsapp"></i></p>
                  </div>
                  <li><a class="phone" href="#phone-contacts" data-toggle="collapse"><i class="fa fa-phone"></i></a></li>
                  <li><a class="whatsapp" href="#whatsapp-contacts" data-toggle="collapse"><i class="fa fa-whatsapp"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
    </footer>
    <!-- Footer -->
  </body>
</html>
