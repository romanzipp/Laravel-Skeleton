cloudflared tunnel \
  --config=.cloudflare/config.yml \
  --origincert=./.cloudflare/cert.pem \
  --loglevel debug \
  run \
  --url=$(lando info --filter "service=appserver_nginx" --format json | jq '.[0].urls[1]' | sed 's/\"//g')
