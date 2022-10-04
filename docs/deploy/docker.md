# Docker

## Build containers

### web

The `web` container comes with nginx and php8.1-fpm.

```shell
docker build -t web . \
  -f .docker/web/Dockerfile \
  --build-arg "NOVA_USERNAME=" \
  --build-arg "NOVA_LICENSE_KEY="
```

```shell
docker run --name web \
  -p 80:80 \
  -v "$(pwd)/.docker/web/app.conf:/etc/nginx/conf.d/app.conf" \
  -v "$(pwd)/.env:/app/.env" \
  web
```

### cli

The `cli` container will run any command provided by the `command` argument. By default the `run/scheduler.sh` script will be executed. `artisan queue:work` command. 

```shell
docker build -t cli . \
  -f .docker/queue/Dockerfile \
  --build-arg "NOVA_USERNAME=" \
  --build-arg "NOVA_LICENSE_KEY="
```

#### Run cli as scheduler

```shell
docker run --name cli \
  -v "$(pwd)/.env:/app/.env" \
  queue \
  run/scheduler.sh
```

#### Run cli as queue

An additional `QUEUE` environment variable can be passed to configure the queue name.

```shell
docker run --name cli \
  -v "$(pwd)/.env:/app/.env" \
  -e QUEUE=default \
  cli \
  run/queue.sh
```

## Docker Compose

### Production docker-compose.yml

**Note**: You will need to specify the following environment variables.  See [the Docker .env.example](/.docker/.env.example) file for more information.

- `COMPOSE_PROJECT_NAME`
- `REPOSITORY_URL` Container registry URL (`___.dkr.ecr.___.amazonaws.com/repository`)
- `DB_ROOT_PASSWORD` Initial root password for database container
- `DB_DATABASE` Database to be created on startup

#### Start docker stack

```shell
docker-compose -f docker-compose.yml up
```

<<< @/../.docker/docker-compose.yml

### Local docker-compose.yml

The local docker compose file uses the included Dockerfiles to build and spin up containers.

**Note**: You will need to specify the following environment variables.  See [the Docker .env.example](/.docker/.env.example) file for more information.

- `COMPOSE_PROJECT_NAME`
- `NOVA_USERNAME` Laravel Nova username
- `NOVA_LICENSE_KEY` Laravel Nova password/API key
- `DB_ROOT_PASSWORD` Initial root password for database container
- `DB_DATABASE` Database to be created on startup

#### Start docker stack

```shell
docker-compose -f docker-compose.local.yml up
```

```shell
docker-compose -f docker-compose.local.yml up --build
```

#### Migrate database

```shell
docker exec -it web php artisan migrate
```

You should be able to access the skeleton at [localhost:8000](http://localhost:8000).

<<< @/../.docker/docker-compose.local.yml
