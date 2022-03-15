# Deployment

The Skeleton comes with a GitHub Actions workflow which builds & pushes to AWS ECR.

## GitHub Secrets

- `AWS_ACCESS_KEY`
- `AWS_SECRET_ACCESS_KEY`
- `AWS_REGION`

## Setup AWS ECR

### ~/.aws/credentials

```
[my_project]
aws_access_key_id = ****
aws_secret_access_key = ****
```

### ~/.aws/config

```
[profile my_project]
region = eu-west-1
```

### Authenticate for Docker

```
aws ecr get-login-password --profile my_project | docker login --username AWS --password-stdin <URL>
```

Replace `<URL>` with your ECR URL (`<ID>.dkr.ecr.eu-central-1.amazonaws.com`)

# Docker

## web

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

## queue

```shell
docker build -t queue . \
  -f .docker/queue/Dockerfile \
  --build-arg "NOVA_USERNAME=" \
  --build-arg "NOVA_PASSWORD="
```

```shell
docker run --name queue \
  -v "$(pwd)/.env:/app/.env" \
  queue
```

## scheduler

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
