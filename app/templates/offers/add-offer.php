<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj ofertę | XBuy</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/theme.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Trad:wght@100..400&family=Poppins&display=swap" rel="stylesheet">
</head>
<body id="add-offer">
<header>
        <a href="/index">
            <img src="../assets/images/logo.svg" alt="logo">
        </a>
        <ul class="links">
            <li class="hidden-mobile"><a href="/add-offer">Dodaj ogłoszenie</a></li>
            <li class="dropdown hidden-mobile">
                <p>
                    Kategorie
                    <img src="../assets/images/dropdown.svg" alt="dropdown">
                </p>
                <div class="dropdown-content">
                    <?php
                    foreach ($_SESSION['categories'] as $category) {
                        echo '<a href="/search?categories='.$category['id'].'">'.$category['name'].'</a>';
                    }
                    ?>
                </div>
            </li>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<li class="hidden-mobile"><a href="/profile">Konto</a></li>';
            } else {
                echo '<li class="hidden-mobile"><a href="/login">Zaloguj się</a></li>';
            }
            ?>
            <li id="search-container">
                <input id="search-input" class="hidden-mobile" type="text" placeholder="Wyszukaj...">
                <img id="search-icon" class="hidden-mobile" src="../assets/images/search.svg" alt="search">
                <img id="mobile-search-icon" class="hidden-desktop" src="../assets/images/search_black.svg" alt="search">
                <div id="search-results"></div>
            </li>
            <li id="hamburger" class="hidden-desktop"><img src="../assets/images/hamburger.svg" alt="hamburger"></li>
        </ul>
        <div id="mobile-menu">
            <ul class="links">
                <li><a href="/add-offer">Dodaj ogłoszenie</a></li>
                <li class="dropdown">
                    <p class="dropdown-button">
                        Kategorie
                        <img src="../assets/images/dropdown.svg" alt="dropdown">
                    </p>
                    <div class="dropdown-content">
                        <?php
                        foreach ($_SESSION['categories'] as $category) {
                            echo '<a href="/search?categories='.$category['id'].'">'.$category['name'].'</a>';
                        }
                        ?>
                    </div>
                </li>

                <?php
                if (isset($_SESSION['user'])) {
                    echo '<li><a href="/profile">Konto</a></li>';
                } else {
                    echo '<li><a href="/login">Zaloguj się</a></li>';
                }
                ?>
            </ul>
        </div>
    </header>
    <main>
        <div class="wrapper">
            <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo '<p class="message">' . $message . '</p>';
                    }
                }
            ?>
            <h2>Nowa oferta</h2>
            <form class="offer" action="add-offer" method="post" enctype="multipart/form-data">
                <label for="title">
                    Tytuł oferty:
                    <input type="text" name="title" required>
                </label>
                <label for="description">
                    Opis oferty:
                    <textarea name="description" required></textarea>
                </label>
                <label for="location">
                    Lokalizacja:
                    <input type="text" name="location"  required>
                </label>
                <label for="price">
                    Cena:
                    <span class="price">
                        <input type="number" name="price" step="0.01" required>
                    </span>
                </label>
                <label for="categories">
                    Kategorie:
                    <select name="categories[]" class="categories" multiple required>
                        <?php
                        if (!empty($_SESSION['categories'])) {
                            $categories = $_SESSION['categories'];
                            foreach ($categories as $category) {
                                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                            }
                        } else {
                            echo '<option value="">Brak dostępnych kategorii</option>';
                        }
                        ?>
                    </select>
                </label>
                <label for="image">
                    Zdjecie:
                    <span class="image">
                        <input type="file" name="file" accept="image/*" required>
                        <div class="image-btn">Wybierz zdjecie</div>
                    </span>
                </label>

                <input type="submit" value="Dodaj ofertę">
            </form>
        </div>
    </main>
    <footer>
        <a href="index" class="logo">
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
    <script src="../assets/js/theme.js" defer></script>
    <script src="../assets/js/search.js" defer></script>
</body>
</html>