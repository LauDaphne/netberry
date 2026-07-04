<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Category;
use App\Models\Task;
use App\Services\CategoryService;
use App\Services\TaskService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService,
        private readonly CategoryService $categoryService
    ) {
    }

    public function index(): View
    {
        return view('tasks.index', [
            'tasks' => $this->taskService->getAll(),
            'categories' => $this->categoryService->getAll()
        ]);
    }

    public function filter(Request $request): JsonResponse
    {
        $tasks = $this->taskService->getAll(
            $request->input('categories', [])
        );

        return response()->json([
            'html' => view('tasks.partials.rows', [
                'tasks' => $tasks,
            ])->render(),
        ]);
    }


    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->store(
            $request->validated()
        );

        return response()->json([
            'message' => 'Task created successfully.',
            'html' => view('tasks.partials.row', [
                'task' => $task->load('categories')
            ])->render(),
        ], 201);
    }

    public function destroy(Task $task): JsonResponse
    {
        $this->taskService->delete($task);

        return response()->json([
            'message' => 'Task deleted successfully.',
        ]);
    }
}
