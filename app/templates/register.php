<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarejestruj się | XBuy</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/theme.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Trad:wght@100..400&family=Poppins&display=swap" rel="stylesheet">
</head>
<body id="login">
    <header>
        <a href="index">
            <img src="../assets/images/logo.svg" alt="logo">
        </a>
        <a href="login">Logowanie</a>
    </header>
    <div id="auth-wrapper">
        <div id="left-column">
            <div class="wrapper">
                <a href="index">
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
                <h2>Rejestracja</h2>
                <form action="register" method="post">
                    <input type="text" name="username" placeholder="nazwa użytkownika" id="">
                    <input type="password" name="password" placeholder="hasło" id="">
                    <input type="password" name="password1" placeholder="powtórz hasło" id="">
                    <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo '<p class="error">' . $message . '</p>';
                        }
                    }
                    ?>
                    <input type="submit" value="Zarejestruj się">
                </form>
                <div class="no-account">Jeśli masz już konto, <a href="login">zaloguj się</a></div>
            </div>
        </div>
    </div>
</body>
</html>