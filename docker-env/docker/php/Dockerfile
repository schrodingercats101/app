# 使用イメージの指定
FROM php:8.3-fpm

# composer イメージ内から特定のファイルをコピー
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 5173
# コマンドの実行
# apt-getコマンドのアップデートと必要なライブラリやドライバのインストール
RUN apt-get update && apt-get install -y \
    git \
    zip unzip \
    curl \
    gnupg \
    && docker-php-ext-install pdo_mysql
RUN apt-get install -y zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev \
&& docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
&& docker-php-ext-install gd
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs
