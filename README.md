# 基礎学習ターム 確認テスト_ピグリー

## 概要
このアプリは、ユーザーが自分の体重や目標体重、運動記録を記録できる体重管理アプリです。LaravelとMySQLを使用して開発しました。

## 環境構築

1. プロジェクトをクローンします。
   ```bash
   git clone git@github.com:Acrow11/PiGLy_test.git
   

2,必要な依存関係をインストールします。
　　composer install

3, .envファイルをコピーし、必要な設定を行います。
    cp .env.example .env

4,Dockerコンテナを起動します。
docker-compose up -d

5,マイグレーションを実行し、データベースを作成します。
php artisan migrate

6,ダミーデータをシーディングします。
 php artisan db:seed

##使用技術
Laravel: PHPフレームワーク（バージョン 9.x）
MySQL: リレーショナルデータベース
Docker: コンテナ化された開発環境
Bootstrap: フロントエンドスタイル
Tailwind CSS: モダンなCSSフレームワーク（オプション）

## ER図
![ER図](https://github.com/Acrow11/PiGLy_test/blob/main/ER-diagram.png?raw=true)




##URL
開発環境: http://localhost

