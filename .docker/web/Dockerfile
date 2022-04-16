########################################
# npm dependencies
########################################
FROM node:16-alpine AS node

WORKDIR /app

RUN apk update && apk upgrade

COPY . /app

RUN yarn install
RUN yarn production

########################################
# nginx + php fpm
########################################
FROM composer:latest AS composer
FROM ubuntu:latest AS web

ARG NOVA_USERNAME
ARG NOVA_PASSWORD

ARG DEBIAN_FRONTEND=noninteractive
ENV TZ=Etc/UTC

WORKDIR /app

RUN apt-get update
RUN apt-get install -y \
    lsb-release \
    ca-certificates \
    apt-transport-https \
    software-properties-common \
    curl \
    netcat \
    wget \
    zip \
    git \
    openssl

# Install PHP

RUN add-apt-repository ppa:ondrej/php -y
RUN apt-get update
RUN apt-get install -y \
    php8.1-fpm \
    php8.1-mysql \
    php8.1-gd \
    php8.1-imagick \
    php8.1-bcmath \
    php8.1-common \
    php8.1-mbstring \
    php8.1-xml \
    php8.1-pdo \
    php8.1-redis \
    php8.1-intl \
    php8.1-curl

# Install Nginx

RUN apt-get install -y nginx

RUN rm -rf /var/lib/apt/lists/*
RUN apt-get clean

# Publish files

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=node /app /app

# Install composer dependencies

RUN composer config http-basic.nova.laravel.com $NOVA_USERNAME $NOVA_PASSWORD
RUN composer install --prefer-dist --no-scripts --no-dev
RUN composer dump-autoload --optimize

# Update permissions

RUN chown -R www-data:www-data /app
RUN php artisan storage:link

EXPOSE 80
CMD ["sh", ".docker/web/start.sh"]
