<ul id="linki">
    <li><a href="pozyczka.php">Weź pożyczkę</a></li>
    <li><a href="spozyczka.php">Spłać pożyczkę</a></li>
    <li><a href="przelew.php">Przelew</a></li>
    <li><a href="pozyczki.php">Pożyczki</a></li>
    <li><a href="wiadomosci.php">Wiadomosci</a></li>
    <li><a href="przelewy.php">Przelewy</a></li>
    <li><a href="zarzadzajuzytkownikami.php">Użytkownicy</a></li>
    <li><a href="autoryzacja.php">Autoryzacja</a></li>
    <li><a href="./php/wyloguj.php" id="wyloguj">Wyloguj się!</a></li>
    <?php
        echo "<br><br>";
        include './php/stan_konta.php';
    ?>
</ul>