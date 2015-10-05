@extends("layouts.master")

@section("content")
            <section id="slider" class="top-pad-80 bottom-pad-80">
                <div data-background="/img/sections/slider/EVE_Online_slider1-bg.jpg" class="image-bg fixed content-in" style="background-image: url(img/sections/slider/EVE_Online_slider1-bg.jpg);"></div>
                <div class="container padding-80">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="img/sections/character1.png" alt="" height="570" width="350">
                        </div>
                        <div class="col-md-8 top-pad-80 white">
                            <h1 class="upper top-padding-120 text-color">Great Way to Grab Eve online Character</h1>
                            <h3> Easy to Search</h3>
                            <p class="description medium white">Check out for the character you want to bid for without having to grind and bind around multiple website!!
                            </p>
                            <p class="top-pad-30"><a href="#" class="btn btn-default big"> Learn More</a> 
                                <!--a href="#" class="btn btn-black big"> Download Now</a-->
                            </p>
                        </div>
                    </div>
                </div>
            </section>




        <section id="about-us" class="page-section">
            <div class="container">
                <div class="section-title" data-animation="fadeInUp">
                    <h1 class="title">Welcome to Eve Garlic</h1>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center" data-animation="fadeInUp">
                        <!-- Text -->
                        <p class="title-description">You are now in right place to get all you want to be successful on Eve Online. You can get the character you want to buy with the skills you are looking for. You can search and join the corporation of your dream. Let the game begin!!</p>
                    </div>
                </div>

                </div>
            </div>
        </section>
        
        <section class="slider rs-slider-full">
                            <!--Find Form -->
            <div class="find-form">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div role="tabpanel" class="travel-tab">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab"><i class="icon-building-o"></i>Characters</a></li>
                                    <li role="presentation"><a href="#flights" aria-controls="flights" role="tab" data-toggle="tab"><i class="icon-plane3"></i>Corporation</a></li>
                                    <li role="presentation"><a href="#rentals" aria-controls="rentals" role="tab" data-toggle="tab"><i class=" icon-home7"></i>Registration</a></li>
                                    <li role="presentation"><a href="#cars" aria-controls="cars" role="tab" data-toggle="tab"><i class=" icon-home7"></i>Application</a></li>
                                                                        </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Character Tab -->
                                    <div role="tabpanel" class="tab-pane active" id="hotels">
										<form action="bazaar" method="get">
                                        <h5>Search For Characters</h5>
                                        <div class="row">
                                            <!-- Character search box -->
                                            <div class="col-sm-6">
												
													<div class="form-group">
														<label for="exampleInputName1">Enter Skills</label>
														<input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Skills" name="search" value="{{ Input::get('search') }}">
													</div>
												
                                            </div>
                                            <!-- Character Search Now -->
                                            <div class="col-sm-2">
												<button type="submit" class="btn btn-default">Search Now</button>
                                            </div>
                                        </div>
										</form>
                                    </div>
                                    <!-- corporation tab -->
                                    <div role="tabpanel" class="tab-pane" id="flights">
                                        <h5>Search For Corporation</h5>
                                        <div class="row">
                                            <!-- corporation searh box -->
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputName2">Enter Details </label>
                                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="character, topic">
                                                </div>
                                            </div>
                                            <!-- Search corporation -->
                                            <div class="col-sm-2">
                                                <a href="#" class="btn btn-default">Search Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Registration -->
                                    <div role="tabpanel" class="tab-pane" id="rentals">
                                        <h5>Click to Register</h5>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <a href="#" class="btn btn-default">Sign up with FB</a>
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="#" class="btn btn-default">Sign up with VK</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Application -->
                                    <div role="tabpanel" class="tab-pane" id="cars">
                                        <h5>Join a corporation</h5>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <a href="#" class="btn btn-default btn-block">Apply Now</a>
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        <section id="fun-factor" class="page-section">
            <!--div class="image-bg content-in fixed" data-background="img/sections/bg/mmo-games-eve-online-odyssey.jpg"></div-->
            <div data-background="img/sections/bg/mmo-games-eve-online-odyssey.jpg" class="image-bg fixed content-in" style="background-image: url(img/sections/bg/mmo-games-eve-online-odyssey.jpg);"></div>
            <div class="container">
                <div class="row text-center fact-counter white">
                    <div class="col-sm-4 col-md-3 bottom-xs-pad-30" data-animation="fadeInLeft">
                        <!-- Icon -->
                        <div class="count-number" data-count="550"><span class="counter">7800</span></div>
                        <!-- Title -->
                        <h5>No. of Corporations</h5>
                    </div>
                    <div class="col-sm-4 col-md-3 bottom-xs-pad-30" data-animation="fadeInRight">
                        <!-- Icon -->
                        <div class="count-number" data-count="1223"><span class="counter">128378</span></div>
                        <!-- Title -->
                        <h5>Auctions</h5>
                    </div>
                    <div class="col-sm-4 col-md-3 bottom-xs-pad-30" data-animation="fadeInLeft">
                        <!-- Icon -->
                        <div class="count-number" data-count="925"><span class="counter">12234</span></div>
                        <!-- Title -->
                        <h5>Appilications</h5>
                    </div>
                    <div class="col-sm-4 col-md-3 bottom-xs-pad-30" data-animation="fadeInRight">
                        <!-- Icon -->
                        <div class="count-number" data-count="1910"><span class="counter">1898993</span></div>
                        <!-- Title -->
                        <h5>Visitors</h5>
                    </div>
                </div>
            </div>
        </section>
        
        
        
        <section id="how-it-works" class="page-section">
            <div class="section-title" data-animation="fadeInUp">
                <!-- Heading -->
                <h2 class="title">Features</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4" data-animation="fadeInRight">
                        <p class="text-center">
                            <a href="img/sections/howitworks1-big.jpg" class="opacity" data-rel="prettyPhoto">
                                <img src="img/sections/howitworks1.jpg" width="370" height="185" alt="" />
                            </a>
                        </p>
                        <h5 class="bottom-margin-10">
                            <a href="#" class="black">How to bait in EVE Online </a>
                        </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                        deserunt a enim harum eaque fugit.</p>
                    </div>
                    <div class="col-sm-4" data-animation="fadeInUp">
                        <p class="text-center">
                            <a href="img/sections/howitworks2-big.jpg" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="img/sections/howitworks2.jpg" width="370" height="185" alt="" />
                            </a>
                        </p>
                        <h5 class="bottom-margin-10">
                            <a href="#" class="black">The Ships of EVE Online</a>
                        </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                        deserunt a enim harum eaque fugit.</p>
                    </div>
                    <div class="col-sm-4" data-animation="fadeInLeft">
                        <p class="text-center">
                            <a href="img/sections/howitswork3-big.jpg" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="img/sections/howitswork3.jpg" width="370" height="185" alt="" />
                            </a>
                        </p>
                        <h5 class="bottom-margin-10">
                            <a href="#" class="black">Core skills</a>
                        </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                        deserunt a enim harum eaque fugit.</p>
                    </div>
                </div>
                <div class="row top-margin-30">
                    <div class="col-sm-4" data-animation="fadeInLeft">
                        <p class="text-center">
                            <a href="img/sections/howitswork4-big.jpg" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="img/sections/howitswork4.jpg" width="370" height="185" alt="" />
                            </a>
                        </p>
                        <h5 class="bottom-margin-10">
                            <a href="#" class="black">The galactic political arena</a>
                        </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                        deserunt a enim harum eaque fugit.</p>
                    </div>
                    <div class="col-sm-4" data-animation="fadeInLeft">
                        <p class="text-center">
                            <a href="img/sections/howitswork5-big.jpg" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="img/sections/howitswork5.jpg" width="370" height="185" alt="" />
                            </a>
                        </p>
                        <h5 class="bottom-margin-10">
                            <a href="#" class="black">Preparing for Battle</a>
                        </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                        deserunt a enim harum eaque fugit.</p>
                    </div>
                    <div class="col-sm-4" data-animation="fadeInLeft">
                        <p class="text-center">
                            <a href="img/sections/howitworks6-big.jpg" class="opacity" data-rel="prettyPhoto[portfolio]">
                                <img src="img/sections/howitworks6.jpg" width="370" height="185" alt="" />
                            </a>
                        </p>
                        <h5 class="bottom-margin-10">
                            <a href="#" class="black">The spectrum of EVE characters</a>
                        </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id pariatur molestiae illum cum facere
                        deserunt a enim harum eaque fugit.</p>
                    </div>
                </div>
            </div>
        </section>
 @stop
