<?php

$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload);

   $conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
   mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
           $a = $object->login;
           $b =  $object->email;
           $c = $object->password;
          $valid=1;
          $validpsw=1;
          $validempty=1;
          $validlog=1;
          $validemail=1;
          if(empty($a)||empty($b)||empty($c))
          {
            $validempty=0;
            echo "Żadne pole nie może być puste.";
          }

          if (!filter_var($b, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Nie poprawny email";
            $validemail =0;
          }

          $specialChars = preg_match('@[^\w]@', $a);

          if(strlen($a)<8||strlen($a)>16|| $specialChars)
          {
            $validlog=0;
            echo "Login musi mieć długość od 8 do 16 znaków i zawierać tlko litery i cyfry.";
          } 

          $uppercase    = preg_match('@[A-Z]@', $c);
          $lowercase    = preg_match('@[a-z]@', $c);
          $number       = preg_match('@[0-9]@', $c);
  
          if(strlen($c)<8||strlen($c)>20 || !$uppercase || !$lowercase || !$number)
          {
            $validpsw=0;
            echo "Hasło musi mieć długość od 8 do 20 znaków, minimum 1 dużą literę, 1 małą litere i 1 cyfrę.";
          }
         
          if($validempty==0||$validlog==0||$validpsw==0||$validemail==0)
          {
            $valid=0;
          }
  

  

    




          if($valid==1)
          {
           $stmt = $conn->prepare("SELECT * FROM uzytkownicy WHERE `login`=?");
           $stmt->execute([$a]); 
           $stmt->store_result();
           $user = $stmt->fetch();
           if ($user) {
        
         echo 'błąd rejestracji: login jest już zajęty';
           } 
           else
           {
               $q="INSERT INTO uzytkownicy (`login`,`haslo`,`email`) VALUES ('$a',MD5('$c'),'$b')";
              if(mysqli_query($conn, $q)){
                session_start();

                $q = mysqli_query ($conn, "SELECT id,zajerestrowany,uprawnienia,aktywny FROM uzytkownicy WHERE login='$a'");
                $data= mysqli_fetch_array($q);
             $_SESSION['id']=$data[0];
             $_SESSION['login']=$a;
             $_SESSION['password']=md5($c);
             $_SESSION['email']=$b;
             $_SESSION['zarejestrowany']=$data[1];
             $_SESSION['uprawnienia']=$data[2];
             $_SESSION['aktywny']=$data[3];
       
echo '<meta http-equiv="refresh" content="0;url=rejestracja-ok.php">';
echo "rejestracja pomyślna";
             } 
             else{
                 echo "Rejestracja nie powiodłą się proszę spróbować ponownie";
             }  
           } 
          }
           $conn->close();
  
       ?> 
