<?php

namespace App\Livewire\Tasks;

use App\Services\TaskService;
use Livewire\Component;

class TaskManager extends Component
{
    public array $tasks = [];

    public array $categories = [];

    public string $search = '';

    public string $categoryFilter = '';

    public string $statusFilter = '';


    /**
     * Inicializar el componente.
     */
    public function mount(TaskService $taskService): void
    {
        $this->categories = $taskService->getCategories();

        $this->loadTasks($taskService);
    }

    /**
     * Consultar tareas aplicando filtros.
     */
    public function loadTasks(TaskService $taskService): void
    {
        $this->tasks = $taskService->getTasks([
            'title' => $this->search,
            'category' => $this->categoryFilter,
            'status' => $this->statusFilter,
        ]);
    }

    /**
     * Actualizar el listado cuando cambien los filtros.
     */
    public function updatedSearch(TaskService $taskService): void
    {
        $this->loadTasks($taskService);
    }

    public function updatedCategoryFilter(TaskService $taskService): void
    {
        $this->loadTasks($taskService);
    }

    public function updatedStatusFilter(TaskService $taskService): void
    {
        $this->loadTasks($taskService);
    }

    /**
     * Renderizar la vista.
     */
    public function render()
    {
        return view('livewire.tasks.task-manager')
            ->layout('layouts.app');
    }
}
