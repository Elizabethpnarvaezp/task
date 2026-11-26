
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task Manager</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('tasks.index') }}">
                <i class="bi bi-check2-square me-2"></i>
                Task Manager
            </a>
        </div>
    </nav>

    <main class="container py-4">
        {{ $slot }}
    </main>

    <footer class="text-center text-muted py-3">
        <small>Task Manager - Laravel 13 + Livewire 4</small>
    </footer>

    @livewireScripts

</body>
</html>
