<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eve Garlic - {{ $title }}</title>

    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Arimo:300,400,700,400italic,700italic' />
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css' />
    <!-- Font Awesome Icons -->
    <link href='/css/font-awesome.min.css' rel='stylesheet' type='text/css' />
    <!-- PrettyPhoto Popup -->
    <link href="/css/prettyPhoto.css" rel="stylesheet" />
    <!-- Icomoon Icons -->
    <link href="css/icons.css" rel="stylesheet" />
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    
    
    <link href="/css/hover-dropdown-menu.css" rel="stylesheet" />
    <!-- Custom Style -->
    <link href="/css/style.css" rel="stylesheet" />
    <link href="/css/vstyle.css" rel="stylesheet" />
	  <link href="/css/responsive.css" rel="stylesheet">
    <!-- Color Scheme -->
    <link href="/css/color.css" rel="stylesheet" />
    
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    
	
		<script src="http://vkontakte.ru/js/api/openapi.js" type="text/javascript"></script>

	<script type="text/javascript">
	  VK.init({
	    apiId: {{ Config::get("vk.appId") }}
	  });
	</script>

	<script type="text/javascript">
		window.fbAsyncInit = function() {
			//SDK loaded, initialize it
			FB.init({
				appId      : '{{ Config::get("facebook.appId") }}',
				xfbml      : true,
				cookie	   : true,
				version    : 'v2.2'
			});
		 
			//check user session and refresh it
			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					//user is authorized
				}
			});
		};
		 
		//load the JavaScript SDK
		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	
	

	
	
	
    @yield('header')
    


    </head>
    <body>
	
	
	<div id="fb-root"></div>
	<div id="vk_api_transport"></div>
		<script language="javascript">
			VK.init({
			  apiId: {{ Config::get("vk.appId") }}
			});
			
			
			function authInfo(response) {
			  if (response.session) {
				window.location.replace('<?php echo url("/login/vkcallback");?>');
			  }
			}
			/*
			VK.Auth.getLoginStatus(authInfo);
			*/
			VK.UI.button('login_button');
		</script>	
	
	
    <div id="page">
		<!-- Page Loader -->
		<div id="pageloader">
			<div class="loader-item fa fa-spin text-color"></div>
		</div>
        <!-- Top Bar -->
        <div id="top-bar" class="top-bar-section top-bar-bg-color">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Top Contact -->
                        <div class="top-contact link-hover-black">
                        <a href="#">
                        <i class="fa fa-phone"></i>+ 123 132 1234</a> 
                        <a href="#">
                        <i class="fa fa-envelope"></i>info@eve-garlic.com</a></div>
                        <!-- Top Social Icon -->
                        <div class="top-social-icon icons-hover-black">
						
						@if(Auth::check())
							{{ " Hi " }}
							<b>
								@if(!empty(Auth::user()->name))
									{{ Auth::user()->name}}
								@elseif(!empty(Auth::user()->email))
									{{ Auth::user()->email}}
								@else
								{{ "User" }}
								@endif
							</b>													
						@else
						 Login or Signup:
	                        <a  id="fb-login-button" href="javascript://"><img src="/img/fb_login.png"></a>
	                        <a href="javascript://" id="vk-login-button"  onclick="VK.Auth.login(authInfo);"><img alt="VK login" src="/img/vk_login.png" height="24px" width="24px"></a>
							
						@endif
						   <!--a href="#"><i class="fa fa-youtube"></i></a> 
	                        <a href="#"><i class="fa fa-dribbble"></i></a>
	                        <a href="#"><i class="fa fa-linkedin"></i></a> 
	                        <a href="#"><i class="fa fa-github"></i></a> 
	                        <a href="#"><i class="fa fa-rss"></i></a> 
	                        <a href="#"><i class="fa fa-google-plus"></i></a-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar -->
        
        <!-- Sticky Navbar -->
         <header id="sticker" class="sticky-navigation">
			<!-- Sticky Menu -->
            <div class="sticky-menu relative">
				<!-- navbar -->
				<div class="navbar navbar-default navbar-bg-light" role="navigation">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="navbar-header">
									<a class="navbar-brand" href="/">
										<img class="site_logo" alt="Site Logo" width="190" height="86" src="/img/logo.png" />
									</a>
								</div>
								<div class="navbar-collapse collapse">
									<ul class="nav navbar-nav">
										<li><a href="/">Home</a></li>
										<li><a href="#">Corporation</a></li>
										<li><a href="/bazaar">Character Bazaar</a></li> 
										<li><a href="#">Gallery</a> </li>
										
										
											@if (Auth::check())
												<!--<a class="dropdown-toggle" href="/login/out">{{ Auth::user()->name}} | Logout</a>-->
												<li><a href="/myprofile">My Profile</a> </li>
												<li class="dropdown">
												<a class="dropdown-toggle" href="/login/out"> Logout</a>
													<ul class="dropdown-menu">
														<li>
															<a href="shop-grid-4.html">Settings</a>
														</li>
													</ul>
												</li>
											@else
												<!--a href="/login" class="header-search">
														Login | Join
												</a-->
											@endif	
										
										
									</ul>
								</div>
								<!-- /.navbar-collapse -->
							</div>
							<!-- /.col-md-12 -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container -->
				</div>
				<!-- navbar -->
			</div>
			 <!-- Sticky Menu -->
		</header>
        <!-- Sticky Navbar -->	
		
		
		
		

		 @yield('content')


        <footer id="footer">
            <div class="footer-widget">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3 widget bottom-xs-pad-20">
                            <div class="widget-title">
                                <!-- Title -->
                                <h3 class="title">About Us</h3>
                            </div>
                            <!-- Text -->
                            <p>We like to provide great site with complete features what you want to impletement in your business!</p>
                            <!-- Address -->
                            <p>
                            <strong>Office:</strong> Zozotheme.com
                            <br />No. 12, Ribon Building,
                            <br />Walse street, Australia.</p>
                            <!-- Phone -->
                            <p>
                            <strong>Call Us:</strong> +0 (123) 456-78-90 or
                            <br />+0 (123) 456-78-90</p>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 widget bottom-xs-pad-20">
                            <div class="widget-title">
                                <!-- Title -->
                                <h3 class="title">Blogroll</h3>
                            </div>
                            <nav>
                                <ul>
                                    <!-- List Items -->
                                    <li>
                                        <a href="#">Complete Documentations</a>
                                    </li>
                                    <li>
                                        <a href="#">Additional Plugins &amp; Modules</a>
                                    </li>
                                    <li>
                                        <a href="#">Child Themes</a>
                                    </li>
                                    <li>
                                        <a href="#">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="#">Support Forums</a>
                                    </li>
                                    <li>
                                        <a href="#">Useful Blog</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="widget-title">
                                <!-- Title -->
                                <h3 class="title">My account</h3>
                            </div>
                            <nav>
                                <ul>
                                    <!-- List Items -->
                                    <li>
                                        <a href="#">My account</a>
                                    </li>
                                    <li>
                                        <a href="#">Order History</a>
                                    </li>
                                    <li>
                                        <a href="#">Shopping Cart</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 widget">
                            <div class="widget-title">
                                <!-- Title -->
                                <h3 class="title">Latest News</h3>
                            </div>
                            <nav>
                                <ul class="footer-blog">
                                    <!-- List Items -->
                                    <li>
                                        <a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                                    </li>
                                    <li>
                                        <a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                                    </li>
                                    <li>
                                        <a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 widget newsletter bottom-xs-pad-20">
                            <div class="widget-title">
                                <!-- Title -->
                                <h3 class="title">Newsletter Signup</h3>
                            </div>
                            <div>
                                <!-- Text -->
                                <p>Subscribe to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</p>
                                <p class="form-message1" style="display: none;"></p>
                                <div class="clearfix"></div>
                                <!-- Form -->
                                <form id="subscribe_form" action="subscription.php" method="post" name="subscribe_form" role="form">
                                    <div class="input-text form-group has-feedback">
                                    <input class="form-control" type="email" value="" name="subscribe_email" /> 
                                    <button class="submit bg-color" type="submit">
                                        <span class="glyphicon glyphicon-arrow-right"></span>
                                    </button></div>
                                </form>
                            </div>
                            <!-- Count -->
                            <div class="footer-count">
                                <p class="count-number" data-count="93550">total downloads : 
                                <span class="counter"></span></p>
                            </div>
                            <div class="footer-count">
                                <p class="count-number" data-count="79550">happy clients : 
                                <span class="counter"></span></p>
                            </div>
                            <!-- Social Links -->
                            <div class="social-icon gray-bg icons-circle i-3x">
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                            </a> 
                            <a href="#">
                                <i class="fa fa-twitter"></i>
                            </a> 
                            <a href="#">
                                <i class="fa fa-pinterest"></i>
                            </a> 
                            <a href="#">
                                <i class="fa fa-google"></i>
                            </a> 
                            <a href="#">
                                <i class="fa fa-linkedin"></i>
                            </a></div>
                        </div>
                        <!-- .newsletter -->
                    </div>
                </div>
            </div>
            <!-- footer-top -->
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <!-- Copyrights -->
                        <div class="col-xs-10 col-sm-6 col-md-6"> &copy; 2015 <a href="#">evegarlic.com</a>. Creative Agency.
                        <br />
                        <!-- Terms Link -->
                         
                        <a href="#">Terms of Use</a> / 
                        <a href="#">Privacy Policy</a></div>
                        <div class="col-xs-2 col-sm-6 col-md-6 text-right page-scroll gray-bg icons-circle i-3x">
                            <!-- Goto Top -->
                            <a href="#page">
                                <i class="glyphicon glyphicon-arrow-up"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-bottom -->
        </footer>
        <!-- footer -->

	</div>
	<div id="login-popup" class="modal small fade in">
		<div class="container">
			<div class="panel panel-primary vmodal-height" >
				<div class="modal-header">		
					<div class="panel-heading">
						<a class="close" data-dismiss="modal">x</a>
						
						<h3 class="panel-title">Login<h3>
					</div>
				</div>
				<div class="modal-body" >
					<div class="panel-body">
						<div id="login_message">
						</div>
					</div>
				</div>
			</div>
		</div>	   
	</div>	
	<script type="text/javascript">

	   $(document).ready(function(){
			$("#login-popup").on('show.bs.modal',function(e){	   
				var message_id = $(e.relatedTarget).data('login-message');
				if(message_id == 1){
					message="You are not logged in. Please Login to Bid Here";
				}else{
					message="You are not logged in. Please Login";
				}
				$('#login_message').html(message);
				
			});
		});
	</script>
	<!-- Scripts -->
	<script src="{{ elixir('js/vendor.js') }}"></script>
	<script src="{{ elixir('js/app.js') }}"></script>	
  <script type="text/javascript" src="/js/custom.js"></script> 
  <!-- Pretty Photo Popup --> 
  <script type="text/javascript" src="/js/jquery.prettyPhoto.js"></script> 
	<script  language="javascript"> 

		//add event listener to login button
		document.getElementById('fb-login-button').addEventListener('click', function() {
			//do the login
			FB.login(function(response) {
				if (response.authResponse) {
					//user just authorized your app
					console.log(response);
					window.location.replace("/login/fbcallback");
				}
			}, {scope: 'email,public_profile', return_scopes: true});
		}, false);		
		
    </script>
	
    </body>
</html>