<?php

namespace Domain\User\Repositories;

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

    public function findById(string $id): ?User
    {
        return $this->query->find($id);
    }

    public function findByMail(string $mail): ?User
    {
        return $this->query->where('email', $mail)->first();
    }

    public function findByName(string $name): ?User
    {
        return $this->query->where('name', $name)->first();
    }
}
