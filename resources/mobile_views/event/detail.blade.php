@extends("layouts.app")

@section("title")
<title>2時間で学ぶReactハンズオン</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/event/sp-detail.css">
@endsection

@section("content")

<div class="main">
	
	<div class="main-img">
		<img src="/image/events/event-sub.png" alt="">
	</div>

	<h1 class="sawarabi-font">2時間で学ぶReactハンズオン</h1>

	<ul class="tags">
		@include("partials.tag",array("tag_name" => "React"))
		@include("partials.tag",array("tag_name" => "frontend"))
		@include("partials.tag",array("tag_name" => "ハンズオン"))
	</ul>

	<div class="chat-join">
		<button>
			チャットに参加する
		</button>
	</div>

	<div class="event-info">
		<h3>イベント情報</h3>

		<div class="event-info-table">
			<table>
				<tbody>
					<tr>
						<th>主催：</th>
						<td>konojunya</td>
					</tr>
					<tr>
						<th>日時：</th>
						<td>2016/09/15 19:00 ~ 21:00</td>
					</tr>
					<tr>
						<th>会場：</th>
						<td>大阪イノベーションハブ</td>
					</tr>
					<tr>
						<th>住所：</th>
						<td>大阪府大阪市 北区大深町3番1号グランフロント大阪ナレッジキャピタルタワーC ７階</td>
					</tr>
				</tbody>
			</table>
			<a href="#" class="add-google-cal">Googleカレンダーへ登録する</a>
		</div>
	</div>

	<div class="entry-form">
		<table>
				<tbody>
					<tr>
						<th>一般参加枠</th>
						<td>
							<p>
								<span class="now-count">15</span>
								<span class="slash">／</span>
								<span class="max-count">200</span>
								人
							</p>
						</td>
						<td class="join-button">
							<button class="join is-join">参加中</button>
						</td>
					</tr>
					<tr>
						<th>発表者枠</th>
						<td>
							<p>
								<span class="now-count">4</span>
								<span class="slash">／</span>
								<span class="max-count">5</span>
								人
							</p>
						</td>
						<td class="join-button">
							<button class="join">参加</button>
						</td>
					</tr>
					<tr>
						<th>ブログ執筆枠</th>
						<td>
							<p>
								<span class="now-count">0</span>
								<span class="slash">／</span>
								<span class="max-count">2</span>
								人
							</p>
						</td>
						<td class="join-button">
							<button class="join">参加</button>
						</td>
					</tr>
					<tr>
						<th>スタッフ</th>
						<td>
							<p>
								<span class="now-count">3</span>
								<span class="slash">／</span>
								<span class="max-count">3</span>
								人
							</p>
						</td>
						<td class="join-button">
							<button class="join">参加</button>
						</td>
					</tr>
				</tbody>
			</table>
	</div>

	<div class="event-contents-container">
		<h3>イベント内容</h3>
		<div class="event-contents">
			<h4>イベント概要</h4>
			<p class="event-description">
				IoTというワードがバズワードになりつつあります。<br>
				とはいえ、IoT領域には関連する幅広い知識や技術があります。<br><br>

				また、アイディアやインスピレーションも重要です。<br>
				この会は個々が持っている知識や開発していることの情報共有や発信の場になります。<br><br>

				大阪で5回目開催です！<br><br>

				関西コミュニティ界では、ものづくり・HW系は若干（！？）年齢層が高めです。普通に募集しちゃいますと、オヂサン（といっても社内ぢゃ若手だったりするのよ…とゆー）揃いの勉強会になちゃうかも。それはそれで楽しかったりもするのですが、そのままではアカンかなと。 できれば、そういったベテラン層と若手層が交流していくと関西が更に活性化していくと思いますヨ。<br><br>

				今回も、もっともっと若手を増える願いも込めてU-30だったものをU-25へさげました！ <br>学生のみなさんどしどし応募ください！<br>
			</p>
			<h4>参加費</h4>
			<p class="join-pay">無料！（懇親会参加費 500円）</p>
			<h4>タイムスケジュール</h4>
			<table class="time-schedule">
				<tbody>
					<tr>
						<th>19:00</th>
						<td>開場</td>
					</tr>
					<tr>
						<th>19:10</th>
						<td>オープニングLT</td>
					</tr>
					<tr>
						<th>19:30</th>
						<td>発表者LT</td>
					</tr>
					<tr>
						<th>19:50</th>
						<td>フードスポンサーLT</td>
					</tr>
					<tr>
						<th>20:00</th>
						<td>懇親会開始</td>
					</tr>
					<tr>
						<th>21:00</th>
						<td>撤収</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="chat-box">
	<div class="chat-head">
		<p class="title">2時間で学ぶReactハンズオン</p>
		<div class="close-button">
			<img src="/image/close-button.svg" alt="close button">
		</div>
	</div>

	<ul class="message">
		<li v-for="item in chatData"  v-bind:class="item.type">
			<p class="sender-name">@{{item.user_name}}</p>
			<div class="balloon-box">
				<p class="balloon">@{{item.text}}</p>
			</div>
		</li>
	</ul>

	<div class="input-area">
		<div class="send-input">
			<input type="text">
		</div>
		<div class="send-button">
			<button>送信</button>
		</div>
	</div>
</div>

<div class="loading">
  <div class="img">
    <img src="/image/wave_logo.svg" alt="logo">
  </div>
</div>
@endsection

@section("javascript")
<script src="/js/utils/EventDetailUtil.class.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.6.9/firebase.js"></script>
<script src="/js/event/sp-detail.js"></script>
@endsection