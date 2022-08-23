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

		$kwota = $_POST['kwota'];
		$nr_konta = $_POST['nr_rachunku'];
		$data = date("Y-m-d H:i:s");
		$ID_Uzytkownika = $_SESSION['id_user'];
		if(is_null($kwota)==TRUE or is_null($nr_konta)==TRUE){
			$_SESSION['pozyczka'] = "<br><h4>Wprowadź dane!</h4>";
			header('Location: ../pozyczka.php');
		}
		else{
			if ($nr_konta == $_SESSION['nr_konta']) {
				$sql = "INSERT INTO pozyczki (ID_Uzytkownika,Kwota,Data) VALUES ('$ID_Uzytkownika','$kwota','$data')";
				$sql1 = "UPDATE rachunki SET Stan_konta = Stan_konta + $kwota WHERE ID_Uzytkownika = $ID_Uzytkownika";
				if (mysqli_query($conn, $sql)) {
					mysqli_query($conn, $sql1);
					mysqli_close($conn);
					$_SESSION['pozyczka'] = "<br><h4>Wziąłeś pożyczkę</h4>";
					header('Location: ../pozyczka.php');
				}
			} 
			else {
				$_SESSION['pozyczka'] = "<br><h4>Źle przepisany numer konta</h4>";
				header('Location: ../pozyczka.php');
			}
		}
	}
?>