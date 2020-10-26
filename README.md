# STEP

What is STEP??

A service that allows users to post what they have learned in what order and what they have learned, and study based on that.

You can check the progress of learning from My Page, so it is easy to study.


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
