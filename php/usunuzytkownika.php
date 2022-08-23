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
	
	$ID_U = $_POST['id_uzytkownika'];
	if(is_null($ID_U)==TRUE){
		$_SESSION['usunuzytkownika'] = "<br><h4>Wybierz ID!</h4>";
		header('Location: ../zarzadzajuzytkownikami.php');
	}
	else{
		$sql = "DELETE FROM uzytkownicy WHERE ID='$ID_U'";
		if(mysqli_query($conn, $sql)){
			$_SESSION['usunuzytkownika'] = "<br><h4>Usunąłeś użytkownika!</h4>";
			header('Location: ../zarzadzajuzytkownikami.php');
		}
			mysqli_close($conn);
		}
	}
?>