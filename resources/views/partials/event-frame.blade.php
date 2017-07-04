<tr>
	<th>{{$frame_name}}</th>
	<td>
		<p>
			<span class="now-count">{{$current_count}}</span>
			<span class="slash">/</span>
			<span class="max-count">{{$max_count}}</span>
			人
		</p>
	</td>
	<td>
		@if($is_join)
			<button class="join is-join">参加中</button>
		@else
			<button class="join">参加</button>
		@endif
	</td>
</tr>