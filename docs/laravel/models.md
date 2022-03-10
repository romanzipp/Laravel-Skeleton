# Models

[Eloquent Models](https://laravel.com/docs/eloquent#introduction) must always extend [`Support\Models\AbstractModel`](app/Support/Model/AbstractModel.php) class.

```php
use Support\Enums\TableName;
use Support\Models\AbstractModel;

final class User extends AbstractModel
{
    protected $table = TableName::USER_USERS;
}
```
