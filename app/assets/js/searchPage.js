document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-search-input');
    const categoryToggles = document.querySelectorAll('#category-toggles input[type="checkbox"]');
    const searchButton = document.getElementById('search-button');
    const searchResults = document.getElementById('offers-container');

    function getQueryParams() {
        const params = new URLSearchParams(window.location.search);
        return {
            title: params.get('title') || '',
            categories: params.get('categories') ? params.get('categories').split(',') : []
        };
    }

    function setInitialCategorySelection() {
        const { categories } = getQueryParams();
        categoryToggles.forEach(checkbox => {
            if (categories.includes(checkbox.value)) {
                checkbox.checked = true;
            }
        });
    }

    function debounce(func, delay) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    async function fetchOffers(query, categories) {
        try {
            const url = new URL('/searchOffers', window.location.origin);
            if (query) {
                url.searchParams.append('title', query);
            }
            if (categories.length > 0) {
                url.searchParams.append('categories', categories.join(','));
            }

            const response = await fetch(url);
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
            <a href="/offer/${offer.id}" class="offer">
                <div class="thumb">
                    <img src="${offer.image || '../assets/images/offer.png'}" class="offer-image" alt="offer image">
                </div>
                <div class="offer-info">
                    <div class="top">
                        <h3>${offer.title}</h3>
                        <p class="location">${offer.location}</p>
                    </div>
                    <p class="price">${offer.price} zł</p>
                </div>
            </a>
        `).join('');

        searchResults.innerHTML = html;
    }

    const handleSearch = debounce(async function () {
        const query = searchInput.value.trim();
        const selectedCategories = Array.from(categoryToggles)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        const offers = await fetchOffers(query, selectedCategories);
        displayOffers(offers);
    }, 300);

    setInitialCategorySelection();
    handleSearch();
    searchInput.addEventListener('input', handleSearch);
    categoryToggles.forEach(checkbox => {
        checkbox.addEventListener('change', handleSearch);
    });
    searchButton.addEventListener('click', handleSearch);
});
