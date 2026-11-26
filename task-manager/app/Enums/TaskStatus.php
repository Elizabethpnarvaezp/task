<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case LEVEL = 'prioridad';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pendiente',
            self::IN_PROGRESS => 'En progreso',
            self::COMPLETED => 'Completada',
            self::LEVEL => 'prioridad'
        };
    }
}
