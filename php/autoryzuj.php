<?php
	session_start();

    include './server.php';

	$ID = $_POST['id'];
    $stan_konta = $_SESSION['Stan_konta'];
    $kwota = $_SESSION['kwota'];
    $nr_firmy = $_SESSION['konto_firmowe'];
    $nr_uzytkownika = $_SESSION['Nr_konta'];
    $data = date("Y-m-d H:i:s");

	if(is_null($ID)==TRUE){
		$_SESSION['autoryzacja'] = "<br><h4>Wpisz ID autoryzacji!</h4>";
		header('Location: ../pozyczki.php');
	}
	else{
        if($stan_konta < $kwota){
            $_SESSION['autoryzacja'] = "<br><h4>Za mało środków na koncie</h4>";
            header('Location: ../autoryzacja.php');
            unset($_SESSION['kwota']);
        }
        else{
            $sql = "UPDATE autoryzacje SET Active = 0 WHERE ID = $ID";
		    if (mysqli_query($conn, $sql)) {
		    	$_SESSION['autoryzacja'] = "<br><h4>Zautoryzowałeś przelew!</h4>";
                $sql = "UPDATE rachunki SET Stan_konta = Stan_konta + $kwota WHERE Nr_konta = $nr_firmy";
                $sql1 = "UPDATE rachunki SET Stan_konta = Stan_konta - $kwota WHERE Nr_konta = $nr_uzytkownika";
                $sql2 = "INSERT INTO historia_przelewow (NR_OD,NR_DO,Kwota,Data) VALUES ('$nr_uzytkownika','$nr_firmy','$kwota','$data')";
                mysqli_query($conn, $sql);
                mysqli_query($conn, $sql1);
                mysqli_query($conn, $sql2);
                unset($_SESSION['kwota']);
                unset($_SESSION['konto_firmowe']);
                header('Location: ../autoryzacja.php');
		    }
		    mysqli_close($conn);
        }
	}
?>