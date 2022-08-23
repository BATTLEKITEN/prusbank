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
    	$kwota = $_POST['kwota'];

		if(is_null($ID_U)==TRUE or is_null($kwota)==TRUE){
			$_SESSION['zmiensaldo'] = "<br><h4>Wprowadź dane!</h4>";
			header('Location: ../zarzadzajuzytkownikami.php');
		}
		else{
			$sql = "UPDATE rachunki SET Stan_konta = '$kwota' WHERE ID_Uzytkownika = '$ID_U'";
			if(mysqli_query($conn, $sql)){
				$_SESSION['zmiensaldo'] = "<br><h4>Zmieniłeś saldo!</h4>";
				header('Location: ../zarzadzajuzytkownikami.php');
			}
			mysqli_close($conn);
		}
	}
?>