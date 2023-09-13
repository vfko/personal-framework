FROM php:8.0-apache

WORKDIR /var/www

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring curl mysqli

RUN apt-get update && \
    apt-get install -y libcurl4-openssl-dev
