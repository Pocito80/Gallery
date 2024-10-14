<?php
session_start();
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload);

   $conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
   mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");

           $a = $object->passwordold;
           $b = $object->passwordnew;
           $c = $object->passwordcon;
          $valid=1;
          $validpsw1=1;
          $validpsw2=1;
          $validpsw3=1;
          $validpsw4=1;
          $validempty=1;
          $validpsw5=1;
          $validpsw6=1;
          if(empty($a)||empty($b)||empty($c))
          {
            $validempty=0;
            echo "Żadne pole nie może być puste.";
          }
          $uppercase    = preg_match('@[A-Z]@', $a);
          $lowercase    = preg_match('@[a-z]@', $a);
          $number       = preg_match('@[0-9]@', $a);
          if(strlen($a)<8||strlen($a)>20 || !$uppercase || !$lowercase || !$number)
          {
            $validpsw1=0;
            echo "Hasło musi mieć długość od 8 do 20 znaków, minimum 1 dużą literę, 1 małą litere i 1 cyfrę.";
          }
          $uppercase    = preg_match('@[A-Z]@', $b);
          $lowercase    = preg_match('@[a-z]@', $b);
          $number       = preg_match('@[0-9]@', $b);
          if(strlen($b)<8||strlen($b)>20 || !$uppercase || !$lowercase || !$number)
          {
            $validpsw2=0;
            echo "Hasło musi mieć długość od 8 do 20 znaków, minimum 1 dużą literę, 1 małą litere i 1 cyfrę.";
          }
          $uppercase    = preg_match('@[A-Z]@', $c);
          $lowercase    = preg_match('@[a-z]@', $c);
          $number       = preg_match('@[0-9]@', $c);
          if(strlen($c)<8||strlen($c)>20 || !$uppercase || !$lowercase || !$number)
          {
            $validpsw3=0;
            echo "Hasło musi mieć długość od 8 do 20 znaków, minimum 1 dużą literę, 1 małą litere i 1 cyfrę.";
          }
         if($b!=$c)
         {
            $validpsw4=0;
            echo "Hasła nie są takie same.";
         }
         if($a==$b)
         {
            $validpsw5=0;
            echo "Nowe hasło musi być inne niż stare.";
         }
         if($_SESSION['password']!=md5($a))
         {
            echo 'Hasło jest błędne';
            $validpsw6=0;
         }
         if($a==$b)
         {
            $validpsw5=0;
            echo "Nowe hasło musi być inne niż stare.";
         }
        
        
          if($validempty==0||$validpsw1==0||$validpsw2==0||$validpsw3==0||$validpsw4==0||$validpsw5==0||$validpsw6==0)
          {
            $valid=0;
          }
  
          if($valid==1)
          {
            $q=" UPDATE uzytkownicy SET haslo = MD5('$b') WHERE id=$_SESSION[id];";
            if(mysqli_query($conn, $q)){
            $_SESSION['password']=md5($b);
            echo 'Hasło zmieniono pomyślnie';
            }
          }
           $conn->close();
  
       ?> 
