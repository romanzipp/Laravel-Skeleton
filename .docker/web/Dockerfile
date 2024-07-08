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
ARG NOVA_LICENSE_KEY

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
    php8.3-fpm \
    php8.3-mysql \
    php8.3-gd \
    php8.3-imagick \
    php8.3-bcmath \
    php8.3-common \
    php8.3-mbstring \
    php8.3-xml \
    php8.3-pdo \
    php8.3-redis \
    php8.3-intl \
    php8.3-curl

# Install Nginx

RUN apt-get install -y nginx

RUN rm -rf /var/lib/apt/lists/*
RUN apt-get clean

# Publish files

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=node /app /app

# Install composer dependencies

RUN composer config http-basic.nova.laravel.com $NOVA_USERNAME $NOVA_LICENSE_KEY
RUN composer install --prefer-dist --no-scripts --no-dev
RUN composer dump-autoload --optimize

# Update permissions

RUN chown -R www-data:www-data /app
RUN php artisan storage:link

EXPOSE 80
CMD ["sh", "run/web.sh"]
