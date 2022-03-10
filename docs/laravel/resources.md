# Resources

[Eloquent Resources](https://laravel.com/docs/eloquent-resources#introduction) must always extend the [`Support\Http\Resources\AbstractResource`](../../app/Support/Http/Resources/AbstractResource.php) class.

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

## Example `toArray` output

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
