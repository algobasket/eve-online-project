	@extends("layouts.master")

	@section("content")

	
			<div class="page-header">
                <div class="container">
                    <h1 class="title">My Profile</h1>
                </div>
                <div class="breadcrumb-box">
                    <div class="container">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/">Home</a>
                            </li>
                            <li>
								<a href="#">My Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
			
			<!-- page-header -->
            <section class="page-section">
                <div class="container">
					<div class="row">
					<div class="pull-right col-sm-12 col-md-9">
						<div class="row">
								
							  <h4 class="title">
									<a href="#">My Profile</a>
								</h4>
								<div class="col-sm-6 col-md-6">
								
									<div class="table-responsive">
										<table class="table">
											<tbody>
												<tr>
													<td scope="row">Name</td>
													<td>{{ $user['name'] }}</td>
												</tr>
												<tr>
													<td scope="row">Email</td>
													<td>@if($profileData['origin'] == 'vk') {{ $user['vk_email'] }} @else {{ $user['email'] }} @endif</td>
												</tr>
												<tr>
													<td scope="row">Created At</td>
													<td>{{ $user['created_at'] }}</td>
												</tr>
												<tr>
													<td scope="row">Last Updated</td>
													<td>{{ $user['updated_at'] }}</td>
												</tr>
											
											
											</tbody>
										</table>
										
										
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="post-image pull-left width-128">
										<img width="128" height="128" src="@if($profileData['origin'] == 'vk') {{ $user['photo_large'] }} @endif">
									</div>
								</div>
							
						</div>
					</div>
							
						 @include('/profile/profilemenu')
					</div>
				</div>
			</section>
			
	  <div id="get-quote" class="bg-color get-a-quote black text-center" data-appear-animation="fadeInUp">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            Need a Help ? <a class="black" href="#">Contact Us </a>
                        </div>
                    </div>
                </div>
            </div>
	  
 @stop
 
 

 
