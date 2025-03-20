# Laravel Skeleton

[![Tests](https://github.com/romanzipp/Laravel-Skeleton/actions/workflows/tests.yml/badge.svg)](https://github.com/romanzipp/Laravel-Skeleton/actions/workflows/tests.yml)
[![PHP-CS-Fixer](https://github.com/romanzipp/Laravel-Skeleton/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/romanzipp/Laravel-Skeleton/actions/workflows/php-cs-fixer.yml)
[![PHPStan](https://github.com/romanzipp/Laravel-Skeleton/actions/workflows/phpstan.yml/badge.svg)](https://github.com/romanzipp/Laravel-Skeleton/actions/workflows/phpstan.yml)

This is a very **opinionated** modified version of the Laravel framework which aims at providing **strong type hinting** with improved **IDE support**.

## Features

- **Domain driven** Laravel architecture
- **Strong type hinting** and actual IDE support (without plugins 🤨)
- Fully featured **OAuth authentication**
- **Blog** example components (models, controllers, views, ...)
- [Cloudflare Turnstile](https://blog.cloudflare.com/turnstile-private-captcha-alternative/) CAPTCHA

### Tooling

- **[Docker](https://www.docker.com) deployment** via [GitHub Actions](https://github.com/features/actions) with separate **Dockerfiles** for web, queues & scheduler + Docker Compose example files
- [**Lando**](https://lando.dev) config for rapid development setup
- [**PHP-CS-Fixer**](https://github.com/FriendsOfPHP/PHP-CS-Fixer) with custom ruleset
- [**PHPStan**](https://github.com/phpstan/phpstan) static analyzer
- Auto-deploying **Documentation** via [vuepress](https://vuepress.vuejs.org)
- [Tailwind CSS](https://tailwindcss.com) included

## Documentation

You can find the documentation on [romanzipp.github.io/Laravel-Skeleton](https://romanzipp.github.io/Laravel-Skeleton/)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
