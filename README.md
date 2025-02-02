基礎学習ターム 確認テスト_ピグリー
このアプリケーションは、ユーザーが自分の体重、目標体重、食事量、運動量を管理するためのWebアプリケーションです。LaravelとMySQLを使用し、Docker環境で構築されています。

環境構築
このプロジェクトをローカル環境で動作させるための手順は以下の通りです。

必要なツール
Docker
Docker Compose
Composer
PHP 8.0以上
MySQL 8.0以上
インストール手順
リポジトリをクローンします。

bash
コピーする
編集する
git clone https://github.com/yourusername/your-repository-name.git
cd your-repository-name
Dockerコンテナをビルドし、起動します。

bash
コピーする
編集する
docker-compose up -d
Laravelの依存関係をインストールします。

bash
コピーする
編集する
docker-compose exec app composer install
.envファイルをコピーして、データベース接続情報を設定します。

bash
コピーする
編集する
cp .env.example .env
マイグレーションとシーディングを実行します。

bash
コピーする
編集する
docker-compose exec app php artisan migrate --seed
アプリケーションが動作しているかを確認します。ブラウザで以下のURLにアクセスしてください。

arduino
コピーする
編集する
http://localhost:8000
使用技術
Laravel：PHPフレームワーク
Docker：コンテナ化技術
MySQL：データベース管理システム
PHP：バックエンドプログラミング言語
ER図
以下のER図は、プロジェクトで使用しているデータベースの設計を示しています。


