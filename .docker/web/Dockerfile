########################################
# node
########################################
FROM node:18 AS build-node

ARG NPM_TOKEN

WORKDIR /app

COPY . /app

RUN npm install && \
    npm run production

##########################################################################################
# php fpm + nginx
##########################################################################################
FROM public.ecr.aws/h7o7l1a9/php-web:latest

LABEL maintainer="Roman Zipp <ich@ich.wtf>"
LABEL description="PHP FPM + nginx"

ARG PRODUCTION=true

WORKDIR /app

COPY . /app
COPY --from=build-node /app/public /app/public

# setup user & permissions

RUN mkdir -p storage/passport storage/framework/cache storage/framework/views storage/framework/sessions storage/logs storage/app/public

RUN chown -R www-data:www-data /app /var/log/nginx

# run composer

RUN if [ "$PRODUCTION" = "true" ]; then \
        composer install --prefer-dist --no-cache --no-scripts --ignore-platform-reqs --no-dev; \
    else \
        composer install --prefer-dist --no-cache --no-scripts --ignore-platform-reqs; \
    fi

RUN composer dump-autoload --optimize

# prepare app

RUN php artisan storage:link

EXPOSE 80
CMD ["sh", "run/web.sh"]
