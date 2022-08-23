<?php
    header('Access-Control-Allow-Origin: *');
    $konto_firmowe = $_POST['konto_firmowe'];
    $kont_uzytkownika = $_POST['konto_uzytkownika'];
    $kwota = $_POST['kwota'];
    $nazwa_firmy = $_POST['nazwa_firmy'];
    $tytul = $_POST['tytul'];
    $user_data = $_POST['user_data'];

    include './php/server.php';

    $data = date("Y-m-d H:i:s");

    $sql = "INSERT INTO autoryzacje (Konto_firmowe,Konto_uzytkownika,Kwota,Data,Active,User_data,Nazwa_firmy,Tytul) VALUES ($konto_firmowe,$kont_uzytkownika,$kwota,'$data',1,'$user_data','$nazwa_firmy','$tytul')";
    mysqli_query($conn, $sql);

    //$nazwa = $_POST['powrot'];
    //header("Location: $nazwa");
    $potw = false;

    for($i = 0; $i < 30; $i++){
        $sql = "SELECT * FROM autoryzacje WHERE data = '$data' AND Active = 0";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $potw=true;
            break;
        }
        sleep(3); // 3 sekundy
     }

    if ($potw) {
        $sql = "UPDATE autoryzacje SET Active = 2 WHERE Data = '$data'";
        mysqli_query($conn, $sql);
        echo "tak";
    }
    else{
        $sql = "UPDATE autoryzacje SET Active = 3 WHERE Data = '$data'";
        mysqli_query($conn, $sql);  
        echo "nie";
    }

?>