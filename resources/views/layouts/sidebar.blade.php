
<div id="side-bar" class="py-4 d-none d-md-block">
		<ul class="list-group list-group-flush">
				<li class="list-group-item">
				    <p>{{ Auth::user()->name }}　さん</p>
						<img src="{{ asset('storage/img/' . Auth::user()->image ) }}" class="rounded-circle mx-auto d-block" width="50"  height="50">
				</li>
				<li class="list-group-item">
				    <p>チャンネル数</p>
				    <p class="text-right"></p>
				</li>
	</ul>

</div>
