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
    	$login = $_POST['login'];

		if(is_null($ID_U)==TRUE OR is_null($login)==TRUE){
			$_SESSION['zmianalogin'] = "<br><h4>Zmieniłeś login!</h4>";
			header('Location: ../zarzadzajuzytkownikami.php');
		}
		else{
			$sql = "UPDATE uzytkownicy SET Login = '$login' WHERE ID = '$ID_U'";
			if(mysqli_query($conn, $sql)){
				$_SESSION['zmianalogin'] = "<br><h4>Zmieniłeś login!</h4>";
				header('Location: ../zarzadzajuzytkownikami.php');
			}
			mysqli_close($conn);
		}
	}
?>