FROM php:5.6-fpm-alpine

RUN docker-php-ext-install -j$(nproc) mysqli opcache
RUN docker-php-ext-install -j$(nproc) mysql opcache