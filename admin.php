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
 
//  console.log(h);
}
function cookie()
{
  const id = ["album", "zdjecia", "komentarze", "uzytkownicy"];
  let h = getCookie("miasto");
  console.log(h);
  if(h>3)
  // console.log(id);
  {
  document.getElementById(id[h-4]).style.display = "block";
  }
  else
  {
    document.getElementById(id[0]).style.display = "block";
  }
}
    </script>
  </head>
  <body  onload="cookie()">
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


if(isset($_POST["Submit20"]))
{
  $idkom=$_POST["idkom"];
  $q="DELETE FROM zdjecia_komentarze WHERE id=$idkom;";
  if(mysqli_query($conn, $q)){

  }
}
if(isset($_POST["Submit21"]))
{
 
  $idkom=$_POST["idkom"];
  $q=" UPDATE zdjecia_komentarze  SET zaakceptowany=1 WHERE id=$idkom;";
if(mysqli_query($conn, $q)){

}
  
}
if(isset($_POST["Submit22"]))
{
  $idkom=$_POST["idkom"];
  $kom= mysqli_real_escape_string($conn, $_POST["kom"]);
  $q=" UPDATE zdjecia_komentarze  SET komentarz='$kom' WHERE id=$idkom;";
  if(mysqli_query($conn, $q)){

  }
}

// użytkownicy
if(isset($_POST["Submit23"]))
{
  $idu=$_POST["idu"];
  $q=" UPDATE uzytkownicy SET aktywny=0 WHERE id=$idu;";
  if(mysqli_query($conn, $q)){

  }
}
if(isset($_POST["Submit24"]))
{
  $idu=$_POST["idu"];
  $q=" UPDATE uzytkownicy SET aktywny=1 WHERE id=$idu;";
  if(mysqli_query($conn, $q)){

  }
}

if(isset($_POST["Submit25"]))
{
  $idu=$_POST["idu"];

  $q="DELETE FROM zdjecia_oceny WHERE id_uzytkownika=$idu;";
  if(mysqli_query($conn, $q)){

  }
  $q="DELETE FROM zdjecia_komentarze WHERE id_uzytkownika=$idu;";
  if(mysqli_query($conn, $q)){

  }
  
  $idalbumow = array();
  $k=0;
  $t = mysqli_query ($conn, "SELECT id  FROM `albumy` WHERE id_uzytkownika =$idu;");
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
  $dirname = 'phot/'.$idalbumow[$j];
  if (rmdir($dirname)) {
  
  } else {
  
  }
  
  $q="  DELETE FROM albumy WHERE id=$idalbumow[$j];";
  if(mysqli_query($conn, $q)){

  }
  }
  $q="DELETE FROM uzytkownicy WHERE id=$idu;";
  if(mysqli_query($conn, $q)){

  }

}



if(isset($_POST["Submit26"]))
{
  $idu=$_POST["idu"];
  $q=" UPDATE uzytkownicy SET uprawnienia='moderator' WHERE id=$idu;";
  if(mysqli_query($conn, $q)){

  }
}
if(isset($_POST["Submit27"]))
{
  $idu=$_POST["idu"];
   $q=" UPDATE uzytkownicy SET uprawnienia='użytkownik' WHERE id=$idu;";
  if(mysqli_query($conn, $q)){

  }
}
if(isset($_POST["Submit28"]))
{
  $idu=$_POST["idu"];
   $q=" UPDATE uzytkownicy SET uprawnienia='administrator' WHERE id=$idu;";
  if(mysqli_query($conn, $q)){

  }
}


if(isset($_POST["Submit30"]))
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

if(isset($_POST["Submit31"]))
{
  $tytul = mysqli_real_escape_string($conn, $_POST["tytul"]);
$idalbum=$_POST["idalbum"];

$q=" UPDATE albumy SET tytul = '$tytul' WHERE id=$idalbum;";
if(mysqli_query($conn, $q)){

}
}

if(isset($_POST["Submit34"]))
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

if(isset($_POST["Submit35"]))
{
  $idzdjecia=$_POST["idzdjecie"];

$q=" UPDATE zdjecia SET zaakceptowane = 1 WHERE id=$idzdjecia;";
if(mysqli_query($conn, $q)){

}
}
    ?>
  <div w3-include-html="menu.php"></div>


  <div class="w3-sidebar w3-bar-block has-background-primary-light has-text-weight-medium has-text-primary w3-card " style="width:130px">
  <h5 class="w3-bar-item has-text-weight-bold has-text-centered">Menu</h5>

<?php
if($_SESSION['uprawnienia']=='administrator'||$_SESSION['uprawnienia']=='moderator'){
  echo '<button class="w3-bar-item w3-button tablink has-text-centered" onclick="openCity(event, \'komentarze\')">Komentarze</button>
  <button class="w3-bar-item w3-button tablink has-text-centered" onclick="openCity(event, \'zdjecia\')">Zdjęcia</button>';
  }
if($_SESSION['uprawnienia']=='administrator'){
echo '<button class="w3-bar-item w3-button tablink has-text-centered" onclick="openCity(event, \'album\')">Albumy</button>
<button class="w3-bar-item w3-button tablink has-text-centered" onclick="openCity(event, \'uzytkownicy\')">Użytkownicy</button>';
}

?>

</div>

<div style="margin-left:130px">

<!-- albumy -->
  <div id="album" value="4" class="w3-container city w3-animate-left" style="display:none">
    <?php
    
    $albumyD = array();
    $a=0;
    $k=0;
    $q = mysqli_query ($conn, "SELECT DISTINCT(albumy.id), albumy.tytul, albumy.data, uzytkownicy.login FROM `albumy` INNER JOIN uzytkownicy ON uzytkownicy.id=albumy.id_uzytkownika INNER JOIN zdjecia ON albumy.id=zdjecia.id_album WHERE zaakceptowane=0;");
    while($row17=mysqli_fetch_array($q)){
      array_push($albumyD,$row17['id']);
      array_push($albumyD,$row17['tytul']);
      array_push($albumyD,$row17['data']);
      array_push($albumyD,$row17['login']);
      $a=$a+4;
      $k=$k+1;
    }
    $q = mysqli_query ($conn, " SELECT DISTINCT(albumy.id), albumy.tytul, albumy.data, uzytkownicy.login FROM albumy INNER JOIN uzytkownicy ON uzytkownicy.id=albumy.id_uzytkownika WHERE albumy.id NOT IN (SELECT DISTINCT(albumy.id) FROM `albumy` INNER JOIN zdjecia ON albumy.id=zdjecia.id_album WHERE zaakceptowane=0);");
    while($row17=mysqli_fetch_array($q)){
      array_push($albumyD,$row17['id']);
      array_push($albumyD,$row17['tytul']);
      array_push($albumyD,$row17['data']);
      array_push($albumyD,$row17['login']);
      $a=$a+4;
      $k=$k+1;
    }
    ob_start();
 
    echo'<div class="swiper mySwiper">
    <div class="swiper-wrapper mb-6 mt-4">';
    $p=$k;
    $o=$k;
    $a=0;
      for($j=0;$j<($k/30);$j++)
      {
        echo '<div class="swiper-slide">';
        if(($o/3)>=10)
        {
          $m=10;
        }
        else
        {
          $m=$o/3;
        }
        for($n=0;$n<$m;$n++)
        {
          echo '<div class="columns has-text-centered  is-gapless mt-4 mb-4"> ';
    
          if($p>=3)
          {
            $z=3;
          }
          else
          {
            $z=$p;
          }
    
          for($i=0;$i<$z;$i++)
          {
            $q = mysqli_query ($conn, "SELECT COUNT(id) FROM `zdjecia` WHERE id_album=$albumyD[$a] AND zaakceptowane=0;");
            $row20=mysqli_fetch_array($q);
            echo '<div class="column is-one-third">
           <div class="box has-background-primary-light ml-4 mr-4 is-clipped has-text-left ">
           
    
           
           <form  method="post">
           
  <b>Tytuł:</b> '.$albumyD[$a+1].'<br><b>Autor:</b> '.$albumyD[$a+3].' <b>Ilość zdjęć do akceptacji:</b> '.$row20['COUNT(id)'].' <br><b>Data:</b> '.$albumyD[$a+2].' </lable>
  <input type="hidden" name="idalb" value="'.$albumyD[$a].'" />
  <input type="hidden" name="tytalb" value="'.$albumyD[$a+1].'" />
  <input type="hidden" name="autalb" value="'.$albumyD[$a+3].'" />
  <input type="hidden" name="datalb" value="'.$albumyD[$a+2].'" />
  <input type="submit" name="Submit29" value="Edytuj Album" class="button is-danger has-text-white is-small has-text-weight-bold is-pulled-right">


           </form>
           </div>';



            echo '</div>';
            $a=$a+4;  
          }
          $p=$p-3;
          echo'</div>';
        }
        $o=$o-30;
        echo'</div>';
        }
echo'</div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
<div class="swiper-pagination"></div>
</div>';
    
 
if(isset($_POST["Submit29"]))
{
  $idal = $_POST["idalb"];
  $tytal = $_POST["tytalb"];
  $autal = $_POST["autalb"];
  $datal = $_POST["datalb"];
  ob_end_clean();
  echo  ' <article class="media">
  <figure class="media-left ">
  <div class="box has-background-primary has-text-primary-light has-text-centered">
 
  <form action="album.php" method="post" enctype="multipart/form-data">

  

  <button class="button is-large has-background-danger has-text-primary-light">
  <span class="icon is-medium">
  <i class="fa-sharp fa-solid fa-images is-size-2 "></i>
  </span>
  <span> Przejdź do Albumu</span>
</button>

  <input type="hidden" name="idalbum" value="'.$idal.'" />
    </form>
  
  <br><p class="is-size-5">Tytuł:
  '.$tytal.'<br>Data: '.$datal.'</p>
  
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
        <input type="submit" name="Submit30" value="Usuń Album" class="button is-danger has-text-white has-text-weight-bold ">
        </div>
      </div>
      <div class="level-left">
        <div class="level-item">
       
        <input type="hidden" name="idalbum" value="'.$idal.'" />
        <input type="submit" name="Submit31" value="Zmień Tytuł" class="button is-danger has-text-white has-text-weight-bold ">
        
        </div>
        
      </div>
      <div class="level-left">
      <div class="level-item">
     
      <input type="submit" name="Submit32" value="Powrót" class="button is-danger has-text-white has-text-weight-bold ">
      
      </div>
      
    </div>
    </nav>

  </div>
  </form>
</article>';
}
    
    
    ?>
  </div>
<!-- zdjecia -->
  <div id="zdjecia" value="5" class="w3-container city w3-animate-left" style="display:none">
  <div class="control has-icons-left mt-4 ml-4">
  <div class="select">
  <form action="" method="GET">
  <select name="listaz" class="has-background-primary has-text-primary-light has-text-weight-bold" onchange="this.form.submit()">
  <option>Wybierz zdjecia</option>  
  <option value="1">Zdjecia do akceptacji</option>
    <option value="2">zdjecia z albumu</option>
</select>

<div class="icon is-small is-left has-text-primary-light has-text-weight-bold">
<i class="fa-solid fa-arrow-down-a-z"></i>
  </div>
</form> 
</div>
</div>
<?php
if(isset($_GET['listaz'])){
  $selected3 = $_GET['listaz'];
}

if(isset($selected3))
{
$sortowanie3=$selected3;
}
else
{
  $sortowanie3=1;
}
if($sortowanie3==1)
{
  echo '<h1 class="is-size-2 has-text-weight-bold has-text-centered">Zdjecia do akceptacji</h1>';

  echo'<div class="swiper mySwiper">
  <div class="swiper-wrapper mb-6 mt-4">';
  $zdjeciaID = array();
$aData = array();
$tytulAZ = array();
$albumID = array();



  $k=0;

  $t = mysqli_query ($conn, "SELECT zdjecia.id, zdjecia.id_album, zdjecia.opis, zdjecia.data FROM `zdjecia` INNER JOIN albumy ON zdjecia.id_album=albumy.id WHERE zdjecia.zaakceptowane=0;");



  while($row1=mysqli_fetch_array($t)){
    array_push($zdjeciaID,$row1['id']);
    array_push($albumID,$row1['id_album']);
    array_push($tytulAZ,$row1['opis']);
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
  <div class="media-content mt-4 has-background-primary-light box">
  <form  method="post">

  <div class="field">
      <p class="is-size-5">
     <b>Opis:</b> '.$tytulAZ[$b].'<br><b>Data:</b> '.$aData[$b].'
      </p>
    </div>
    <nav class="level">
      <div class="level-left">
        <div class="level-item">
        <input type="submit" name="Submit34" value="Usuń Zdjęcie" class="button is-danger has-text-white has-text-weight-bold ">
        </div>
      </div>
      <div class="level-left">
        <div class="level-item">
        <input type="hidden" name="idzdjecie" value="'.$zdjeciaID[$b].'" />
        <input type="hidden" name="idalbum" value="'.$albumID[$b].'" />
        <input type="submit" name="Submit35" value="zaakceptuj" class="button is-danger has-text-white has-text-weight-bold ">
        
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

}
if($sortowanie3==2)
{
  echo '<h1 class="is-size-2 has-text-weight-bold has-text-centered">Wybór albumu ze zdjeciami</h1>';

  $albumyD = array();
  $a=0;
  $k=0;
  $q = mysqli_query ($conn, "SELECT DISTINCT(albumy.id), albumy.tytul, albumy.data, uzytkownicy.login FROM `albumy` INNER JOIN uzytkownicy ON uzytkownicy.id=albumy.id_uzytkownika;");
  while($row17=mysqli_fetch_array($q)){
    array_push($albumyD,$row17['id']);
    array_push($albumyD,$row17['tytul']);
    array_push($albumyD,$row17['data']);
    array_push($albumyD,$row17['login']);
    $a=$a+4;
    $k=$k+1;
  }
  
  ob_start();

  echo'<div class="swiper mySwiper">
  <div class="swiper-wrapper mb-6 mt-4">';
  $p=$k;
  $o=$k;
  $a=0;
    for($j=0;$j<($k/30);$j++)
    {
      echo '<div class="swiper-slide">';
      if(($o/3)>=10)
      {
        $m=10;
      }
      else
      {
        $m=$o/3;
      }
      for($n=0;$n<$m;$n++)
      {
        echo '<div class="columns has-text-centered  is-gapless mt-4 mb-4"> ';
  
        if($p>=3)
        {
          $z=3;
        }
        else
        {
          $z=$p;
        }
  
        for($i=0;$i<$z;$i++)
        {
          $q = mysqli_query ($conn, "SELECT COUNT(id) FROM `zdjecia` WHERE id_album=$albumyD[$a];");
          $row20=mysqli_fetch_array($q);
          echo '<div class="column is-one-third">
         <div class="box has-background-primary-light ml-4 mr-4 is-clipped has-text-left ">
         
  
         
         <form  method="post">
         
<b>Tytuł:</b> '.$albumyD[$a+1].'<br><b>Autor:</b> '.$albumyD[$a+3].' <b>Ilość zdjęć w albumie: </b> '.$row20['COUNT(id)'].' <br><b>Data:</b> '.$albumyD[$a+2].' </lable>
<input type="hidden" name="idalbum" value="'.$albumyD[$a].'" />
<input type="submit" name="Submit37" value="Przejdź do zdjeć" class="button is-danger has-text-white is-small has-text-weight-bold is-pulled-right">


         </form>
         </div>';



          echo '</div>';
          $a=$a+4;  
        }
        $p=$p-3;
        echo'</div>';
      }
      $o=$o-30;
      echo'</div>';
      }
}
if(isset($_POST["Submit37"]))
{
  ob_end_clean();
  echo'<div class="swiper mySwiper">
  <div class="swiper-wrapper mb-6 mt-4">';
  $idalbum=$_POST["idalbum"];
  $aData = array();
$tytulAZ = array();
$albumID = array();
$zdjeciaID = array();
$acc = array();

  $k=0;

  $t = mysqli_query ($conn, "SELECT zdjecia.id, zdjecia.id_album, zdjecia.opis, zdjecia.data, zdjecia.zaakceptowane FROM `zdjecia` INNER JOIN albumy ON zdjecia.id_album=albumy.id WHERE zdjecia.id_album = $idalbum;");



  while($row1=mysqli_fetch_array($t)){
    array_push($zdjeciaID,$row1['id']);
    array_push($albumID,$row1['id_album']);
    array_push($tytulAZ,$row1['opis']);
    array_push($aData,$row1['data']);
    array_push($acc,$row1['zaakceptowane']);
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
  <div class="media-content mt-4 has-background-primary-light box">
  <form  method="post">

  <div class="field">
      <p class="is-size-5">
     <b>Opis:</b> '.$tytulAZ[$b].'<br><b>Data:</b> '.$aData[$b].'
      </p>
    </div>
    <nav class="level">
      <div class="level-left">
        <div class="level-item">
        <input type="submit" name="Submit34" value="Usuń Zdjęcie" class="button is-danger has-text-white has-text-weight-bold ">
        </div>
      </div>
      
        <input type="hidden" name="idzdjecie" value="'.$zdjeciaID[$b].'" />
        <input type="hidden" name="idalbum" value="'.$albumID[$b].'" />';
        if($acc[$b]==0)
        {
         echo '<div class="level-left">
         <div class="level-item"><input type="submit" name="Submit35" value="zaakceptuj" class="button is-danger has-text-white has-text-weight-bold "></div>
         </div>';
        }
      echo'  

      <div class="level-left">
      <div class="level-item">
     
      <input type="submit" name="Submit32" value="Powrót" class="button is-danger has-text-white has-text-weight-bold ">
      
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
}

echo'</div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
<div class="swiper-pagination"></div>
</div>';


?>
  </div>
<!-- kometarze -->
  <div id="komentarze" value="6" class="w3-container city w3-animate-left" style="display:none">
  <div class="control has-icons-left mt-4 ml-4">
  <div class="select">
  <form action="" method="GET">
  <select name="listak" class="has-background-primary has-text-primary-light has-text-weight-bold" onchange="this.form.submit()">
  <option>Wybierz typ komentarzy</option>  
  <option value="1">Wszystkie Komentarze</option>
    <option value="2">Komentarze do Zaakceptowania</option>
</select>
<div class="icon is-small is-left has-text-primary-light has-text-weight-bold">
<i class="fa-solid fa-arrow-down-a-z"></i>
  </div>
 
</form> 
</div>
</div>
<?php
if(isset($_GET['listak'])){
  $selected2 = $_GET['listak'];
}

if(isset($selected2))
{
$sortowanie2=$selected2;
}
else
{
  $sortowanie2=1;
}
if($sortowanie2==1)
{
  $zdjeciaKOM = array();
  $l=0;
  $k=0;
  $q = mysqli_query ($conn, "SELECT zdjecia_komentarze.id, zdjecia_komentarze.komentarz, uzytkownicy.login, zdjecia_komentarze.date, zdjecia_komentarze.zaakceptowany FROM zdjecia_komentarze, uzytkownicy WHERE zdjecia_komentarze.id_uzytkownika=uzytkownicy.id ORDER BY zdjecia_komentarze.date DESC;");
  while($row9=mysqli_fetch_array($q)){
    array_push($zdjeciaKOM,$row9['id']);
    array_push($zdjeciaKOM,$row9['login']);
    array_push($zdjeciaKOM,$row9['date']);
    array_push($zdjeciaKOM,$row9['komentarz']);
    array_push($zdjeciaKOM,$row9['zaakceptowany']);
    $l=$l+5;
    $k=$k+1;
  }
  echo '<h1 class="is-size-2 has-text-weight-bold has-text-centered">Wszystkie Komentarze</h1>';
}
else if($sortowanie2==2)
{ $zdjeciaKOM = array();
  $l=0;
  $k=0;
  $q = mysqli_query ($conn, "SELECT zdjecia_komentarze.id, zdjecia_komentarze.komentarz, uzytkownicy.login, zdjecia_komentarze.date, zdjecia_komentarze.zaakceptowany FROM zdjecia_komentarze, uzytkownicy WHERE zdjecia_komentarze.id_uzytkownika=uzytkownicy.id AND zdjecia_komentarze.zaakceptowany=0 ORDER BY zdjecia_komentarze.date DESC;");
  while($row9=mysqli_fetch_array($q)){
    array_push($zdjeciaKOM,$row9['id']);
    array_push($zdjeciaKOM,$row9['login']);
    array_push($zdjeciaKOM,$row9['date']);
    array_push($zdjeciaKOM,$row9['komentarz']);
    array_push($zdjeciaKOM,$row9['zaakceptowany']);
    $l=$l+5;
    $k=$k+1;
  }
  echo '<h1 class="is-size-2 has-text-weight-bold has-text-centered">Komentarze do Akceptacji</h1>';
}

  if($l==0)
  {
    echo '<h2 class="is-size-3 has-text-weight-bold has-text-centered has-text-danger">Brak komentarzy spełniających kryterium wyszukiwania</h2>';
  }
  else
  {
    echo'<div class="swiper mySwiper">
    <div class="swiper-wrapper">';
    $p=$k;
    $o=$k;
    $g=0;
      for($j=0;$j<($k/6);$j++)
      {
        echo '<div class="swiper-slide">';
        if(($o/2)>=3)
        {
          $m=3;
        }
        else
        {
          $m=$o/2;
        }
        for($n=0;$n<$m;$n++)
        {
          echo '<div class="columns has-text-centered  is-gapless mt-4 mb-6"> ';
    
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
            echo '<div class="column is-half">';
            echo'<div class="box has-background-primary-light ml-4 mr-4 is-clipped">
<article class="media">
<div class="media-content">
<div class="content">
  <p>
    <strong>'.$zdjeciaKOM[$g+1].'</strong> <small>'.$zdjeciaKOM[$g+2].'</small>
    <br>
   '.$zdjeciaKOM[$g+3].'
  </p>
</div>

</div>
</article>
<form  method="post">

<div class="field">
<p class="control">
  <textarea class="textarea  has-fixed-size" name="kom" placeholder="Edytuj komentarz"></textarea>
</p>
</div>
<nav class="level">
<div class="level-left">
  <div class="level-item">
  <input type="submit" name="Submit20" value="Usuń Komentarz" class="button is-danger has-text-white has-text-weight-bold ">
  </div>
</div>';

if($zdjeciaKOM[$g+4]==0)
{
  echo'
<div class="level-left">
<div class="level-item">
<input type="submit" name="Submit21" value="Zaakceptuj komentarz" class="button is-danger has-text-white has-text-weight-bold ">
</div>
</div>';
}
echo'
<div class="level-left">
  <div class="level-item">
 
  <input type="hidden" name="idkom" value="'.$zdjeciaKOM[$g].'" />';
  if($_SESSION['uprawnienia']=='administrator')
  {
    echo'<input type="submit" name="Submit22" value="Edytuj Komentarz" class="button is-danger has-text-white has-text-weight-bold ">';
  }
  echo'
  </div>
</div>
</nav>

</div>
</form>';
            echo '</div>';
            $g=$g+5;  

          }
          $p=$p-2;
          echo'</div>';
        }
        $o=$o-6;
        echo'</div>';
        }
echo'</div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
<div class="swiper-pagination"></div>
</div>';

  }
?>
  </div>
  <!-- uzytkownicy -->
  <div id="uzytkownicy" value="7" class="w3-container city w3-animate-left" style="display:none">
  <div class="control has-icons-left mt-4 ml-4">
  <div class="select">
  <form action="" method="GET">
  <select name="listau" class="has-background-primary has-text-primary-light has-text-weight-bold" onchange="this.form.submit()">
  <option>Wybierz typ użytkownika</option>  
  <option value="1">Wszyscy użytkownicy</option>
  <option value="2">Użytkownicy</option>
  <option value="3">Moderatorzy</option>
  <option value="4">Administratorzy</option>
</select>
<div class="icon is-small is-left has-text-primary-light has-text-weight-bold">
<i class="fa-solid fa-arrow-down-a-z"></i>
  </div>
 
</form> 
</div>
</div>
<?php
if(isset($_GET['listau'])){
  $selected = $_GET['listau'];
}

if(isset($selected))
{
$sortowanie=$selected;
}
else
{
  $sortowanie=1;
}
$userinf = array();
if($sortowanie==1)
{
  
 $k=0;
  $q = mysqli_query ($conn, "SELECT id, login, uprawnienia, aktywny FROM `uzytkownicy` WHERE id != $_SESSION[id];");
  while($row10=mysqli_fetch_array($q)){
    array_push($userinf,$row10['id']);
    array_push($userinf,$row10['login']);
    array_push($userinf,$row10['uprawnienia']);
    array_push($userinf,$row10['aktywny']);
    $k=$k+1;
  }
  echo '<h1 class="is-size-2 has-text-weight-bold has-text-centered">Wszyscy Użytkownicy</h1>';
}
else if($sortowanie==2)
{
  $k=0;
  $q = mysqli_query ($conn, "SELECT id, login, uprawnienia, aktywny FROM `uzytkownicy` WHERE id != $_SESSION[id] AND uprawnienia='użytkownik';");
  while($row10=mysqli_fetch_array($q)){
    array_push($userinf,$row10['id']);
    array_push($userinf,$row10['login']);
    array_push($userinf,$row10['uprawnienia']);
    array_push($userinf,$row10['aktywny']);
    $k=$k+1;
  }
  echo '<h1 class="is-size-2 has-text-weight-bold has-text-centered">Użytkownicy</h1>';
}
else if($sortowanie==3)
{
  $k=0;
  $q = mysqli_query ($conn, "SELECT id, login, uprawnienia, aktywny FROM `uzytkownicy` WHERE id != $_SESSION[id] AND uprawnienia='moderator';");
  while($row10=mysqli_fetch_array($q)){
    array_push($userinf,$row10['id']);
    array_push($userinf,$row10['login']);
    array_push($userinf,$row10['uprawnienia']);
    array_push($userinf,$row10['aktywny']);
    $k=$k+1;
  }
  echo '<h1 class="is-size-2 has-text-weight-bold has-text-centered">Moderatorzy</h1>';
}
else if($sortowanie==4)
{
  $k=0;
  $q = mysqli_query ($conn, "SELECT id, login, uprawnienia, aktywny FROM `uzytkownicy` WHERE id != $_SESSION[id] AND uprawnienia='administrator';");
  while($row10=mysqli_fetch_array($q)){
    array_push($userinf,$row10['id']);
    array_push($userinf,$row10['login']);
    array_push($userinf,$row10['uprawnienia']);
    array_push($userinf,$row10['aktywny']);
    $k=$k+1;
  }
  echo '<h1 class="is-size-2 has-text-weight-bold has-text-centered">Administratorzy</h1>';
}


  
  if($k==0)
{
  echo '<h2 class="is-size-3 has-text-weight-bold has-text-centered has-text-danger">Brak użytkowników spełniających kryteria wyszukiwania</h2>';
}
  echo'<div class="swiper mySwiper">
  <div class="swiper-wrapper">';
  $p=$k;
  $o=$k;
  $u=0;
  $b=0;
    for($j=0;$j<($k/9);$j++)
    {
      echo '<div class="swiper-slide">';
      if(($o/3)>=3)
      {
        $m=3;
      }
      else
      {
        $m=$o/3;
      }
      for($n=0;$n<$m;$n++)
      {
        echo '<div class="columns has-text-centered  is-gapless mt-4 mb-6"> ';
  
        if($p>=3)
        {
          $z=3;
        }
        else
        {
          $z=$p;
        }
  
        for($i=0;$i<$z;$i++)
        {

          echo '<div class="column is-one-third"> 
          <div class="box has-background-primary-light is-clipped mr-2">
          <form  method="post">
          <div class="field">
          <p class="is-size-4"> <b>Login:</b> '.$userinf[$u+1].' <br><b>Uprawnienia:</b> '.$userinf[$u+2].' <br><b>Zablokowany:</b> ';

          if($userinf[$u+3]==1)
          {
          echo
          'Nie</p>
          </div>
          <nav class="level">
          <div class="level-left">
            <div class="level-item">

            <input type="submit" name="Submit23" value="Zablokuj konto" class="button is-danger has-text-white ">';
          }
          else if($userinf[$u+3]==0)
          {
            echo
          'Tak</p>
          </div>
          <nav class="level">
          <div class="level-left">
            <div class="level-item">

            <input type="submit" name="Submit24" value="Odblokuj konto" class="button is-danger has-text-white ">';
          }

          echo'  </div>
          </div>
          <input type="hidden" name="idu" value="'.$userinf[$u].'" />
          <div class="level-left">
          <div class="level-item">
          <input type="submit" name="Submit25" value="Usuń Konto" class="button is-danger has-text-white ">
          </div>
          </div>';

          if($userinf[$u+2]!='moderator')
          {
            echo'
          <div class="level-left">
            <div class="level-item">
            <input type="submit" name="Submit26" value="Moderator" class="button is-danger has-text-white ">
            </div>
          </div>';
          }
          if($userinf[$u+2]!='użytkownik')
          {
          echo'
          <div class="level-left">
            <div class="level-item">
          <input type="submit" name="Submit27" value="Użytkownik" class="button is-danger has-text-white ">
            </div>
          </div>';
          }
          if($userinf[$u+2]!='administrator')
          {
            echo'
          <div class="level-left">
            <div class="level-item">
          <input type="submit" name="Submit28" value="Administrator" class="button is-danger has-text-white ">
            </div>
          </div>';
          }

          echo'</nav>
          </div>
          </form>
          </div>
         ';
          
          $u=$u+4;  

        }
        $p=$p-3;
        echo'</div>';
      }
      $o=$o-9;
      echo'</div>';
      }
echo'</div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
<div class="swiper-pagination"></div>
</div>';



?>
  </div>

</div>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="javascript/swiper.js"></script>
  <div w3-include-html="stopka.html"></div>
    <script>
      includeHTML();
    </script>
    <?php 
    $conn->close();
    ?>
  </body>
</html>
