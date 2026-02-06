FROM php:8.2-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y libpq-dev \
  && docker-php-ext-install pdo pdo_pgsql \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
