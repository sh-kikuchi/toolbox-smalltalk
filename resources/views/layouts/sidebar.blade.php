
<div id="side-bar" class="py-4 d-none d-md-block">
		<ul class="list-group list-group-flush">
				<li class="list-group-item">
				    <p>{{ Auth::user()->name }}　さん</p>
						<!-- <img src="{{ asset('storage/img/' . Auth::user()->image ) }}" class="rounded-circle mx-auto d-block" width="50"  height="50"> -->
						<div class="text-center">
								@if(Auth::id())
										<i class="fas fa-user-circle fa-3x mr-2" style="color: #333333"></i>
								@else
										<i class="fas fa-user-circle fa-3x mr-2 text-primary"></i></i>
								@endif
						</div>
				</li>
				<li class="list-group-item">
				    <p>チャンネル数</p>
				    <p class="text-right">{{ $cnt_channel }}</p>
				</li>
	</ul>

</div>
