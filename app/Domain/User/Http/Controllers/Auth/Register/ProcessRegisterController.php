<?php

namespace Domain\User\Http\Controllers\Auth\Register;

use Domain\User\Actions\CreateUser;
use Domain\User\Data\CreateUserData;
use Domain\User\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Rule;
use Support\Http\Controllers\AbstractController;

final class ProcessRegisterController extends AbstractController
{
    use RegistersUsers;

    private CreateUser $createUser;

    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;
    }

    public function __invoke(Request $request)
    {
        return $this->register($request);
    }

    protected function validator(array $data): Validator
    {
        return ValidatorFacade::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::getTableName())],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data): User
    {
        return $this->createUser->execute(
            new CreateUserData([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ])
        );
    }
}
