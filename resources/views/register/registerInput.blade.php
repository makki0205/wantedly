@extends('layouts.app')

@section("title")
<title>新規登録 | WAVE</title>
@endsection

@section('stylesheet')
<link rel="stylesheet" href="/css/register/registerInput.css">
@endsection

@section('content')

<div class="main-container">

	<div class="register-form">
		
		<h1 class="title">アカウント作成</h1>
		<div class="form-content">
			<form action="/api/register/" method="post" id="form">
				<div class="user-name input">
					<label for="nickname">プロフィール名</label>
					<input type="text" name="display_name" id="display-name">
				</div>

				<div class="user-id input">
					<label for="password">ユーザーID</label>
					<input type="text" name="nickname" id="user-id">
				</div>

				<div class="password input">
					<label for="password">パスワード</label>
					<input type="password" name="password" id="password">
				</div>
				
				<button type="submit" class="send-button">アカウント作成</button>
			</form>
		</div>

	</div>

</div>
@endsection

@section('javascript')
<script src="/js/register/register_input.js"></script>
@endsection