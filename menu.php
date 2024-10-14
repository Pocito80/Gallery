<?php
session_start();
?>
<nav class="navbar is-primary has-text-weight-bold" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" >
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/62/ART_Television_%28Sri_Lanka%29_%28logo%29.png" width="112" height="28">
      </a>
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div id="navbarBasicExample" class="navbar-start">
      <div class="navbar-start has-text-primary-light">
        <a class="navbar-item" href="index.php"> Galeria </a>
        
        <?php
    if (isset($_SESSION['uprawnienia']))
    {
      echo ' <a class="navbar-item" href="dodaj-album.php" > Załóż album </a>
      <a class="navbar-item" href="dodaj-foto.php"> Dodaj zdjęcie </a>';
    }
    else
    {
      echo ' <a class="navbar-item" href="logrej.php" > Załóż album </a>
      <a class="navbar-item" href="logrej.php"> Dodaj zdjęcie </a>';
    }
  ?>


        <a class="navbar-item" href="top-foto.php"> Najlepiej oceniane </a>
         <a class="navbar-item" href="nowe-foto.php"> Najnowsze </a>
      </div>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
         
        
        <?php
          if (isset($_SESSION['uprawnienia']))
          {
        if($_SESSION['uprawnienia']=='użytkownik'){
          echo  ' 
          <a class="button is-danger" href="moje-konto.php">
          Moje konto
        </a>
          <a class="button is-danger" href="wyloguj.php">
          Wyloguj się
        </a>';
          
        }
        else if($_SESSION['uprawnienia']=='administrator'||$_SESSION['uprawnienia']=='moderator'){
         echo ' 
         <a class="button is-danger" href="moje-konto.php">
         Moje konto
       </a>
         <a class="button is-danger" href="wyloguj.php"">
            Wyloguj się
          </a>
          <a class="button is-danger" href="admin.php">
           Panel administracyjny
          </a>';
        }
      }
      else
      {
        echo '<a class="button is-danger" href="logrej.php">
        <strong>Zaloguj się</strong>
      </a>
      <a class="button is-danger" href="logrej.php">
        Rejestracja
      </a>';
      }
      
        function logout(){
          session_unset();
          session_destroy();
        }
     
        ?>
        </div>
      </div>
  </nav>