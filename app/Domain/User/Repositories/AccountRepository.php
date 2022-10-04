<?php

namespace Domain\User\Repositories;

use Domain\User\Models\Account;
use Support\Repositories\AbstractRepository;

/**
 * @method \Domain\User\Models\Account|null first($columns = ['*'])
 */
class AccountRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return \Domain\User\Models\Account::class;
    }

    public function getResourceClass(): string
    {
        return \Domain\User\Http\Resources\AccountResource::class;
    }

    public static function getCommonRelations(): array
    {
        return [
            'media',
        ];
    }

    public function findById(string $id): ?Account
    {
        return $this->query->find($id);
    }

    public function findByName(string $name): ?Account
    {
        $this->with(self::getCommonRelations());

        $this->query->where('name', $name);

        return $this->first();
    }
}
