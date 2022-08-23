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
        <h1>Weź pożyczę! Spłacasz tyle ile pożyczyłeś +10%</h1>
        <br>
        <form action="./php/wezpozyczke.php" method="POST" id="wezpozyczke">
            <input type="number" name="kwota" placeholder="Kwota" min="1" required>
            <input type="password" name="nr_rachunku" placeholder="Twój numer rachunku" required>
            <button type="submit" form="wezpozyczke" class="przyciski">Weź pożyczkę</button>
        </form>
        <?php
            if (isset($_SESSION['pozyczka'])) {
                echo $_SESSION['pozyczka'];
                unset($_SESSION['pozyczka']);
            }
        ?>
    </div>
    <div id="stopka">
        <h5> Wykonał: Mateusz Prus <br>
        <h5> Prus Bank
    </div>
</body>
</html>