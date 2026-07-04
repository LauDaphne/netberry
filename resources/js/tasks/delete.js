import axios from 'axios';

document.addEventListener('click', async (event) => {

    if (!event.target.classList.contains('delete-task')) {
        return;
    }

    if (!confirm('Delete this task?')) {
        return;
    }

    const button = event.target;

    button.disabled = true;

    try {

        await axios.delete(button.dataset.url);

        button.closest('tr').remove();

        checkEmptyTable();

    } catch (error) {

        console.error(error);

        button.disabled = false;

    }

});

function checkEmptyTable() {

    const tbody = document.getElementById('tasks-table-body');

    if (tbody.querySelectorAll('.task-row').length > 0) {
        return;
    }

    tbody.innerHTML = `
        <tr id="empty-message">
            <td colspan="3" class="text-center text-muted py-4">
                No tasks created.
            </td>
        </tr>
    `;

}
