FROM php:8.0.5-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

EXPOSE 80