document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');

    function debounce(func, delay) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    async function fetchOffers(query) {
        try {
            const response = await fetch(`/searchOffers?title=${encodeURIComponent(query)}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            return data.data;
        } catch (error) {
            console.error('Error fetching offers:', error);
            return [];
        }
    }

    function displayOffers(offers) {
        if (offers.length === 0) {
            searchResults.innerHTML = '<p>Nie znaleziono ofert.</p>';
            return;
        }

        const html = offers.map(offer => `
            <a href="/offer/${offer.id}">
                <div class="offer">
                    <img src="/${offer.image}" alt="${offer.title}">
                    <div class="offer-info">
                        <p class="title">${offer.title}</p>
                        <p class="price">Price: $${offer.price}</p>
                    </div>
                </div>
            </a>
        `).join('');
        searchResults.style.display = 'block';
        searchResults.innerHTML = html;
    }

    const handleSearch = debounce(async function () {
        const query = searchInput.value.trim();

        if (query.length === 0) {
            searchResults.innerHTML = '';
            searchResults.style.display = 'none';
            return;
        }

        const offers = await fetchOffers(query);
        displayOffers(offers);
    }, 300);

    searchInput.addEventListener('focus', handleSearch);
    searchInput.addEventListener('input', handleSearch);
    searchInput.addEventListener("blur", () => {
        setTimeout(() => {
            searchResults.innerHTML = '';
            searchResults.style.display = 'none';
        }, 300)
    })
});