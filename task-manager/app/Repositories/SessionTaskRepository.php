<?php

namespace App\Repositories;

use App\Contracts\TaskRepositoryInterface;
use App\Enums\TaskStatus;
use Illuminate\Support\Facades\Session;

class SessionTaskRepository implements TaskRepositoryInterface
{
    /**
     * Clave utilizada para almacenar las tareas en la sesión.
     */
    private const SESSION_KEY = 'task_manager.tasks';

    /**
     * Categorías disponibles inicialmente.
     */
    private const CATEGORIES = [
        'Trabajo',
        'Personal',
        'Estudios',
        'Otros',
    ];

    /**
     * Obtener todas las tareas aplicando filtros opcionales.
     */
    public function all(array $filters = []): array
    {
        $this->initializeMockData();

        $tasks = Session::get(self::SESSION_KEY, []);

        // Búsqueda por título.
        if (!empty($filters['title'])) {
            $title = mb_strtolower(trim($filters['title']));

            $tasks = array_filter($tasks, function ($task) use ($title) {
                return str_contains(
                    mb_strtolower($task['titulo']),
                    $title
                );
            });
        }

        // Filtro por categoría.
        if (!empty($filters['category'])) {
            $tasks = array_filter($tasks, function ($task) use ($filters) {
                return $task['categoria'] === $filters['category'];
            });
        }

        // Filtro por estado.
        if (!empty($filters['status'])) {
            $tasks = array_filter($tasks, function ($task) use ($filters) {
                return $task['estado'] === $filters['status'];
            });
        }

        return array_values($tasks);
    }

    /**
     * Buscar una tarea por su identificador.
     */
    public function find(int $id): ?array
    {
        $this->initializeMockData();

        $tasks = Session::get(self::SESSION_KEY, []);

        foreach ($tasks as $task) {
            if ($task['id'] === $id) {
                return $task;
            }
        }

        return null;
    }

    /**
     * Crear una nueva tarea.
     */
    public function create(array $data): array
    {
        $this->initializeMockData();

        $tasks = Session::get(self::SESSION_KEY, []);

        $nextId = empty($tasks)
            ? 1
            : max(array_column($tasks, 'id')) + 1;

        $task = [
            'id' => $nextId,
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'categoria' => $data['categoria'],
            'estado' => $data['estado'],
            'fecha' => $data['fecha'],
        ];

        $tasks[] = $task;

        Session::put(self::SESSION_KEY, $tasks);

        return $task;
    }

    /**
     * Actualizar una tarea existente.
     */
    public function update(int $id, array $data): bool
    {
        $this->initializeMockData();

        $tasks = Session::get(self::SESSION_KEY, []);

        foreach ($tasks as $index => $task) {
            if ($task['id'] === $id) {

                $tasks[$index] = array_merge(
                    $task,
                    $data
                );

                Session::put(self::SESSION_KEY, $tasks);

                return true;
            }
        }

        return false;
    }

    /**
     * Eliminar una tarea.
     */
    public function delete(int $id): bool
    {
        $this->initializeMockData();

        $tasks = Session::get(self::SESSION_KEY, []);

        foreach ($tasks as $index => $task) {
            if ($task['id'] === $id) {

                unset($tasks[$index]);

                Session::put(
                    self::SESSION_KEY,
                    array_values($tasks)
                );

                return true;
            }
        }

        return false;
    }

    /**
     * Obtener las categorías disponibles.
     */
    public function categories(): array
    {
        return self::CATEGORIES;
    }

    /**
     * Inicializar los datos mock cuando la sesión todavía no tiene tareas.
     */
    private function initializeMockData(): void
    {
        if (Session::has(self::SESSION_KEY)) {
            return;
        }

        $tasks = [
            [
                'id' => 1,
                'titulo' => 'Diseñar interfaz del proyecto',
                'descripcion' => 'Crear el diseño inicial del gestor de tareas.',
                'categoria' => 'Trabajo',
                'estado' => TaskStatus::IN_PROGRESS->value,
                'fecha' => '2026-11-20',
            ],
            [
                'id' => 2,
                'titulo' => 'Estudiar Laravel',
                'descripcion' => 'Repasar servicios, repositorios y contratos.',
                'categoria' => 'Estudios',
                'estado' => TaskStatus::PENDING->value,
                'fecha' => '2026-11-25',
            ],
            [
                'id' => 3,
                'titulo' => 'Organizar actividades personales',
                'descripcion' => 'Planificar las actividades de la semana.',
                'categoria' => 'Personal',
                'estado' => TaskStatus::COMPLETED->value,
                'fecha' => '2026-11-22',
            ],
            [
                'id' => 4,
                'titulo' => 'Implementar el CRUD',
                'descripcion' => 'Desarrollar las operaciones de gestión de tareas.',
                'categoria' => 'Trabajo',
                'estado' => TaskStatus::PENDING->value,
                'fecha' => '2026-11-26',
            ],
        ];

        Session::put(self::SESSION_KEY, $tasks);
    }
}
