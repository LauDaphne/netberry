<form
    id="task-form"
    method="POST"
    action="{{ route('tasks.store') }}"
    class="mb-4"
>

    @csrf

    <h5 class="mb-3">

        New task

    </h5>

    <div class="row align-items-start g-3">

        <div class="col-md-6">

            <input
                id="name"
                name="name"
                type="text"
                class="form-control"
                placeholder="Task name..."
                required
            >

            <div
                id="error-name"
                class="text-danger small mt-1"
            ></div>

        </div>

        <div class="col-md-4">

            <div class="d-flex flex-wrap gap-3">

                @foreach($categories as $category)

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="category-{{ $category->id }}"
                            name="categories[]"
                            value="{{ $category->id }}"
                        >

                        <label
                            class="form-check-label"
                            for="category-{{ $category->id }}"
                        >

                            {{ $category->name }}

                        </label>

                    </div>

                @endforeach

            </div>

            <div
                id="error-categories"
                class="text-danger small mt-1"
            ></div>

        </div>

        <div class="col-md-2">

            <button
                type="submit"
                class="btn btn-primary w-100"
            >

                Add

            </button>

        </div>

    </div>

</form>

<div id="form-errors"></div>
