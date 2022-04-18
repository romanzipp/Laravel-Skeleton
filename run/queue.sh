#!/bin/sh

echo "Running in queue mode with queue '$QUEUE'"

if [ ! "$DB_HOST" ] || [ ! "$DB_PORT" ]; then
    echo "DB_HOST or DB_PORT unconfigured"
    exit 1
fi

echo "Waiting for database connection"
until nc -z -v -w30 "$DB_HOST" "$DB_PORT"; do
    echo "No response..."
    sleep 2
done

php /app/artisan queue:work --verbose --tries=3 --timeout=0 --queue=$QUEUE
