<?php
    session_start();
    if ($_SESSION['zalogowany']==false OR $_SESSION['grupa']=="Uzytkownik" OR $_SESSION['grupa']=="Pracownik")
	{
		header('Location: ./index.php');
        session_unset();
		exit();
	}
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Prus Bank</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="nav">
        <div id="lewo">
            <a href="./bank.php" id='home'><img src="./img/logomenu.png"></a>
            <?php
                echo "<h1>Witaj, " . $_SESSION['imie'] . " " . $_SESSION['nazwisko'] .  " !</h1><br>";
            ?>
        </div>
        <div id="prawo">
            <?php
                include "./php/nav.php";
            ?>
        </div>
    </div>

    <div id="tresc">
        <h2>Lista użytkowników</h2>
        <div id="tabelka">
            <?php
                include './php/server.php';
                $sql = "SELECT * from uzytkownicy INNER JOIN rachunki ON uzytkownicy.ID=rachunki.ID_Uzytkownika";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>ID Użytkownika</th>";
                    echo "<th>Login</th>";
                    echo "<th>Haslo</th>";
                    echo "<th>Imie</th>";
                    echo "<th>Nazwisko</th>";
                    echo "<th>Numer konta</th>";
                    echo "<th>Ostatnie logowanie</th>";
                    echo "<th>Grupa</th>";
                    echo "<th>Stan konta</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<th>" . $row["ID"];
                        echo "<th>" . $row["Login"];
                        echo "<th>" . $row["Haslo"];
                        echo "<th>" . $row["Imie"];
                        echo "<th>" . $row["Nazwisko"];
                        echo "<th>" . $row["Nr_konta"];
                        echo "<th>" . $row["Ostatnie_logowanie"];
                        echo "<th>" . $row["Grupa"];
                        echo "<th>" . $row["Stan_konta"];
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                mysqli_close($conn);
            ?>
        </div>
        <div id="formularze">
            <h3>Zmiana loginu użytkownika</h3>
            <form action="./php/zmianaloginu.php" method="POST" id="zmianaloginu">
                <input type="number" required name="id_uzytkownika" placeholder="ID Użytkownika"><br>
                <input type="text" required name="login" placeholder="Nowy login"><br>
                <button type="submit" form="zmianaloginu" id="przycisk">Zmień login!</button>
            </form>
            <?php
                if (isset($_SESSION['zmianalogin'])) {
                    echo $_SESSION['zmianalogin'];
                    unset($_SESSION['zmianalogin']);
                }
            ?>
            <br>

            <h3>Zmiana grupy użytkownika</h3>
            <form action="./php/zmianagrupy.php" method="POST" id="zmianagrup">
                <input type="number" required name="id_uzytkownika" placeholder="ID Użytkownika"><br>
                <input type='radio' required name='grupa' value="Administrator"> Administrator <br>
                <input type='radio' required name='grupa' value="Pracownik"> Pracownik <br>
                <input type='radio' required name='grupa' value="Uzytkownik">Uzytkownik <br>
                <button type="submit" form="zmianagrup" id="przycisk">Zmień grupę!</button>
            </form>
            <?php
                if (isset($_SESSION['zmianagrupy'])) {
                    echo $_SESSION['zmianagrupy'];
                    unset($_SESSION['zmianagrupy']);
                }
            ?>
            <br>

            <h3>Zmiana hasła użytkownika</h3>
            <form action="./php/zmianahaslo.php" method="POST" id="zmianahasla">
                <input type="number" required name="id_uzytkownika" placeholder="ID Użytkownika"><br>
                <input type="password" required name="pass" placeholder="Nowe hasło"><br>
                <button type="submit" form="zmianahasla" id="przycisk">Zmień hasło!</button>
            </form>
            <?php
                if (isset($_SESSION['zmianahasla'])) {
                    echo $_SESSION['zmianahasla'];
                    unset($_SESSION['zmianahasla']);
                }
            ?>
            <br>

            <h3>Dodaj użytkownika</h3>
            <form action="./php/dodajuzytkownika.php" method="POST" id="dodajuzytkownika">
                <input type="text" name="imie" placeholder="Imie" required><br>
                <input type="text" name="nazwisko" placeholder="Nazwisko" required><br>
                <input type="text" name="login" placeholder="Login" required><br>
                <input type="password" name="haslo" placeholder="Haslo min. 6 znaków" required><br>
                Grupa<br>
                <input type='radio' required name='grupa' value="Administrator"> Administrator <br>
                <input type='radio' required name='grupa' value="Pracownik"> Pracownik <br>
                <input type='radio' required name='grupa' value="Uzytkownik">Uzytkownik <br>
                <button type="submit" form="dodajuzytkownika" id="przycisk">Dodaj użytkownika</button>
            </form>
            <?php
                if (isset($_SESSION['dodajuzytkownika'])) {
                    echo $_SESSION['dodajuzytkownika'];
                    unset($_SESSION['dodajuzytkownika']);
                }
            ?>

            <br>

            <h3>Którego użytkownika chcesz usunąć?</h3>
            <form action="./php/usunuzytkownika.php" method="POST" id="usunuzytkownika">
                <input type="number" required name="id_uzytkownika" placeholder="ID Użytkownika"><br>
                <button type="submit" form="usunuzytkownika" id="przycisk">Usuń użytkownika!</button>
            </form>
            <?php
                if (isset($_SESSION['usunuzytkownika'])) {
                    echo $_SESSION['usunuzytkownika'];
                    unset($_SESSION['usunuzytkownika']);
                }
            ?>
            <br>

            <h3>Zmień saldo konta</h3>
            <form action="./php/zmiensaldo.php" method="POST" id="zmiensaldo">
                <input type="number" required name="id_uzytkownika" placeholder="ID Użytkownika"><br>
                <input type="number" name="kwota" placeholder="Kwota" min="1" required><br>
                <button type="submit" form="zmiensaldo" id="przycisk">Zmień saldo użytkownika!</button>
            </form>
            <?php
                if (isset($_SESSION['zmiensaldo'])) {
                    echo $_SESSION['zmiensaldo'];
                    unset($_SESSION['zmiensaldo']);
                }
            ?>
        </div>
    </div>
</body>
</html>