<div
    id="category-filter"
    data-url="{{ route('tasks.filter') }}"
    class="mb-4"
>

    <h5 class="mb-3">

        Filter by categories

    </h5>

    <div class="d-flex gap-3">

        @foreach($categories as $category)

            <div class="form-check">

                <input
                    class="form-check-input filter-category"
                    type="checkbox"
                    value="{{ $category->id }}"
                    id="filter-category-{{ $category->id }}"
                >

                <label
                    class="form-check-label"
                    for="filter-category-{{ $category->id }}"
                >
                    {{ $category->name }}
                </label>

            </div>

        @endforeach

    </div>

</div>
<div
    id="filter-loading"
    class="text-center my-3 d-none"
>

    <div
        class="spinner-border spinner-border-sm"
        role="status"
    >
        <span class="visually-hidden">

            Loading...

        </span>
    </div>

</div>
