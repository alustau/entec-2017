FROM php:7.1-fpm-alpine

RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS

RUN apk add --update libpng-dev libxml2-dev

RUN apk add vim

RUN docker-php-ext-install zip pdo_mysql mbstring

RUN apk add --update ca-certificates openssl git openssh

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir /entec-2017

WORKDIR /entec-2017

COPY . /entec-2017

#RUN chmod +x database.sh

RUN composer install

RUN chown -R www-data:www-data .

CMD ["php-fpm"]

#ENTRYPOINT ["/entec-2017/database.sh"]
