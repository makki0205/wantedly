@extends("layouts.app")

@section("title")
<title>プロフィール | WAVE</title>
@endsection

@section("stylesheet")
<link rel="stylesheet" href="/css/user/detail.css">
@endsection

@section("content")
<div class="viewMode">
  <div class="cover" v-bind:style="{ backgroundImage: 'url('+userDetail.cover_image+')'}">
    <div class="filter"></div>
    <ul class="sns">
      <li><a href="#" class="twitter"><i class="fa fa-twitter fa-2x"></i></a></li>
      <li><a href="#" class="facebook"><i class="fa fa-facebook fa-2x"></i></a></li>
    </ul>
  </div>

  <div class="icon-box">
    <div class="img">
      <img :src="userDetail.icon" alt="icon">
    </div>
    <button class="edit-button">編集</button>
  </div>
  <div class="user-detail-contents">
    <div class="head">
      <h1 class="name">@{{userDetail.display_name}}</h1>
      <p class="description">@{{userDetail.description}}</p>    
    </div>
    <p class="region">
      <i class="fa fa-map-marker" aria-hidden="true"></i>
      @{{userDetail.address.region}}
    </p>
  </div>

  <div class="main-contents">
    <div class="top-content">
      <div class="introduction">
        <h2>自己紹介</h2>
        <p class="introduction-text">@{{userDetail.introduction}}</p>
      </div>

      <div class="wave-point-box sex-man">
        <h2>WAVEスコア</h2>
        <p class="wave-point">@{{userDetail.wave_point}}</p>
      </div>

    </div>

    <div class="bottom-content">

      <div class="event-container">
        <h2>イベント情報</h2>
        <ul>
          <li>
            <p class="join-count-title">イベント参加回数</p>
            <p class="join-count">@{{userDetail.number_build}}</p>
          </li>
          <li>
            <p class="organization-count-title">イベント参加回数</p>
            <p class="organization-count">@{{userDetail.number_participate}}</p>
          </li>
        </ul>
      </div>

      <div class="fav-container">
        <div class="interest">
          <h2>気になるモノ</h2>
          <ul>
            <li v-for="item in userDetail.topic">@{{item.topic}}</li>
          </ul>
        </div>  
        <div class="aspiring-industries">
          <h2>気になる業界</h2>
          <ul>
            <li v-for="item in userDetail.aspiring_industries">@{{item.aspiring_industry}}</li>
          </ul>
        </div>
      </div>

      <div class="history-container">

        <div class="academic-history">
          <h2>学歴</h2>
          <ul>
            <li>
              <p class="school-name">@{{userDetail.school_name}}</p>
              <div class="sub">
                <p class="department">@{{userDetail.graduate}}</p>
                <p class="date">@{{userDetail.undergraduate}}</p>
              </div>
            </li>
          </ul>
        </div>
        <div class="career-history">
          <h2>職歴</h2>
          <ul>
            <li v-for="item in userDetail.career_history">
              <p class="company-name">@{{item.title}}</p>
              <div class="sub">
                <p class="position">@{{item.Contents}}</p>
                <p class="date">
                  @{{item.start_time}}
                  <span>-</span>
                  @{{item.end_time}}
                </p>
              </div>
            </li>
          </ul>
        </div>

        <div class="awards-history">
          <h2>受賞歴</h2>
          <ul>
            <li v-for="item in userDetail.award">
              <p class="award-name">@{{item.award}}</p>
              <p class="award-date">@{{item.date}}</p>
            </li>
          </ul>
        </div>

      </div>

    </div>
  </div>
</div>

<div class="editMode _hidden">
  <div class="cover" v-bind:style="{ backgroundImage: 'url('+userDetail.cover_image+')'}">
    <ul class="sns">
      <li><a href="#" class="twitter"><i class="fa fa-twitter fa-2x"></i></a></li>
      <li><a href="#" class="facebook"><i class="fa fa-facebook fa-2x"></i></a></li>
    </ul>
    <div class="filter"></div>
    <input type="file" class="file-cover-input">
    <div class="cover-select-filter">
      <i class="fa fa-plus fa-3x" aria-hidden="true"></i>
    </div>
  </div>

  <div class="icon-box">
    <div class="img">
      <div class="icon-select-filter">
        <i class="fa fa-plus fa-3x" aria-hidden="true"></i>
      </div>
      <input type="file" class="file-icon-input">
      <img :src="userDetail.icon" alt="icon">
    </div>
  </div>
  <div class="user-detail-contents">
    <div class="head">
      <h1 class="name"><input class="userInput-displayName" type="text" v-model="userDetail.display_name" placeholder="山田太郎"></h1>
      <p class="description"><input class="userInput-description" type="text" v-model="userDetail.description" placeholder="ひとこと"></p>    
    </div>
    <p class="region">
      <i class="fa fa-map-marker" aria-hidden="true"></i>
      <select class="userInput-region">
        <option v-bind:value="item.id" v-for="item in regions" v-bind:selected="item.selected">@{{item.region}}</option>
      </select>
    </p>
    <p class="sex-select">
      <select class="userInput-sex">
        <option value="default">性別を選択してください</option>
        <option value="0">男</option>
        <option value="1">女</option>
      </select>
    </p>
  </div>

  <div class="main-contents">
    <div class="top-content">
      <div class="introduction">
        <h2>自己紹介</h2>
        <textarea class="introduction-text">@{{userDetail.introduction}}</textarea>
      </div>

      <div class="wave-point-box sex-man">
        <h2>WAVEスコア</h2>
        <p class="wave-point">@{{userDetail.wave_point}}</p>
      </div>

    </div>

    <div class="bottom-content">

      <div class="event-container">
        <h2>イベント情報</h2>
        <ul>
          <li>
            <p class="join-count-title">イベント参加回数</p>
            <p class="join-count">@{{userDetail.number_build}}</p>
          </li>
          <li>
            <p class="organization-count-title">イベント参加回数</p>
            <p class="organization-count">@{{userDetail.number_participate}}</p>
          </li>
        </ul>
      </div>

      <div class="fav-container">
        <div class="interest">
          <h2>気になるモノ</h2>
          <ul>
            <li v-for="item in topic"><input type="checkbox" v-bind:value="item.id">@{{item.topic}}</li>
          </ul>
        </div>  
        <div class="aspiring-industries">
          <h2>気になる業界</h2>
          <ul>
            <li v-for="item in aspiringIndustry"><input type="checkbox" v-bind:value="item.id">@{{item.aspiring_industry}}</li>
          </ul>
        </div>
      </div>

      <div class="history-container">
        <div class="academic-history">
          <h2>学歴</h2>
          <ul>
            <li>
              <p class="school-name"><input type="text" v-bind:value="userDetail.school_name" placeholder="大阪大学"></p>
              <div class="sub">
                <p class="department"><input type="text" v-bind:value="userDetail.graduate" placeholder="経済学部"></p>
                <p class="date"><input type="text" v-bind:value="userDetail.undergraduate" placeholder="2019/3"></p>
              </div>
            </li>
          </ul>
        </div>
        <div class="career-history">
          <h2>職歴</h2>
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

        <div class="awards-history">
          <h2>受賞歴</h2>
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

    </div>
  </div>

  <button class="save-button">変更を保存する</button>

</div>

<div class="loading">
  <div class="img">
    <img src="/image/wave_logo.svg" alt="logo">
  </div>
</div>
@endsection
@section("javascript")
<script src="/js/utils/UserDetailUtil.class.js"></script>
<script src="/js/user/detail.js"></script>
@endsection