#!/bin/sh

echo "Running in web mode"
echo "PHP version:     $(php -v| head -n 1)"
echo "PHP-FPM version: $(php-fpm -v| head -n 1)"

php-fpm --daemonize
nginx -g "daemon off;"
