<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Dodawanie Foto</title>
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
     <script src="include/include.js"></script>

<body>

    <div w3-include-html="menu.php"></div>



  <?php

session_start();

$zdjeciaID = array();
$aData = array();
$tytulAZ = array();
$dataAZ = array();
$loginAZ = array();

$conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");


    $k=0;
    $d = mysqli_query ($conn, " SELECT DISTINCT albumy.id FROM `albumy` WHERE id_uzytkownika='$_SESSION[id]' ORDER BY albumy.data DESC;");
    while($row2=mysqli_fetch_array($d)){
      array_push($dataAZ,$row2['id']);
      $k=$k+1;
    }
    if($k==0)
    {
      echo ' <div class="container is-max-desktop mt-6">
      <div class="box has-background-primary has-text-centered">
      <p class="title is-1 has-text-primary-light ">Nie posiadasz żadnego albumu</p>
    <a class="button is-danger "  href="dodaj-album.php">Zalóż Album</a>
</div>';
    }
    else if($k==1||isset($_POST["Submit1"])||isset($_SESSION['aid']))
    {
    
      ob_start();
      if(isset($_POST["Submit1"]))
      {
      $t=$_POST["postvar"];
      }
      else if(isset($_SESSION['aid']))
      {
        $t=$_SESSION['aid'];
        unset($_SESSION['aid']);
      }
      else
      {
        $t=0;
      }
      
 
      echo'
      <div class="field has-addons ml-4 mt-4 mr-4">
    <p class="control">
    <form class="field has-addons" action="upload.php" method="post" enctype="multipart/form-data">
    <div id="file-js-example" class="file has-name is-primary">
    <label class="file-label">
      <input class="file-input" id="fileToUpload" type="file"  name="fileToUpload">
      <span class="file-cta">
        <span class="file-icon">
          <i class="fas fa-upload"></i>
        </span>
        <span class="file-label">
        Wybierz zdjęcie do dodania
        </span>
      </span>
      <span class="file-name has-background-primary-light">
        Nie wybrano zdjęcia
      </span>
    </label>
  </div>

    </p>
    <p class="control">
      <input class="input has-background-primary-light" name="opis" type="text" maxlength="255" placeholder="Dodaj opis (opcjonalne)">
      <input type="hidden" name="aid" value="'.$dataAZ[$t].'" />
      <input type="hidden" name="t" value="'.$t.'" />
    </p>
    <p class="control">
    <input type="submit" value="Upload Image" name="submit" class="button is-primary has-text-white has-text-weight-bold">
    </p>  
      </form>
    <p class="control ml-auto ">
    <form method="post">
    <input type="submit" value="Powrót do albumów" name="Submit2" class="button is-danger has-text-white has-text-weight-bold ">  
    <form>
    </p> 
  </div>
  
  <div class="swiper mySwiper">
  <div class="swiper-wrapper">
  ';

  $ki=0;
  $h = mysqli_query ($conn, "SELECT id FROM `zdjecia` WHERE id_album=$dataAZ[$t];");
  while($row6=mysqli_fetch_array($h)){
    array_push($zdjeciaID,$row6['id']);
    $ki=$ki+1;
  }
  $p=$ki;
  $o=$ki;
  $b=0;
 
    for($j=0;$j<($ki/20);$j++)
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


 
         
    $a = mysqli_query ($conn, "SELECT zdjecia.id FROM `albumy`,`zdjecia` WHERE zdjecia.id_album=albumy.id  AND albumy.id=$dataAZ[$t];");
    $row8=mysqli_fetch_array($a);
    echo ' <div class="column is-one-fifth ">';
   
    if (file_exists("phot/$dataAZ[$t]/$zdjeciaID[$b].png")==TRUE)
    {
    echo '<img  src="phot/'.$dataAZ[$t].'/'.$zdjeciaID[$b].'-min.png" height="180px" width="180px" >';
    }
    else if (file_exists("phot/$dataAZ[$t]/$zdjeciaID[$b].jpg")==TRUE)
    {
    echo '<img  src="phot/'.$dataAZ[$t].'/'.$zdjeciaID[$b].'-min.jpg" height="180px" width="180px" >';
    }
    else if (file_exists("phot/$dataAZ[$t]/$zdjeciaID[$b].jpeg")==TRUE)
    {
    echo '<img  src="phot/'.$dataAZ[$t].'/'.$zdjeciaID[$b].'.-min.jpeg" height="180px" width="180px" >';
    }
    else if (file_exists("phot/$dataAZ[$t]/$zdjeciaID[$b].gif")==TRUE)
    {
    echo '<img  src="phot/'.$dataAZ[$t].'/'.$zdjeciaID[$b].'-min.gif" height="180px" width="180px" >';
    }
    
    echo'</div>';

    
    $b=$b+1;  
   
      }
      $p=$p-5;
      echo'</div>';
    }
    $o=$o-20;
    echo'</div>';
  }
  
}

    else if($k>1||isset($_POST["Submit2"]))
    {
      ob_start();
      
      echo ' <div class="swiper mySwiper">
      <div class="swiper-wrapper">';
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


  
      $a = mysqli_query ($conn, "SELECT DISTINCT albumy.tytul, albumy.data, COUNT(zdjecia.id) FROM `albumy`,`uzytkownicy`,`zdjecia` WHERE albumy.id_uzytkownika=uzytkownicy.id AND zdjecia.id_album=albumy.id  AND albumy.id=$dataAZ[$b];");
      $row8=mysqli_fetch_array($a);
    
      echo' <div class="column is-one-fifth">
      <div class="box has-background-primary has-text-primary-light">
        <article class="media">
          <div class="media-left">


          
          <i class="fa-sharp fa-solid fa-images is-size-1"></i>
          </div>
          <div class="media-content">
            <div class="content has-text-left">
              <p>
                <strong class="has-text-primary-light">Tytuł: </strong>'.$row8['tytul'].'
                <br><strong class="has-text-primary-light">Data założenia: </strong>'.$row8['data'].'
                <br><strong class="has-text-primary-light">Ilość zdjęć: </strong>'.$row8['COUNT(zdjecia.id)'].' 
              </p>
            </div>
            <nav class="level">
            <form method="post">
            <input type="submit" value="Przejdź do albumu" name="Submit1" class="button is-danger has-text-white is-small is-fullwidth has-text-weight-bold ">
            <input type="hidden" name="postvar" value="'.$b.'" />
            </form>
          </nav>
          </div>
        </article>
      </div>
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

<script>
  const fileInput = document.querySelector('#file-js-example input[type=file]');
  fileInput.onchange = () => {
    if (fileInput.files.length > 0) {
      const fileName = document.querySelector('#file-js-example .file-name');
      fileName.textContent = fileInput.files[0].name;
    }
  }
</script>


    <div w3-include-html="stopka.html"></div>
    <script>
      includeHTML();
    </script>
</body>
</html>