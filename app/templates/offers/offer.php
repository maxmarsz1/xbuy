<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $offer['title'] ?> | XBuy</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/theme.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Trad:wght@100..400&family=Poppins&display=swap" rel="stylesheet">
</head>
<body id="offer">
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
                        echo '<a href="/searchOffers?category='.$category['id'].'">'.$category['name'].'</a>';
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
                            echo '<a href="/searchOffers?category='.$category['id'].'">'.$category['name'].'</a>';
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
            <div id="offer-container">
                <div class="back">
                    <a href="/offers">
                        <img src="../assets/images/arrow.svg" alt="arrow">
                        Powrót do ogłoszeń
                    </a>
                </div>
                <div class="thumb">
                    <img src="/../<?= $offer['image'] ?>" alt="laptop">
                </div>
                <div class="info">
                    <h2 class="title"><?= $offer['title'] ?></h2>
                    <span class="categories">
                        <?php
                        foreach ($categories as $category) {
                            echo '<p class="category">' . $category . '</p>';
                        }
                        ?>
                    </span>
                    <p class="price"><?= $offer['price'] ?> zł</p>
                    <div class="contact-block">
                        <button class="contact">Kontakt do sprzedawcy</button>
                        <span class="contact-info">
                            <?php if ($user): ?>
                                <p><?= $user['first_name'] . ' ' . $user['last_name'] ?></p>
                                <p><?= $user['phone_number'] ?></p>
                            <?php else: ?>
                                <p>Brak danych kontaktowych</p>
                            <?php endif; ?>
                        </span>
                    </div>
                    <h4>Lokalizacja</h4>
                    <p class="location"><?= $offer['location'] ?></p>
                    <h4>Opis oferty</h4>
                    <p class="description"><?= $offer['description'] ?></p>
                    <h4>Oferta wystawiona</h4>
                    <p class="date"><?= $offer['created_date'] ?></p>
                </div>
            </div>
            <!-- <div class="pagination">
                <a href="" class="active">1</a>
                <a href="">2</a>
                <a href="">3</a>
            </div> -->
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
    <script src="../assets/js/theme.js"></script>
</body>
</html>