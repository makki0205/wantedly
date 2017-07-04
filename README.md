# WAVE

====

# Overview

「イベント × 就活」の新しいイベントプラットフォーム

## Description

「イベント × 就活」というコンセプトを元に、イベント主催者を評価できるシステムと、参加者同士が盛んにコミュニケーションをとれる場を提供する。

## Author

[MOREINVEST](http://moreinvest.jp)

## memo
前提：初回起動済み
### サーバ立ち上げ手順
`php artisan serve --host 0.0.0.0:8000`

### データベースの初期化
```sh
# ロールバック
php artisan migrate:reset
# migrationの実行
php artisan migrate
# seedの実行
php artisan db:seed
```

### seedファイルのクラス別実行方法
`php artisan db:seed --class=<クラス名>`

### テストの実行
```sh
#全テスト実行
./vendor/bin/phpunit
#クラスごとのテスト実行
./vendor/bin/phpunit --filter <クラス名>
```
