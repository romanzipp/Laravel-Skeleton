#!/bin/sh
php /app/artisan queue:work --verbose --tries=3 --timeout=0
