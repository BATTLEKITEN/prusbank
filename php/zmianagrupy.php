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
    	$grupa = $_POST['grupa'];

		if(is_null($ID_U)==TRUE or is_null($grupa)==TRUE){
			$_SESSION['zmianagrupy'] = "<br><h4>Wprowadź dane</h4>";
			header('Location: ../zarzadzajuzytkownikami.php');
		}
		else{
			$sql = "UPDATE uzytkownicy SET Grupa = '$grupa' WHERE ID = '$ID_U'";
			if(mysqli_query($conn, $sql)){
				$_SESSION['zmianagrupy'] = "<br><h4>Zmieniłeś grupe!</h4>";
				header('Location: ../zarzadzajuzytkownikami.php');
			}
			mysqli_close($conn);
		}
	}
?>