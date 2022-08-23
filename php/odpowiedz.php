<?php
	session_start();
	if ($_SESSION['zalogowany']==false OR $_SESSION['grupa']=="Uzytkownik")
	{
		header('Location: ../index.php');
		session_unset();
		exit();
	}
	else{
		$ID = $_POST['ID'];
		$wiadomosc = $_POST['wiadomosc'];
		
		if(is_null($ID)==TRUE or is_null($wiadomosc)==TRUE){
			$_SESSION['odpowiedz'] = "<br><h4>Wprowadź dane!</h4>";
			header('Location: ../wiadomosci.php');
		}
			include './server.php';

			$sql = "UPDATE wiadomosci SET odpowiedz = '$wiadomosc' WHERE ID=$ID";
			if (mysqli_query($conn, $sql)) {
				$_SESSION['odpowiedz'] = "<br><h4>Odpowiedziałeś na wiadomość!</h4>";
				header('Location: ../wiadomosci.php');
			}
			mysqli_close($conn);
		}
?>