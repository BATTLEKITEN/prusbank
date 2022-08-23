<?php
    session_start();
    if ($_SESSION['zalogowany']==false)
	{
		header('Location: ../index.php');
        session_unset();
		exit();
	}
    else{
        include './server.php';

        $kwota = $_POST['kwota'];
        $nr_osoby = $_POST['nr_osoby'];
        $kod = $_POST['kod'];
        $ID_Uzytkownika = $_SESSION['id_user'];
        $nr_konta = $_SESSION['Nr_konta'];
        $data = date("Y-m-d H:i:s");

        if(is_null($kwota)==TRUE OR is_null($nr_osoby)==TRUE OR is_null($kod)==TRUE){
            $_SESSION['przelew'] = "<br><h4>Wprowadź dane!</h4>";
            header('Location: ../przelew.php');
        }
        else{
            if ($kod == $_SESSION['kod']) {
                if ($nr_osoby == $nr_konta) {
                    $_SESSION['przelew'] = "<h3>Nie możesz samemu sobie wysłać pieniędzy</h3>";
                    header('Location: ../przelew.php');
                } else {
                    if ($_SESSION['Stan_konta'] <= 0 or $_SESSION['Stan_konta'] < $kwota) {
                        $_SESSION['przelew'] = "<h3>Za mało pieniędzy na koncie</h3>";
                        header('Location: ../przelew.php');
                    } else {
                        $sql = "UPDATE rachunki SET Stan_konta = Stan_konta + $kwota WHERE Nr_konta = $nr_osoby";
                        $sql1 = "UPDATE rachunki SET Stan_konta = Stan_konta - $kwota WHERE ID_Uzytkownika = $ID_Uzytkownika";
                        $sql2 = "INSERT INTO historia_przelewow (NR_OD,NR_DO,Kwota,Data) VALUES ('$nr_konta','$nr_osoby','$kwota','$data')";
                        if (mysqli_query($conn, $sql)) {
                            mysqli_query($conn, $sql1);
                            mysqli_query($conn, $sql2);
                            $_SESSION['przelew'] = "<br><h4>Przelałeś pieniądze</h4>";
                            header('Location: ../przelew.php');
                        }
                    }
                }
            } else {
                $_SESSION['przelew'] = "<h4>Źle przepisany numer zabezpieczający</h4>";
                header('Location: ../przelew.php');
            }
            mysqli_close($conn);
        }
    }
?>