@extends("layouts.app")

@section("title")
<title>プロフィール | WAVE</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/user/sp-detail.css">
@endsection

@section("content")
<div class="viewMode">
  <div class="cover-img-container" v-bind:style="{ backgroundImage: 'url('+userDetail.cover_image+')'}">
    <div class="cover-img-filter"></div>
  </div>

  <div class="profile-container">
    <div class="user-icon">
      <div class="icon-img">
        <img :src="userDetail.icon" alt="icon">
      </div>
      <button class="edit-button">編集</button>
    </div>

    <div class="profile-top">
      <h2>@{{userDetail.display_name}}</h2>
      <div class="region">
        <p>
          <i class="fa fa-map-marker" aria-hidden="true"></i>
          @{{userDetail.address.region}}
        </p>
      </div>
    </div>

    <p class="description">@{{userDetail.description}}</p>

  </div>

  <div class="wave-score sex-man">
    <div class="wave-score-circle">
      <h3>WAVEスコア</h3>
      <p class="wave-point">@{{userDetail.wave_point}}</p>
    </div>
  </div>

  <div class="container">
    
    <div class="introduction section list-section">
      <div class="section-top">
        <h2>自己紹介</h2>
      </div>

      <p>@{{userDetail.introduction}}</p>
    </div>

    <div class="event-info section list-section">
      <div class="section-top">
        <h2>イベント情報</h2>
      </div>
      <ul>
        <li>
          <p class="join-count-title">イベント参加回数</p>
          <p class="join-count">@{{userDetail.number_build}}</p>
        </li>
        <li>
          <p class="organization-count-title">イベント主催回数</p>
          <p class="organization-count">@{{userDetail.number_participate}}</p>
        </li>
      </ul>
    </div>

    <div class="interest section list-section">
      <div class="section-top">
        <h2>気になるモノ</h2>
      </div>
      
      <ul class="fav">
        <li v-for="item in userDetail.topic">@{{item.topic}}</li>
      </ul>
    </div>

    <div class="aspiring-industries section list-section">
      <div class="section-top">
        <h2>気になる業界</h2>
      </div>

      <ul>
        <li v-for="item in userDetail.aspiring_industries">@{{item.aspiring_industry}}</li>
      </ul>  
    </div>

    <div class="academic-history section list-section">
      <div class="section-top">
        <h2>学歴</h2>
      </div>

      <ul class="educational-qualification">
        <li>
          <p>@{{userDetail.school_name}}</p>
          <dl>
            <dt>@{{userDetail.graduate}}</dt>
            <dd>@{{userDetail.undergraduate}}</dd>
          </dl>
        </li>
      </ul>
    </div>

    <div class="career-history section list-section">
      <div class="section-top">
        <h2>職歴</h2>
      </div>

      <ul>
        <li v-for="item in userDetail.career_history">
          <p>@{{item.title}}</p>
          <dl>
            <dt>@{{item.start_time}} - @{{item.end_time}}</dt>
            <dd>@{{item.Contents}}</dd>
          </dl>
        </li>
      </ul>
    </div>

    <div class="award-history section list-section">
      <div class="section-top">
        <h2>受賞歴</h2>
      </div>

      <ul>
        <li v-for="item in userDetail.award">
          <dl>
            <dt>@{{item.date}}</dt>
            <dd>@{{item.award}}</dd>
          </dl>
        </li>
      </ul>
    </div>

  </div>
</div>

<div class="editMode _hidden">
  <div class="cover-img-container" v-bind:style="{ backgroundImage: 'url('+userDetail.cover_image+')'}">
    <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
    <input type="file" class="file-cover-input">
  </div>

  <div class="profile-container">
    <div class="user-icon">
      <div class="icon-img">
        <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
        <input type="file" class="file-icon-input">
        <img :src="userDetail.icon" alt="icon">
      </div>
    </div>

    <div class="profile-top">
      <h2><input class="userInput-displayName" type="text" v-model="userDetail.display_name" placeholder="プロフィール名"></h2>
      <div class="region">
        <p>
          <i class="fa fa-map-marker" aria-hidden="true"></i>
          <select class="userInput-region">
            <option v-bind:value="item.id" v-for="item in regions" v-bind:selected="item.selected">@{{item.region}}</option>
          </select>
        </p>
      </div>
    </div>

    <div class="profile-bottom">
      <p class="description"><input class="userInput-description" type="text" v-model="userDetail.description" placeholder="ひとこと"></p>
      <div class="sex-select">
        <p>
          <select class="userInput-sex">
            <option value="default">性別を選択してください</option>
            <option value="0">男</option>
            <option value="1">女</option>
          </select>
        </p>
      </div>
    </div>
    

  </div>

  <div class="wave-score sex-man">
    <div class="wave-score-circle">
      <h3>WAVEスコア</h3>
      <p class="wave-point">@{{userDetail.wave_point}}</p>
    </div>
  </div>

  <div class="container">
    
    <div class="introduction section list-section">
      <div class="section-top">
        <h2>自己紹介</h2>
      </div>

      <p><textarea class="userInput-introduction">@{{userDetail.introduction}}</textarea></p>
    </div>

    <div class="event-info section list-section">
      <div class="section-top">
        <h2>イベント情報</h2>
      </div>
      <ul>
        <li>
          <p class="join-count-title">イベント参加回数</p>
          <p class="join-count">@{{userDetail.number_build}}</p>
        </li>
        <li>
          <p class="organization-count-title">イベント主催回数</p>
          <p class="organization-count">@{{userDetail.number_participate}}</p>
        </li>
      </ul>
    </div>

    <div class="interest section list-section">
      <div class="section-top">
        <h2>気になるモノ</h2>
      </div>
      
      <!-- <ul class="fav" v-for="item in userDetail.topic">
        <li>@{{item.topic}}</li>
      </ul> -->
      <ul class="fav">
        <li><input type="checkbox" value="1" id="fav-1"><label for="fav-1">オフィス訪問</label></li>
        <li><input type="checkbox" value="2" id="fav-2"><label for="fav-2">勉強会</label></li>
        <li><input type="checkbox" value="3" id="fav-3"><label for="fav-3">仕事仲間</label></li>
        <li><input type="checkbox" value="4" id="fav-4"><label for="fav-4">ハッカソン</label></li>
        <li><input type="checkbox" value="5" id="fav-5"><label for="fav-5">志向の合う仲間</label></li>
        <li><input type="checkbox" value="6" id="fav-6"><label for="fav-6">インターン</label></li>
        <li><input type="checkbox" value="7" id="fav-7"><label for="fav-7">講演会</label></li>
        <li><input type="checkbox" value="8" id="fav-8"><label for="fav-8">他業種の仲間</label></li>
        <li><input type="checkbox" value="9" id="fav-9"><label for="fav-9">専門分野の相談にのる</label></li>
        <li><input type="checkbox" value="10" id="fav-10"><label for="fav-10">合同説明会</label></li>
        <li><input type="checkbox" value="11" id="fav-11"><label for="fav-11">セミナー</label></li>
      </ul>
    </div>

    <div class="aspiring-industries section list-section">
      <div class="section-top">
        <h2>気になる業界</h2>
      </div>

      <!-- <ul v-for="item in userDetail.aspiring_industries">
        <li>@{{item.aspiring_industry}}</li>
      </ul> -->
      <ul>
        <li><input type="checkbox" value="1" id="aspiring_industries-1"><label for="aspiring_industries-1">テレビ</label></li>
        <li><input type="checkbox" value="2" id="aspiring_industries-2"><label for="aspiring_industries-2">広告</label></li>
        <li><input type="checkbox" value="3" id="aspiring_industries-3"><label for="aspiring_industries-3">出版</label></li>
        <li><input type="checkbox" value="4" id="aspiring_industries-4"><label for="aspiring_industries-4">コンサル</label></li>
        <li><input type="checkbox" value="5" id="aspiring_industries-5"><label for="aspiring_industries-5">銀行</label></li>
        <li><input type="checkbox" value="6" id="aspiring_industries-6"><label for="aspiring_industries-6">自動車</label></li>
        <li><input type="checkbox" value="7" id="aspiring_industries-7"><label for="aspiring_industries-7">電機</label></li>
        <li><input type="checkbox" value="8" id="aspiring_industries-8"><label for="aspiring_industries-8">商社</label></li>
        <li><input type="checkbox" value="9" id="aspiring_industries-9"><label for="aspiring_industries-9">インターネット</label></li>
        <li><input type="checkbox" value="10" id="aspiring_industries-10"><label for="aspiring_industries-10">人材</label></li>
        <li><input type="checkbox" value="11" id="aspiring_industries-11"><label for="aspiring_industries-11">ゲーム</label></li>
        <li><input type="checkbox" value="12" id="aspiring_industries-12"><label for="aspiring_industries-12">証券</label></li>
        <li><input type="checkbox" value="13" id="aspiring_industries-13"><label for="aspiring_industries-13">生保</label></li>
        <li><input type="checkbox" value="14" id="aspiring_industries-14"><label for="aspiring_industries-14">損保</label></li>
        <li><input type="checkbox" value="15" id="aspiring_industries-15"><label for="aspiring_industries-15">不動産</label></li>
        <li><input type="checkbox" value="16" id="aspiring_industries-16"><label for="aspiring_industries-16">ゼネコン</label></li>
        <li><input type="checkbox" value="17" id="aspiring_industries-17"><label for="aspiring_industries-17">鉄鋼</label></li>
        <li><input type="checkbox" value="18" id="aspiring_industries-18"><label for="aspiring_industries-18">製薬</label></li>
        <li><input type="checkbox" value="19" id="aspiring_industries-19"><label for="aspiring_industries-19">ビール</label></li>
        <li><input type="checkbox" value="20" id="aspiring_industries-20"><label for="aspiring_industries-20">製菓</label></li>
        <li><input type="checkbox" value="21" id="aspiring_industries-21"><label for="aspiring_industries-21">新聞</label></li>
        <li><input type="checkbox" value="22" id="aspiring_industries-22"><label for="aspiring_industries-22">旅行</label></li>
        <li><input type="checkbox" value="23" id="aspiring_industries-23"><label for="aspiring_industries-23">百貨店</label></li>
        <li><input type="checkbox" value="24" id="aspiring_industries-24"><label for="aspiring_industries-24">通信</label></li>
        <li><input type="checkbox" value="25" id="aspiring_industries-25"><label for="aspiring_industries-25">空運・海運・陸運</label></li>
        <li><input type="checkbox" value="26" id="aspiring_industries-26"><label for="aspiring_industries-26">食品</label></li>
        <li><input type="checkbox" value="27" id="aspiring_industries-27"><label for="aspiring_industries-27">トイレタリー</label></li>
        <li><input type="checkbox" value="28" id="aspiring_industries-28"><label for="aspiring_industries-28">エンタメ</label></li>
      </ul>
    </div>

    <div class="academic-history section list-section">
      <div class="section-top">
        <h2>学歴</h2>
      </div>

      <!-- <ul class="educational-qualification">
        <li>
          <p>HAL大阪</p>
          <dl>
            <dt>2019</dt>
            <dd>IT学部Web開発学科</dd>
          </dl>
        </li>
      </ul> -->

      <div class="academic-history-input-area">
        <input type="text" v-bind:value="userDetail.school_name" class="school-name" placeholder="大阪大学">
        <input type="text" v-bind:value="userDetail.graduate" class="department" placeholder="経済学部">
        <div class="date">
          <input type="text" v-bind:value="userDetail.undergraduate" class="date" placeholder="2019/3">
        </div>
        <button class="add-button">追加</button>
      </div>
    </div>

    <div class="career-history section list-section">
      <div class="section-top">
        <h2>職歴</h2>
      </div>

      <!-- <ul>
        <li v-for="item in userDetail.career_history">
          <p>@{{item.title}}</p>
          <dl>
            <dt>@{{item.start_time}} - @{{item.end_time}}</dt>
            <dd>@{{item.Contents}}</dd>
          </dl>
        </li>
      </ul> -->
      <ul>
        <li v-for="item in userDetail.career_history">
          <p class="company-name"><input type="text" v-bind:value="item.title"></p>
          <div class="sub">
            <p class="position"><input type="text" v-bind:value="item.Contents"></p>
            <p class="date">
              <input type="text" v-bind:value="item.start_time">
              <span>-</span>
              <input type="text" v-bind:value="item.end_time">
            </p>
          </div>
        </li>
      </ul>
      <div class="career-history-input-area">
        <input type="text" class="career-history-input-area__company-name" placeholder="WAVE Inc.">
        <input type="text" class="career-history-input-area__position" placeholder="営業">
        <div class="career-history-input-area__date">
          <input type="text" class="career-history-input-area__date-start" placeholder="2019/3">
          <span>-</span>
          <input type="text" class="career-history-input-area__date-end" placeholder="2019/3">
        </div>
        <button class="add-button">追加</button>
      </div>
    </div>

    <div class="award-history section list-section">
      <div class="section-top">
        <h2>受賞歴</h2>
      </div>

      <!-- <ul>
        <li v-for="item in userDetail.award">
          <dl>
            <dt>@{{item.date}}</dt>
            <dd>@{{item.award}}</dd>
          </dl>
        </li>
      </ul> -->
      <ul>
        <li v-for="item in userDetail.award">
          <p class="award-name"><input type="text" v-bind:value="item.award"></p>
          <p class="award-date"><input type="text" v-bind:value="item.date"></p>
        </li>
      </ul>
      <div class="awards-history-input-area">
        <div class="awards-history-input-area__wrapper">
          <input type="text" class="awards-history-input-area__name" placeholder="WAVE大賞">
          <input type="text" class="awards-history-input-area__date" placeholder="2019/3">
        </div>
        <button class="add-button">追加</button>
      </div>
    </div>

  </div>

  <button class="save-button">変更を保存する</button>

  <div class="image-upload-process">
    <p>画像をアップロード中です...</p>
  </div>

</div>

<div class="loading">
  <div class="img">
    <img src="/image/wave_logo.svg" alt="logo">
  </div>
</div>

@endsection

@section("javascript")
<script src="/js/utils/UserDetailUtil.class.js"></script>
<script src="/js/user/sp-detail.js"></script>
@endsection