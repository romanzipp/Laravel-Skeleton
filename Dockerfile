########################################
# npm dependencies
########################################
FROM node:16-alpine AS node

WORKDIR /app

RUN apk update && apk upgrade

COPY package.json package.json
COPY yarn.lock yarn.lock
COPY .npmrc .npmrc

RUN yarn install

########################################
# composer dependencies
########################################
FROM composer:latest AS composer

WORKDIR /app

# Install php extensions

RUN apk update
RUN apk add zlib-dev libpng-dev freetype-dev libjpeg-turbo-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql exif pcntl bcmath gd

# Copy files

COPY --from=node /app /app
COPY . /app

RUN composer install --prefer-dist --no-scripts --no-dev
RUN composer dump-autoload --optimize

#########################################
# npm build
#########################################
FROM node:12-alpine as node-build

WORKDIR /app

COPY --from=composer /app /app

RUN yarn production

########################################
# php fpm daemon
########################################
FROM php:8.0-fpm

WORKDIR /app

# Install php extensions

RUN apt-get update
RUN apt-get install -y netcat curl libfreetype6-dev libjpeg62-turbo-dev libpng-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd pdo_mysql exif pcntl bcmath

# Publish files

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=node-build /app /app

# Update permissions

RUN chown -R www-data:www-data /app

# Export port & start fpm

EXPOSE 9000
CMD ["sh", "start.sh"]
