@extends("layouts.master")


@section('header')


<script type="text/javascript">

function hideErrorMessage(ele){
	$('#'+ele).html("");
}

$(document).ready(function() {
	
	
	$('#myProfile').on('submit', function(){
		var flag = true;
		var namelen = $('#name').val().length;
		if (namelen < 3) {
			$('#sname_error').html("Please Enter Correct Name");
			flag = false;
		}
		var api1keylen = $('#eve_user_id1').val().length;
		var api1vkeylen = $('#eve_api_key1').val().length;
		if (api1keylen < 2) {
			$('#eve_user_error1').html("Please Enter Correct Api Key");
			flag = false;
		}
		
		if (api1vkeylen < 2) {
			$('#eve_api_error1').html("Please Enter Correct Verification Code");
			flag = false;
		}
		
		
		/*var $ij = 0;
		$(":input[id^=eve_user_id]").each(function() {
			$ij++;
			if($ij==1){
				continue
			}
			alert($(this).val());
		});*/
		
		
		return flag;
	});

	
	$("#add_api_key").click(function(e){
		e.preventDefault();
		
		var ap_x=$(":input[id^=eve_user_id]").length;
		ap_x++;
		$("#api_keys").append('<div role="form" class="row"><div class="col-md-6"><input name="eve_user_id[]" class="form-control" id="eve_user_id'+ap_x+'" placeholder="Eve Api Key '+ ap_x +'" /></div><div class="col-md-6"><input  name="eve_api_key[]" class="form-control" id="eve_api_key'+ap_x+'" placeholder="Eve Verification code '+ ap_x +'"   value="" /></div></div>');
		
	});
});


</script>

@stop

@section("content")
         <!-- Sticky Navbar -->
		 
		 
        <div class="page-header">
            <div class="container">
                <h1 class="title">Complete your profile</h1>
            </div>
        </div>
        <!-- page-header -->
        <section class="page-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    Consequuntur ex eligendi minima voluptatem assumenda voluptas quidem sit maiores odio velit voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
					<div id="response"></div>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="content col-sm-12 col-md-8">
                        <form  id="myProfile" class="contact-form" method="post">
                        <h3 class="title">Last step to go</h3>
                        @if(Session::has('ssuccess_messsage'))
						<div class="success" id="success">{{ Session::get('ssuccess_messsage') }}</div>
						@endif
						@if(Session::has('serror_message'))
						<div class="alert alert-danger" role="alert">{{ Session::get('serror_message') }}</div>
						@endif
						
						
						
						@if($profileData['origin'] == 'vk' )							
							<input  @if(!empty($form_data['vk_email']))  'disabled="yes"' @endif class="form-control" type="email" name="email" placeholder="Email *" value="{{ $form_data['vk_email'] }}" onfocus="hideErrorMessage('semail_error');" required />
							<span class="field-errors" id="semail_error" >{{$errors->first('email')}}</span>
						@else
							<input disabled="yes" class="form-control" type="email" name="email" placeholder="Email *" value="{{ $form_data['email'] }}" onfocus="hideErrorMessage('semail_error');"/>
							<span class="field-errors" id="semail_error" >{{$errors->first('email')}}</span>
						@endif

                        <input class="form-control" type="text" name="name" id="name" placeholder="Name *"  value="{{ $form_data['name'] }}"  onfocus="hideErrorMessage('sname_error');" required /> 
						<span class="field-errors" id="sname_error" >{{$errors->first('name')}}</span>
                        <div id="api_keys">
						
						@if(count($apikey)==0) 
							<div class="row" role="form">
								<div class="col-md-6">
									<input name="eve_user_id[1]" class="form-control" id="eve_user_id1" placeholder="Eve User Id"   value="{{ $form_data['eve_user_id'] }}" onfocus="hideErrorMessage('spwd');" />
									<span class="field-errors" id="eve_user_error1">{{$errors->first('eve_user_id')}}</span>
								</div>
								
								<div class="col-md-6">
									<input  name="eve_api_key[1]" class="form-control" id="eve_api_key1" placeholder="Eve API Key"   value="{{ $form_data['eve_api_key'] }}" onfocus="hideErrorMessage('scpwd');"/>
									<span class="field-errors" id="eve_api_error1">{{$errors->signup->first('eve_api_key')}}</span>
								</div>
							  
							</div>
							@else
								@foreach($apikey as $apk)
								<?php if(empty($k)) $k=1; else $k++; ?>
								<div class="row" role="form">
									<div class="col-md-6">
										<input name="eve_user_id[$k]" class="form-control" id="eve_user_id{{ $k }}" placeholder="Eve Api Key"   value="{{ $apk->apikey }}" onfocus="hideErrorMessage('spwd');" />
										<span class="field-errors" id="eve_user_error{{ $k }}">{{$errors->first('eve_user_id')}}</span>
									</div>
									
									<div class="col-md-6">
										<input  name="eve_api_key[$k]" class="form-control" id="eve_api_key{{ $k }}" placeholder="Eve verification Code"   value="{{ $apk->vkey }}" onfocus="hideErrorMessage('scpwd');"/>
										<span class="field-errors" id="eve_api_error{{ $k }}">{{$errors->signup->first('eve_api_key')}}</span>
									</div>
							  
								</div>
								
								@endforeach
							@endif
							
							
							
							
                        </div>
						<div class="clearfix"></div>
						<p><a href="javascript:;" role="button" class="btn btn-info" id="add_api_key">Add New Key</a></p>
                        
                        <button id="submit" class="btn btn-default">Update</button> 
                        <!-- .buttons-box -->
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						</form>
                    </div>
                    <!-- .content -->
                    <div class="col-sm-12 col-md-4">

                    </div>
                </div>
            </div>
        </section>
        <!-- page-section -->
        <div id="get-quote" class="bg-color get-a-quote black text-center" data-appear-animation="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">Need a Help ? 
                    <a class="black" href="#">Contact Us</a></div>
                </div>
            </div>
        </div>
        <!-- request -->


    
		

 
 @stop
 
 
 
 
 
 
