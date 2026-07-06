import axios from 'axios';
import {showToast} from "../toast";

document.addEventListener('change', async (event) => {

    if (!event.target.classList.contains('filter-category')) {
        return;
    }

    const url = document
        .getElementById('category-filter')
        .dataset.url;

    const loading = document.getElementById('filter-loading');

    const categories = [
        ...document.querySelectorAll('.filter-category:checked')
    ].map(input => input.value);

    try {
        if (loading) {
            loading.classList.remove('invisible');
        }
        document
            .querySelectorAll('.filter-category')
            .forEach(input => input.disabled = true);
        const response = await axios.get(url, {
            params: {
                categories,
            },
        });

        document.getElementById('tasks-table-body').innerHTML =
            response.data.html;

    } catch (error) {

        if (loading) {
            loading.classList.add('invisible');
        }
        document
            .querySelectorAll('.filter-category')
            .forEach(input => input.disabled = false);

        showToast(
            'An unexpected error occurred.',
            'danger'
        );

    } finally {

        if (loading) {
            loading.classList.add('invisible');
        }
        document
            .querySelectorAll('.filter-category')
            .forEach(input => input.disabled = false);

    }

});
