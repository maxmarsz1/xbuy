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
<body id="offers">
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
            <h2>Najnowsze oferty</h2>
            <div id="offers-container">
            <?php
            foreach ($offers as $offer) {
                echo '<a href="offer/'.$offer['id'].'" class="offer">
                    <div class="thumb">
                        <img src="' . (isset($offer['image']) && $offer['image'] !== '' ? $offer['image'] : '../assets/images/offer.png') . '" class="offer-image" alt="offer image">
                    </div>
                    <div class="offer-info">
                        <div class="top">
                            <h3>'.$offer['title'].'</h3>
                            <p class="location">'.$offer['location'].'</p>
                        </div>
                        <p class="price">'.$offer['price'].' zł</p>
                    </div>
                </a>';
            }
            ?>
            </div>
            <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>">Poprzednia</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= $i === $currentPage ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>">Następna</a>
            <?php endif; ?>
        </div>
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