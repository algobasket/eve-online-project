@extends("layouts.master")

@section('header')


	
<script type="text/javascript">
	   $(document).ready(function(){
	   	$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper-side").toggleClass("toggled");
		});
   

	});
	
	function hideErrorMessage(ele){
		$('#'+ele).html("");
	}
	
</script>		

<script type="text/javascript">
function toggle_visibility(id) {
 var e = document.getElementById(id);
 if(e.style.display == 'block')
  e.style.display = 'none';
 else
  e.style.display = 'block';
  
 return false;
}

function toggle_row_visibility(id) {
 var e = document.getElementById(id);
 if(e.style.display == 'table-row')
  e.style.display = 'none';
 else
  e.style.display = 'table-row';
  
 return false;
}
function show_div(name) {
	var e = document.getElementById(name+"Div");
	if (!e) return true;
	e.style.display = 'block';
	e = document.getElementById(name);
	if (!e) return true;
	e.style.display = 'block';
	
	return false;
}

function hide_div(name) {
	var e = document.getElementById(name+"Div");
	if (!e) return true;
	e.style.display = 'none';
	e = document.getElementById(name);
	if (!e) return true;
	e.style.display = 'none';
	
	return false;
}
function show_notes(id) {
	var e = document.getElementById("notesDiv");
	if (!e) return true;
	e.style.display = 'block';
	e = document.getElementById("notes");
	if (!e) return true;
	e.style.display = 'block';
	document.getElementById("noteText").innerHTML=document.getElementById("note"+id).innerHTML
	
	return false;
}

function hide_notes() {
	var e = document.getElementById("notesDiv");
	if (!e) return;
	e.style.display = 'none';
	e = document.getElementById("notes");
	if (!e) return;
	e.style.display = 'none';
}
function show_name(id) {
	var e = document.getElementById("editNameDiv");
	if (!e) return true;
	e.style.display = 'block';
	e = document.getElementById("editName");
	if (!e) return true;
	e.style.display = 'block';
	document.getElementById("noteText").innerHTML=document.getElementById("note"+id).innerHTML
	
	return false;
}

function hide_name() {
	var e = document.getElementById("editNameDiv");
	if (!e) return;
	e.style.display = 'none';
	e = document.getElementById("editName");
	if (!e) return;
	e.style.display = 'none';
}
function getScrollTop() {
 if (typeof window.pageYOffset !== 'undefined' ) 
	return window.pageYOffset;

 var d = document.documentElement;
 return (d.clientHeight) ? d.scrollTop : document.body.scrollTop;
}

function getWindowHeight() {
 if (typeof window.innerHeight !== 'undefined' ) 
	return window.innerHeight;

 return 0;
}
function watch_for_scroll() {
  window.onscroll = function() {
   var sTop = getScrollTop();
  	var e = document.getElementById("fade");
	if (e) 
		e.style.top = sTop + "px";
	e = document.getElementById("login");
	if (e) 
		e.style.top = (sTop + getWindowHeight() * .4) + "px";
  };
}
function update_skill_time(time){
	day="";
	hour="";
	min="";
	sec="";
	output="";
	D=new Date().getTime()/1000;
	trainingTime=time-D;
	days = Math.floor(trainingTime/(24*60*60));
	hours =Math.floor((trainingTime-(days*24*60*60))/(60*60));
	mins = Math.floor(((trainingTime-(hours*60*60))-(days*24*60*60))/60);
	secs = Math.floor(((trainingTime-(mins*60))-(hours*60*60))-(days*24*60*60));

	if (days ==1)  output += days +" day"; else
	if (days > 1)  output += days +" days";
	if (hours>0&&output!="") output +=", "
	if (hours ==1) output += hours +" hour"; else
	if (hours > 1) output += hours +" hours";
	if (mins>0&&output!="") output +=", "
	if (mins ==1)  output += mins +" minute"; else
	if (mins > 1)  output += mins +" minutes";
	if (secs>0&&output!="") output +=", "
	if (secs ==1)  output += secs +" second"; else
	if (secs > 1)  output += secs +" seconds";
	
	if(trainingTime<=0)
		document.getElementById("skilltime").innerHTML="Training Complete";

	document.getElementById("skilltime").innerHTML=output;
	var t=setTimeout("update_skill_time("+time+")",1000);
}
</script>

 <link href="/css/sidebar.css" rel="stylesheet">


@stop



@section("content")


 <!-- Sticky Navbar -->
        <div class="page-header">
            <div class="container">
                <h1 class="title">Characters Bazaar</h1>
            </div>
            <div class="breadcrumb-box">
                <div class="container">
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">Bazaar</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- page-header -->
        <section class="page-section">
            <div class="container shop">
				
				
                <div class="row">
				<a id="menu-toggle" class="btn-success btn-sm" href="#menu-toggle">+</a>
						<div id="wrapper-side" class="toggled">
                    <div class="col-sm-12 col-md-12 pull-right product-page" id="page-content-wrapper">
					
					@foreach ($content as $cont)
					<?php $profile_link = str_replace("_128","_256",$cont->profile_link); ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="product-item">
                                    <div class="product-img">
                                        <img src="https://image.eveonline.com//Character/{{ $profile_link }}" alt="" width="265" height="276" />
                                        <div class="product-overlay">
                                            <div class="add-to-cart">
                                                <a href="@if(Auth::check())	{{ '#CharSkills' }} @else {{ '#login-popup' }} @endif" data-charid="{{ $cont->char_id }}"  data-charname1="{{ $cont->pilotname }}"  data-toggle="modal">
                                                <i class="fa fa-shopping-cart"></i> SKILLS</a>
                                            </div>
                                            <div class="quick-view">
                                                <a href="@if(Auth::check())	{{ '#CharDetail' }} @else {{ '#login-popup' }} @endif"   data-charname="{{ $cont->pilotname }}" data-toggle="modal">
                                                <i class="fa fa-eye"></i> DETAIL </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-details">
                                        <h4>{{ strip_tags($cont->pilotname) }}</h4>
                                        <h5 class="text-color">Updated At:{{ strip_tags($cont->lastpost_time) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <!-- .product -->
                            <div class="col-md-8 col-sm-6">
                                <!--<div class="product-rating pull-right">
                                    <div class="star-rating">
                                    <i class="fa fa-star"></i> 
                                    <i class="fa fa-star"></i> 
                                    <i class="fa fa-star"></i> 
                                    <i class="fa fa-star"></i> 
                                    <i class="fa fa-star-half-o"></i></div>
                                </div>-->
                                <div class="price-details">
                                    <h3>{{ strip_tags($cont->maintitle) }}</h3>
                                    <span class="price"></span>
                                </div>
                                <div class="description">
                                     <?php 
									 
										//var_dump($cont);
										$str = str_replace("<br><br>","<br>",$cont->wall_post);
										$str = str_replace("<br><br>","<br>",$str);	
										
										$str = str_replace("<br>"," ::abr::",$str);
										
										preg_match_all("{<a (.*?) href=\"(.*?)\" (.*?)>(.*?)</a>}",$str,$desc1,PREG_SET_ORDER);
										//var_dump($desc1);
										$desc2 = preg_replace("/<\\/?a(\\s+.*?>|>)/", "", $str);
										$desc2 = preg_replace("/<.*?>/", "", $desc2);
										$desc2 = str_replace("::abr::","\n",$desc2);
										$desc2 = substr ( $desc2, 0,101 );
										$desc2 = nl2br($desc2);
										$desc2 = rtrim($desc2,"\\");
										
										echo  $desc2; ?>  ...
                                </div>
                                <a href="@if(Auth::check())	{{ url('bazaar/'.strip_tags($cont->id1)) }} @else {{ '#login-popup' }} @endif" class="btn btn-default"  data-toggle="modal">Read More</a>&nbsp;&nbsp;
                                <a href="@if(Auth::check())	{{ '#bid-form' }} @else {{ '#login-popup' }} @endif" data-bid-amount="{{ $cont->bid_amount }}" data-au-start="{{ $cont->post_time }}" data-au-end="{{ $cont->end_date }}" data-bid-name="{{ $cont->maintitle }}" data-thread-id="{{ $cont->threadid }}" data-bid-id="{{ $cont->bid_id }}" class="btn btn-primary" data-login-message="1" data-toggle="modal">Bid Now</a>
								
                            </div>
                        </div>
                        @endforeach
						<?php echo $content->render(); ?> 
					
					</div>
					
					@include("charactersale.bid_widget")
					
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
       
			@include("charactersale.bid_popup");   
	   
	   

 @stop
