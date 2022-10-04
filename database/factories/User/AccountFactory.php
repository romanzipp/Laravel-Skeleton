<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Support\Enums\ServiceEnum;

class AccountFactory extends Factory
{
    protected $model = \Domain\User\Models\Account::class;

    public function definition()
    {
        return [
            'name' => $name = $this->faker->unique()->userName(),
            'display_name' => $name,
            'service' => $this->faker->randomElement(ServiceEnum::toArray()),
            'service_user_id' => (string) random_int(100000, 99999999),
            'service_user_name' => $name,
        ];
    }
}
