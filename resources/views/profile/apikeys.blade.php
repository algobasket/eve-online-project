	
	
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
								<a href="#">API Keys</a>
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
								<a href="#">API Key Management</a>
							</h4>
							<hr>
							<div class="row">
								<div class="col-sm-6 col-md-12">
									<form class="form-inline" method="post" action="{{ url('/addkeys')}}">
										@if(Session::has('success_message'))<div <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>@endif
										@if(Session::has('error_message'))<div class="alert alert-danger" role="alert">{{ Session::get('error_message') }}</div>@endif
											
										<div class="form-group">
											<input type="text" placeholder="Enter API KEY" class="form-control" name="akey"  id="akey" value="" required >
											<!--<span class="field-errors" id="sname_error" >ddd{{$errors->first('akey')}}</span>-->
										</div>
										<div class="form-group">
											<input type="text" placeholder="Enter VKEY" class="form-control" name="vkey" value="" id="vkey" value="" required>
											<!--<span class="field-errors" id="sname_error" >ddd{{$errors->first('vkey')}}</span>-->
										</div>
										<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						
										<button type="" class="btn btn-default">Add New KEY</button>
										<a class="btn btn-default" target="_blank" href="https://community.eveonline.com/support/api-key/update/" >Generate New API Key</a>
									</form>
								</div>
							</div>
							<hr>	
								@if($apikey)
						<?php $i=1;?>
						@foreach($apikey as $KEY)
							@if((($i-1)%2)  == 0)
							<div class="row">
					
							@endif
							<div class="col-sm-6 col-md-6"><div class="keyAuth">
                    
                        <p class="keyID"><span>Api Key:&nbsp;</span><b>{{ $KEY['apikey'] }}</b></p>
                        <p class="vCode" ><span>vCode:&nbsp;</span><b><span style="font-size:10px">{{ $KEY['vkey'] }}</span></b></p>                        
						<div class="actions">
                            <a href="#" class="btn btn-default">Update</a>
							<!--<a onclick="" href="javascript:void(0);" class="btn btn-default">Detail</a>-->
                            <a onclick="" href="javascript:void(0);" class="btn btn-danger">Delete</a>
                            
                        </div>
                    </div> </div>
							@if(($i%2)  == 0)
							</div>
							<hr>
							@endif
							<?php $i++;?>
						@endforeach
						
						@if((($i)%2)  == 0)
							</div>
							<hr>
						@endif
						
						
					@endif
                
							
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
 
 

 
