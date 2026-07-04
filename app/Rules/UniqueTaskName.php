<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\Task;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueTaskName implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $normalizedName = Task::normalizeName($value);

        $exists = Task::query()
            ->whereRaw('LOWER(TRIM(name)) = ?', [$normalizedName])
            ->whereNull('deleted_at')
            ->exists();

        if ($exists) {
            $fail('A task with this name already exists.');
        }
    }
}
