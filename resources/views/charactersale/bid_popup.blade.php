<div id="bid-form" class="modal small fade in">
			 <div class="container">
		<div class="panel panel-primary vmodal-height">
			<div class="modal-header">
			
			
			<div class="panel-heading">
			<a class="close" data-dismiss="modal">x</a>
			<h3 class="panel-title">BID FOR : <span id="bid_name" class="text-color"></span><h3>
			</div>
			</div>
			<div class="modal-body" >
			<div class="panel-body">
				<div class="col-md">
					<p>Highest Bid Offer <i id="bidAmount" class="text-color"></i></p>
					<p>Auction Started on  <i id="au_start" class="text-color"></i>. End Date <i id="au_end" class="text-color"></i></p>
					<p style="display: none;" class="form-message"></p>
					
					<div class="contact-form">
						<!-- Form Begins -->
						<form action="/bidnow" method="post" id="bidNowForm" name="bidNowForm" role="form">
						<!-- Field 3 -->
							<div class="input-email form-group has-feedback">
								<input type="text" placeholder="Enter Your Bid Amount" class="form-control" name="bid_am" id="bid_am" required onfocus="hideErrorMessage('bid_am_error');">
								<span class="field-errors" id="bid_am_error" >{{$errors->first('bid_am')}}</span>
								</div>
							<!-- Field 4 -->
							<div class="textarea-message form-group has-feedback">
								<textarea rows="2" placeholder="Comment" class="textarea-message hight-82 form-control" name="post_message" id="post_message" required  onfocus="hideErrorMessage('post_message_error');"></textarea>
								<span class="field-errors" id="post_message_error" >{{$errors->first('post_message')}}</span>
								</div>
							<!-- Button -->
							<input type="hidden" name="thread_id" id="thread_id" value="">
							<input type="hidden" name="bid_id" id="bid_id" value="">
							<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<button type="submit" class="btn btn-default">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						</form>
							<!-- Form Ends -->
					</div>
			</div>
			</div>
			</div>
			</div>
		</div>	   
		</div>	
	
<div id="CharSkills" class="modal small fade in">
	<div class="container">
		<div class="panel panel-primary">
			<div class="modal-header">		
				<div class="panel-heading">
					<a class="close" data-dismiss="modal">x</a>
					
					<h3 class="panel-title">Character Skills<h3>
				</div>
			</div>
			<div class="modal-body" >
				<div class="panel-body">
					<div id="allSkills">
					
					</div>
				</div>
			</div>
		</div>
	</div>	   
</div>	
<div id="CharDetail" class="modal small fade in">
	<div class="container">
		<div class="panel panel-primary">
			<div class="modal-header">		
				<div class="panel-heading">
					<a class="close" data-dismiss="modal">x</a>
					<h3 class="panel-title">Character Details<h3>
				</div>
			</div>
			<div class="modal-body" >
				<div class="panel-body">
					<div id="allDetail">
						
					</div>
				</div>
			</div>
		</div>
	</div>	   
</div>	







<script>
	   $(document).ready(function(){
	   $("#bid-form").on('show.bs.modal',function(e){
		   
		   $("#bidAmount").text("");
		   $("#thread_id").val("");
		   $("#au_start").text("");
		   $("#au_end").text("");
		   $("#bid_name").text("");
		   $("#bid_id").val("");
		   
		    //au_end=="";
		   
		   var bidAmount = $(e.relatedTarget).data('bid-amount');
		   var thread_id = $(e.relatedTarget).data('thread-id');
		   var au_start = $(e.relatedTarget).data('au-start');
		   var au_end = $(e.relatedTarget).data('au-end');
		   var bid_name = $(e.relatedTarget).data('bid-name');
		   var bid_id = $(e.relatedTarget).data('bid-id');
		    
		   if(bidAmount == "")
		   bidAmount ="Please Check Related Posts";
		   $("#bidAmount").text(bidAmount);
		   $("#thread_id").val(thread_id);
		   $("#bid_id").val(bid_id);
		   $("#au_start").text(au_start);
		   $("#au_end").text(au_end);
		   $("#bid_name").text(bid_name);
		   
	   });
	   
	   $("#CharSkills").on('show.bs.modal',function(e){	   
			var charid = $(e.relatedTarget).data('charid');
			var charname1 = $(e.relatedTarget).data('charname1');
			var $modal = $(this);
			//id="pageloader"
			$('#allSkills').html('<div ><div class="loader-item fa fa-spin text-color"></div></div>');
			$.ajax({  cache:false,type:'GET',url:'/jackapi',data:{ charid : charid,charname:charname1, _token : '<?php echo csrf_token();?>'  },success: function(data1){
					   $modal.find('#allSkills').html(data1); }
			});
			/*$.ajaxSetup({
				headers:{'csrftoken' : '<?php echo  csrf_token() ?>' }
			});
			*/
	   });
	   
	   
	   $("#CharDetail").on('show.bs.modal',function(e){	   
			var charname = $(e.relatedTarget).data('charname');
			charname = encodeURIComponent(charname);
			$('#allDetail').html('<div ><div class="loader-item fa fa-spin text-color"></div></div>');
			$('#allDetail').load('/eveboard/'+charname);
			
	   }); 
	   
	   $("#login-popup").on('show.bs.modal',function(e){	   
			var message_id = $(e.relatedTarget).data('login-message');
			if(message_id == 1){
				message="You are not logged in. Please Login to Bid Here";
			}else{
				message="You are not logged in. Please Login";
			}
			$('#login_message').html(message);
			
	   });
   
		
		
		
		$('#bidNowForm').on('submit', function(){
		   $('#bid_am').html("");
			if(!($.isNumeric($('#bid_am').val()))){
				$('#bid_am_error').html("Please Enter Numeric Increment Value");	
				return false; 				
		   }
		   
	   });
	});
</script>



		