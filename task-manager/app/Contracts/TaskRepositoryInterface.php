<?php

namespace App\Contracts;

interface TaskRepositoryInterface
{
    public function all(array $filters = []): array;

    public function find(int $id): ?array;

    public function create(array $data): array;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function categories(): array;
}
