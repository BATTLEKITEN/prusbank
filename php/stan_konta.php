<?php
	if ($_SESSION['zalogowany']==false)
	{
		header('Location: ../index.php');
        session_unset();
		exit();
	}
    include './php/server.php';

    $sql = "SELECT * FROM rachunki WHERE ID_Uzytkownika = '" . $_SESSION['id_user'] . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['Stan_konta'] = $row["Stan_konta"];
            $_SESSION['Nr_konta'] = $row["Nr_konta"];
        }
    }
    echo "<p>Twój stan konta wynosi: " . $_SESSION['Stan_konta'] . " zł </p>";
    echo "<p>Twój numer rachunku to: " . $_SESSION['Nr_konta'] . "</p>";

    mysqli_close($conn);
?>
