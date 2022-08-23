<?php
    session_start();
    if ($_SESSION['zalogowany']==true)
	{
		header('Location: ../index.php');
        session_unset();
		exit();
	}
    include './server.php';

    $_SESSION['zalogowany'] = false;
    $login = $_POST['login'];
    $pass = $_POST['haslo'];
    $haslo = hash("sha256", $pass);
    $data = date("Y-m-d H:i:s");
    if (is_null($login) == TRUE or is_null($pass) == TRUE) {
        $_SESSION['powiadomienie_login'] = "<br><h5>Wpisz login i hasło!</h5>";
        header('Location: ../index.php');
    } else {

        $sql = "SELECT * from uzytkownicy Where Login = '$login' AND Haslo = '$haslo'";

        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['zalogowany'] = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['id_user'] = $row["ID"];
                $_SESSION['login'] = $row['Login'];
                $_SESSION['grupa'] = $row['Grupa'];
                $_SESSION['imie'] = $row['Imie'];
                $_SESSION['nazwisko'] = $row['Nazwisko'];
                $_SESSION['nr_konta'] = $row['Nr_konta'];
            }
            $id = $_SESSION['id_user'];
            $nr_konta = $_SESSION['nr_konta'];
            $sql1 = "UPDATE rachunki INNER JOIN uzytkownicy ON rachunki.Nr_konta=uzytkownicy.Nr_konta SET ID_Uzytkownika = '$id' WHERE rachunki.Nr_konta = '$nr_konta'";
            $sql2 = "UPDATE uzytkownicy SET Ostatnie_logowanie = '$data' WHERE ID = '$id'";
            mysqli_query($conn, $sql1);
            mysqli_query($conn, $sql2);
            header('Location: ../bank.php');
        } else {
            $_SESSION['powiadomienie_login'] = "<br><h5>Nieprawidłowy login lub hasło!</h5>";
            header('Location: ../index.php');
        }
        mysqli_close($conn);
    }
?>