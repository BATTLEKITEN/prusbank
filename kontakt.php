<?php
    session_start();
    if ($_SESSION['zalogowany']==false)
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
        <h1>Skontaktuj się z nami!</h1>
        <form action="./php/skontaktuj.php" method="POST" id="skontaktuj">
            <input type="text" name="wiadomosc" placeholder="Wiadomość" style="height:150px;" required>
            <button type="submit" form="skontaktuj" class="przyciski">Wyślij wiadomość</button>
        </form>
        <?php
            if (isset($_SESSION['kontakt'])) {
                echo $_SESSION['kontakt'];
                unset($_SESSION['kontakt']);
            }
            ?>

            <?php
                include './php/server.php';
                
                $ID_Uzytkownika = $_SESSION['id_user'];
                $sql = "SELECT * from wiadomosci WHERE ID_Uzytkownika = $ID_Uzytkownika";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) == 0) {
                    echo "<br>";
                    echo "<h2>Brak wiadomości!</h2>";
                } else {
                    echo "<br>";
                    echo "<h1>Twoje wiadomości</h1>";
                    echo "<div id='tabelka'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>ID Wiadomości</th>";
                    echo "<th>Data</th>";
                    echo "<th>Wiadomosc</th>";
                    echo "<th>Odpowiedz</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<th>" . $row["ID"];
                        echo "<th>" . $row["Data"];
                        echo "<th>" . $row["Wiadomosc"];
                        echo "<th>" . $row["Odpowiedz"];
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                }
            ?>
    </div>
    <div id="stopka">
        <h5> Wykonał: Mateusz Prus <br>
        <h5> Prus Bank
    </div>
</body>
</html>