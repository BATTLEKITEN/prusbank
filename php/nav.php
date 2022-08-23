<?php
    if ($_SESSION['grupa'] == "Administrator") {
        include "./php/navadmin.php";
    } elseif ($_SESSION['grupa'] == "Pracownik") {
        include "./php/navpracownik.php";
    } else {
        include "./php/navuzytkownik.php";
    }
?>