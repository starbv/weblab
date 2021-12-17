FROM php:7.4-fpm
RUN apt-get update
RUN apt-get install -y zlib1g-dev curl libpq-dev git libicu-dev libxml2-dev libzip-dev vim \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install zip xml

WORKDIR /var/www/web

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer