##########################################################################################
# php fpm + nginx
##########################################################################################
FROM public.ecr.aws/h7o7l1a9/php-cli:latest

LABEL maintainer="Roman Zipp <ich@ich.wtf>"
LABEL description="PHP CLI"

ARG PRODUCTION=true

WORKDIR /app

COPY . /app

# setup user & permissions

RUN chown -R www-data:www-data /app

USER www-data

RUN mkdir -p storage/passport storage/framework/cache storage/framework/views storage/framework/sessions storage/logs storage/app/public

# run composer

RUN if [ "$PRODUCTION" = "true" ]; then \
        composer install --prefer-dist --no-cache --no-scripts --ignore-platform-reqs --no-dev; \
    else \
        composer install --prefer-dist --no-cache --no-scripts --ignore-platform-reqs; \
    fi

RUN composer dump-autoload --optimize

# prepare app

RUN php artisan storage:link

CMD ["sh", "run/scheduler.sh"]

