#!/bin/sh

echo "Running in scheduler mode"

while true
do
  php /app/artisan schedule:run --verbose --no-interaction &
  sleep 60
done
