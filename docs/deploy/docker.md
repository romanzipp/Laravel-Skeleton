# Docker

## Build containers

### web

The `web` container comes with nginx and php8.1-fpm.

```shell
docker build -t web . \
  -f .docker/web/Dockerfile \
  --build-arg "NOVA_USERNAME=" \
  --build-arg "NOVA_PASSWORD="
```

```shell
docker run --name web \
  -p 80:80 \
  -v "$(pwd)/.docker/web/app.conf:/etc/nginx/conf.d/app.conf" \
  -v "$(pwd)/.env:/app/.env" \
  web
```

### queue

The `queue` container will run the `artisan queue:work` command. An additional `QUEUE` environment variable can be passed to configure the queue name.

```shell
docker build -t queue . \
  -f .docker/queue/Dockerfile \
  --build-arg "NOVA_USERNAME=" \
  --build-arg "NOVA_PASSWORD="
```

```shell
docker run --name queue \
  -v "$(pwd)/.env:/app/.env" \
  -e QUEUE=default \
  queue
```

### scheduler

The `scheduler` container will execute the `artisan schedule:run` command every 60 seconds. This replaces a cron-based setup.

```shell
docker build -t scheduler . \
  -f .docker/scheduler/Dockerfile \
  --build-arg "NOVA_USERNAME=" \
  --build-arg "NOVA_PASSWORD="
```

```shell
docker run --name scheduler \
  -v "$(pwd)/.env:/app/.env" \
  scheduler
```

## Docker Compose

```shell
COMPOSE_PROJECT_NAME=skeleton docker-compose up
```

### Local docker-compose.yml

The local docker compose file uses the included Dockerfiles to build and spin up containers.

Note: You will need to specify environment variables for Laravel Nova and the database container. See [the Docker .env.example](/.docker/.env.example) file for more information.

```shell
COMPOSE_PROJECT_NAME=skeleton docker-compose up --build
```

You should be able to access the skeleton at [localhost:8000](http://localhost:8000).

<< .docker/docker-compose.yml
