<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    

        <title>Rejestracja</title>
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



    <div class="container is-max-desktop mt-6">
        <div class="box has-background-primary">
          <h1 class="title has-text-centered has-text-primary-light">REJESTRACJA</h1>
        <form id="signup" class="form" method="post">
          
                <div class="field">
                    <p class="control has-icons-left">
                      <input
                        class="input has-background-primary-light"
                        type="text" name="username" id="username" autocomplete="off"
                        placeholder="Login"
                      />
                      <small class="has-text-danger-dark is-size-6" >&nbsp</small>
                      <span class="icon is-small is-left">
                        <i class="fa-solid fa-right-to-bracket"></i>
                      </span>
                    </p>
                  </div>
          
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                      <input
                        class="input has-background-primary-light"
                        type="text" name="email" id="email" autocomplete="off"
                        placeholder="Email"
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
                        type="password" name="password" id="password" autocomplete="off"
                        placeholder="Hasło"
                      />
                      <small class="has-text-danger-dark is-size-6" >&nbsp</small>
                      <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                      </span>
                    </p>
                    </div>
         


            
                <div class="field">
                    <p class="control has-icons-left">
                      <input
                        class="input has-background-primary-light"
                        type="password" name="confirm-password" id="confirm-password" autocomplete="off"
                        placeholder="Potwierdz Hasło"
                      />
                      <small class="has-text-danger-dark is-size-6" id="response" >&nbsp</small>
                      <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                      </span>
                    </p>
                  </div>
        

                  <div class="buttons is-centered">
                <input class="button is-danger has-text-weight-bold has-text-primary-light" type="submit" value="Zarejestruj się">
                    </div>
        </form>
        </div>
      </div>

    <div class="container is-max-desktop mt-6 mb-3">
      <div class="box has-background-primary">
        <h1 class="title has-text-centered has-text-primary-light">LOGOWANIE</h1>
    <form id="login" class="form">
          
      <div class="field">
          <p class="control has-icons-left">
            <input
              class="input has-background-primary-light"
              type="text" name="usernamelog" id="usernamelog" autocomplete="off"
              placeholder="Login"
            />
            <small class="has-text-danger-dark is-size-6" >&nbsp</small>
            <span class="icon is-small is-left">
              <i class="fa-solid fa-right-to-bracket"></i>
            </span>
          </p>
        </div>

        <div class="field">
          <p class="control has-icons-left">
            <input
              class="input has-background-primary-light"
              type="password" name="passwordlog" id="passwordlog" autocomplete="off"
              placeholder="Hasło"
            />
            <small class="has-text-danger-dark is-size-6" id="response2" >&nbsp</small>
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
    <script src="javascript/validation.js"></script>

    <div w3-include-html="stopka.html"></div>
    <script>
      includeHTML();
    </script>
</body>
</html>