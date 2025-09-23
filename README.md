# お問い合わせフォーム　
## 環境構築🔗
Dockerビルド

1.  git clone git@github.com:taewoo-0709/confirmation-test.git
2. docker-compose up -d --build

＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.ymlファイルを編集してください。

Laravel環境構築

1. docker-compose exec php bash

2. composer install

3. .env.exampleファイルから.envを作成し、環境変数を変更

4. php artisan key:generate

5. php artisan migrate

6. php artisan db:seed


## 使用技術🔗

・PHP 8.1.33

・Laravel 8.83.29

・MySQL 8.0.34

## ER図

<img width="512" alt="スクリーンショット 2025-06-29 9 28 48" src="https://github.com/user-attachments/assets/a0946dd4-c704-41fd-acde-7b5b5f3b17b1" />

## URL

・開発環境：http://localhost/

・phpMyAdmin：http://localhost:8080/
