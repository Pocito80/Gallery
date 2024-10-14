<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Album</title>
    <link rel="stylesheet" href="Style/style.css" type="text/css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"
    />
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script
      src="https://kit.fontawesome.com/92b04f16d6.js"
      crossorigin="anonymous"
    ></script>
    <script src="include/include.js"></script>
  </head>
  <body>
  <div w3-include-html="menu.php"></div>
<div class="content mt-4 mr-4 has-text-right">
  <a href="index.php" class="button is-danger has-text-white has-text-weight-bold ">Powrót do galerii</a>
</div>

  <div class="swiper mySwiper">
           <div class="swiper-wrapper">
            

<?php
$a=$_POST["idalbum"];


$zdjeciaID = array();
$aData = array();
$tytulAZ = array();
$dataAZ = array();
$loginAZ = array();



$conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");


  $k=0;
  $t = mysqli_query ($conn, " SELECT id FROM `zdjecia` WHERE id_album=$a AND zaakceptowane=1;");
  while($row1=mysqli_fetch_array($t)){
    array_push($tytulAZ,$row1['id']);
    $k=$k+1;
  }

  $p=$k;
  $o=$k;
  $b=0;
    for($j=0;$j<($k/20);$j++)
    {
      echo '<div class="swiper-slide">';
      if(($o/5)>=4)
      {
        $g=4;
      }
      else
      {
        $g=$o/5;
      }
      for($n=0;$n<$g;$n++)
      {
        echo '<div class="columns has-text-centered is-gapless mt-4 mb-6"> ';
  
        if($p>=5)
        {
          $z=5;
        }
        else
        {
          $z=$p;
        }
  
        for($i=0;$i<$z;$i++)
        {
   



echo '<div class="column  is-one-fifth">
<form action="foto.php" method="post" enctype="multipart/form-data">';

if (file_exists("phot/$a/$tytulAZ[$b].png")==TRUE)
{
echo '<input type="image" name="Submit6" src="phot/'.$a.'/'.$tytulAZ[$b].'-min.png"  height="180px;" width="180px">';
}
else if (file_exists("phot/$a/$tytulAZ[$b].jpg")==TRUE)
{
  echo '<input type="image" name="Submit6" src="phot/'.$a.'/'.$tytulAZ[$b].'-min.jpg"  height="180px;" width="180px">';
}
else if (file_exists("phot/$a/$tytulAZ[$b].jpeg")==TRUE)
{
  echo '<input type="image" name="Submit6" src="phot/'.$a.'/'.$tytulAZ[$b].'-min.jpeg"  height="180px;" width="180px">';
}
else if (file_exists("phot/$a/$tytulAZ[$b].gif")==TRUE)
{
  echo '<input type="image" name="Submit6" src="phot/'.$a.'/'.$tytulAZ[$b].'-min.gif"  height="180px;" width="180px">';
}
echo'<input type="hidden" name="idzdjecie" value="'.$tytulAZ[$b].'" />
<input type="hidden" name="idalbum" value="'.$a.'" />
</form>
</div>';
  
 
  $b=$b+1;  

  }
  $p=$p-5;
  echo'</div>';
}
$o=$o-20;
echo'</div>';
}

$conn->close();
?>

</div>
           <div class="swiper-button-next"></div>
           <div class="swiper-button-prev"></div>
           <div class="swiper-pagination"></div>
</div>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="javascript/swiper.js"></script>


  
  <div w3-include-html="stopka.html"></div>
    <script>
      includeHTML();
    </script>
  </body>
</html>
