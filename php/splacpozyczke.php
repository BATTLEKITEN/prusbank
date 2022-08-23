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
		
		$ID_Pozyczki = $_POST['id_pozyczki'];
		$ID_Uzytkownika = $_SESSION['id_user'];

		if(is_null($ID_Pozyczki)==TRUE){
			$_SESSION['splata'] = "<br><h4>Wybierz ID!</h4>";
			header('Location: ../spozyczka.php');
		}
		else{
			$sql1 = "UPDATE rachunki INNER JOIN pozyczki SET rachunki.Stan_konta = rachunki.Stan_konta - pozyczki.Kwota*1.1 WHERE rachunki.ID_Uzytkownika = $ID_Uzytkownika AND pozyczki.ID = $ID_Pozyczki";
			$sql2 = "DELETE FROM pozyczki WHERE ID='$ID_Pozyczki' AND ID_Uzytkownika='" . $_SESSION['id_user'] . "'";

			if (mysqli_query($conn, $sql1)) {
				mysqli_query($conn, $sql2);
				$_SESSION['splata'] = "<br><h4>Spłaciłeś pożyczkę!</h4>";
				header('Location: ../spozyczka.php');
			}
			mysqli_close($conn);
		}
	}
?>
