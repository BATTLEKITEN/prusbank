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
        <?php
            include './php/server.php';
            
            $konto_uzytkownika = $_SESSION['Nr_konta'];

            $sql = "SELECT * from autoryzacje WHERE Konto_uzytkownika = $konto_uzytkownika AND Active = 1";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                echo "<h2>Brak autoryzacji!</h2>";
            } else {
                echo "<h1>Autoryzacje</h1>";
                echo "<div id='tabelka'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>ID Autoryzacji</th>";
                echo "<th>Firma</th>";
                echo "<th>Tytuł</th>";
                echo "<th>Kwota</th>";
                echo "<th>Data</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<th>" . $row["ID"];
                    echo "<th>" . $row["Nazwa_firmy"];
                    $_SESSION['kwota'] = $row["Kwota"];
                    $_SESSION['konto_firmowe'] = $row["Konto_firmowe"];
                    echo "<th>" . $row["Tytul"];
                    echo "<th>" . $row["Kwota"];
                    echo "<th>" . $row["Data"];
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
                echo "<br>";
                echo "<h2>Wybierz </h2>";
                echo "<form action='./php/autoryzuj.php' method='POST' id='autoryzuj'>";
                echo "<input type='text' name='id' placeholder='ID Autoryzacji' required>";
                echo  "<button type='submit' form='autoryzuj' class='przyciski'>Autoryzuj</button>";
                echo "</form>";
            }
            if (isset($_SESSION['autoryzacja'])){
                echo $_SESSION['autoryzacja'];
                unset($_SESSION['autoryzacja']);
            }
        ?>
        
    </div>
    <div id="stopka">
        <h5> Wykonał: Mateusz Prus <br>
        <h5> Prus Bank
    </div>
</body>
</html>