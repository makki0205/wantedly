<!DOCTYPE html>
<html lang="ja">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>事前登録ページ | WAVE</title>

    <link rel="stylesheet" href="/css/lib/font-awesome.min.css">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/pre-register/register.css">
    <script>
        function validateForm() {
            var value = document.forms["pre-register-form"]["email"].value;
            if (value.match(/.+@.+\..+/)==null) {
                alert("メールアドレスを正しい形式で入力してください");
                return false;
            } else {
                return true;
            }
        }
    </script>
</head>
<body>

<main id="main">

    <div class="main-container">
        <img src="https://s3-us-west-2.amazonaws.com/wave-dev2/media/public/Pasted+image+at+2017_02_26+08_37+PM-1.png" class="logo" alt="WAVEロゴ">
        <div class="pre-register-message1">
            <p>WAVEに事前登録して、</p>
            <p>最新情報をゲットしよう</p>
            <p>（５月に正式版ローンチ予定！）</p>
        </div>
        <div class="form-content">
            <form action="{{url('pre-register/complete')}}" name="pre-register-form" onsubmit="return validateForm()"  method="post" id="form">
                <div>
                    <input class="email" type="text" name="email" placeholder="XXX@XXX.com">
                </div>
                <button type="submit" class="send-button">登録</button>
            </form>
        </div>
        <div class="pre-register-message2">
            <p>「さあ、感動をわかちあおう」</p>
            <p>学生イベント応援サービス"WAVE"は</p>
            <p>イベントを一回きりで終わらせない。</p>
        </div>

    </div>

</main>

</body>
</html>