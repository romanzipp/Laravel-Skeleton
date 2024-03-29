# Deployment

The Skeleton comes with a GitHub Actions workflow which builds & pushes to AWS ECR.

## GitHub Secrets

- `AWS_ACCESS_KEY`
- `AWS_SECRET_ACCESS_KEY`
- `AWS_REGION`

## Setup AWS ECR

You need to create a new repository for each container role (`web`, `queue` and `scheduler`) with the format of `<name>/<role>`. The name can be configured via the `REPOSITORY_PREFIX` value in the [Deploy GitHub Actions workflow](/.github/workflows/deploy.yml).

Example:
- `skeleton/web`
- `skeleton/queue`
- `skeleton/scheduler`

### ~/.aws/credentials

```
[<PROFILE>]
aws_access_key_id=***
aws_secret_access_key=***
```

### ~/.aws/config

```
[profile <PROFILE>]
region=<REGION>
```

### Authenticate for Docker

```
aws ecr get-login-password --profile <PROFILE> | docker login --username AWS --password-stdin <URL>
```

- Replace (or remove) `<PROFILE>`
- Replace `<URL>` with your ECR URL (`<ID>.dkr.ecr.<REGION>.amazonaws.com`)

If you get a `Error response from daemon: login attempt to ... failed with status: 400 Bad Request` you propably entered the wrong region.

## Directory structure

```
.
├── database             Persistent database storage
├── docker-compose.yml
├── .env                 Environment values for docker-compose
├── storage              Laravel storage
│   ├── app              Laravel storage
│   └── logs             Laravel storage
└── web
    ├── app.conf         web Container nginx site
    └── .env             Laravel .env file
```

## Host nginx

```nginx
server {
    listen       443 ssl;
    server_name  <server_name>;

    ssl_certificate            <cert.crt>;
    ssl_certificate_key        <cert.key>;
    ssl_protocols              TLSv1 TLSv1.1 TLSv1.2;
    ssl_ciphers                'AES128+EECDH:AES128+EDH';
    ssl_prefer_server_ciphers  on;

    location / {
        proxy_pass        http://localhost:8000; # <----------
        proxy_set_header  Host $host;
        proxy_set_header  X-Real-IP $remote_addr;
        proxy_set_header  X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header  X-Forwarded-Proto $scheme;
    }

    location = /favicon.ico {
        access_log     off;
        log_not_found  off;
    }

    location = /robots.txt {
        access_log     off;
        log_not_found  off;
    }

    location ~ /\.ht {
        deny all;
    }
}
```
