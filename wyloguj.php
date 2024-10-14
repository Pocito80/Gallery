<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Wylogowanie</title>
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

  <?php
          session_start();
          session_unset();
          session_destroy();
      ?>

  <div class="container is-max-desktop mt-6">
        <div class="box has-background-primary has-text-centered">
        <p class="title is-1 has-text-primary-light">Wylogowanie Pomyślne</p>
        <a class="button is-danger "  href="index.php">Przejdz do strony głównej</a>
      
</div>
</div>

  </body>
</html>




