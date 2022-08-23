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
        <h1>Przelej pieniądze użytkownikowi!</h1><br>
        <h2>Musisz znać jego numer konta!</h2>
        <form action="./php/przelej.php" method="POST" id="przelej">
            <input type="number" name="kwota" placeholder="Kwota" min="1" required>
            <input type="number" name="nr_osoby" placeholder="Numer konta osoby" required>
            <?php
                $_SESSION['kod'] = $nr_konta = rand(1, 1000);
                echo "<h2>Kod zabezpieczający: " . $_SESSION['kod'] . "</h2>";
            ?>
            <input type="number" name="kod" placeholder="Kod zabezpieczający" required>
            <button type="submit" form="przelej" class="przyciski">Przelej pieniądze</button>
        </form>
        <?php
        if (isset($_SESSION['przelew'])) {
            echo $_SESSION['przelew'];
            unset($_SESSION['przelew']);
        }
        ?>

        <?php
            include './php/server.php';
            
            $Nr_konta = $_SESSION['Nr_konta'];

            $sql = "SELECT * from historia_przelewow WHERE Nr_OD = $Nr_konta or Nr_DO = $Nr_konta;";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                echo "<br>";
                echo "<h2>Brak histori przelewów!</h2>";
            } else {
                echo "<br>";
                echo "<br>";
                echo "<h1>Ostatnie przelewy</h1>";
                echo "<div id='tabelka'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>Od</th>";
                echo "<th>Do</th>";
                echo "<th>Kwota</th>";
                echo "<th>Data</th>";
                echo "</tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
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