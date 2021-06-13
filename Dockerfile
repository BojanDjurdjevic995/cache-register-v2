FROM php:8.0-apache
WORKDIR /var/www/html

COPY index.php index.php
EXPOSE 80

COPY --from=composer:2 /usr/bin/composer /usr/src/composer
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install --no-dev