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
        <h1>Historia przelewów</h1>
        <?php
            include './php/server.php';
            
            $Nr_konta = $_SESSION['Nr_konta'];

            $sql = "SELECT * from historia_przelewow";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                echo "<h2>Brak pożyczek!</h2>";
            } else {
                echo "<div id='tabelka'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Od nr</th>";
                echo "<th>Do nr</th>";
                echo "<th>Kwota</th>";
                echo "<th>Data</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<th>" . $row["ID"];
                    echo "<th>" . $row["Nr_OD"];
                    echo "<th>" . $row["Nr_DO"];
                    echo "<th>" . $row["Kwota"];
                    echo "<th>" . $row["Data"];
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