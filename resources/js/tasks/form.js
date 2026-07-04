const form = document.getElementById('task-form');

function clearErrors() {

    document.getElementById('error-name').textContent = '';

    document.getElementById('error-categories').textContent = '';

}

function showValidationErrors(errors) {

    if (errors.name) {

        document.getElementById('error-name').textContent =
            errors.name[0];

    }

    if (errors.categories) {

        document.getElementById('error-categories').textContent =
            errors.categories[0];

    }

}

function removeEmptyMessage() {

    const emptyMessage = document.getElementById('empty-message');

    if (emptyMessage) {
        emptyMessage.remove();
    }

}

function prependTask(html) {

    const tbody = document.getElementById('tasks-table-body');

    tbody.insertAdjacentHTML(
        'afterbegin',
        html
    );

}

function resetForm(form) {

    form.reset();

}

if (form) {

    form.addEventListener('submit', async function (event) {

        event.preventDefault();

        const formData = new FormData(form);

        try {
            clearErrors();
            const response = await axios.post(
                form.action,
                formData
            );

            removeEmptyMessage();

            prependTask(
                response.data.html
            );

            resetForm(form);

        } catch (error) {

            if (error.response?.status === 422) {

                showValidationErrors(
                    error.response.data.errors
                );

                return;

            }

            console.error(error);

        }

    });

}
