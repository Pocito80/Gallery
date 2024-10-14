<?php
 session_start();
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload);
$d = $object->login;
$e = $object->password;


$conn = mysqli_connect ('localhost','root','','maciejlecki_4a');
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");

$valid=1;
$validpsw=1;
$validempty=1;
$validlog=1;
if(empty($d)||empty($e))
{
  $validempty=0;
  echo "Żadne pole nie może być puste.";
}

$specialChars = preg_match('@[^\w]@', $d);

if(strlen($d)<8||strlen($d)>16|| $specialChars)
{
  $validlog=0;
  echo "Login musi mieć długość od 8 do 16 znaków i zawierać tlko litery i cyfry.";
} 

$uppercase    = preg_match('@[A-Z]@', $e);
$lowercase    = preg_match('@[a-z]@', $e);
$number       = preg_match('@[0-9]@', $e);

if(strlen($e)<8||strlen($e)>20 || !$uppercase || !$lowercase || !$number)
{
  $validpsw=0;
  echo "Hasło musi mieć długość od 8 do 20 znaków, minimum 1 dużą literę, 1 małą litere i 1 cyfrę.";
}

if($validempty==0||$validlog==0||$validpsw==0)
{
  $valid=0;
}







if($valid==1)
{
$stmt = $conn->prepare("SELECT * FROM uzytkownicy WHERE `login`=?");
$stmt->execute([$d]); 
$stmt->store_result();
$user = $stmt->fetch();

if ($user) {
   $q= mysqli_query ($conn,"SELECT haslo FROM uzytkownicy WHERE login='$d'");
   $pwd = mysqli_fetch_array($q);

    if($pwd[0]==md5($e))
    {
      
        $j= mysqli_query ($conn,"SELECT aktywny FROM uzytkownicy WHERE login='$d'");
        $activ= mysqli_fetch_array($j);
  
        if($activ[0]==0)
        {
            echo 'Konto użytkownika jest zablokowane';
        }
        else
        {

        $q = mysqli_query ($conn, "SELECT * FROM uzytkownicy WHERE login='$d'");
        $data= mysqli_fetch_array($q);
            
         $_SESSION['id']=$data[0];
         $_SESSION['login']=$data[1];
         $_SESSION['password']=$data[2];
         $_SESSION['email']=$data[3];
         $_SESSION['zarejestrowany']=$data[4];
         $_SESSION['uprawnienia']=$data[5];
         $_SESSION['aktywny']=$data[6];
      
            echo 'logowanie pomyślne';


       echo '<meta http-equiv="refresh" content="0;url=index.php">';
   
        }
    }
    else
    {
        echo 'błędne hasło';
    }
} 
else
{
    echo 'błąd logowania: Użytkownik nie istnieje ';
}
}

$conn->close();



 ?>