@forelse($tasks as $task)

    @include('tasks.partials.row')

@empty

    @include('tasks.partials.empty')

@endforelse
