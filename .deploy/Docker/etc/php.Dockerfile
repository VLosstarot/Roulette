FROM composer:latest AS composer
FROM php:7.3-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN pecl install xdebug

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && apt-get install -y openssl \
    && apt-get install -y zip unzip

RUN docker-php-ext-install \
    mbstring \
    opcache \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-enable xdebug

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql
RUN usermod -u 1000 www-data && \
    groupmod -g 1000 www-data

COPY php/conf /usr/local/etc/php-fpm.d/
COPY php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
WORKDIR /var/www
CMD ["php-fpm"]
