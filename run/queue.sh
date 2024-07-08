#!/bin/sh

echo "Running in queue monde for queue $QUEUE"
echo "PHP version: $(php -v| head -n 1)"

n=0
until [ "$n" -ge 10 ]
do
   php /app/artisan queue:work --verbose --timeout=0 --queue=$QUEUE && break
   n=$((n+1))

   echo "Queue worker failed to start. Attempt $n/10. Retrying in 5 seconds..."
   sleep 5
done

echo "Queue worker failed to start 10 times. Exiting."
exit 1
