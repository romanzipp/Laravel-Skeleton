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
aws ecr get-login-password --profile <PROFILE> | docker login --username AWS --password-stdin <URL>
```

- Replace (or remove) `<PROFILE>`
- Replace `<URL>` with your ECR URL (`<ID>.dkr.ecr.<REGION>.amazonaws.com`)
