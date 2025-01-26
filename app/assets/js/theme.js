document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    const dimmed = document.getElementById('dimmed');
    const mobileSearchIcon = document.getElementById('mobile-search-icon');
    const searchInput = document.getElementById('search-input');
    const searchIcon = document.getElementById('search-icon');

    mobileSearchIcon.addEventListener('click', () => {
        mobileSearchIcon.style.display = 'none';
        searchInput.classList.remove('hidden-mobile');
        searchIcon.classList.remove('hidden-mobile');
        searchInput.focus();
    })
    searchInput.addEventListener('blur', () => {
        searchInput.classList.add('hidden-mobile');
        searchIcon.classList.add('hidden-mobile');
        mobileSearchIcon.style.display = 'block';
    })

    hamburger.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
        dimmed.style.display = 'block';
    })

    dimmed.addEventListener('click', () => {
        const activeElement = document.querySelector('.active');
        activeElement.classList.remove('active');
        dimmed.style.display = 'none';
    })
})