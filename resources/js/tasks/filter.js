import axios from 'axios';

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
            loading.classList.remove('d-none');
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
            loading.classList.add('d-none');
        }
        document
            .querySelectorAll('.filter-category')
            .forEach(input => input.disabled = false);
        console.error(error);

    } finally {

        if (loading) {
            loading.classList.add('d-none');
        }
        document
            .querySelectorAll('.filter-category')
            .forEach(input => input.disabled = false);

    }

});
