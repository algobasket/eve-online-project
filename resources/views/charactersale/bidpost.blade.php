	@extends("layouts.master")
	
	@section("header")
	<script>
	function hideErrorMessage(ele){
		$('#'+ele).html("");
	}
	</script>
	@stop
	
	
	
	@section("content")

	@foreach ($threaddetail as $threaddetai)
	<?php 	$pilotname = urlencode(trim($threaddetai->pilotname));?>
	@endforeach
	
	@foreach ($firstpost as $fist_p)
	<?php $p_link = $fist_p->profile_link; ?>
	
	@endforeach
			<div class="page-header">
                <div class="container">
                    <h1 class="title">{{ $threaddetai->maintitle }}</h1>
                </div>
                <div class="breadcrumb-box">
                    <div class="container">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/">Home</a>
                            </li>
                            <li>
                              <a href="/bazaar">Bazaar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- page-header -->
            <section class="page-section">
                <div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-9">
						<div class="row">
							 <div class="col-sm-12">
							<div id="table_skills" >
								<script>$('#table_skills').load("<?php echo url('eveboard/'.$pilotname.'/');?>");</script>
									
								</div>
								<div class="post-image opacity post-list">
									<div class="post-item">
										<div class="post-image pull-left width-128">
											<img width="128" height="128" src="/img/72x72_Icon_bidding.jpg">
										</div>
										<div class="post-content">
											<div>
												<h4>Highest Bid Offer : <span class="text-color">@if(empty($top_bid)) {{ "Please Check related Posts" }} @else {{ $top_bid['0'] }} @endif</span> </h4> 
												@for($a =0;$a<count($top_bid);$a++)
												<span> {{ $top_bid[$a] }} </span>
												@endfor
												<h5> Auction Started on  &nbsp;<span class="text-color" >{{ $fist_p->post_time }}</span>. End Date &nbsp;<span class="text-color" >{{ $fist_p->end_date }}</span>.</h5>
												<a href="#bid-form" data-bid-amount="{{ $fist_p->bid_amount }}" data-au-start="{{ $fist_p->post_time }}" data-au-end="{{ $fist_p->end_date }}" data-bid-name="{{ $threaddetai->maintitle }}" data-thread-id="{{ $fist_p->threadid }}" data-bid-id="{{ $fist_p->bid_id }}" class="btn btn-default" data-login-message="1" data-toggle="modal">Bid Now</a>
											</div>
										</div>
							   
									</div>
								</div>
						
						<div class="post-content top-pad-20">
								<h4>Auction Detail</h4>
									
									
									<?php 
										//var_dump($cont);
										$str = str_replace("<br><br>","<br>",$fist_p->wall_post);
										$str = str_replace("<br><br>","<br>",$str);	
										
										$str = str_replace("<br>"," ::abr::",$str);
										
										preg_match_all("{<a (.*?) href=\"(.*?)\" (.*?)>(.*?)</a>}",$str,$desc1,PREG_SET_ORDER);
										//var_dump($desc1);
										$desc2 = preg_replace("/<\\/?a(\\s+.*?>|>)/", "", $str);
										$desc2 = preg_replace("/<.*?>/", "", $desc2);
										$desc2 = str_replace("::abr::","<br>",$desc2);
										echo  $desc2; ?>
									
								</div>
								<div class="post-meta">
									<!-- Author  -->								
									<span class="author"><i class="fa fa-user"></i> {{ $threaddetai->pilotname }}</span>
									<!-- Meta Date -->
									<span class="time"><i class="fa fa-calendar"></i> {{ date("d-m-Y H:i:s",strtotime($threaddetai->lastpost_time)) }} </span>
									<!-- Comments -->
									<span class="category "><i class="fa fa-heart"> {{ $threaddetai->topiclikes }} </i></span>
									<!-- Category -->
									<span class="comments pull-right"><i class="fa fa-comments"></i> Conversation {{ $threaddetai->topicreplies }}</span>								
								</div>
							</div>		
						</div>
						<hr>
						
						<div class="row">
							<div class="col-md-12 top-pad-20">
								<h4>Bid Board</h4>								
								@foreach ($content as $cont)
								<?php if($cont->post_rank == 1) { continue;} ?>
								<div class="comment-item">
									<div class="pull-left author-img"><img class="img-circle" src="https://image.eveonline.com//Character/{{ $cont->profile_link }}" width="80" height="80" alt="" title=""></div>
									<p><?php 
									 
										//var_dump($cont);
										$str = str_replace("<br><br>","<br>",$cont->wall_post);
										$str = str_replace("<br><br>","<br>",$str);	
										
										$str = str_replace("<br>"," ::abr::",$str);
										
										preg_match_all("{<a (.*?) href=\"(.*?)\" (.*?)>(.*?)</a>}",$str,$desc1,PREG_SET_ORDER);
										//var_dump($desc1);
										$desc2 = preg_replace("/<\\/?a(\\s+.*?>|>)/", "", $str);
										$desc2 = preg_replace("/<.*?>/", "", $desc2);
										$desc2 = str_replace("::abr::","<br>",$desc2);
										echo  $desc2; ?><br><br></p>
									<div class="post-meta">
										<!-- Author  -->								
										<span class="author"><i class="fa fa-user"></i> {{ $cont->	username }}</span>
										<!-- Meta Date -->
										<span class="time"><i class="fa fa-calendar"></i> {{ date("d-m-Y H:i:s",strtotime($cont->post_time)) }}</span>
										<!-- Category -->
										<!--<span class="comments pull-right"><i class="fa fa-comments"></i> <a href="#">reply</a></span>	-->								
									</div>
								</div>
								@endforeach
								<?php echo $content->render(); ?> 
								
							</div>
						</div>
						<!--
						<h4>Leave a Reaply</h4>
						<div class="row">
									<form role="form" name="contactform"  method="post">									
																		
											<div class="col-md-6">
												<div class="input-text form-group">
													<input type="text" name="contact_name" class="input-name form-control" placeholder="Full Name" />
												</div>
												
												<div class="input-email form-group">
													<input type="email" name="contact_email" class="input-email form-control" placeholder="Email"/>
												</div>
											</div>
											<div class="col-md-8">
											
											<div class="textarea-message form-group">
												<textarea name="contact_message" class="textarea-message form-control" placeholder="Message" rows="4" ></textarea>
											</div>
											
											<button class="btn btn-default" type="submit">Send Now <i class="icon-paper-plane"></i></button>
											</div>
										</div>
									</form>-->
					</div>
					<div class="sidebar col-sm-12 col-md-3">
						
						<div class="widget">
							<div class="widget-title">
							<h3 class="title">Recent Posts</h3>
							</div>
							@foreach($last_three_posts as $lastpo)
							<?php if($lastpo->post_rank == 1) { continue;} 
							
							?>
							<ul class="latest-posts">
								
								<li>
									<div class="post-thumb"><img class="img-rounded" src="https://image.eveonline.com//Character/{{ $lastpo->profile_link }}" alt="" title="" width="84" height="84"></div>
									<div class="post-details">
										<div class="description">
											<a href="#">
										<?php
										
										$str = str_replace("<br><br>","<br>",$lastpo->wall_post);
										$str = str_replace("<br><br>","<br>",$str);	
										
										$str = str_replace("<br>"," ::abr::",$str);
										
										preg_match_all("{<a (.*?) href=\"(.*?)\" (.*?)>(.*?)</a>}",$str,$desc1,PREG_SET_ORDER);
										//var_dump($desc1);
										$desc2 = preg_replace("/<\\/?a(\\s+.*?>|>)/", "", $str);
										$desc2 = preg_replace("/<.*?>/", "", $desc2);
										$desc2 = str_replace("::abr::","\n",$desc2);
										if(strlen($desc2) > 20){
											$desc2 = substr ( $desc2, 0,20 );
											$desc2 = $desc2." ... ";
										}
										
										$desc2 = nl2br($desc2);
										$desc2 = rtrim($desc2,"\\");
										echo $desc2;
											
											?>
												
											</a>
										</div>								
										<div class="meta">
											<!-- Meta Date -->
											<span class="time"><i class="fa fa-calendar"></i> {{ date("d-m-Y H:i:s",strtotime($lastpo->post_time)) }}</span>
										</div>
									</div>
								</li>
								@endforeach
							</ul>							
						</div>
				
				</div>
				</div>
				</div>
            </section>
            <!-- page-section -->
            <div id="get-quote" class="bg-color get-a-quote black text-center" data-appear-animation="fadeInUp">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            Need a Help ? <a class="black" href="#">Contact Us </a>
                        </div>
                    </div>
                </div>
            </div>
       
       @include("charactersale.bid_popup");   

 @stop
 
 

 
