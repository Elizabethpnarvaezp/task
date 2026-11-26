
<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Tasks\TaskManager;

Route::get('/tasks', TaskManager::class)
    ->name('tasks.index');
