FROM php:7.4-fpm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && \
apt-get install -y \
zlib1g-dev \
libicu-dev \
libpq-dev \
libzip-dev \
zip \
libzip-dev && apt-get install -y wget

RUN docker-php-ext-install zip pdo_mysql

WORKDIR /var/www/html
