<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Task Manager</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-light">
<!-- Toast -->
<div
    class="toast-container position-fixed bottom-0 end-0 p-3"
    style="z-index:1080"
>

    <div
        id="app-toast"
        class="toast"
        role="alert"
    >

        <div class="toast-header">

            <strong class="me-auto">

                Task Manager

            </strong>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="toast"
            ></button>

        </div>

        <div
            id="app-toast-body"
            class="toast-body"
        >

        </div>

    </div>

</div>
<!-- Modal -->
<div
    class="modal fade"
    id="deleteTaskModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Delete task

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>

            <div class="modal-body">

                Are you sure you want to delete this task?

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >

                    Cancel

                </button>

                <button
                    id="confirm-delete-task"
                    type="button"
                    class="btn btn-danger"
                >

                    Delete

                </button>

            </div>

        </div>

    </div>

</div>
<!-- Tasks -->
<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h2 class="mb-4">

                        Task Manager

                    </h2>

                    @yield('content')

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
