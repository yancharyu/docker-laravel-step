FROM php:7.4-fpm-buster
COPY ./php.ini /usr/local/etc/php/php.ini
LABEL maintainer="yancharyu"

# -o         オプション設定をするためのオプション
# -e         シェルスクリプト内で何らかのエラーが発生した時点で。それ以降の処理を中断できる
# -u         未定義の変数に対して読み込み等を行おうとした場合にエラーとなる
# -x         実行したコマンドをすべて標準エラー出力に出してくれる
# pipefail   パイプ中のあらゆる段階でエラーがあれば失敗とする
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer

# コマンドを実行
RUN apt-get update \
  && apt-get -y install git unzip libzip-dev libicu-dev libonig-dev \
  # キャッシュを削除
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* \
  # PHP拡張ライブラリをインストール
  && docker-php-ext-install intl pdo_mysql zip bcmath \
  # nodejsをインストール
  && curl -sL https://deb.nodesource.com/setup_14.x | bash - \
  && apt-get install -y nodejs \
  # yarnをインストール
  && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
  && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
  && apt-get update && apt-get install yarn \
  # ロケールの追加・設定
  && apt-get install -y locales \
  && locale-gen ja_JP.UTF-8 \
  && echo "export LANG=ja_JP.UTF-8" >> ~/.bashrc \
  && composer config -g process-timeout 3600 \
  # composer高速化プラグイン
  && composer config -g repos.packagist composer https://packagist.jp \
  && composer global require hirak/prestissimo

# 環境変数
ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer \
  TZ='Asia/Tokyo' \
  LANG=ja_JP.UTF-8 \
  LANGUAGE=ja_JP:ja \
  LC_CTYPE="ja_JP.UTF-8" \
  LC_NUMERIC="ja_JP.UTF-8" \
  LC_TIME="ja_JP.UTF-8"\
  LC_COLLATE="ja_JP.UTF-8"\
  LC_MONETARY="ja_JP.UTF-8"\
  LC_MESSAGES="ja_JP.UTF-8"\
  LC_PAPER="ja_JP.UTF-8"\
  LC_NAME="ja_JP.UTF-8"\
  LC_ADDRESS="ja_JP.UTF-8"\
  LC_TELEPHONE="ja_JP.UTF-8"\
  LC_MEASUREMENT="ja_JP.UTF-8"\
  LC_IDENTIFICATION="ja_JP.UTF-´8"\
  LC_ALL= \
  # Laravel environment
  DB_CONNECTION=mysql \
  DB_HOST=mysql \
  DB_DATABASE=laravel_step \
  DB_USERNAME=homestead \
  DB_PASSWORD=secret

# UNIXソケットで通信する
COPY ./php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
# php.iniをコピー
COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /work