<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj profil | XBuy</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/theme.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Trad:wght@100..400&family=Poppins&display=swap" rel="stylesheet">
</head>
<body id="edit-profile">
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
                $user = $_SESSION['user'];
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo '<p class="message">' . $message . '</p>';
                    }
                }
            ?>
            <h2>Edytuj profil</h2>
            <form class="profile" action="/edit-profile" method="post" enctype="multipart/form-data">
                <label for="firstName">
                    Imię:
                    <input type="text" id="firstName" name="firstName" value="<?= $user->getFirstName() ?>" required>
                </label>
                <label for="lastName">
                    Nazwisko:
                    <input type="text" id="lastName" name="lastName" value="<?= $user->getLastName() ?>"  required>
                </label>
                <label for="phoneNumber">
                    Numer telefonu:
                    <input type="text" id="phoneNumber" name="phoneNumber" value="<?= $user->getPhoneNumber() ?>" required>
                </label>
                <div class="buttons">
                    <input type="submit" value="Zapisz zmiany">
                    <a href="/profile">Powrót</a>
                </div>
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