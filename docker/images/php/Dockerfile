FROM php:7.4-fpm
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y \
    htop \
    zip \
    git

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir /.composer && chown 1000:1000 /.composer