
<div>

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Gestión de tareas</h2>
            <p class="text-muted mb-0">
                Administra y organiza tus actividades.
            </p>
        </div>

        <button class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Nueva tarea
        </button>
    </div>

    <!-- Filtros -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <div class="row g-3">

                <!-- Búsqueda -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Buscar tarea
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Buscar por título..."
                            wire:model.live.debounce.300ms="search"
                        >
                    </div>
                </div>

                <!-- Categoría -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Categoría
                    </label>

                    <select
                        class="form-select"
                        wire:model.live="categoryFilter"
                    >
                        <option value="">Todas las categorías</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category }}">
                                {{ $category }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Estado -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Estado
                    </label>

                    <select
                        class="form-select"
                        wire:model.live="statusFilter"
                    >
                        <option value="">Todos los estados</option>
                        <option value="pending">Pendiente</option>
                        <option value="in_progress">En progreso</option>
                        <option value="completed">Completada</option>
                    </select>
                </div>

            </div>
        </div>
    </div>

    <!-- Listado -->
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-list-task me-2"></i>
                Listado de tareas

                <span class="badge bg-primary ms-2">
                    {{ count($tasks) }}
                </span>
            </h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Título</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($tasks as $task)

                            <tr>
                                <td class="ps-3 fw-semibold">
                                    {{ $task['titulo'] }}
                                </td>

                                <td>
                                    {{ $task['descripcion'] }}
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $task['categoria'] }}
                                    </span>
                                </td>

                                <td>
                                    @if ($task['estado'] === 'pending')
                                        <span class="badge bg-warning text-dark">
                                            Pendiente
                                        </span>
                                    @elseif ($task['estado'] === 'in_progress')
                                        <span class="badge bg-info text-dark">
                                            En progreso
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            Completada
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $task['fecha'] }}
                                </td>

                                <td class="text-center">
                                    <button
                                        class="btn btn-sm btn-outline-primary"
                                        title="Editar"
                                        disabled
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button
                                        class="btn btn-sm btn-outline-danger"
                                        title="Eliminar"
                                        disabled
                                    >
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-5">

                                    <i class="bi bi-inbox fs-1 text-muted"></i>

                                    <p class="text-muted mt-2 mb-0">
                                        No se encontraron tareas.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>
