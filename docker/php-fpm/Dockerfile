FROM php:7.4-fpm

RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

ADD docker/php-fpm/php.ini /usr/local/etc/php/php.ini

COPY ./ /var/www/html/

USER root
RUN chmod -R 777 /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
