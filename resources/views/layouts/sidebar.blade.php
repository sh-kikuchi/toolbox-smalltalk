
<div id="side-bar" class="py-4">
		<ul class="list-group list-group-flush">
				<li class="list-group-item">
				    <p>{{ Auth::user()->name }}　さん</p>
						<img src="{{ asset('storage/img/' . Auth::user()->image ) }}" class="rounded-circle mx-auto d-block" width="50"  height="50">
				</li>
				<li class="list-group-item">
				    <p>フォロワー数</p>
				    <p class="text-right">{{ $cnt_follower }}</p>
				</li>
				<li class="list-group-item">
				    <p>フォロー数</p>
				    <p class="text-right">{{ $cnt_following }}</p>
				</li>
				<li class="list-group-item">
				    <p>投稿数</p>
				    <p class="text-right">{{ $cnt_post }}</p>
				</li>
	</ul>
		<div>
		    <button type="button" class="btn btn-outline-info w-100 my-4 center-block"><a href="{{ route('profile.show') }}">プロフィール</a></button>
		</div>
		<!-- <div>
		    <button type="button" class="btn btn-outline-info w-100 center-block"><a>マイルーム</a></button>
		</div> -->
</div>
