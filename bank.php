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
            <a href="" id='home'><img src="./img/logomenu.png"></a>
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
        <h1>Witaj na naszej stronie!<br>
            U nas Twoje pieniądzę są bezpieczne! <br>
            Skorzystaj z menu, które jest w prawym górnym rogu </h1>
            <br>
            <h1>Twój kod BLIK:</h1><br>
            <?php
                $blik1 = rand(100,1000);
                $blik2 = rand(100,1000);
                echo "<h2>". $blik1 . " " . $blik2 . "</h2>";
            ?>
    </div>
    <div id="stopka">
        <h5> Wykonał: Mateusz Prus <br>
        <h5> Prus Bank
    </div>
</body>
</html>