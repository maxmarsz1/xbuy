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
<body id="add-offer">
    <header>
        <a href="home">
            <img src="../assets/images/logo.svg" alt="logo">
        </a>
        <ul class="links">
            <li class="hidden-mobile"><a href="addOffer">Dodaj ogłoszenie</a></li>
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
                <li><a href="addOffer">Dodaj ogłoszenie</a></li>
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
            <h2>Nowa oferta</h2>

            <form action="addOffer" method="post" enctype="multipart/form-data">
                <label for="title">
                    Tytuł oferty:
                    <input type="text" name="title" placeholder="Tytuł oferty" required>
                </label>
                <label for="description">
                    Opis oferty:
                    <textarea name="description" placeholder="Opis oferty" required></textarea>
                </label>
                <label for="location">
                    Lokalizacja:
                    <input type="text" name="location" placeholder="Lokalizacja" required>
                </label>
                <label for="price">
                    Cena:
                    <input type="number" name="price" placeholder="Cena" step="0.01" required>
                </label>
                <label for="image">
                    Zdjecie:
                    <input type="file" name="image" accept="image/*" required>
                </label>

                <input type="submit" value="Dodaj ofertę">
            </form>
        </div>
    </main>
    <footer>
        <a href="home" class="logo">
            <img src="../assets/images/logo_big.svg" alt="logo">
        </a>
        <section class="right">
            <div class="links-wrapper">
                <h3>xbuy</h3>
                <ul class="links">
                    <li><a href="">polityka prywatności</a></li>
                    <li><a href="">regulamin</a></li>
                    <li><a href="">politka cookies</a></li>
                    <li><a href="">zasady bezpieczeństwa</a></li>
                </ul>
            </div>
            <div class="links-wrapper">
                <ul class="links">
                    <li><a href="">o nas</a></li>
                    <li><a href="">blog</a></li>
                    <li><a href="">reklama</a></li>
                    <li><a href="">pomoc</a></li>
                </ul>
            </div>
            <div class="links-wrapper contact">
                <h3>kontakt</h3>
                <ul class="links">
                    <li><a href="">+48 000 000 000</a></li>
                    <li><a href="">support@xbuy.com</a></li>
                </ul>
            </div>
        </section>
        
    </footer>
    <div id="dimmed"></div>
    <script src="../assets/js/theme.js"></script>
</body>
</html>