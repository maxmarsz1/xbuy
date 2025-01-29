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
            <li class="hidden-mobile"><a href="/categories">
                Kategorie
                <img src="../assets/images/dropdown.svg" alt="dropdown">
            </a></li>
            <li class="hidden-mobile"><a href="/profile">Konto</a></li>
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
                <li class="dropdown"><a href="/categories">
                    Kategorie
                    <img src="../assets/images/dropdown.svg" alt="dropdown">
                </a></li>
                <li><a href="/profile">Konto</a></li>
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
            <h2>Moje oferty</h2>
            <div id="offers-container">
            <?php
            if(isset($offers) && count($offers) > 0) {
                foreach ($offers as $offer) {
                    echo '<div class="offer">
                        <a href="offer/'.$offer['id'].'" class="offer-link">
                            <img src="' . (isset($offer['image']) && $offer['image'] !== '' ? $offer['image'] : '../assets/images/offer.png') . '" alt="offer">
                        </a>
                        <div class="offer-info">
                            <div class="top">
                                <a href="offer/'.$offer['id'].'" class="offer-link">
                                    <h3>'.$offer['title'].'</h3>
                                </a>
                                <p class="location">'.$offer['location'].'</p>
                            </div>
                            <div class="bottom">
                                <div class="options">
                                    <a href="edit-offer/'.$offer['id'].'"><img src="../assets/images/edit.svg" alt="edit"></a>
                                    <a href="delete-offer/'.$offer['id'].'"><img src="../assets/images/delete.svg" alt="delete"></a>
                                </div>
                                <p class="price">'.$offer['price'].' zł</p>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '<p>Brak ofert</p>';
            }
            
            ?>
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