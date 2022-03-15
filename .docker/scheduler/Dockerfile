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
    php8.1-cli \
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

# Publish files

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY . /app

# Install composer dependencies

RUN composer config http-basic.nova.laravel.com $NOVA_USERNAME $NOVA_PASSWORD
RUN composer install --prefer-dist --no-scripts --no-dev
RUN composer dump-autoload --optimize

# Update permissions

RUN chown -R www-data:www-data /app

EXPOSE 80
ENTRYPOINT ["sh", ".docker/scheduler/start.sh"]
