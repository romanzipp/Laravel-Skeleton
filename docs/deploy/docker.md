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

### Production docker-compose.yml

**Note**: You will need to specify the following environment variables.  See [the Docker .env.example](/.docker/.env.example) file for more information.

- `REPOSITORY_URL` Container registry URL (`___.dkr.ecr.___.amazonaws.com/repository`)

#### Start docker stack

```shell
docker-compose -p skeleton_production -f docker-compose.yml up
```

<<< @/../.docker/docker-compose.yml

### Local docker-compose.yml

The local docker compose file uses the included Dockerfiles to build and spin up containers.

**Note**: You will need to specify the following environment variables.  See [the Docker .env.example](/.docker/.env.example) file for more information.

- `NOVA_USERNAME` Laravel Nova username
- `NOVA_PASSWORD` Laravel Nova password/API key
- `DB_ROOT_PASSWORD` initial root password for database container

#### Start docker stack

```shell
docker-compose -p skeleton -f docker-compose.local.yml up
```

```shell
docker-compose -p skeleton -f docker-compose.local.yml up --build
```

#### Migrate database

```shell
docker exec -it web php artisan migrate
```

You should be able to access the skeleton at [localhost:8000](http://localhost:8000).

<<< @/../.docker/docker-compose.local.yml
