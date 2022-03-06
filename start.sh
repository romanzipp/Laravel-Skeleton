#!/bin/bash
set -eu

role=${CONTAINER_ROLE}

if [ "$role" = "web" ]; then
  echo "Running in web mode"

  php-fpm

elif [ "$role" = "queue" ]; then
  echo "Running in queue mode"

  if [ ! "$DB_HOST" ] || [ ! "$DB_PORT" ]; then
    echo "DB_HOST or DB_PORT unconfigured"
    exit 1
  fi

  echo "Waiting for database connection"
  until nc -z -v -w30 "$DB_HOST" "$DB_PORT"; do
    echo "No response..."
    sleep 2
  done

  php artisan queue:work --verbose --tries=3 --timeout=90

elif [ "$role" = "scheduler" ]; then
  echo "Running in scheduler mode"

  while true; do
    php artisan schedule:run --verbose --no-interaction &
    sleep 60
  done
else
  echo "Could not match the container role...."
  exit 1
fi
