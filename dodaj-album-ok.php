<?php
    
 session_start();
    $requestPayload = file_get_contents("php://input");
    $object = json_decode($requestPayload);
    $d = $object->album;
    $i = $_SESSION['id'];
    $conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
    mysqli_query($conn, 'SET CHARACTER SET utf8');
 mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
 $tekst= mysqli_real_escape_string($conn, $d);

 $q = "INSERT INTO albumy(`tytul`,`id_uzytkownika`) VALUES ('$tekst','$_SESSION[id]')";
 if(mysqli_query($conn, $q))
 {
   $q= mysqli_insert_id($conn); 
    mkdir("phot/$q");
    echo "udało się";
    echo '<meta http-equiv="refresh" content="0;url=dodaj-foto.php">';
 }
else
{
echo "nie udało się";
}
$conn->close();
    ?>