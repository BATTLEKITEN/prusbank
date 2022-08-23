<?php
	session_start();
	if ($_SESSION['zalogowany']==false OR $_SESSION['grupa']=="Uzytkownik")
	{
		header('Location: ../index.php');
		session_unset();
		exit();
	}
	
	include './server.php';

	$ID_Pozyczki = $_POST['id'];
	if(is_null($ID_Pozyczki)==TRUE){
		$_SESSION['splata'] = "<br><h4>Wprowadź dane!</h4>";
		header('Location: ../pozyczki.php');
	}
	else{
		$sql1 = "UPDATE rachunki INNER JOIN pozyczki ON rachunki.ID_Uzytkownika = pozyczki.ID_Uzytkownika SET rachunki.Stan_konta = rachunki.Stan_konta - pozyczki.Kwota*1.1 WHERE pozyczki.ID = $ID_Pozyczki AND rachunki.ID_Uzytkownika = pozyczki.ID_Uzytkownika";
		$sql2 = "DELETE FROM pozyczki WHERE ID=$ID_Pozyczki";

		if (mysqli_query($conn, $sql1)) {
			mysqli_query($conn, $sql2);
			$_SESSION['splata'] = "<br><h4>Spłaciłeś pożyczkę!</h4>";
			header('Location: ../pozyczki.php');
		}
		mysqli_close($conn);
	}
?>