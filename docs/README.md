# Introduction

This is a very **opinionated** modified version of the Laravel framework which aims at providing **strong type hinting** with improved **IDE support**.

## Core Principles

- [Domain oriented Laravel](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel)
- [Actions](https://stitcher.io/blog/laravel-beyond-crud-03-actions)
- Database UUIDs
- [Model Repository pattern](#repositories)
- Invoked single method controllers

See the [app/Domain/User](https://github.com/romanzipp/Laravel-Skeleton/tree/master/app/Domain/User) directory for an example Model, Action & Data structure.

## Directory Structure

- [app/**App**](app/App): Code that is required to run the core application.
- [app/**Domain**](app/Domain): Domains
- [app/**Support**](app/Support): Abstract classes, interfaces, traits to support the Domains

## Requirements

- [PHP 8.1](https://www.php.net)
- [Composer](https://packagist.org)
- [Yarn](https://yarnpkg.com)
- [Lando](https://lando.dev) (optional)

## Getting Started

**Start lando development container**

```shell
lando start
```

**Link storage folder**

```shell
lando artisan storage:link
```

**Migrate database**

```shell
lando artisan migrate:fresh
```

**Create a new Nova user**

```shell
lando artisan nova:user
```

### Additional Packages

- **Composer packages**
    - [myclabs/**php-enum**](https://github.com/myclabs/php-enum)
    - [romanzipp/**dto**](https://github.com/romanzipp/dto)
    - [romanzipp/**laravel-queue-monitor**](https://github.com/romanzipp/Laravel-Queue-Monitor)
    - [romanzipp/**laravel-seo**](https://github.com/romanzipp/Laravel-SEO)
    - [romanzipp/**laravel-previously-deleted**](https://github.com/romanzipp/Laravel-Previously-Deleted)
    - [romanzipp/**laravel-model-doc**](https://github.com/romanzipp/Laravel-Model-Doc) (Run `php artisan model-doc:generate`)
    - [romanzipp/**laravel-env-normalizer**](https://github.com/romanzipp/Laravel-Env-Normalizer)
    - [romanzipp/**php-cs-fixer-config**](https://github.com/romanzipp/PHP-CS-Fixer-Config)
    - [spatie/**laravel-medialibrary**](https://github.com/spatie/laravel-medialibrary)
    - [ebess/**advanced-nova-media-library**](https://github.com/ebess/advanced-nova-media-library)
- **npm packages**
    - [tailwindcss](https://github.com/tailwindcss/tailwindcss)
    - [Laravel-Mix](https://github.com/JeffreyWay/laravel-mix)

## Generator commands

In order to provide a quick kickstarting there are many generator commands.

- `php artisan make:model [...] --domain [...]` (Tip: Provide a `--all` flag to create associated classes)
- `php artisan make:factory [...] --domain [...]`
- `php artisan make:repository [...] --domain [...]`
- `php artisan make:resource [...] --domain [...]`
- `php artisan make:migration [...] --domain [...]` (Coming Soon)

## GitHub Actions

#### Laravel Nova

You will need to define your Laravel Nova credentials via the `NOVA_USERNAME` and `NOVA_PASSWORD` GitHub secrets.

## Tools

#### PHP-CS-Fixer

```shell
lando phpcs fix
```

#### PHPStan

```shell
lando phpstan
```

#### Model-Doc Generator

```shell
lando artisan model-doc:generate
```
