<?php
    session_start();
    if ($_SESSION['zalogowany']==false or $_SESSION['grupa']=="Uzytkownik")
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
    <link rel="stylesheet" href="bankstyle.css">
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
        <?php
            include './php/server.php';

            $sql = "SELECT * from wiadomosci";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                echo "<h2>Brak wiadomości!</h2>";
            } else {
                echo "<h1>Wiadomosci</h1>";
                echo "<br>";
                echo "<div id='tabelka'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>ID Użytkownika</th>";
                echo "<th>Data</th>";
                echo "<th>Wiadomosc</th>";
                echo "<th>Odpowiedz</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<th>" . $row["ID"];
                    echo "<th>" . $row["ID_Uzytkownika"];
                    echo "<th>" . $row["Data"];
                    echo "<th>" . $row["Wiadomosc"];
                    echo "<th>" . $row["Odpowiedz"];
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";

                echo "<h1>Odpowiedz na wiadomosci</h1>";
                echo "<form action='./php/odpowiedz.php' method='POST' id='odpowiedz'>";
                echo "<input type='number' name='ID' placeholder='ID Wiadomosci' required>";
                echo "<input type='text' name='wiadomosc' placeholder='Odpowiedź' style='height:150px;' required>";
                echo "<button type='submit' form='odpowiedz' class='przyciski'>Wyślij odpowiedź</button>";
                echo "</form>";
            }
        ?>

        <?php
            if (isset($_SESSION['odpowiedz'])) {
                echo $_SESSION['odpowiedz'];
                unset($_SESSION['odpowiedz']);
            }
        ?>
    </div>
    <div id="stopka">
        <h5> Wykonał: Mateusz Prus <br>
        <h5> Prus Bank
    </div>
</body>
</html>