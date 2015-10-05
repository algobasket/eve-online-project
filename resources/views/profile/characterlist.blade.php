	@extends("layouts.master")

	
	@section('header')
	
	<script>
	   $(document).ready(function(){
	   $("#sellnow-form").on('show.bs.modal',function(e){
		   
		   $("#char_name").text("");
		   $("#sell_image").text("");
		   $("#charid").val("");
		   $("#charname").val("");
		  
		    //au_end=="";
		   var char_name = $(e.relatedTarget).data('char-name');
		   var charid = $(e.relatedTarget).data('char-id');
		   
		    
		   $("#char_name").text(char_name);
		   $("#sell_image").html('<img src="https://image.eveonline.com//Character/'+charid +'_128.jpg">');
		   $("#charid").val(charid);
		   $("#charname").val(char_name);
		   
		   
	   });
	   
	   $('#sellNow').on('submit', function(){
		   $('#inc_value_error').html("");
			if(!($.isNumeric($('#inc_value').val()))){
				$('#inc_value_error').html("Please Enter Numeric Increment Value");	
				return false; 				
		   }
		   
	   });
	   
	   
	   
	   });
	   
	   
	function hideErrorMessage(ele){
		$('#'+ele).html("");
	}
		   
	</script>
	@stop
	
	
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
								<a href="#">My Characters</a>
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
									<a href="#">My Characters</a>
								</h4>
							
							<hr>	
								@if($characters)
						<?php $i=1;?>
						@foreach($characters as $CHAR)
							@if((($i-1)%3)  == 0)
							<div class="row">
					
							@endif
							<div class="col-sm-6 col-md-4"><div class="charList">
						
                       
                        <div > <img width="128" height="128" title="" alt="" src="https://image.eveonline.com//Character/{{ $CHAR['char_id'] }}_128.jpg"></div>
						 <p ><span class="descriptor">Name:&nbsp;</span><b>{{ $CHAR['username'] }}</b></p>
                        <p class="vCode"><span class="descriptor">Corporation:&nbsp;</span><b>{{ $CHAR['corporation'] }}</b></p>
                        
						<div class="actions">
							@if($CHAR['sell_status'] == 0 )
							<a href="#sellnow-form"  data-char-name="{{ $CHAR['username'] }}"  data-char-id="{{ $CHAR['char_id'] }}"  class="btn btn-default" data-toggle="modal">Sell Now</a>
							@else
							<a href="#end_auction"   class="btn btn-default">END Auction</a>
							@endif
							<!--<a onclick="" href="javascript:void(0);" class="btn btn-default">Detail</a>-->
                            <!--<a onclick="" href="javascript:void(0);" class="btn btn-danger">Delete</a>
                            -->
                        </div>
                    </div> </div>
							@if(($i%3)  == 0)
							</div>
							<hr>
							@endif
							<?php $i++;?>
						@endforeach
						
						@if((($i)%3)  == 0)
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
	  @include('/profile/sellnow_popup')
 @stop
 
 

 
