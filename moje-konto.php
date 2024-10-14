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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script
      src="https://kit.fontawesome.com/92b04f16d6.js"
      crossorigin="anonymous"
    ></script>
    <script src="include/include.js"></script>
    <script>

       function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace("has-background-danger-light", ""); 
 
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " has-background-danger-light";

  var cookieValue = document.getElementById(cityName).getAttribute('value');
  document.cookie = "miasto=" + cookieValue;
}

function cookie2()
{
  const id = ["dane", "albumy", "zdjecia", "usun"];
  let h = getCookie("miasto");
  if(h<=3)

  {
  document.getElementById(id[h]).style.display = "block";
  }
  else
  {
    document.getElementById(id[0]).style.display = "block";
  }
}
    </script>
  </head>
  <body onload="cookie2()">
    <?php
    session_start();
    ini_set('log_errors','On');

      ini_set('display_errors','Off');

      ini_set('error_reporting', E_ALL );

      define('WP_DEBUG', false);

      define('WP_DEBUG_LOG', true);

      define('WP_DEBUG_DISPLAY', false);

    $conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");

if(isset($_POST["Submit9"]))
{
  $idzdjecia=$_POST["idzdjecie"];
  $idalbum=$_POST["idalbum"];
  if (file_exists("phot/$idalbum/$idzdjecia.png")==TRUE)
  {
    $filename = 'phot/'.$idalbum.'/'.$idzdjecia.'.png';
    $filename2 = 'phot/'.$idalbum.'/'.$idzdjecia.'-min.png';
  }
  else if (file_exists("phot/$idalbum/$idzdjecia.jpg")==TRUE)
  {
    $filename = 'phot/'.$idalbum.'/'.$idzdjecia.'.jpg';
    $filename2 = 'phot/'.$idalbum.'/'.$idzdjecia.'-min.jpg';
  }
  else if (file_exists("phot/$idalbum/$idzdjecia.jpeg")==TRUE)
  {
    $filename = 'phot/'.$idalbum.'/'.$idzdjecia.'.jpeg';
    $filename2 = 'phot/'.$idalbum.'/'.$idzdjecia.'-min.jpeg';
  }
  else if (file_exists("phot/$idalbum/$idzdjecia.gif")==TRUE)
  {
    $filename = 'phot/'.$idalbum.'/'.$idzdjecia.'.gif';
    $filename2 = 'phot/'.$idalbum.'/'.$idzdjecia.'-min.gif';
  }

  if (unlink($filename)) {

  } else {

  }
  if (unlink($filename2)) {
    
  } else {
   
  }
  
  $q="   DELETE FROM zdjecia WHERE id=$idzdjecia;";
  if(mysqli_query($conn, $q)){

  }
  $q=" DELETE FROM zdjecia_komentarze WHERE id_zdjecia=$idzdjecia;";
  if(mysqli_query($conn, $q)){

  }
  $q="  DELETE FROM zdjecia_oceny WHERE id_zdjecia=$idzdjecia;";
  if(mysqli_query($conn, $q)){

  }

  
 
} 


if(isset($_POST["Submit10"]))
{
  $opis = mysqli_real_escape_string($conn, $_POST["opis"]);
$idzdjecia=$_POST["idzdjecie"];

$q=" UPDATE zdjecia SET opis = '$opis' WHERE id=$idzdjecia;";
if(mysqli_query($conn, $q)){

}

} 


if(isset($_POST["Submit12"]))
{
  $idzdjec = array();
  $h=0;

  $idalbum=$_POST["idalbum"];
  
  $t = mysqli_query ($conn, "SELECT id  FROM `zdjecia` WHERE id_album =$idalbum;");
  while($row4=mysqli_fetch_array($t)){
    array_push($idzdjec,$row4['id']);
    $h=$h+1;
  }

  for($i=0;$i<$h;$i++)
  {



  if (file_exists("phot/$idalbum/$idzdjec[$i].png")==TRUE)
  {
    $filename = 'phot/'.$idalbum.'/'.$idzdjec[$i].'.png';
    $filename2 = 'phot/'.$idalbum.'/'.$idzdjec[$i].'-min.png';
  }
  else if (file_exists("phot/$idalbum/$idzdjec[$i].jpg")==TRUE)
  {
    $filename = 'phot/'.$idalbum.'/'.$idzdjec[$i].'.jpg';
    $filename2 = 'phot/'.$idalbum.'/'.$idzdjec[$i].'-min.jpg';
  }
  else if (file_exists("phot/$idalbum/$idzdjec[$i].jpeg")==TRUE)
  {
    $filename = 'phot/'.$idalbum.'/'.$idzdjec[$i].'.jpeg';
    $filename2 = 'phot/'.$idalbum.'/'.$idzdjec[$i].'-min.jpeg';
  }
  else if (file_exists("phot/$idalbum/$idzdjec[$i].gif")==TRUE)
  {
    $filename = 'phot/'.$idalbum.'/'.$idzdjec[$i].'.gif';
    $filename2 = 'phot/'.$idalbum.'/'.$idzdjec[$i].'-min.gif';
  }

  if (unlink($filename)) {
  
  } else {
 
  }
  if (unlink($filename2)) {
    
  } else {

  }


  $q="   DELETE FROM zdjecia WHERE id=$idzdjec[$i];";
  if(mysqli_query($conn, $q)){
 
  }
  $q=" DELETE FROM zdjecia_komentarze WHERE id_zdjecia=$idzdjec[$i];";
  if(mysqli_query($conn, $q)){

  }
  $q="  DELETE FROM zdjecia_oceny WHERE id_zdjecia=$idzdjec[$i];";
  if(mysqli_query($conn, $q)){

  }



}
$dirname = 'phot/'.$idalbum;
if (rmdir($dirname)) {

} else {

}

$q="  DELETE FROM albumy WHERE id=$idalbum;";
if(mysqli_query($conn, $q)){

}
} 

if(isset($_POST["Submit13"]))
{
  $tytul = mysqli_real_escape_string($conn, $_POST["tytul"]);
$idalbum=$_POST["idalbum"];

$q=" UPDATE albumy SET tytul = '$tytul' WHERE id=$idalbum;";
if(mysqli_query($conn, $q)){

}
} 

if(isset($_POST["Submit14"]))
{
echo 'usuń konto';

} 

 
    ?>
  <div w3-include-html="menu.php"></div>


  <div class="w3-sidebar w3-bar-block has-background-primary-light has-text-weight-medium has-text-primary w3-card " style="width:130px">
  <h5 class="w3-bar-item has-text-weight-bold has-text-centered">Menu</h5>
  <button class="w3-bar-item w3-button tablink has-text-centered" onclick="openCity(event, 'dane')">Moje Dane</button>
  <button class="w3-bar-item w3-button tablink has-text-centered" onclick="openCity(event, 'albumy')">Moje Albumy</button>
  <button class="w3-bar-item w3-button tablink has-text-centered" onclick="openCity(event, 'zdjecia')">Moje Zdjęcia</button>
  <button class="w3-bar-item w3-button tablink has-text-centered" onclick="openCity(event, 'usun')">Usuń Konto</button>
</div>

<div style="margin-left:130px">


<!-- dane -->
  <div id="dane" value="0" class="w3-container city w3-animate-left" style="display:none">

  <!-- email -->
  <div class="container is-max-desktop mt-6 mb-3">
      <div class="box has-background-primary">
        <h1 class="title has-text-centered has-text-primary-light">Zmień Email</h1>
    <form id="emailchange" class="form">
          
    <div class="field">
                    <p class="control has-icons-left has-icons-right">
                      <input
                        class="input has-background-primary-light"
                        type="text" name="email" id="email" autocomplete="off"
                        placeholder="Nowy Email"
                      />
                      <small class="has-text-danger-dark is-size-6" >&nbsp</small>
                      <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                      </span>
                    </p>
                </div>

        <div class="field">
          <p class="control has-icons-left">
            <input
              class="input has-background-primary-light"
              type="password" name="passwordE" id="passwordE" autocomplete="off"
              placeholder="Hasło"
            />
            <small class="has-text-danger-dark is-size-6" id="response3" >&nbsp</small>
            <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
          </p>
          </div>
           <div class="buttons is-centered">
                <input class="button is-danger has-text-weight-bold has-text-primary-light" type="submit" value="Zmień" >
                    </div>
</form>
</div>
</div>
<!-- haslo -->
<div class="container is-max-desktop mt-6 mb-3">
      <div class="box has-background-primary">
        <h1 class="title has-text-centered has-text-primary-light">Zmień hasło</h1>
    <form id="haslo" class="form">
          
    <div class="field">
          <p class="control has-icons-left">
            <input
              class="input has-background-primary-light"
              type="password" name="passwordold" id="passwordold" autocomplete="off"
              placeholder="Stare Hasło"
            />
            <small class="has-text-danger-dark is-size-6">&nbsp</small>
            <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
          </p>
          </div>
          <div class="field">
          <p class="control has-icons-left">
            <input
              class="input has-background-primary-light"
              type="password" name="passwordnew" id="passwordnew" autocomplete="off"
              placeholder="Nowe Hasło"
            />
            <small class="has-text-danger-dark is-size-6">&nbsp</small>
            <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
          </p>
          </div>
        <div class="field">
          <p class="control has-icons-left">
            <input
              class="input has-background-primary-light"
              type="password" name="passwordcon" id="passwordcon" autocomplete="off"
              placeholder="Potwierdź Nowe Hasło"
            />
            <small class="has-text-danger-dark is-size-6" id="response4" >&nbsp</small>
            <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
          </p>
          </div>
           <div class="buttons is-centered">
                <input class="button is-danger has-text-weight-bold has-text-primary-light" type="submit" value="Zaloguj się" >
                    </div>
</form>
</div>
</div>

  </div>
<!-- albumy -->
  <div id="albumy" value="1" class="w3-container city w3-animate-left" style="display:none">
  <div class="swiper mySwiper">
           <div class="swiper-wrapper">
<?php

$zdjeciaID = array();
$aData = array();
$tytulAZ = array();
$albumID = array();

  $k=0;

  $t = mysqli_query ($conn, "SELECT tytul, id, data FROM `albumy` WHERE id_uzytkownika=$_SESSION[id];");
  while($row1=mysqli_fetch_array($t)){
    array_push($tytulAZ,$row1['tytul']);
    array_push($albumID,$row1['id']);
    array_push($aData,$row1['data']);
    $k=$k+1;

  }
  $p=$k;
  $o=$k;
  $b=0;
    for($j=0;$j<($k/8);$j++)
    {
    echo '<div class="swiper-slide mt-4"><div class="container mb-6">';
    if(($o/2)>=4)
      {
        $g=4;
      }
      else
      {
        $g=$o/2;
      }
      for($n=0;$n<$g;$n++)
      {
        echo '<div class="columns is-gapless"> ';
  
        if($p>=2)
        {
          $z=2;
        }
        else
        {
          $z=$p;
        }
  
        for($i=0;$i<$z;$i++)
        {
          echo'<div class="column is-half ">
  <article class="media">
  <figure class="media-left ">
  <div class="box has-background-primary has-text-primary-light has-text-centered">
 
  <form action="album.php" method="post" enctype="multipart/form-data">

  

  <button class="button is-large has-background-danger has-text-primary-light">
  <span class="icon is-medium">
  <i class="fa-sharp fa-solid fa-images is-size-2 "></i>
  </span>
  <span> Przejdź do Albumu</span>
</button>

  <input type="hidden" name="idalbum" value="'.$albumID[$b].'" />
    </form>
  
  <br><p class="is-size-5">Tytuł:
  '.$tytulAZ[$b].'<br>Data: '.$aData[$b].'</p>
  
  </div>
  </figure>
  <div class="media-content mt-4">
  <form  method="post">

  <div class="field">
      <p class="control">
        <textarea class="textarea  has-fixed-size" name="tytul"  maxlength="100" placeholder="Nowy Tytuł"></textarea>
      </p>
    </div>
    <nav class="level">
      <div class="level-left">
        <div class="level-item">
        <input type="submit" name="Submit12" value="Usuń Album" class="button is-danger has-text-white has-text-weight-bold ">
        </div>
      </div>
      <div class="level-left">
        <div class="level-item">
       
        <input type="hidden" name="idalbum" value="'.$albumID[$b].'" />
        <input type="submit" name="Submit13" value="Zmień Tytuł" class="button is-danger has-text-white has-text-weight-bold ">
        
        </div>
      </div>
    </nav>

  </div>
  </form>
</article>
</div>';

          $b=$b+1;  

        }
        $p=$p-2;
        echo'</div>';
      }
      $o=$o-8;
      echo'</div></div>';
      }
      ?>
      </div>
           <div class="swiper-button-next"></div>
           <div class="swiper-button-prev"></div>
           <div class="swiper-pagination"></div>
</div>
  </div>
<!-- zdjecia -->
  <div id="zdjecia" value="2" class="w3-container city w3-animate-left" style="display:none">
    
  <!-- SELECT zdjecia.id, zdjecia.id_album FROM `zdjecia` INNER JOIN albumy ON zdjecia.id_album=albumy.id WHERE albumy.id_uzytkownika=3; -->
  <div class="swiper mySwiper">
           <div class="swiper-wrapper">
<?php

$zdjeciaID = array();
$aData = array();
$tytulAZ = array();
$albumID = array();



  $k=0;

  $t = mysqli_query ($conn, "SELECT zdjecia.id, zdjecia.id_album FROM `zdjecia` INNER JOIN albumy ON zdjecia.id_album=albumy.id WHERE albumy.id_uzytkownika=$_SESSION[id];");



  while($row1=mysqli_fetch_array($t)){
    array_push($zdjeciaID,$row1['id']);
    array_push($albumID,$row1['id_album']);
    $k=$k+1;

  }
  $p=$k;
  $o=$k;
  $b=0;
    for($j=0;$j<($k/8);$j++)
    {
    echo '<div class="swiper-slide mt-4"><div class="container mb-6">';
    if(($o/2)>=4)
      {
        $g=4;
      }
      else
      {
        $g=$o/2;
      }
      for($n=0;$n<$g;$n++)
      {
        echo '<div class="columns is-gapless"> ';
  
        if($p>=2)
        {
          $z=2;
        }
        else
        {
          $z=$p;
        }
  
        for($i=0;$i<$z;$i++)
        {
          echo'<div class="column is-half ">
  <article class="media">
  <figure class="media-left">
    <p class="image">';
    
    if (file_exists("phot/$albumID[$b]/$zdjeciaID[$b].png")==TRUE)
    {
    echo '<img src="phot/'.$albumID[$b].'/'.$zdjeciaID[$b].'-min.png">';
    }
    else if (file_exists("phot/$albumID[$b]/$zdjeciaID[$b].jpg")==TRUE)
    {
    echo ' <img src="phot/'.$albumID[$b].'/'.$zdjeciaID[$b].'-min.jpg">';
    }
    else if (file_exists("phot/$albumID[$b]/$zdjeciaID[$b].jpeg")==TRUE)
    {
    echo ' <img src="phot/'.$albumID[$b].'/'.$zdjeciaID[$b].'-min.jpeg">';
    }
    else if (file_exists("phot/$albumID[$b]/$zdjeciaID[$b].gif")==TRUE)
    {
    echo ' <img src="phot/'.$albumID[$b].'/'.$zdjeciaID[$b].'-min.gif">">';
    }
     echo'
    </p>
  </figure>
  <div class="media-content mt-4">
  <form  method="post">

  <div class="field">
      <p class="control">
        <textarea class="textarea  has-fixed-size" name="opis"  maxlength="255" placeholder="Nowy Opis Zdjęcia"></textarea>
      </p>
    </div>
    <nav class="level">
      <div class="level-left">
        <div class="level-item">
        <input type="submit" name="Submit9" value="Usuń Zdjęcie" class="button is-danger has-text-white has-text-weight-bold ">
        </div>
      </div>
      <div class="level-left">
        <div class="level-item">
        <input type="hidden" name="idzdjecie" value="'.$zdjeciaID[$b].'" />
        <input type="hidden" name="idalbum" value="'.$albumID[$b].'" />
        <input type="submit" name="Submit10" value="Zmień Opis" class="button is-danger has-text-white has-text-weight-bold ">
        
        </div>
      </div>
    </nav>

  </div>
  </form>
</article>
</div>';

          $b=$b+1;  

        }
        $p=$p-2;
        echo'</div>';
      }
      $o=$o-8;
      echo'</div></div>';
      }

?>

</div>
           <div class="swiper-button-next"></div>
           <div class="swiper-button-prev"></div>
           <div class="swiper-pagination"></div>
</div>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="javascript/swiper.js"></script>


  </div>
  <!-- usun -->
  <div id="usun" value="3" class="w3-container city w3-animate-left" style="display:none">
  
  <div class="container is-max-desktop mt-6 mb-3">
      <div class="box has-background-primary">
        <h1 class="title has-text-centered has-text-primary-light">Zmień hasło</h1>
    <form id="del" class="form">
          
        <div class="field">
          <p class="control has-icons-left">
            <input
              class="input has-background-primary-light"
              type="password" name="passwordDel" id="passwordDel" autocomplete="off"
              placeholder="Potwierdź Nowe Hasło"
            />
            <small class="has-text-danger-dark is-size-6" id="response5" >&nbsp</small>
            <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
          </p>
          </div>
           <div class="buttons is-centered">
                <input class="button is-danger has-text-weight-bold has-text-primary-light" type="submit" value="Usuń Konto" >
                    </div>
</form>
</div>
</div>


</div>

<script src="javascript/changevalidation.js"></script>
  <div w3-include-html="stopka.html"></div>
    <script>
      includeHTML();
    </script>
    <?php 
    $conn->close();
    ?>
  </body>
</html>
