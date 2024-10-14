<?php
session_start();
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload);

   $conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
   mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
           $b =  $object->email;
           $c = $object->password;
          $valid=1;
          $validpsw=1;
          $validempty=1;
          $validemail=1;
          $validpsw2=1;
          $validemail2=1;
          if(empty($b)||empty($c))
          {
            $validempty=0;
            echo "Żadne pole nie może być puste.";
          }

          if (!filter_var($b, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Nie poprawny email";
            $validemail =0;
          }


          $uppercase    = preg_match('@[A-Z]@', $c);
          $lowercase    = preg_match('@[a-z]@', $c);
          $number       = preg_match('@[0-9]@', $c);
  
          if(strlen($c)<8||strlen($c)>20 || !$uppercase || !$lowercase || !$number)
          {
            $validpsw=0;
            echo "Hasło musi mieć długość od 8 do 20 znaków, minimum 1 dużą literę, 1 małą litere i 1 cyfrę.";
          }
          if($_SESSION['password']!=md5($c))
          {
             echo 'Hasło jest błędne';
             $validpsw2=0;
          }
          if($_SESSION['email']==$b)
          {
             echo 'Nie można zmienic emaila na taki sam.';
             $validemail2=0;
          }
         
          if($validempty==0||$validpsw==0||$validemail==0||$validpsw2==0||$validemail2==0)
          {
            $valid=0;
          }
  

  

    




          if($valid==1)
          {
            $q=" UPDATE uzytkownicy SET email ='$b' WHERE id=$_SESSION[id];";
            if(mysqli_query($conn, $q)){
            $_SESSION['email']=$b;
            echo 'Email zmieniony pomyślnie';
            }
          }
           $conn->close();
  
       ?> 
