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
    	$pass = $_POST['pass'];
		$haslo = md5($pass);

		if(is_null($ID_U)==TRUE OR is_null($pass)==TRUE){
			$_SESSION['zmianahasla'] = "<br><h4>Wprowadź dane!</h4>";
			header('Location: ../zarzadzajuzytkownikami.php');
		}
		else{
			$sql = "UPDATE uzytkownicy SET Haslo = '$haslo' WHERE ID = '$ID_U'";
			if(mysqli_query($conn, $sql)){
				$_SESSION['zmianahasla'] = "<br><h4>Zmieniłeś haslo!</h4>";
				header('Location: ../zarzadzajuzytkownikami.php');
			}
			mysqli_close($conn);
		}	
	}
?>