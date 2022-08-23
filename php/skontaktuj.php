<?php
	session_start();
	if ($_SESSION['zalogowany']==false)
	{
		header('Location: ../index.php');
        session_unset();
		exit();
	}
	
	include './server.php';

	$data = date("Y-m-d H:i:s");
	$ID_Uzytkownika = $_SESSION['id_user'];
	$wiadomosc = $_POST['wiadomosc'];

	if(is_null($ID_Uzytkownika)==TRUE or is_null($wiadomosc)==TRUE){
		$_SESSION['kontakt'] = "<br><h4>Wprowadź dane!</h4>";
		header('Location: ../kontakt.php');
	}
	else{
		$sql = "INSERT INTO wiadomosci (ID_Uzytkownika,Data,Wiadomosc,Odpowiedz) VALUES ('$ID_Uzytkownika','$data','$wiadomosc','')";
		if (mysqli_query($conn, $sql)) {
			$_SESSION['kontakt'] = "<br><h4>Dziękujemy!</h4>";
			header('Location: ../kontakt.php');
		}
		mysqli_close($conn);
	}
?>
