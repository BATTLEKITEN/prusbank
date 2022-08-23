<?php
    session_start();
    if ($_SESSION['zalogowany']==true)
	{
		header('Location: ../index.php');
        session_unset();
		exit();
	}
    include './server.php';

    $login = $_POST['login'];
    $pass = $_POST['haslo'];
    $haslo = hash("sha256", $pass);
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $nr_konta = rand(1, 10000000);
    $ostatnie_logowanie = date("Y-m-d H:i:s");
    $wszystko_ok = true;

    //Sprawdzenie czy podane dane do rejestracji są wpisane w formularzu
    //Jeśli nie wyskakuje komunikat o tym że trzeba podać dane do rejestracji
    //I dalsza część kodu się nie uruchomi, ponieważ zmienna $wszystko_ok
    //zmienia się na wartość false
    if (is_null($login) == True or is_null($haslo) == True or is_null($imie) == True or is_null($nazwisko) == True) {
        $wszystko_ok = false;
        $_SESSION['powiadomienie_rej'] = "<br><h4>Podaj potrzebne dane do rejestracji!</h4>";
        header('Location: ../index.php');
    } else {
        if (strlen($pass) < 6) {
            $_SESSION['powiadomienie_rej'] = "<br><h4>Haslo musi mieć więcej niż 6 znaków!</h4>";
            header('Location: ../index.php');
        } else {
            //Sprawdzamy czy dany użytkownik z danym loginem już istnieje
            $sprlogin = "SELECT Login from uzytkownicy WHERE Login = '$login'";
            $result1 = mysqli_query($conn, $sprlogin);

            if (mysqli_num_rows($result1) > 0) {
                $_SESSION['powiadomienie_rej'] = "<br><h4>Użytkownik już istnieje</h4>";
                header('Location: ../index.php');
            } else {
                $sql = "INSERT INTO uzytkownicy (Login,Haslo,Imie,Nazwisko,Nr_konta,Ostatnie_logowanie,Grupa) VALUES ('$login','$haslo','$imie','$nazwisko','$nr_konta','$ostatnie_logowanie','Uzytkownik')";
                $sql1 = "INSERT INTO rachunki (Nr_konta, Stan_konta) VALUE ('$nr_konta',0);";

                //Jeśli wszystko jest poprawne to zostanie dodany użytkownik do tabeli użytkownicy oraz jego rachunek zostanie ustawiony na 0
                if (mysqli_query($conn, $sql)) {
                    if (mysqli_query($conn, $sql1)) {
                        $_SESSION['powiadomienie_rej'] = "<br><h4>Zarejestrowałeś się! Aby aktywować konto zaloguj się!</h4>";
                        header('Location: ../index.php');
                    }
                }
            }
        }
    }
    mysqli_close($conn);
?>
