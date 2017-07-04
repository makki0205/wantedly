@extends("layouts.app")

@section("title")
<title>404 NotFound</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/errors/not-found.css">
@endsection

@section("content")
<div class="main-container">
	<div class="main">
		<div class="error-img">
			<img src="/image/errors/not-found.jpg" alt="">
		</div>

		<h2>ページは波にのまれてしまったようです！！</h2>
		<p class="error-message">
			お探しのページは、削除されたかURLが変更した可能性があります。<br>
			申し訳ありませんが、もう一度URLをご確認ください。
		</p>
	</div>
</div>
@endsection