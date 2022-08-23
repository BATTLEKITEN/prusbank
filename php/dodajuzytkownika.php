<?php
    session_start();
    if ($_SESSION['zalogowany']==false OR $_SESSION['grupa']=="Uzytkownik" OR $_SESSION['grupa']=="Pracownik")
	{
		header('Location: ../index.php');
        session_unset();
		exit();
	}
    else{
        include './server.php';
        
        $login = $_POST['login'];
        $pass = $_POST['haslo'];
        $haslo = md5($pass);
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $nr_konta = rand(1, 10000000);
        $grupa = $_POST['grupa'];
        
        if (is_null($login) == TRUE or is_null($haslo) == TRUE or is_null($imie) == TRUE or is_null($nazwisko) == TRUE or is_null($grupa) == TRUE) {
            $_SESSION['dodajuzytkownika'] = "<br><h4>Wprowadź dane!</h4>";
            header('Location: ../zarzadzajuzytkownikami.php');
        } 
        else {
            $sql = "INSERT INTO uzytkownicy (Login,Haslo,Imie,Nazwisko,Nr_konta,Grupa) VALUES ('$login','$haslo','$imie','$nazwisko',$nr_konta,'$grupa');";
            $sql1 = "INSERT INTO rachunki (Nr_konta, Stan_konta) VALUE ('$nr_konta',0);";
                mysqli_query($conn, $sql);
                mysqli_query($conn, $sql1);
                $_SESSION['dodajuzytkownika'] = "<br><h4>Dodałeś użytkownika!</h4>";
                header('Location: ../zarzadzajuzytkownikami.php');
	    	mysqli_close($conn);
        }
    }
?>