@foreach($char_detail as $char1)
<div class="post-image opacity post-list" >
<div class="post-item">
	@if(!empty($char1->char_id))
	<div class="post-image pull-left width-128">
		<img height="128" width="128" src="http://image.eveonline.com/Character/{{ str_replace('_256','_128',$char1->profile_link) }}">
	</div>
	@endif
  
	<div class="post-content">
	@if($char1->is_protected == 1) {{ "The Character Information is Protected." }}					
	@else 
							
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
          <td scope="row" colspan="4" bgcolor="#e1e1e1"><h2 class="post-title"><a href="#">{{ $char1->username }}</a></h2></td>
        </tr>
        <tr>
					<td scope="row">Corporation</td>
					<td>{{ $char1->corporation }}</td>
				
					<td scope="row">Intelligence</td>
					<td>{{ $char1->intelligence }}</td>
				</tr>
				<tr>
					<td scope="row">Perception</td>
					<td>{{ $char1->perception }}</td>
				
					<td scope="row">Charisma</td>
					<td>{{ $char1->charisma }}</td>
				</tr>
				<tr>
					<td scope="row">R / B / A</td>
					<td>{{ $char1->r_character}} / {{    $char1->b_character }} / {{  $char1->a_character  }}</td>
				
					<td scope="row">Date of Birth</td>
					<td>{{ $char1->dob }}</td>
				</tr>
				<tr>
					<td scope="row">ISK</td>
					<td>@if($char1->isk == "-1.00") {{ "Hidden" }} @else {{ $char1->isk }} @endif</td>
				
					<td scope="row">Average Speed</td>
					<td>{{ $char1->avg_speed }}</td>
				</tr>
				<tr>
					<td scope="row">Skill points</td>
					<td>{{ $char1->skillpoints }}</td>
				
					<td scope="row">Memory</td>
					<td>{{ $char1->memory }}</td>
				</tr>
				<tr>
					<td scope="row">Clone</td>
					<td>{{ $char1->clone }}</td>
				
					<td scope="row">Unallocated</td>
					<td>{{ $char1->unallocated }}</td>
				</tr>
				<tr>
					<td scope="row">Security Status</td>
					<td>{{ $char1->security_status }}</td>
				
					<td scope="row">Remaps</td>
					<td>{{ $char1->remaps }}</td>
				</tr>
				<tr>
					<td scope="row">Alliance</td>
					<td>{{ $char1->alliance }}</td>
				
					<td scope="row">Willpower</td>
					<td>{{ $char1->willpower }}</td>
				</tr>
			</table>
		</div>
		@endif

	</div>
                           
</div>
</div>
@endforeach
