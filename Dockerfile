FROM composer:1.5

ENV COMPOSER_ARGUMENTS --prefer-lowest --prefer-stable

WORKDIR /app
COPY . /app

RUN composer update --prefer-dist ${COMPOSER_ARGUMENTS}
