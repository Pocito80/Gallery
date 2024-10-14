<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Rejestracja OK</title>
    <link rel="stylesheet" href="Style/style.css" type="text/css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"
    />
    <script
      src="https://kit.fontawesome.com/92b04f16d6.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
  <div class="container is-max-desktop mt-6">
    <div class="box has-background-primary has-text-centered">



<?php


session_start();
$_SESSION['aid']=$_POST["t"];
if(isset($_POST["submit"])) {
 
if($_FILES["fileToUpload"]["name"]=="")
  {
    echo ' <p class="title is-1 has-text-primary-light ">Nie wybrano pliku </p>';

 
  }
  else
  {
    $conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
    mysqli_query($conn, 'SET CHARACTER SET utf8');
    mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
    
$o = mysqli_real_escape_string($conn, $_POST["opis"]);
$a=$_POST["aid"];




$target_dir = "phot/".$a."/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
   
    $uploadOk = 1;
  } else {
    
    $uploadOk = 0;
  }
}




if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {


 echo'<p class="title is-1 has-text-primary-light ">Plik musi być w formacie JPG, JPEG, PNG, GIF </p>';
    
  $uploadOk = 0;
}









if ($uploadOk == 0) {
  echo'<p class="title is-1 has-text-primary-light ">Twój plik nie został przesłany</p>';

} else {

  $q="INSERT INTO zdjecia (`opis`,`id_album`,`zaakceptowane`) VALUES ('$o','$a',0)";
  if(mysqli_query($conn, $q)){
    $zid= mysqli_insert_id($conn);
  }
  $file = ($_FILES["fileToUpload"]["tmp_name"]);
$img_size_array = getimagesize($file);
$cont=0;

if($img_size_array[0]>1200||$img_size_array[1]>1200)
{
  $cont=1;
  if($img_size_array[0]>$img_size_array[1])
  {
    $wd=1200;
    $hd=-1;
  
  }
  if($img_size_array[1]>$img_size_array[0])
  {
    $wd=-1;
    $hd=1200;
   
  }
}

  $target_file = $target_dir . $zid .".". $imageFileType ;
  if($cont==0)
  {
  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
  }
  else
  {

    if($imageFileType=="png")
    {
      $image = imagecreatefrompng($file); 
      $img = imagescale( $image, $wd, $hd );
        imagepng($img,"phot/".$a."/".$zid.".".$imageFileType);
    }
    else if($imageFileType=="gif")
    {
      $image = imagecreatefromgif($file); 
      $img = imagescale( $image, $wd, $hd );
        imagegif($img,"phot/".$a."/".$zid.".".$imageFileType);
    }
    else if($imageFileType=="jpg"||$imageFileType=="jpeg")
    {
      $image = imagecreatefromjpeg($file); 
      $img = imagescale( $image, $wd, $hd );
        imagejpeg($img,"phot/".$a."/".$zid.".".$imageFileType);
    }

  
  }
    if($imageFileType=="png")
    {
      $image = imagecreatefrompng("phot/$a/$zid.$imageFileType");  
      $img = imagescale( $image, 180, 180 );
      imagepng($img,"phot/".$a."/".$zid."-min.".$imageFileType);
    }
    else if($imageFileType=="gif")
    {
      $image = imagecreatefromgif("phot/$a/$zid.$imageFileType");  
      $img = imagescale( $image, 180, 180 );
      imagegif($img,"phot/".$a."/".$zid."-min.".$imageFileType);
    }
    else if($imageFileType=="jpg"||$imageFileType=="jpeg")
    {
      $image = imagecreatefromjpeg("phot/$a/$zid.$imageFileType");  
      $img = imagescale( $image, 180, 180 );
      imagejpeg($img,"phot/".$a."/".$zid."-min.".$imageFileType);
    }
  
 
      echo'<p class="title is-1 has-text-primary-light ">Plik przesłany pomyślnie.</p>';
    
  } 
}
}

$conn->close();
?>
   <a  class="button is-danger has-text-white has-text-weight-bold " href="dodaj-foto.php">Pwrót do albumu</a>
   
   </div>
   </div>



</body>
</html>

