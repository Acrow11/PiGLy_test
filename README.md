# 基礎学習ターム 確認テスト_ピグリー

## 概要
このアプリは、ユーザーが自分の体重や目標体重、運動記録を記録できる体重管理アプリです。LaravelとMySQLを使用して開発しました。

## 環境構築

### 必要な依存環境
- **PHP**: 8.0 以上
- **Composer**: PHPの依存管理ツール
- **Docker**: コンテナ化された開発環境
- **MySQL**: バージョン 8.x

### セットアップ手順
1. プロジェクトをクローンします。
   ```bash
   git clone https://github.com/yourusername/your-repository.git
   cd your-repository
必要な依存関係をインストールします。

bash
コピーする
編集する
composer install
.envファイルをコピーし、必要な設定を行います。

bash
コピーする
編集する
cp .env.example .env
Dockerコンテナを起動します。

bash
コピーする
編集する
docker-compose up -d
マイグレーションを実行し、データベースを作成します。

bash
コピーする
編集する
php artisan migrate
必要に応じて、ダミーデータをシーディングします。

bash
コピーする
編集する
php artisan db:seed
アプリケーションをブラウザで確認します。

bash
コピーする
編集する
http://localhost
使用技術
Laravel: PHPフレームワーク（バージョン 9.x）
MySQL: リレーショナルデータベース
Docker: コンテナ化された開発環境
Bootstrap: フロントエンドスタイル
Tailwind CSS: モダンなCSSフレームワーク（オプション）
ER図
以下は、このプロジェクトにおけるテーブル設計を示すER図です。


URL
開発環境: http://localhost
本番環境（デプロイ先がある場合）: https://your-app-url.com
