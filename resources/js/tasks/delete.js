import axios from 'axios';
import { Modal } from 'bootstrap';
import { showToast } from '../toast';

const modalElement = document.getElementById('deleteTaskModal');

const modal = Modal.getOrCreateInstance(modalElement);

const confirmButton = document.getElementById('confirm-delete-task');

let currentButton = null;

document.addEventListener('click', (event) => {

    if (!event.target.classList.contains('delete-task')) {
        return;
    }

    currentButton = event.target;

    modal.show();

});

confirmButton.addEventListener('click', async () => {

    if (!currentButton) {
        return;
    }

    confirmButton.disabled = true;

    try {

        const response = await axios.delete(
            currentButton.dataset.url
        );

        currentButton.closest('tr').remove();

        checkEmptyTable();

        showToast(response.data.message);

        modal.hide();

    } catch {

        showToast(
            'An unexpected error occurred.',
            'danger'
        );

    } finally {

        confirmButton.disabled = false;

        currentButton = null;

    }

});

function checkEmptyTable() {

    const tbody = document.getElementById('tasks-table-body');

    if (tbody.querySelectorAll('.task-row').length) {
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
