@extends("layouts.master")


@section('header')
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



@stop



@section("content")
         <!-- Sticky Navbar -->
		 
		  

	<div id="vk_api_transport"></div>    
	
	<script language="javascript">
		VK.init({
		  apiId: {{ Config::get("vk.appId") }}
		});
		
		
		function authInfo(response) {
		  if (response.session) {
		    window.location.replace("/login/vkcallback");
		  }
		}
		/*
		VK.Auth.getLoginStatus(authInfo);
		*/
		VK.UI.button('login_button');
	</script>	


		 
        <div class="page-header">
            <div class="container">
                <h1 class="title">Login | Join</h1>
            </div>
        </div>
        <!-- page-header -->
        <section class="page-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    Our Joining process is simple. Just use your FB credential or VK credential. You are good to go. Please keep your Eve Online API key for characters in handy as its very much required to complete the sign up process and fully be a part of Eve Garlic. Mind it your API keys are never public. We follow Advanced Encryption Standard.
					<div id="response"></div>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="content col-sm-12 col-md-8">
							<a href="javascript://" id="fb-login-button"><img src="/img/fb-login.png"/></a>




                    </div>
                    <!-- .content -->
                    <div class="col-sm-12 col-md-4">

						<a href="javascript://" id="vk-login-button"  onclick="VK.Auth.login(authInfo);"><img src="/img/vk-login.jpg"/></a>
						
                    </div>
                </div>
            </div>
        </section>
        <!-- page-section -->
        <div id="get-quote" class="bg-color get-a-quote black text-center" data-appear-animation="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"> Need a Help ? 
                    <a class="black" href="#">Contact Us</a></div>
                </div>
            </div>
        </div>
        <!-- request -->
    <script>  

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
		

 
 @stop
 
 
 
 
 
 
