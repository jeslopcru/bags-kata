FROM php:7.4-alpine

RUN apk add --no-cache git unzip

RUN apk add --no-cache $PHPIZE_DEPS
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN find / -name "xdebug.so" -exec ln -s {} /usr/local/lib/php/extensions/xdebug.so \;

WORKDIR /app
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer
ADD composer.json /app/
RUN composer install

ADD . /app
