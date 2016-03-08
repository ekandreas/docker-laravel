FROM php:5.6-apache

MAINTAINER Andreas Ek <andreas@aekab.se>

RUN a2enmod rewrite

RUN docker-php-ext-install mysql mysqli pdo pdo_mysql

ADD config/docker.conf /etc/apache2/sites-enabled/

ADD config/php.ini /usr/local/etc/php/
