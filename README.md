# Laravel Skeleton

This is a modified version of the Laravel framework skeleton.

## Core Principles

- [Domain oriented Laravel](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel)
- [Actions](https://stitcher.io/blog/laravel-beyond-crud-03-actions)
- Database UUIDs
- Invoked controllers
- [Model Repository pattern](#repositories)
- Final classes by default

See the [app/Domain/User](https://github.com/romanzipp/Laravel-Skeleton/tree/master/app/Domain/User) directory for an example Model, Action & Data structure.

## Directory Structure

- **App**: Code that is required to run the core application.
- **Domain**: Domains
- **Support**: Abstract classes, interfaces, traits to support the Domains

## Requirements

- [PHP 7.4](https://www.php.net) or [PHP 8.0](https://www.php.net)
- [Composer](https://packagist.org)
- [Yarn](https://yarnpkg.com)

### Additional Packages

- **Composer packages**
  - [myclabs/php-enum](https://github.com/myclabs/php-enum)
  - [romanzipp/dto](https://github.com/romanzipp/dto)
  - [romanzipp/laravel-queue-monitor](https://github.com/romanzipp/Laravel-Queue-Monitor)
  - [romanzipp/laravel-seo](https://github.com/romanzipp/Laravel-SEO)
  - [romanzipp/laravel-previously-deleted](https://github.com/romanzipp/Laravel-Previously-Deleted)
- **npm packages**
  - [tailwindcss](https://github.com/tailwindcss/tailwindcss)
  - [Laravel-Mix](https://github.com/JeffreyWay/laravel-mix)

## Documentation

### Enums

Enums must always extend the [`Support\Enums\AbstractEnum`](app/Support/Enums/AbstractEnum.php) class.

### Table names

Table names are stored in the [`Support\Enums\TableName`](app/Support/Enums/TableName.php) enum prefixed by the used Domain (example: `user-password_resets`, `user-users`). These enums are used across all Models and Migrations.

### Repositories

Instead of building Model queries in a separate Controllers, we use the **Repository pattern** to create reusable query building.
Simply extend the [`Support\Repositories\AbstractRepository`](app/Support/Repositories/AbstractRepository.php) class to create a new model repository.

#### AbstractRepository API

**Query building**

- `paginate(int $perPage = 50): AbstractRepository`
- `with(array $relations)`
- `withCount(array $relations)`
- `orderBy(string $field, string $direction)`

**Query Builder overrides**

- `exists(): bool`
- `count($columns = ['*']): int`
- `get($columns = ['*'])`
- `first($columns = ['*'])`
- `find($id, $columns = ['*'])`
- `each(callable $callback, $count = 1000): bool`

**Data conversion**

- `toResources(?Scope $scope = null): ResourceCollection`
- `toResource(?Scope $scope = null): ?AbstractResource`
- `toObject(Request $request, ?Scope $scope = null): ?stdClass`
- `toObjects(Request $request, ?Scope $scope = null): stdClass`

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
    
    public function whereIsAdmin(): self
    {
        $this->query->where('admin', true);

        return $this;
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

To achieve this, the [`AbstractRepository`](app/Support/Repositories/AbstractRepository.php) class features various helping methods:
- `toObjects(Request $request): stdClass`
- `toObject(Request $request): ?stdClass`

These repository methods are shortcuts to the [`AbstractResource`](app/Support/Http/Resources/AbstractResource.php) `toView($request): stdClass` method.

```php
use Domain\User\Repositories\UserRepository;
use Illuminate\Http\Request;

final class UserController
{
    private UserRepository $users;
    
    private UserRepository $admins;

    public function __construct(UserRepository $users, UserRepository $admins)
    {
        $this->users = $users;
        $this->admins = $admins;
    }

    public function __invoke(Request $request)
    {
        $users = $this
            ->users
            ->withPendingVerification()
            ->paginate()
            ->toObjects($request);

        $admin = $this
            ->admins
            ->whereIsAdmin()
            ->toObject($request);

        return view('users', [
            'users' => $users,
            'admin' => $admin,
        ]);
    }
}
```

#### Example data passed to view

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
            "...": "..."
        },
        "meta": {
            "...": "..."
        }
    },
    "admin": {
        "id": 123,
        "name": "Roman"
    }
}
```

### Models

[Eloquent Models](https://laravel.com/docs/eloquent#introduction) must always extend [`Support\Models\AbstractModel`](app/Support/Model/AbstractModel.php) class.

```php
use Support\Enums\TableName;
use Support\Models\AbstractModel;

final class User extends AbstractModel
{
    protected $table = TableName::USER_USERS;
}
```

### Resources

[Eloquent Resources](https://laravel.com/docs/eloquent-resources#introduction) must always extend the [`Support\Http\Resources\AbstractResource`](app/Support/Http/Resources/AbstractResource.php) class.

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

#### Example `toArray` output

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

Heavy lifting procedures including model creation, updating and deletion must be wrapped in **Actions**.

```php
use Domain\User\Data\CreateUserData;
use Domain\User\Models\User;

final class CreateUser
{
    public function execute(CreateUserData $data): User
    {
        $user = new User([
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

Data passed to actions or around the application must always extend the [`Support\Data\AbstractData`]((app/Support/Data/AbstractData.php)) class.

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

## Frontend

### Styles

All styles are contained in [Tailwind Plugins](https://tailwindcss.com/docs/plugins) to easily adapt on core style changes. Take a look at the [`button`](resources/js/tailwind/button.js) plugin for an easy example.

### Blade Components

The contained authentication forms are built with [Blade Components](https://laravel.com/docs/master/blade#components).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
