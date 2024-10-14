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
  <body>
  <div w3-include-html="menu.php"></div>

  
  <div class="control has-icons-left mt-4 ml-4">
  <div class="select ">
  <form action="" method="GET">
  <select name="lista" class="has-background-primary has-text-primary-light has-text-weight-bold"  onchange="this.form.submit()">
  <option>Sortuj wyniki</option>  
  <option value="1">tytuł</option>
    <option value="2">data dodania</option>
    <option value="3">nick użytkownika</option>
</select>
<div class="icon is-small is-left has-text-primary-light has-text-weight-bold">
<i class="fa-solid fa-arrow-down-a-z"></i>
  </div>
 
</form> 
</div>
</div>





  <div class="swiper mySwiper">
           <div class="swiper-wrapper">



<?php

$zdjeciaID = array();
$aData = array();
$tytulAZ = array();
$dataAZ = array();
$loginAZ = array();

if(isset($_GET['lista'])){
      $selected = $_GET['lista'];
  }

if(isset($selected))
{
  $sortowanie=$selected;
}
else
{
  $sortowanie=1;
}

$conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");

if($sortowanie==1)
{
  $k=0;
  $t = mysqli_query ($conn, " SELECT DISTINCT albumy.id FROM `albumy`,`zdjecia` WHERE albumy.id=zdjecia.id_album AND zdjecia.zaakceptowane=1 ORDER BY albumy.tytul ASC;");
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
    $h = mysqli_query ($conn, "SELECT MIN(id) FROM `zdjecia` WHERE id_album=$tytulAZ[$b] AND zdjecia.zaakceptowane=1;");
    $row4=mysqli_fetch_array($h);
    array_push($zdjeciaID,$row4['MIN(id)']);

    $a = mysqli_query ($conn, "SELECT DISTINCT albumy.tytul, albumy.data, uzytkownicy.login FROM `albumy`,`uzytkownicy` WHERE albumy.id_uzytkownika=uzytkownicy.id  AND albumy.id=$tytulAZ[$b];");
    $row7=mysqli_fetch_array($a);

    echo '<div class="column  is-one-fifth tooltip">
    <form action="album.php" method="post" enctype="multipart/form-data">';

    if (file_exists("phot/$tytulAZ[$b]/$zdjeciaID[$b].png")==TRUE)
    {
    echo '<input type="image" src="phot/'.$tytulAZ[$b].'/'.$zdjeciaID[$b].'-min.png">';
    }
    else if (file_exists("phot/$tytulAZ[$b]/$zdjeciaID[$b].jpg")==TRUE)
    {
    echo '<input type="image" src="phot/'.$tytulAZ[$b].'/'.$zdjeciaID[$b].'-min.jpg">';
    }
    else if (file_exists("phot/$tytulAZ[$b]/$zdjeciaID[$b].jpeg")==TRUE)
    {
    echo '<input type="image" src="phot/'.$tytulAZ[$b].'/'.$zdjeciaID[$b].'-min.jpeg">';
    }
    else if (file_exists("phot/$tytulAZ[$b]/$zdjeciaID[$b].gif")==TRUE)
    {
    echo '<input type="image" src="phot/'.$tytulAZ[$b].'/'.$zdjeciaID[$b].'-min.gif">';
    }
   echo' <span class="tooltiptext">'.$row7['tytul'].'<br>'.$row7['data'].'<br>'.$row7['login']. '</span>
    
    <input type="hidden" name="idalbum" value="'.$tytulAZ[$b].'" />
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
}







if($sortowanie==2)
{
  $k=0;
  $d = mysqli_query ($conn, " SELECT DISTINCT albumy.id FROM `albumy`,`zdjecia` WHERE albumy.id=zdjecia.id_album AND zdjecia.zaakceptowane=1 ORDER BY albumy.data DESC;");
  while($row2=mysqli_fetch_array($d)){
    array_push($dataAZ,$row2['id']);
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
        echo '<div class="columns has-text-centered  is-gapless mt-4 mb-6"> ';
  
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
    $h = mysqli_query ($conn, "SELECT MIN(id) FROM `zdjecia` WHERE id_album=$dataAZ[$b] AND zdjecia.zaakceptowane=1;");
    $row5=mysqli_fetch_array($h);
    array_push($zdjeciaID,$row5['MIN(id)']);

    $a = mysqli_query ($conn, "SELECT DISTINCT albumy.tytul, albumy.data, uzytkownicy.login FROM `albumy`,`uzytkownicy` WHERE albumy.id_uzytkownika=uzytkownicy.id  AND albumy.id=$dataAZ[$b];");
    $row8=mysqli_fetch_array($a);
  
   
    echo '<div class="column  is-one-fifth tooltip">
    <form action="album.php" method="post" enctype="multipart/form-data">';

    if (file_exists("phot/$dataAZ[$b]/$zdjeciaID[$b].png")==TRUE)
    {
    echo '   <input type="image" src="phot/'.$dataAZ[$b].'/'.$zdjeciaID[$b].'-min.png" >';
    }
    else if (file_exists("phot/$dataAZ[$b]/$zdjeciaID[$b].jpg")==TRUE)
    {
      echo '   <input type="image" src="phot/'.$dataAZ[$b].'/'.$zdjeciaID[$b].'-min.jpg" >';
    }
    else if (file_exists("phot/$dataAZ[$b]/$zdjeciaID[$b].jpeg")==TRUE)
    {
      echo '   <input type="image" src="phot/'.$dataAZ[$b].'/'.$zdjeciaID[$b].'-min.jpeg" >';
    }
    else if (file_exists("phot/$dataAZ[$b]/$zdjeciaID[$b].gif")==TRUE)
    {
      echo '   <input type="image" src="phot/'.$dataAZ[$b].'/'.$zdjeciaID[$b].'-min.gif">';
    }



 

    echo'<span class="tooltiptext">'.$row8['tytul'].'<br>'.$row8['data'].'<br>'.$row8['login']. '</span>
    
    <input type="hidden" name="idalbum" value="'.$dataAZ[$b].'" />
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
}




if($sortowanie==3)
{
  $k=0;
  $l = mysqli_query ($conn, "SELECT DISTINCT albumy.id FROM `albumy`,`zdjecia`,`uzytkownicy` WHERE albumy.id=zdjecia.id_album AND zdjecia.zaakceptowane=1 AND albumy.id_uzytkownika=uzytkownicy.id ORDER BY uzytkownicy.login ASC;");
  while($row3=mysqli_fetch_array($l)){
    array_push($loginAZ,$row3['id']);
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
      echo '<div class="columns has-text-centered  is-gapless mt-4 mb-6"> ';

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
        $h = mysqli_query ($conn, "SELECT MIN(id) FROM `zdjecia` WHERE id_album=$loginAZ[$b] AND zdjecia.zaakceptowane=1;");
        $row6=mysqli_fetch_array($h);
        array_push($zdjeciaID,$row6['MIN(id)']);
    
        $a = mysqli_query ($conn, "SELECT DISTINCT albumy.tytul, albumy.data, uzytkownicy.login FROM `albumy`,`uzytkownicy` WHERE albumy.id_uzytkownika=uzytkownicy.id  AND albumy.id=$loginAZ[$b];");
        $row9=mysqli_fetch_array($a);
      
      echo '<div class="column  is-one-fifth tooltip">
    <form action="album.php" method="post" enctype="multipart/form-data">';

      if (file_exists("phot/$loginAZ[$b]/$zdjeciaID[$b].png")==TRUE)
    {
    echo '  <input type="image" src="phot/'.$loginAZ[$b].'/'.$zdjeciaID[$b].'-min.png">';
    }
    else if (file_exists("phot/$loginAZ[$b]/$zdjeciaID[$b].jpg")==TRUE)
    {
      echo '  <input type="image" src="phot/'.$loginAZ[$b].'/'.$zdjeciaID[$b].'-min.jpg" >';
    }
    else if (file_exists("phot/$loginAZ[$b]/$zdjeciaID[$b].jpeg")==TRUE)
    {
      echo '  <input type="image" src="phot/'.$loginAZ[$b].'/'.$zdjeciaID[$b].'-min.jpeg">';
    }
    else if (file_exists("phot/$loginAZ[$b]/$zdjeciaID[$b].gif")==TRUE)
    {
      echo '  <input type="image" src="phot/'.$loginAZ[$b].'/'.$zdjeciaID[$b].'-min.gif" >';
    }

  
    echo'<span class="tooltiptext">'.$row9['tytul'].'<br>'.$row9['data'].'<br>'.$row9['login']. '</span>
    
    <input type="hidden" name="idalbum" value="'.$loginAZ[$b].'" />
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
