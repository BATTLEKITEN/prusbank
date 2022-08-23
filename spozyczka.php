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
        <?php
            include './php/server.php';

            $sql = "SELECT * from pozyczki Where ID_Uzytkownika =" . $_SESSION['id_user'];
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                echo "<h2>Nie masz żadnych zadłużeń!</h2>";
            } else {
                echo "<h1>Twoje pożyczki</h1>";
                echo "<div id='tabelka'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Kwota</th>";
                echo "<th>Data</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<th>" . $row["ID"];
                    echo "<th>" . $row["Kwota"];
                    echo "<th>" . $row["Data"];
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
                echo "<br> <h2>Wybierz, którą pożyczkę chcesz spłacić całkowicie +10%</h2>";

                $sql1 = "SELECT * from pozyczki Where ID_Uzytkownika =" . $_SESSION['id_user'];
                $result = mysqli_query($conn, $sql1);
                echo "<form action='./php/splacpozyczke.php' method='POST' id='splacpozyczke'>";

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<input type='radio' required name='id_pozyczki' value='" . $row['ID'] . "'>" . "ID: " . $row['ID'] . " , Kwota: " . $row["Kwota"] . "</option><br>";
                    }
                }
                echo "<button type='submit' form='splacpozyczke' id='przycisk'>Spłać pożyczkę</button>";
                echo "</form>";
            }
            mysqli_close($conn);
            echo "<br>";
            
            if (isset($_SESSION['splata'])) {
                echo $_SESSION['splata'];
                unset($_SESSION['splata']);
            }
        ?>
    </div>
    <div id="stopka">
        <h5> Wykonał: Mateusz Prus <br>
        <h5> Prus Bank
    </div>
</body>
</html>