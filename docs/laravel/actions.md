# Actions

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
