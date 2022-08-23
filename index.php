<?php
    session_start();
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Prus Bank</title>
    <link rel="stylesheet" href="indexstyle.css">
</head>
<body>
    <div id="tresc">
        <img src="./img/logo.png">
        <h4>Zaloguj się!</h4>

        <form class="formularz" action="./php/logowanie.php" method="POST" id="logowanie">
            <input type="text" name="login" placeholder="Login" required>
            <input type="password" name="haslo" placeholder="Haslo" required>
            <button type="submit" form="logowanie" class="przyciski">Zaloguj się!</button>
        </form>
        <?php
        if (isset($_SESSION['powiadomienie_login'])) {
            echo $_SESSION['powiadomienie_login'];
            unset($_SESSION['powiadomienie_login']);
        }
        ?>
        <br>
        <h4>Nie masz konta?</h4>

        <form class="formularz" action="./php/rejestracja.php" method="POST" id="rejestracja">
            <input type="text" name="imie" placeholder="Imie" required>
            <input type="text" name="nazwisko" placeholder="Nazwisko" required>
            <input type="text" name="login" placeholder="Login" required>
            <input type="password" name="haslo" placeholder="Haslo min. 6 znaków" required>
            <button type="submit" form="rejestracja" class="przyciski">Zarejestruj się!</button>
        </form>
        <?php
        if (isset($_SESSION['powiadomienie_rej'])) {
            echo $_SESSION['powiadomienie_rej'];
            unset($_SESSION['powiadomienie_rej']);
        }
        ?>
    </div>
</body>
</html>