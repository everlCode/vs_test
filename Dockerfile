FROM composer:2.7 AS composer

FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libsqlite3-dev zip unzip git \
    && docker-php-ext-install pdo pdo_sqlite

# Копируем composer из composer-образа
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
