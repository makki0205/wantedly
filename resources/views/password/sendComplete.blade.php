@extends('layouts.app')


@section('stylesheet')
<link rel="stylesheet" href="/css/register/sendComplete.css">
@endsection

@section('content')

    <div class="main-container">
		
		<div class="send-complete">
			<h1 class="title">パスワードリセット用メールの送信完了</h1>
			<p class="send-complete-content">
				パスワードリセット用メールの送信が完了しました。<br>
				メールに記載されたURLより手続きを完了してください。
			</p>
			<p class="attention">
				※24時間以内にリセットされない場合、パスワードリセット用メールに記載のURLは無効となります。
			</p>
		</div>

	</div>

@endsection