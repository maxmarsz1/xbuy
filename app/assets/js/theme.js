document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    const dimmed = document.getElementById('dimmed');
    const mobileSearchIcon = document.getElementById('mobile-search-icon');
    const searchInput = document.getElementById('search-input');
    const searchIcon = document.getElementById('search-icon');


    // mobile search
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

    // mobile menu
    hamburger.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
        dimmed.style.display = 'block';
        document.body.classList.toggle('no-scroll');
    })

    dimmed.addEventListener('click', () => {
        const activeElement = document.querySelector('.active');
        activeElement.classList.remove('active');
        dimmed.style.display = 'none';
        document.body.classList.toggle('no-scroll');
    })


    // add offer/edit offer image handling
    const imageInput = document.querySelector('.image input[type="file"]');
    const imageBtn = document.querySelector('.image .image-btn');
    if(imageInput && imageBtn){
        imageBtn.addEventListener('click', () => {
            imageInput.click();
        })
        imageInput.addEventListener('change', () => {
            const fileName = imageInput.files[0].name;
            imageBtn.innerText = fileName;
        })
    }

    // offer page - contact info toggling
    const contactButton = document.querySelector("button.contact");
    const contactInfo = document.querySelector(".contact-info");
    if(contactButton && contactInfo){
        contactButton.addEventListener('click', () => {
            contactInfo.classList.toggle('active');
        })
    }

    // edit profile phone number validation
    const phoneInput = document.getElementById('phoneNumber');
    if(phoneInput){
        const phoneForm = phoneInput.closest('form');
        phoneInput.addEventListener('input', () => {
            phoneInput.value = phoneInput.value.replace(/[^0-9]/g, '');
        })
        phoneForm.addEventListener('submit', (e) => {
            if(phoneInput.value.length < 8){
                e.preventDefault();
                alert('Numer telefonu musi mieć conajmniej 8 cyfr');
            }
        })
    }

    const dropdownButton = document.querySelectorAll('.dropdown-button');
    if(dropdownButton){
        dropdownButton.forEach(button => {
            button.addEventListener('click', () => {
                const dropdown = button.nextElementSibling;
                dropdown.classList.toggle('active');
            })
        })
    }

    
})