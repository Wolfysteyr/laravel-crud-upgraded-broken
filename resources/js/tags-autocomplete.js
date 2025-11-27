document.addEventListener('DOMContentLoaded', () => {
    const input = document.querySelector('input[name="name"][data-tag-autocomplete]');
    if (!input) return;

    const list = document.createElement('ul');
    list.style.border = '1px solid #ccc';
    list.style.maxHeight = '150px';
    list.style.overflowY = 'auto';
    list.style.marginTop = '0.25rem';
    list.style.padding = '0';
    list.style.listStyle = 'none';
    list.style.position = 'absolute';
    list.style.backgroundColor = '#fff';
    list.style.zIndex = '1000';
    list.hidden = true;

    input.parentElement.style.position = 'relative';
    input.parentElement.appendChild(list);

    let controller = null;

    input.addEventListener('input', async () => {
        const term = input.value.trim();
        if (term.length === 0) {
            list.hidden = true;
            list.innerHTML = '';
            return;
        }

        const url = input.dataset.autocompleteUrl;
        if (!url) return;

        if (controller) controller.abort();
        controller = new AbortController();

        try {
            const res = await fetch(url + '?q=' + encodeURIComponent(term), {
                signal: controller.signal,
                headers: {
                    'Accept': 'application/json',
                },
            });
            if (!res.ok) return;

            const tags = await res.json();
            list.innerHTML = '';

            if (!tags.length) {
                list.hidden = true;
                return;
            }

            tags.forEach(name => {
                const li = document.createElement('li');
                li.textContent = name;
                li.style.padding = '4px 8px';
                li.style.cursor = 'pointer';

                li.addEventListener('mousedown', (e) => {
                    e.preventDefault(); // prevent blur
                    input.value = name;
                    list.hidden = true;
                });

                list.appendChild(li);
            });

            list.hidden = false;
        } catch (e) {
            if (e.name !== 'AbortError') {
                console.error(e);
            }
        }
    });

    document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !list.contains(e.target)) {
            list.hidden = true;
        }
    });
});