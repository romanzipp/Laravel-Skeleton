#!/bin/sh

echo "Running in scheduler mode"
echo "PHP version: $(php -v| head -n 1)"

while true
do
  php /app/artisan schedule:run --verbose --no-interaction &
  sleep 60
done
