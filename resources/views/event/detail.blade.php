@extends("layouts.app")

@section("title")
<title>2時間で学ぶReactハンズオン | WAVE</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/event/detail.css">
@endsection

@section("content")
<div class="main-container">
	<div class="main-top">
		<div class="main-left">
			<div class="main-img">
				<img src="/image/events/event-sub.png" alt="">
			</div>

			<h1>2時間で学ぶReactハンズオン</h1>
			<div class="tag">
				<ul>
					@include("partials.tag",array('tag_name' => 'React'))
					@include("partials.tag",array('tag_name' => 'フロントエンド'))
					@include("partials.tag",array('tag_name' => 'ハンズオン'))
				</ul>
			</div>

			<div class="event-info">
				<h2>イベント情報</h2>
				<table>
					<tbody>
						<tr>
							<th>主催：</th>
							<td>konojunya</td>
						</tr>
						<tr>
							<th>日時：</th>
							<td>
								<div class="date-area">
									<p class="date">2016/09/15 19:00 ~ 21:00</p>
									<a href="http://www.google.com/calendar/event?action=TEMPLATE&text=2時間で学ぶReactハンズオン&location=大阪イノベーションハブ&dates=20170916T190000/20170916T210000" target="_blank" class="add-google-cal">Googleカレンダーへ追加</a>
								</div>
							</td>
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
			</div>
			
			<div class="event-contents">
				<h2>イベント内容</h2>
				<h3>イベント概要</h3>
				<p>
					IoTというワードがバズワードになりつつあります。<br>
					とはいえ、IoT領域には関連する幅広い知識や技術があります。<br><br>

					また、アイディアやインスピレーションも重要です。<br>
					この会は個々が持っている知識や開発していることの情報共有や発信の場になります。<br><br>

					大阪で5回目開催です！<br><br>

					関西コミュニティ界では、ものづくり・HW系は若干（！？）年齢層が高めです。普通に募集しちゃいますと、オヂサン（といっても社内ぢゃ若手だったりするのよ…とゆー）揃いの勉強会になちゃうかも。それはそれで楽しかったりもするのですが、そのままではアカンかなと。 できれば、そういったベテラン層と若手層が交流していくと関西が更に活性化していくと思いますヨ。<br><br>

					今回も、もっともっと若手を増える願いも込めてU-30だったものをU-25へさげました！ <br>学生のみなさんどしどし応募ください！<br>
				</p>

				<h3>参加費</h3>
				<p>
					無料！（懇親会参加費 500円）
				</p>

				<h3>タイムスケジュール</h3>
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

		<div class="main-right">
			
			<div class="entry-form">
				<table>
					<tbody>
						@include("partials.event-frame",array(
							"frame_name" => "一般参加枠",
							"current_count" => "0",
							"max_count" => "50",
							"is_join" => true
						))
						@include("partials.event-frame",array(
							"frame_name" => "発表者枠",
							"current_count" => "0",
							"max_count" => "10",
							"is_join" => false
						))
						@include("partials.event-frame",array(
							"frame_name" => "ブログ執筆枠",
							"current_count" => "0",
							"max_count" => "2",
							"is_join" => false
						))
						@include("partials.event-frame",array(
							"frame_name" => "スタッフ",
							"current_count" => "0",
							"max_count" => "2",
							"is_join" => false
						))
					</tbody>
				</table>
			</div>

			<div class="venue">
				<h3><i class="fa fa-map-marker" aria-hidden="true"></i><span>会場</span></h3>
				<p class="place">大阪イノベーションハブ</p>
				<p class="place-address">
					大阪府大阪市 北区大深町3番1号<br>
					グランフロント大阪ナレッジキャピタルタワーC ７階
				</p>
			</div>

			<div class="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.969616483947!2d135.49231481477833!3d34.70594628043316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e68f07c92525%3A0x8082dbd046d0b18e!2z5aSn6Ziq44Kk44OO44OZ44O844K344On44Oz44OP44OW!5e0!3m2!1sja!2sjp!4v1486945710947" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>

		</div>
	</div>

</div>
@endsection