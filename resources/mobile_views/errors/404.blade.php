@extends("layouts.app")

@section("title")
<title>404 NotFound</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/errors/sp-not-found.css">
@endsection

@section("content")
<div class="main-container">
	<!-- <div class="main"> -->
		<div class="wave-bg-container">
			<div class="wave-bg">
				<div class="wave-font">
					<img src="/image/errors/404-font.svg" alt="">
				</div>
			</div>
		</div>
		
		<div class="not-found-content">
			<h2>ページは波にのまれてしまったようです！！</h2>
			<p class="error-message">
				お探しのページは、<br>
				削除されたかURLが変更した可能性があります。<br>
				申し訳ありませんが、<br>
				もう一度URLをご確認ください。
			</p>
		</div>
		
	<!-- </div> -->
</div>
@endsection