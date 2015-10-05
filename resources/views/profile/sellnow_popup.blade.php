<div id="sellnow-form" class="modal small fade in">
			 <div class="container">
		<div class="panel panel-primary ">
			<div class="modal-header">
			
			
			<div class="panel-heading">
				<a class="close" data-dismiss="modal">x</a>
				<h3 class="panel-title"> Start Auction to sell  <span id="char_name" class="text-color"></span></h3>
			</div>
			</div>
			<div class="modal-body" >
			<div class="panel-body">
				<div class="col-md">
					<p id="sell_image"></p>
					<p style="display: none;" class="form-message"></p>
					
					<div class="contact-form">
						<!-- Form Begins -->
						<form action="/sellnow" method="post" id="sellNow" name="sellNow" role="form">
						<!-- Field 3 -->
							<!--<div class="form-group">
								<input type="text" placeholder="Please enter Minimum Bid Amount" class="input-phone form-control" name="min_amount" data-bv-field="contact_phone"></div>-->
							<!-- Field 4 -->
							
							<div class="form-group">
								<input type="text" placeholder="Please enter Title" class="input-phone form-control" name="title" id="title" required onfocus="hideErrorMessage('title_error');">
								<span class="field-errors" id="title_error" >{{$errors->first('title')}}</span>
								</div>	
							<div class="form-group">
								<input type="text" placeholder="Please enter Minimum Increment Amount" class="input-phone form-control" name="inc_value" id="inc_value" required onfocus="hideErrorMessage('inc_value_error');">
								<span class="field-errors" id="inc_value_error" >{{$errors->first('inc_value')}}</span>
								</div>							
							
							<!--<div role="form" class="row">
								<div class="col-md-6">
									<input type="text" placeholder="Please enter Start Date" id="au_start_date" name="au_start_date" class="form-control">
								</div>
								<div class="col-md-6">
									<input type="text" placeholder="Please enter End Date"  class="form-control" name="au_end_date" id="au_end_date">
								</div>
							</div>-->
							
							<div class="textarea-message form-group has-feedback">
								<textarea rows="2" placeholder="Please enter Some Character Detail" class="textarea-message hight-82 form-control" name="char_detail" id="char_detail"  required onfocus="hideErrorMessage('char_detail_error');"></textarea><span class="field-errors" id="char_detail_error" >{{$errors->first('char_detail')}}</span></div>
							
							<!-- Button -->
							<input type="hidden" name="charid" id="charid" value="">
							<input type="hidden" name="charname" id="charname" value="">
							<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<button type="submit" class="btn btn-default">Sell Now</button>
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