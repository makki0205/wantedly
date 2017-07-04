<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width">
    <title>現在メンテナンス中です | WAVE</title>
    <style>
        @charset "utf-8";
        *,
        *::after,
        *::before{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body,html{
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .maintenance-container-cover {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url(https://s3-us-west-2.amazonaws.com/wave-dev2/media/public/Pasted+image+at+2017_02_26+08_37+PM.png);
            background-repeat: no-repeat;
            -webkit-background-size: cover;
            background-size: cover;
            background-position: center;
            filter: blur(4px);
            transform: scale(1.1);
            z-index: -1;
        }
        @media screen and (min-width:961px) {
        /*pc用のcssを記述*/
            .maintenance-container {
                width: 95%;
                height: 90%;
                margin: 0 auto;
                margin-top: 2.5%;
                background-color: rgba(0,0,0,0.4);
            }
            .maintenance {
                position: absolute;
                top: 50%;
                left: 50%;
                overflow: hidden;
                transform: translateY(-50%) translateX(-50%);
            }
            .maintenance .logo {
                font-size: 1.2rem;
            }
            .maintenance .logo img {
                display: block;
                width: 40%;
                margin: 0 auto;
            }
            .maintenance .logo,
            .maintenance-title,
            .maintenance-content,
            .maintenance-notice-link,
            .maintenance-notice-link a {
                color: #fff;
                text-align: center;
            }
            .maintenance-title {
                padding-top: 2rem;
                font-size: 2.5rem;
                font-weight: normal;
            }
            .maintenance-content {
                padding-top: 5rem;
                font-size: 1.2rem;
            }
            .br-sp {
                display: none;
            }
            .maintenance-notice-link {
                padding-top: 1rem;
                font-size: 1.2rem;
            }
        }
          
        @media only screen and (min-width:376px) and (max-width:960px) {
        /*tablet用のcssを記述*/
            .maintenance-container {
                width: 95%;
                height: 90%;
                margin: 0 auto;
                margin-top: 2.5%;
                background-color: rgba(0,0,0,0.4);
            }
            .maintenance {
                position: absolute;
                top: 50%;
                left: 50%;
                overflow: hidden;
                transform: translateY(-50%) translateX(-50%);
            }
            .maintenance .logo {
                font-size: 1.2rem;
            }
            .maintenance .logo img {
                display: block;
                width: 40%;
                margin: 0 auto;
            }
            .maintenance .logo,
            .maintenance-title,
            .maintenance-content,
            .maintenance-notice-link,
            .maintenance-notice-link a {
                color: #fff;
                text-align: center;
            }
            .maintenance-title {
                padding-top: 2rem;
                font-size: 2rem;
                font-weight: normal;
                white-space: nowrap;
            }
            .maintenance-content {
                padding-top: 3rem;
                font-size: 1rem;
                white-space: nowrap;
            }
            .br-tablet {
                display: none;
            }
            .maintenance-notice-link {
                white-space: nowrap;
                padding-top: 1rem;
                font-size: 1.2rem;
            }
        }
         
        @media screen and (max-width:375px) {
        /*スマホ用のcssを記述*/
            .maintenance-container {
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.2);
            }
            .maintenance {
                padding-top: 5rem;
            }
            .maintenance .logo {
                font-size: 1.2rem;
            }
            .maintenance .logo img {
                display: block;
                width: 70%;
                margin: 0 auto;
            }
            .maintenance .logo,
            .maintenance-title,
            .maintenance-content,
            .maintenance-notice-link,
            .maintenance-notice-link a {
                color: #fff;
                text-align: center;
            }
            .maintenance-title {
                padding-top: 2rem;
                font-size: 1.5rem;
                font-weight: normal;
            }
            .maintenance-content {
                padding-top: 2rem;
            }
            .maintenance-notice-link {
                padding-top: 2rem;
            }
        }
        
    </style>
</head>
<body>

    <div class="maintenance-container">
        <div class="maintenance">
            <div class="logo">
                <img src="https://s3-us-west-2.amazonaws.com/wave-dev2/media/public/Pasted+image+at+2017_02_26+08_37+PM-1.png" alt="WAVEロゴ">
                やりたいことを見つけよう
            </div>
            <h1 class="maintenance-title">
                現在メンテナンス中です
            </h1>
            <div class="maintenance-content">
                WAVE は 波にのまれてしまいました。<br>
                メンテナンス終了まで<br class="br-sp br-tablet">しばらくお待ち下さい。
            </div>
            <div class="maintenance-notice-link">
                メンテナンスの終了は<br class="br-sp"><a href="https://twitter.com/WAVE_gakueve">公式Twitter</a>にて告知いたします。
            </div>            
        </div>
    </div>
    <div class="maintenance-container-cover"></div>
    
</body>
</html>