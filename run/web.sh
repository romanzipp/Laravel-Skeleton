#!/bin/sh

echo "Running in web mode"

/etc/init.d/php8.1-fpm start
nginx -g "daemon off;"
