@extends('layouts.app')

@section("title")
<title>新規登録 | WAVE</title>
@endsection

@section('stylesheet')
<link rel="stylesheet" href="/css/register/sp-sendEmail.css">
@endsection

@section('content')

<div class="main-container">

	<div class="send-email">
		<h1 class="title">WAVEを使ってみよう</h1>
		<div class="send-email-content-container">
			<p class="send-email-content">
				入力されたメールアドレスに、WAVE会員登録用のメールを送信いたします。<br>
				実際に受信できるメールアドレスを<br>
				入力してください。
			</p>
			<p class="attention">
				※24時間以内に本登録がされない場合、登録用メールに記載のURLは無効となります。
			</p>

			<div class="form-content" id="form">
				<form action="/api/prov" method="post">
					<div class="mail-address">
						<label for="mail-address">メールアドレス</label>
						<input type="text" name="email" id="mail-address">
					</div>

					<input id="send-button" class="send-button" type="submit" value="メールを送信する">
				</form>
			</div>
		</div>
	</div>

	<div class="send-complete">
		<h1 class="title">仮登録メールの送信完了</h1>
		<p class="send-complete-content">
			<span>【</span><span class="js-mail-address"></span><span>】</span>宛に<br>
			仮登録メールの送信が完了しました。
		</p>
		<p class="send-complete-sub-content">
			現在は仮登録の状態です。<br>
			メールに記載されたURLより<br>
			本登録を完了してください。
		</p>
		<p class="attention">
			※24時間以内に本登録がされない場合、<br>
			登録用メールに記載のURLは無効となります。
		</p>
	</div>

</div>

<div class="spinner-cover">
	<div class="spinner">
		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
	</div>
</div>

@endsection


@section('javascript')
<script src="/js/register/sp-sendEmail.js"></script>
@endsection