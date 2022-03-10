# Repositories

Instead of building Model queries in a separate Controllers, we use the **Repository pattern** to create reusable query building.
Simply extend the [`Support\Repositories\AbstractRepository`](../../app/Support/Repositories/AbstractRepository.php) class to create a new model repository.

## AbstractRepository API

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

## Example usage

To make data as consistent as possible, data passed to views must always be [Eloquent Resources](https://laravel.com/docs/eloquent-resources#introduction) converted to a data collection or single object. This schema is the same when returning resources form an API endpoint.

To achieve this, the [`AbstractRepository`](../../app/Support/Repositories/AbstractRepository.php) class features various helping methods:
- `toObjects(Request $request): stdClass`
- `toObject(Request $request): ?stdClass`

These repository methods are shortcuts to the [`AbstractResource`](../../app/Support/Http/Resources/AbstractResource.php) `toView($request): stdClass` method.

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

## Example data passed to view

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
