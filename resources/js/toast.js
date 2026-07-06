import { Toast } from 'bootstrap';

export function showToast(message, type = 'success') {

    const toastElement = document.getElementById('app-toast');

    const body = document.getElementById('app-toast-body');

    body.textContent = message;

    toastElement.classList.remove(
        'text-bg-success',
        'text-bg-danger'
    );

    toastElement.classList.add(
        `text-bg-${type}`
    );

    const toast = new Toast(toastElement, {
        delay: 1500,
        autohide: true,
    });

    toast.show();

}
