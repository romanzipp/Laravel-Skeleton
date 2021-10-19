# Data

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
