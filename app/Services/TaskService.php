<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TaskService
{

    public function getAll(array $categoryIds = []): Collection
    {
        $query = Task::query()
            ->with('categories')
            ->orderByDesc('created_at');

        $this->applyCategoryFilter(
            $query,
            $categoryIds
        );

        return $query->get();
    }

    private function applyCategoryFilter(
        Builder $query,
        array $categoryIds
    ): void {

        if ($categoryIds === []) {
            return;
        }

        foreach ($categoryIds as $categoryId) {

            $query->whereHas(
                'categories',
                fn (Builder $builder) => $builder->whereKey($categoryId)
            );

        }

    }

    public function store(array $data): Task
    {
        return DB::transaction(function () use ($data) {

            $task = Task::create([
                'name' => $data['name'],
            ]);

            $task->categories()->sync($data['categories']);

            return $task->load('categories');

        });
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}
