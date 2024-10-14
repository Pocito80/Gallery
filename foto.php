<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeria</title>
    
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
  <body >
  <div w3-include-html="menu.php"></div>

  <div class="swiper mySwiper">
           <div class="swiper-wrapper">
  
  
<?php
session_start();



$a=$_POST['idalbum'];
$b=$_POST['idzdjecie'];

if(isset($_SESSION['id']))
{
$id=$_SESSION['id'];
}


$data = array();
$zdjeciaID = array();
$aData = array();
$tytulAZ = array();
$dataAZ = array();
$zdjeciaKOM = array();


$conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");


if(isset($_COOKIE['sw'])) { echo "Screen width: ".$_COOKIE['sw']."<br/>";}
if(isset($_COOKIE['sh'])) { echo "Screen height: ".$_COOKIE['sh']."<br/>";}

$ki=0;
  $h = mysqli_query ($conn, "SELECT id FROM `zdjecia` WHERE id_album=$a AND zaakceptowane=1 ORDER BY id < $b, id;");
  while($row6=mysqli_fetch_array($h)){
    array_push($zdjeciaID,$row6['id']);
    $ki=$ki+1;
  }
  
  for($j=0;$j<$ki;$j++)
  {
  $q = mysqli_query ($conn, " SELECT albumy.tytul, zdjecia.data, uzytkownicy.login, zdjecia.opis FROM `albumy`,`zdjecia`, uzytkownicy WHERE albumy.id=zdjecia.id_album AND uzytkownicy.id=albumy.id_uzytkownika AND zdjecia.id=$zdjeciaID[$j];");
  $row1=mysqli_fetch_array($q);
  $q = mysqli_query ($conn, "SELECT ROUND(AVG(ocena), 2), COUNT(id_uzytkownika)FROM `zdjecia_oceny` WHERE id_zdjecia=$zdjeciaID[$j];");
  $row2=mysqli_fetch_array($q);
  
    if($row2[0]==NULL)
    {
      $row2[0]=0;
    }
    if (isset($_SESSION['uprawnienia']))
{
  $q = mysqli_query ($conn, "SELECT ocena FROM zdjecia_oceny WHERE id_uzytkownika=$_SESSION[id] AND id_zdjecia=$zdjeciaID[$j];");
  $row3=mysqli_fetch_array($q);
}


echo '<div class="swiper-slide has-text-centered ">
<div class="box has-text-left has-text-justified is-clipped has-background-primary has-text-primary-light mt-4 ml-4 mr-4 is-size-4">'
.'<b>Nazwa albumu: </b>'.$row1[0].' <b>Data dodania: </b>'.$row1[1].' <b>Dodane przez: </b>'.$row1[2].'<b> Opis: </b>'.$row1[3].'
  <form action="album.php" method="post" enctype="multipart/form-data" class="has-text-right">
<input type="submit" value="Powrót do albumu" class="button is-danger has-text-white has-text-weight-bold is-small">
<input type="hidden" name="idalbum" value="'.$a.'" />
</form>
  </div>';
 


  if (file_exists("phot/$a/$zdjeciaID[$j].png")==TRUE)
  {
   
 

    
  
    echo'<br><img src="phot/'.$a.'/'.$zdjeciaID[$j].'.png" class="fotoh" ><br>';

   
  }
  else if (file_exists("phot/$a/$zdjeciaID[$j].jpg")==TRUE)
  {
    $image_info = getimagesize("phot/$a/$zdjeciaID[$j].jpg");
    echo'<br><img src="phot/'.$a.'/'.$zdjeciaID[$j].'.jpg"  class="fotoh"><br>';
    
   
  }
  else if (file_exists("phot/$a/$zdjeciaID[$j].jpeg")==TRUE)
  {
    $image_info = getimagesize("phot/$a/$zdjeciaID[$j].jpeg");
    echo'<br><img src="phot/'.$a.'/'.$zdjeciaID[$j].'.jpeg"  class="fotoh"><br>';
    
   
  }
  else if (file_exists("phot/$a/$zdjeciaID[$j].gif")==TRUE)
  {
    $image_info = getimagesize("phot/$a/$zdjeciaID[$j].gif");
    echo'<br><img src="phot/'.$a.'/'.$zdjeciaID[$j].'.gif"  class="fotoh"><br>';
    
   
  }

echo'<div class="columns ml-4 mt-4 mb-4">
<div class="column">
<div  class="box has-background-primary has-text-primary-light is-size-4 ">
<b>Średnia ocen: '.$row2[0].' Ocenione przez: '.$row2[1].' osób</b>';


if(empty($row3[0])&&isset($_SESSION['id']))
{
echo '
<form action="ocena.php" method="post" enctype="multipart/form-data">
<div class="control">
  <label class="radio">
    <input type="radio" name="answer" value="1" checked>
    1
  </label>
  <label class="radio">
    <input type="radio" name="answer" value="2">
   2
  </label>
  <label class="radio">
  <input type="radio" name="answer" value="3">
  3
</label>
<label class="radio">
  <input type="radio" name="answer" value="4">
  4
</label>
<label class="radio">
<input type="radio" name="answer" value="5">
5
</label>
<label class="radio">
<input type="radio" name="answer" value="6">
6
</label>
<label class="radio">
<input type="radio" name="answer" value="7">
7
</label>
<label class="radio">
<input type="radio" name="answer" value="8">
8
</label>
<label class="radio">
<input type="radio" name="answer" value="9">
9
</label>
<label class="radio">
<input type="radio" name="answer" value="10">
10
</label>
<input type="hidden" name="idzdjecie" value="'.$b.'" />
<input type="hidden" name="idalbum" value="'.$a.'" />
<input type="hidden" name="idz" value="'.$zdjeciaID[$j].'" />
<input type="submit" name="Submit6" value="Oceń" class="button is-danger has-text-white has-text-weight-bold ">
</div>
</form>';}
else if(empty($_SESSION['id']))
{
  echo '<br><a href="logrej.php"  class="button has-text-weight-bold is-small is-danger" > Zaloguj się by móc ocenić zdjęcie</a>';
}
else{
  echo '<br><b> Twoja ocena: '.$row3[0].'</b>';
}
echo '</div>
</div>';


if(isset($_SESSION['id']))
{
echo '
<div class="column">
<form action="komentarz.php" class="mr-4" method="post" enctype="multipart/form-data">
<div class="control">
  <textarea class="textarea is-small has-background-primary-light  is-primary has-fixed-size" name="komentarz" placeholder="Zostaw komętarz"></textarea>
  <input type="hidden" name="idzdjecie" value="'.$b.'" />
  <input type="hidden" name="idalbum" value="'.$a.'" />
  <input type="hidden" name="idz" value="'.$zdjeciaID[$j].'" />
<input type="submit" name="Submit6" value="Skomentuj zdjęcie" class="is-fullwidth button is-small is-danger has-text-white has-text-weight-bold ">
</div>
</form>



</div>';
}
else{
  echo '<div class="column"><div  class="box has-background-primary has-text-primary-light is-size-4 ">
  <b>Zaloguj się by skomentować</b><br>
  <a href="logrej.php"  class="button has-text-weight-bold is-small is-danger" >Przejdź do rejestracji</a>
  </div></div>';
}
echo'
</div>'
;
$l=0;
$q = mysqli_query ($conn, "SELECT zdjecia_komentarze.komentarz, uzytkownicy.login, zdjecia_komentarze.date FROM zdjecia_komentarze, uzytkownicy WHERE zdjecia_komentarze.id_uzytkownika=uzytkownicy.id AND zdjecia_komentarze.zaakceptowany=1 AND zdjecia_komentarze.id_zdjecia=$zdjeciaID[$j] ORDER BY zdjecia_komentarze.date DESC;");
while($row9=mysqli_fetch_array($q)){
  array_push($zdjeciaKOM,$row9['login']);
  array_push($zdjeciaKOM,$row9['date']);
  array_push($zdjeciaKOM,$row9['komentarz']);
 
  $l=$l+3;
}
if($l==0)
{
  echo '<div  class="box has-background-primary has-text-primary-light is-size-4 ml-4 mr-4 mb-6"><b>Pośpiesz się! Możesz być pierwszym który skomentuje to zdjęcie!</b></div>';
}
else
{
  echo '<div class="box has-background-primary-light ml-4 mr-4 is-clipped">
  <h1 class="is-size-2 has-text-weight-bold">KOMENTARZE</h1>';
  for($g=0;$g<$l;$g=$g+3)
  {
 
echo'
    <article class="media">
  <div class="media-content">
    <div class="content">
      <p>
        <strong>'.$zdjeciaKOM[$g].'</strong> <small>'.$zdjeciaKOM[$g+1].'</small>
        <br>
       '.$zdjeciaKOM[$g+2].'
      </p>
    </div>

  </div>
</article>
';

  }
  echo '</div>';
}


echo'<form action="album.php" method="post" enctype="multipart/form-data" class="mb-6 mt-4 mr-4 has-text-centered">
<input type="submit" value="Powrót do albumu" class="button is-danger has-text-white has-text-weight-bold is-small">
<input type="hidden" name="idalbum" value="'.$a.'" />
</form>
</div>'

;
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

     

  
  <div w3-include-html="stopka.html"></div></b>
    <script>
      includeHTML();
    </script>
  </body>
</html>
