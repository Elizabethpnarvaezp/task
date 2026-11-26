<?php

namespace App\Services;

use App\Contracts\TaskRepositoryInterface;

class TaskService
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository
    ) {
    }

    /**
     * Obtener tareas con filtros.
     */
    public function getTasks(array $filters = []): array
    {
        return $this->taskRepository->all($filters);
    }

    /**
     * Obtener una tarea.
     */
    public function getTask(int $id): ?array
    {
        return $this->taskRepository->find($id);
    }

    /**
     * Crear una tarea.
     */
    public function createTask(array $data): array
    {
        return $this->taskRepository->create($data);
    }

    /**
     * Actualizar una tarea.
     */
    public function updateTask(int $id, array $data): bool
    {
        return $this->taskRepository->update($id, $data);
    }

    /**
     * Eliminar una tarea.
     */
    public function deleteTask(int $id): bool
    {
        return $this->taskRepository->delete($id);
    }

    /**
     * Obtener las categorías disponibles.
     */
    public function getCategories(): array
    {
        return $this->taskRepository->categories();
    }
}
