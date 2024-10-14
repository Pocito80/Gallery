<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Dodawanie Albumu</title>
        <link rel="stylesheet" href="Style/style.css" type="text/css" />
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"
        />
        <script
          src="https://kit.fontawesome.com/92b04f16d6.js"
          crossorigin="anonymous"
        ></script>
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      </head>
     <script src="include/include.js"></script>
<body>

    <div w3-include-html="menu.php"></div>




    <div class="container is-max-desktop mt-6 mb-3">
      <div class="box has-background-primary">
        <h1 class="title has-text-centered has-text-primary-light">Załóż Nowy Album</h1>
    <form id="albumadd" class="form">
          
      <div class="field">
          <p class="control has-icons-left">
            <input
              class="input has-background-primary-light"
              type="text" name="albumname" id="albumname" autocomplete="off"
              placeholder="Nazwa Albumu"
            />
            <small class="has-text-danger-dark is-size-6" id="response2"  >&nbsp</small>
            <span class="icon is-small is-left">
            <i class="fa-sharp fa-solid fa-images"></i>
            </span>
          </p>
        </div>

           <div class="buttons is-centered">
                <input class="button is-danger has-text-weight-bold has-text-primary-light" type="submit" value="Załóż Album" >
                    </div>
</form>
</div>
</div>
    <script src="javascript/albumvalidation.js"></script>
    <div w3-include-html="stopka.html"></div>
    <script>
      includeHTML();
    </script>
</body>
</html>