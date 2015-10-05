

   <div class="sidebar col-sm-12 col-md-3" id="sidebar-wrapper">
						<div class="widget"  >
                            <div class="widget-title">
                                <h3 class="title">Search</h3>
                            </div>
                            <div class="filter-price-box">
                              <form class="form-inline" action="bazaar" method="get">
									<div class="form-group">
										<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
										<div class="input-group">
										 
										  <input type="text" class="form-control" id="exampleInputAmount" name="search" placeholder="Search" value="<?php echo  Input::get('search') ?>">
										  
										</div>
									</div>
									<button type="submit" class="btn btn-primary">Search</button>
								</form>
                            </div>
                        </div>
                        <!--<div class="widget">
                            <div class="widget-title">
                                <h3 class="title">Price Filter</h3>
                            </div>
                            <div class="filter-price-box">
                                
                                <div class="nstSlider range" data-range_min="0" data-range_max="300" data-cur_min="0" data-cur_max="150">
                                    
                                    <div class="bar"></div>
                                   
                                    <div class="leftGrip">
                                        <span class="drag">
                                            <span class="doller">$</span>
                                            <span class="leftLabel"></span>
                                        </span>
                                    </div>
                                    
                                    <div class="rightGrip">
                                        <span class="drag">
                                            <span class="doller">$</span>
                                            <span class="rightLabel"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                        <div class="widget">
                            <div class="widget-title">
                                <h3 class="title">Filter By Category</h3>
                            </div>
                            <div id="MainMenu2">
                                <div class="list-group panel">
                                    <div class="collapse in" id="demo3">
                                        <a href="#1" class="list-group-item" data-toggle="collapse" data-parent="#1">Watch
                                        <i class="fa fa-caret-down"></i></a>
                                        <div class="collapse list-group-submenu" id="1">
                                        <a href="#" class="list-group-item" data-parent="#1">Men</a> 
                                        <a href="#" class="list-group-item" data-parent="#1">Women</a></div>
                                        <a href="#2" class="list-group-item" data-toggle="collapse" data-parent="#2">Dress
                                        <i class="fa fa-caret-down"></i></a>
                                        <div class="collapse list-group-submenu" id="2">
                                        <a href="#" class="list-group-item" data-parent="#SubMenu2">Men</a> 
                                        <a href="#" class="list-group-item" data-parent="#SubMenu2">Women</a></div>
                                        <a href="#3" class="list-group-item" data-toggle="collapse" data-parent="#3">Shoes
                                        <i class="fa fa-caret-down"></i></a>
                                        <div class="collapse list-group-submenu" id="3">
                                        <a href="#" class="list-group-item" data-parent="#3">Men</a> 
                                        <a href="#" class="list-group-item" data-parent="#3">Women</a></div>
                                        <a href="#4" class="list-group-item" data-toggle="collapse" data-parent="#4">Accessories
                                        <i class="fa fa-caret-down"></i></a>
                                        <div class="collapse list-group-submenu" id="4">
                                        <a href="#" class="list-group-item" data-parent="#4">Men</a> 
                                        <a href="#" class="list-group-item" data-parent="#4">Women</a></div>
                                        <a href="#5" class="list-group-item" data-toggle="collapse" data-parent="#5">Electronics Item
                                        <i class="fa fa-caret-down"></i></a>
                                        <div class="collapse list-group-submenu" id="5">
                                        <a href="#" class="list-group-item" data-parent="#5">Phone</a> 
                                        <a href="#" class="list-group-item" data-parent="#5">Laptop</a> 
                                        <a href="#" class="list-group-item" data-parent="#5">Music System</a></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="widget">
                            <div class="widget-title">
                                <h3 class="title">Top Rated Products</h3>
                            </div>
                            <ul class="latest-posts clearfix shop">
                                <li>
                                    <div class="post-thumb">
                                        <img class="img-rounded" src="img/sections/shop/1.jpg" alt="" title="" width="84" height="84" />
                                    </div>
                                    <div class="post-details">
                                        <div class="description">
                                            <a href="#">
                                                
                                                <h5>Nike- Round Neck T-Shirt</h5>
                                            </a>
                                        </div>
                                        <div class="price">
                                        <del>$98</del> $49</div>
                                        <div class="star-rating">
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star-half-o text-color"></i></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-thumb">
                                        <img class="img-rounded" src="img/sections/shop/2.jpg" alt="" title="" width="84" height="84" />
                                    </div>
                                    <div class="post-details">
                                        <div class="description">
                                            <a href="#">
                                                
                                                <h5>Polo- Round Neck T-Shirt</h5>
                                            </a>
                                        </div>
                                        <div class="price">
                                        <del>$28</del> $12</div>
                                        <div class="star-rating">
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star-half-o text-color"></i></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-thumb">
                                        <img class="img-rounded" src="img/sections/shop/3.jpg" alt="" title="" width="84" height="84" />
                                    </div>
                                    <div class="post-details">
                                        <div class="description">
                                            <a href="#">
                                                
                                                <h5>Nike- Round Neck T-Shirt</h5>
                                            </a>
                                        </div>
                                        <div class="price">
                                        <del>$58</del> $25</div>
                                        <div class="star-rating">
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star text-color"></i> 
                                        <i class="fa fa-star-half-o text-color"></i></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget">
                            <div class="widget-title">
                                <h3 class="title">Community Poll</h3>
                            </div>
                            <ul>
                                <li>
									<div class="checkbox">
                                        <input type="radio" name="poll" />
                                        <label class="">less than 18 years</label>
                                    </div>
                                </li>
                                <li>
									<div class="checkbox">
                                        <input type="radio" name="poll" />
                                        <label class="">18-24 years</label>
                                    </div>
                                </li>
                                <li>
									<div class="checkbox">
                                        <input type="radio" name="poll" />
                                        <label class="">24-30 years</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox">
                                        <input type="radio" name="poll" />
                                        <label class="">30-40 years</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox">
                                        <input type="radio" name="poll" />
                                        <label class="">More than 40 years</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget">
                            <div class="widget-title">
                                <h3 class="title">Recommended</h3>
                            </div>
                            <div class="owl-carousel navigation-1" data-pagination="false" data-items="1" data-autoplay="true" data-navigation="true">
                            <img src="img/sections/shop/1.jpg" width="270" height="270" alt="" /> 
                            <img src="img/sections/shop/2.jpg" width="270" height="270" alt="" /></div>
                        </div>
                        <div class="widget">
                            <div class="widget-title">
                                <h3 class="title">Tags</h3>
                            </div>
                            <ul class="tags">
                                <li>
                                    <a href="#">Corporate</a>
                                </li>
                                <li>
                                    <a href="#">business</a>
                                </li>
                                <li>
                                    <a href="#">agency</a>
                                </li>
                                <li>
                                    <a href="#">medical</a>
                                </li>
                                <li>
                                    <a href="#">studio</a>
                                </li>
                                <li>
                                    <a href="#">university</a>
                                </li>
                                <li>
                                    <a href="#">motors</a>
                                </li>
                                <li>
                                    <a href="#">charity</a>
                                </li>
                                <li>
                                    <a href="#">realestate</a>
                                </li>
                                <li>
                                    <a href="#">app</a>
                                </li>
                                <li>
                                    <a href="#">restaurant</a>
                                </li>
                                <li>
                                    <a href="#">fitness</a>
                                </li>
                                <li>
                                    <a href="#">band</a>
                                </li>
                                <li>
                                    <a href="#">wedding</a>
                                </li>
                                <li>
                                    <a href="#">sports</a>
                                </li>
                                <li>
                                    <a href="#">fashion</a>
                                </li>
                            </ul>
                        </div>
						-->
                    </div>
 