<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj się | XBuy</title>
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Trad:wght@100..400&family=Poppins&display=swap" rel="stylesheet">
</head>
<body id="login">
    <header>
        <a href="home">
            <img src="../assets/images/logo.svg" alt="logo">
        </a>
        <a href="register">Rejestracja</a>
    </header>
    <div id="auth-wrapper">
        <div id="left-column">
            <div class="wrapper">
                <a href="home">
                    <div class="logo-container">
                        <img src="../assets/images/logo_big.svg" alt="logo">
                        <span>buy</span>
                    </div>
                </a>
                <span id="logo-text">mamy <u>wszystko</u>,<br>czego potrzebujesz</span>
            </div>
        </div>
        <div id="right-column">
            <div class="wrapper">
                <h2>Logowanie</h2>
                <form action="login" method="post">
                    <input type="text" name="username" placeholder="nazwa użytkownika" id="">
                    <input type="password" name="password" placeholder="hasło" id="">
                    <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo '<p class="error">' . $message . '</p>';
                        }
                    }
                    ?>
                    <input type="submit" value="Zaloguj się">
                </form>
                <div class="no-account">Jeśli nie masz konta, <a href="register">zarejestruj się</a></div>
            </div>
        </div>
    </div>
</body>
</html>