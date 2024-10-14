<?php
session_start();
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload);

   $conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
   mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");

           $a = $object->passwordDel;
            echo $a;
      
           $valid=1;
          $validpsw1=1;
          $validempty=1;
          $validpsw6=1;
  
          if(empty($a))
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
         if($_SESSION['password']!=md5($a))
         {
            echo 'Hasło jest błędne';
            $validpsw6=0;
         }
  
        
        
          if($validempty==0||$validpsw1==0||$validpsw6==0)
          {
            $valid=0;
          }
  
          if($valid==1)
          {
      
$q="DELETE FROM zdjecia_oceny WHERE id_uzytkownika=$_SESSION[id];";
if(mysqli_query($conn, $q)){
echo "powodzenie";
}
$q="DELETE FROM zdjecia_komentarze WHERE id_uzytkownika=$_SESSION[id];";
if(mysqli_query($conn, $q)){
echo "powodzenie";
}

$idalbumow = array();
$k=0;
$t = mysqli_query ($conn, "SELECT id  FROM `albumy` WHERE id_uzytkownika =$_SESSION[id];");
  while($row9=mysqli_fetch_array($t)){
    array_push($idalbumow,$row9['id']);
    $k=$k+1;
  }

for($j=0;$j<$k;$j++)
{
$idzdjec = array();
  $h=0;
  
  $t = mysqli_query ($conn, "SELECT id  FROM zdjecia WHERE id_album =$idalbumow[$j];");
  while($row4=mysqli_fetch_array($t)){
    array_push($idzdjec,$row4['id']);
    $h=$h+1;
  }

  for($i=0;$i<$h;$i++)
  {

  if (file_exists("phot/$idalbumow[$j]/$idzdjec[$i].png")==TRUE)
  {
    $filename = 'phot/'.$idalbumow[$j].'/'.$idzdjec[$i].'.png';
    $filename2 = 'phot/'.$idalbumow[$j].'/'.$idzdjec[$i].'-min.png';
  }
  else if (file_exists("phot/$idalbumow[$j]/$idzdjec[$i].jpg")==TRUE)
  {
    $filename = 'phot/'.$idalbumow[$j].'/'.$idzdjec[$i].'.jpg';
    $filename2 = 'phot/'.$idalbumow[$j].'/'.$idzdjec[$i].'-min.jpg';
  }
  else if (file_exists("phot/$idalbumow[$j]/$idzdjec[$i].jpeg")==TRUE)
  {
    $filename = 'phot/'.$idalbumow[$j].'/'.$idzdjec[$i].'.jpeg';
    $filename2 = 'phot/'.$idalbumow[$j].'/'.$idzdjec[$i].'-min.jpeg';
  }
  else if (file_exists("phot/$idalbumow[$j]/$idzdjec[$i].gif")==TRUE)
  {
    $filename = 'phot/'.$idalbumow[$j].'/'.$idzdjec[$i].'.gif';
    $filename2 = 'phot/'.$idalbumow[$j].'/'.$idzdjec[$i].'-min.gif';
  }

  if (unlink($filename)) {
    // echo 'The file ' . $filename . ' was deleted successfully!';
  } else {
    // echo 'There was a error deleting the file ' . $filename;
  }
  if (unlink($filename2)) {
    // echo 'The file ' . $filename2 . ' was deleted successfully!';
  } else {
    // echo 'There was a error deleting the file ' . $filename2;
  }


  $q="   DELETE FROM zdjecia WHERE id=$idzdjec[$i];";
  if(mysqli_query($conn, $q)){
  // echo "powodzenie";
  }
  $q=" DELETE FROM zdjecia_komentarze WHERE id_zdjecia=$idzdjec[$i];";
  if(mysqli_query($conn, $q)){
  // echo "powodzenie";
  }
  $q="  DELETE FROM zdjecia_oceny WHERE id_zdjecia=$idzdjec[$i];";
  if(mysqli_query($conn, $q)){
  // echo "powodzenie";
  }



}
$dirname = 'phot/'.$idalbumow[$j];
if (rmdir($dirname)) {
  // echo 'The file ' . $dirname . ' was deleted successfully!';
} else {
  // echo 'There was a error deleting the file ' . $dirname;
}

$q="  DELETE FROM albumy WHERE id=$idalbumow[$j];";
if(mysqli_query($conn, $q)){
// echo "powodzenie";
}
}
$q="DELETE FROM uzytkownicy WHERE id=$_SESSION[id];";
if(mysqli_query($conn, $q)){
echo "powodzenie";
session_unset();
session_destroy();
echo '<meta http-equiv="refresh" content="0;url=index.php">';
}




          }
           $conn->close();
  
       ?> 
