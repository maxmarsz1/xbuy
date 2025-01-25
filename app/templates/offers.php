<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oferty | XBuy</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/theme.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Trad:wght@100..400&family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="home">
            <img src="../assets/images/logo.svg" alt="logo">
        </a>
        <ul class="links">
            <li class="hidden-mobile"><a href="add-offer">Dodaj ogłoszenie</a></li>
            <li class="hidden-mobile"><a href="categories">
                Kategorie
                <img src="../assets/images/dropdown.svg" alt="dropdown">
            </a></li>
            <li class="hidden-mobile"><a href="account">Konto</a></li>
            <li id="search-container">
                <input id="search-input" class="hidden-mobile" type="text" placeholder="Wyszukaj...">
                <img id="search-icon" class="hidden-mobile" src="../assets/images/search.svg" alt="search">
                <img id="mobile-search-icon" class="hidden-desktop" src="../assets/images/search_black.svg" alt="search">
            </li>
            <li id="hamburger" class="hidden-desktop"><img src="../assets/images/hamburger.svg" alt="hamburger"></li>
        </ul>
        <div id="mobile-menu">
            <ul class="links">
                <li><a href="add-offer">Dodaj ogłoszenie</a></li>
                <li class="dropdown"><a href="categories">
                    Kategorie
                    <img src="../assets/images/dropdown.svg" alt="dropdown">
                </a></li>
                <li><a href="account">Konto</a></li>
            </ul>
        </div>
    </header>
    <main>
        <div class="wrapper">
            <h2>Najnowsze oferty - Kraków</h2>
            <div id="offers">
                <div class="offer">
                    <img src="../assets/images/offer.png" alt="offer">
                    <div class="offer-info">
                        <div class="top">
                            <h3>Oferta 2</h3>
                            <p class="location">Basztowa, Kraków</p>
                        </div>
                        <p class="price">100 zł</p>
                    </div>
                </div>
                <div class="offer">
                    <img src="../assets/images/offer.png" alt="offer">
                    <div class="offer-info">
                        <div class="top">
                            <h3>Oferta 2</h3>
                            <p class="location">Basztowa, Kraków</p>
                        </div>
                        <p class="price">100 zł</p>
                    </div>
                </div>
                <div class="offer">
                    <img src="../assets/images/offer.png" alt="offer">
                    <div class="offer-info">
                        <div class="top">
                            <h3>Oferta 2</h3>
                            <p class="location">Basztowa, Kraków</p>
                        </div>
                        <p class="price">100 zł</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="dimmed"></div>
    <script src="../assets/js/theme.js"></script>
</body>
</html>