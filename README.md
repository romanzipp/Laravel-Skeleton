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

Table names are stored in the `Support\Enums\TableName` enum prefixed by the used Domain (example: `user-password_resets`, `user-users`). These enums are used across all Models and Migrations.

### Styles

All styles are contained in [Tailwind Plugins](https://tailwindcss.com/docs/plugins) to easily adapt on core style changes. Take a look at the [`button`](https://github.com/romanzipp/Laravel-Skeleton/blob/master/resources/js/tailwind/button.js) plugin for an easy example.

### Blade Components

The contained authentication forms are built with [Blade Components](https://laravel.com/docs/master/blade#components).

### Repositories

Instead of building Model queries each in a separate Controller, we use the Repository pattern to create reusable query building.
Simply extend the `Support\Repositories\AbstractRepository` class to create a new model repository.

```php
use Domain\User\Http\Resources\UserResource;
use Domain\User\Models\User;
use Support\Repositories\AbstractRepository;

final class UserRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return User::class;
    }

    public function getResourceClass(): string
    {
        return UserResource::class;
    }

    public function withPendingVerification(): self
    {
        $this->query->whereNull('verified_at');

        return $this;
    }
}
```

Example usage in controllers:

```php
use Domain\User\Repositories\UserRepository;
use Illuminate\Http\Request;

final class UserController
{
    private UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;    
    }

    public function __invoke(Request $request)
    {
        $users = $this
            ->users
            ->withPendingVerification()
            ->toResources()
            ->toView($request);

        return view('users', [
            'users' => $users,
        ]);
    }
}
```

### Models

[Eloquent Models](https://laravel.com/docs/master/eloquent#introduction) must always extend `Support\Models\AbstractModel` class.

```php
use Support\Enums\TableName;
use Support\Models\AbstractModel;

final class User extends AbstractModel
{
    protected $table = TableName::USER_USERS;
}
```

### Resources

[Eloquent Resources](https://laravel.com/docs/master/eloquent-resources#introduction) must always extend the `Support\Http\Resources\AbstractResource` class.

```php
use Support\Http\Resources\AbstractResource;
use Domain\User\Models\User;

final class UserResource extends AbstractResource
{
    public static $wrap = 'user';

    public function toArray($request)
    {
        /** @var \Domain\User\Models\User $resource */
        $resource = $this->resource;

        return [
            'id' => $resource->id,

            $this->withDates(),
        
            $this->withPolicies(fn (User $user) => [
                'accessAdmin' => $user->can('accessAdmin')
            ]),
        ];
    }
}
```

Example output:

```json
{
    "user": {
        "id": 1,
        "created_at": "2020-01-01 01:00:00",
        "updated_at": "2020-01-01 01:00:00",
        "can": {
            "accessAdmin": true
        }
    }
}
```

### View Data

To make data as consistent as possible, data passed to views must always be [Eloquent Resources](https://laravel.com/docs/master/eloquent-resources#introduction).

To elevate this, Resources and ResourceCollections feature a new method `toView(Request $request)` which will convert this data into a more API-like schema.

```php
use Domain\User\Http\Resources\UserResource;

$adminResource = new UserResource($admin);
$usersResources = UserResource::collection($users);

return view('users', [
    'admin' => $adminResource->toView($request),
    'users' => $usersResources->toView($request),
]);
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
