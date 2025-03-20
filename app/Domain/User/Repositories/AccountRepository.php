<?php

namespace Domain\User\Repositories;

use Domain\User\Models\AccountModel;
use Support\Repositories\AbstractRepository;

/**
 * @method \Domain\User\Models\AccountModel|null first($columns = ['*'])
 */
class AccountRepository extends AbstractRepository
{
    public function getModelClass(): string
    {
        return \Domain\User\Models\AccountModel::class;
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

    public function findById(string $id): ?AccountModel
    {
        return $this->query->find($id);
    }

    public function findByName(string $name): ?AccountModel
    {
        $this->with(self::getCommonRelations());

        $this->query->where('name', $name);

        return $this->first();
    }
}
