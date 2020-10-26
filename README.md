# STEP

STEPとは

ユーザーの学習過程、どういった順番で何を学習してきたかを投稿し、それをもとに勉強をできるサービス。

マイページから学習の進捗状況も確認できるため、勉強しやすい。

# Usage
 
Clone project from github
```
$ git clone https://github.com/yancharyu/docker-laravel-step.git
```
```
$ cd docker-laravel-step
```
```
$ docker-compose up -d --build
```
In app container 
```
[app] $ docker-compose exec app bash
```
create .env
```
[app] $ cp .env.example .env
```
```
[app] $ php artisan key:generate
```
```
[app] $ php artisan migrate
```
Exit from app container
```
[app] $ exit
```
