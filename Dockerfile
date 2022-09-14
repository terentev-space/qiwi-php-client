FROM php:7.2

RUN mkdir /qiwi-php-client
WORKDIR /qiwi-php-client

RUN apt-get update
RUN apt-get install -y git zip unzip

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
