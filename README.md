<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

This is a modified version of the Laravel framework skeleton.

## Core Principles

- [Domain oriented Laravel](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel)
- [Actions](https://stitcher.io/blog/laravel-beyond-crud-03-actions)
- Database UUIDs
- Invoked controllers
- Model Repository pattern
- Final classes by default

See the [app/Domain/User](https://github.com/romanzipp/Laravel-Skeleton/tree/master/app/Domain/User) directory for an example Model, Action & Data structure.

## Directory Structure

- **App**: Code that is required to run the core application.
- **Domain**: Domains
- **Support**: Abstract classes, interfaces, traits to support the Domains

## Requirements

- [PHP 7.4](https://www.php.net)
- [Composer](https://packagist.org)
- [Yarn](https://yarnpkg.com)

## Additional Packages

- **Composer packages**
  - [myclabs/php-enum](https://github.com/myclabs/php-enum)
  - [spatie/data-transfer-object](https://github.com/spatie/data-transfer-object)
  - [romanzipp/laravel-queue-monitor](https://github.com/romanzipp/Laravel-Queue-Monitor)
  - [romanzipp/laravel-seo](https://github.com/romanzipp/Laravel-SEO)
- **npm packages**
  - [tailwindcss](https://github.com/tailwindcss/tailwindcss)
  - [Laravel-Mix](https://github.com/JeffreyWay/laravel-mix)

## Extended

### Table names

Table names are stored in the `Support\Enums\TableName` enum prefixed by the used Domain. These enums are used across all Models and Migrations.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
