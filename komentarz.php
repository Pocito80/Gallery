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
    
$conn = mysqli_connect ('localhost','root','','maciejlecki_4a'); 
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");

    $id=$_SESSION['id'];
    $o = $_POST["komentarz"];
    $p = $_POST["idz"];
    $a=$_POST['idalbum'];
    $b=$_POST['idzdjecie'];
    

    ob_start();

    echo'<p class="title is-1 has-text-primary-light ">Czy na pewno opublikować komentarz:  "'.$o.'"?</p>
    <form  method="post">
    <input type="hidden" name="idzdjecie" value="'.$p.'" />
<input type="hidden" name="idalbum" value="'.$a.'" />
<input type="hidden" name="idz" value="'.$p.'" />
<input type="hidden" name="komentarz" value="'.$o.'" />
    <input type="submit" name="Submit7" value="Tak" class="button is-danger has-text-white has-text-weight-bold ">
    <input type="submit" name="Submit8" value="Nie" class="button is-danger has-text-white has-text-weight-bold ">
    </form>

    
    
    ';

    if (isset($_POST["Submit7"])) {
        $tekst = mysqli_real_escape_string($conn, $o);
        $q = "INSERT INTO zdjecia_komentarze (`id_zdjecia`,`id_uzytkownika`,`komentarz`) VALUES ('$p','$id','$tekst')";
        if ($conn->query($q) === TRUE) {
            ob_end_clean();
            echo '<p class="title is-1 has-text-primary-light ">Komentarz opublikowany pomyślnie</p>
            <form action="foto.php"  method="post">
            <input type="hidden" name="idzdjecie" value="'.$p.'" />
        <input type="hidden" name="idalbum" value="'.$a.'" />
        <input type="hidden" name="idz" value="'.$p.'" />
        <input type="hidden" name="komentarz" value="'.$o.'" />
            <input type="submit" name="Submit9" value="Powrót do zdjęcia" class="button is-danger has-text-white has-text-weight-bold ">
           
            </form>';

        } else {
            ob_end_clean();
            echo '<p class="title is-1 has-text-primary-light ">Publikacja komentarza nie powiodło się, spróbuj ponownie później</p>
            <form action="foto.php"  method="post">
            <input type="hidden" name="idzdjecie" value="'.$p.'" />
        <input type="hidden" name="idalbum" value="'.$a.'" />
        <input type="hidden" name="idz" value="'.$p.'" />
        <input type="hidden" name="komentarz" value="'.$o.'" />
            <input type="submit" name="Submit9" value="Powrót do zdjęcia" class="button is-danger has-text-white has-text-weight-bold ">
           
            </form>';
        }
    } 
    else if (isset($_POST["Submit8"])) {
        ob_end_clean();
        echo '<p class="title is-1 has-text-primary-light ">Zrezygnowano z oceny zdjęcia</p>
        <form action="foto.php"  method="post">
        <input type="hidden" name="idzdjecie" value="' . $p. '" />
    <input type="hidden" name="idalbum" value="' . $a . '" />
    <input type="hidden" name="idz" value="' . $p . '" />
    <input type="hidden" name="komentarz" value="'.$o.'" />
        <input type="submit" name="Submit9" value="Powrót do zdjęcia" class="button is-danger has-text-white has-text-weight-bold ">
       
        </form>';
    }
    $conn->close();
 
    ?>


    </div>
   </div>

   
</body>
</html>

