<tr
    class="task-row"
    data-task-id="{{ $task->id }}"
>

    <td>

        {{ $task->name }}

    </td>

    <td>

        @foreach($task->categories as $category)

            <span class="badge bg-secondary me-1">

                {{ $category->name }}

            </span>

        @endforeach

    </td>

    <td>

        <button
            class="btn btn-outline-danger btn-sm delete-task"
            data-url="{{ route('tasks.destroy', $task) }}"
        >

            Delete

        </button>

    </td>

</tr>
