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
  - [romanzipp/dto](https://github.com/romanzipp/dto)
  - [romanzipp/laravel-queue-monitor](https://github.com/romanzipp/Laravel-Queue-Monitor)
  - [romanzipp/laravel-seo](https://github.com/romanzipp/Laravel-SEO)
- **npm packages**
  - [tailwindcss](https://github.com/tailwindcss/tailwindcss)
  - [Laravel-Mix](https://github.com/JeffreyWay/laravel-mix)

## Extended

### Enums

Enums must always extend the [`Support\Enums\AbstractEnum`](https://github.com/romanzipp/Laravel-Skeleton/blob/master/app/Support/Enums/AbstractEnum.php) class

### Table names

Table names are stored in the [`Support\Enums\TableName`](https://github.com/romanzipp/Laravel-Skeleton/blob/master/app/Support/Enums/TableName.php) enum prefixed by the used Domain (example: `user-password_resets`, `user-users`). These enums are used across all Models and Migrations.

### Styles

All styles are contained in [Tailwind Plugins](https://tailwindcss.com/docs/plugins) to easily adapt on core style changes. Take a look at the [`button`](https://github.com/romanzipp/Laravel-Skeleton/blob/master/resources/js/tailwind/button.js) plugin for an easy example.

### Blade Components

The contained authentication forms are built with [Blade Components](https://laravel.com/docs/master/blade#components).

### Repositories

Instead of building Model queries each in a separate Controller, we use the Repository pattern to create reusable query building.
Simply extend the [`Support\Repositories\AbstractRepository`](https://github.com/romanzipp/Laravel-Skeleton/blob/master/app/Support/Repositories/AbstractRepository.php) class to create a new model repository.

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

#### Example usage

To make data as consistent as possible, data passed to views must always be [Eloquent Resources](https://laravel.com/docs/eloquent-resources#introduction) converted to a data collection or single object. This schema is the same when returning resources form an API endpoint.

To achieve this, the [`AbstractRepository`](https://github.com/romanzipp/Laravel-Skeleton/blob/master/app/Support/Repositories/AbstractRepository.php) class features various helping methods:
- `manyToView(Request $request): stdClass`
- `oneToView(Request $request): ?stdClass`

These repository methods are shortcuts to the [`AbstractResource`](https://github.com/romanzipp/Laravel-Skeleton/blob/master/app/Support/Http/Resources/AbstractResource.php) `toView($request): stdClass` method.

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
            ->fresh()
            ->withPendingVerification()
            ->toObjects($request);

        $admin = $this
            ->users
            ->fresh()
            ->where('admin', true)
            ->oneToView($request);

        return view('users', [
            'users' => $users,
            'admin' => $admin,
        ]);
    }
}
```

#### Example output

```json
{
    "users": {
        "data": [
            {
                "id": 123,
                "name": "Roman"
            }
        ],
        "links": {
            "first": "http://localhost/users?page=1",
            "last": "http://localhost/users?page=1",
            "prev": null,
            "next": null
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 1,
            "path": "http://localhost/users",
            "per_page": 25,
            "to": 1,
            "total": 1
        }
    },
    "admin": {
        "id": 123,
        "name": "Roman"
    }
}
```

### Models

[Eloquent Models](https://laravel.com/docs/eloquent#introduction) must always extend [`Support\Models\AbstractModel`](https://github.com/romanzipp/Laravel-Skeleton/blob/master/app/Support/Model/AbstractModel.php) class.

```php
use Support\Enums\TableName;
use Support\Models\AbstractModel;

final class User extends AbstractModel
{
    protected $table = TableName::USER_USERS;
}
```

### Resources

[Eloquent Resources](https://laravel.com/docs/eloquent-resources#introduction) must always extend the [`Support\Http\Resources\AbstractResource`](https://github.com/romanzipp/Laravel-Skeleton/blob/master/app/Support/Http/Resources/AbstractResource.php) class.

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

#### Example output

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

### Actions

To make as much logic as possible reusable, all heavy lifting actions must be wrapped in **Actions**.

```php
use Domain\User\Data\CreateUserData;
use Domain\User\Models\User;

final class CreateUser
{
    public function execute(CreateUserData $data): User
    {
        /** @var User $user */
        $user = User::query()->make([
            'display_name' => $data->displayName,
            'email' => $data->email,
            'password' => $data->password,
        ]);

        $user->save();

        return $user;
    }
}
```

### Data

Data passed to actions or around the application must always extend the [`Support\Data\AbstractData`]((https://github.com/romanzipp/Laravel-Skeleton/blob/master/app/Support/Data/AbstractData.php)) class.

The `AbstractData` class is a just an extending class of [romanzipp/dto](https://github.com/romanzipp/dto).

```php
use Support\Data\AbstractData;

final class CreateUserData extends AbstractData
{
    protected static array $required = [
        'name',
        'password'
    ];

    public string $email;

    public string $password;

    public ?string $displayName = null;
}

```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
