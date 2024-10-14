
const usernameEl = document.querySelector('#username');
const emailEl = document.querySelector('#email');
const passwordEl = document.querySelector('#password');
const confirmPasswordEl = document.querySelector('#confirm-password');

const form = document.querySelector('#signup');


const checkUsername = () => {

    let valid = false;

    const min = 8,
        max = 16;

    const username = usernameEl.value.trim();

    if (!isRequired(username)) {
        showError(usernameEl, 'To pole nie może być puste.');
    } else if (!isBetween(username.length, min, max)) {
        showError(usernameEl, `Nazwa użytkownika musi mieć długość od ${min} do ${max} znaków.`);
    } else {
        showSuccess(usernameEl);
        valid = true;
    }
    return valid;
};


const checkEmail = () => {
    let valid = false;
    const email = emailEl.value.trim();
    if (!isRequired(email)) {
        showError(emailEl, 'To pole nie może być puste.');
    } else if (!isEmailValid(email)) {
        showError(emailEl, 'Email nie jest poprawny.');
    } else {
        showSuccess(emailEl);
        valid = true;
    }
    return valid;
};

const checkPassword = () => {
    let valid = false;


    const password = passwordEl.value.trim();

    if (!isRequired(password)) {
        showError(passwordEl, 'To pole nie może być puste.');
    } else if (!isPasswordSecure(password)) {
        showError(passwordEl, 'Hasło musi mieć długość od 8 do 20 znaków, minimum 1 dużą literę, 1 małą litere i 1 cyfrę. ');
    } else {
        showSuccess(passwordEl);
        valid = true;
    }

    return valid;
};

const checkConfirmPassword = () => {
    let valid = false;

    const confirmPassword = confirmPasswordEl.value.trim();
    const password = passwordEl.value.trim();

    if (!isRequired(confirmPassword)) {
        showError(confirmPasswordEl, 'Proszę powtórzyć hasło.');
    } else if (password !== confirmPassword) {
        showError(confirmPasswordEl, 'Hasła nie są takie same.');
    } else {
        showSuccess(confirmPasswordEl);
        valid = true;
    }

    return valid;
};

const isEmailValid = (email) => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

const isPasswordSecure = (password) => {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,20}$/;
    return re.test(password);
};

const isRequired = value => value === '' ? false : true;
const isBetween = (length, min, max) => length < min || length > max ? false : true;


const showError = (input, message) => {

    const formField = input.parentElement;

    formField.classList.remove('success');
    formField.classList.add('error');

 
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess = (input) => {
    
    const formField = input.parentElement;


    formField.classList.remove('error');
    formField.classList.add('success');

  
    const error = formField.querySelector('small');
    error.textContent ='\xa0';
}

form.addEventListener('submit', function (e) {
 
    e.preventDefault();

    let isUsernameValid = checkUsername(),
        isEmailValid = checkEmail(),
        isPasswordValid = checkPassword(),
        isConfirmPasswordValid = checkConfirmPassword();

    let isFormValid = isUsernameValid &&
        isEmailValid &&
        isPasswordValid &&
        isConfirmPasswordValid;

    if (isFormValid) {
         const jsonString = JSON.stringify({login: usernameEl.value, email: emailEl.value, password: passwordEl.value});
         const xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function()
 
          {
         if(xhr.readyState == 4 && xhr.status == 200)
    {
      document.getElementById("response").innerHTML = xhr.responseText;
    }
}
         xhr.open("POST", "rejestracja.php");
         xhr.setRequestHeader("Content-type", "application/json");
        xhr.send(jsonString);
    }
});


const debounce = (fn, delay = 500) => {
    let timeoutId;
    return (...args) => {
      
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
    
        timeoutId = setTimeout(() => {
            fn.apply(null, args)
        }, delay);
    };
};

form.addEventListener('input', debounce(function (e) {
    switch (e.target.id) {
        case 'username':
            checkUsername();
            break;
        case 'email':
            checkEmail();
            break;
        case 'password':
            checkPassword();
            break;
        case 'confirm-password':
            checkConfirmPassword();
            break;
    }
}));



// 



const usernameE2 = document.querySelector('#usernamelog');
const passwordE2 = document.querySelector('#passwordlog');
const form2 = document.querySelector('#login');


const checkUsername2 = () => {

    let valid = false;

    const min = 8,
        max = 16;

    const username2 = usernameE2.value.trim();

    if (!isRequired2(username2)) {
        showError2(usernameE2, 'To pole nie może być puste.');
    } else if (!isBetween2(username2.length, min, max)) {
        showError2(usernameE2, `Nazwa użytkownika musi mieć długość od ${min} do ${max} znaków.`);
    } else {
        showSuccess2(usernameE2);
        valid = true;
    }
    return valid;
};



const checkPassword2 = () => {
    let valid = false;


    const password2 = passwordE2.value.trim();

    if (!isRequired2(password2)) {
        showError2(passwordE2, 'To pole nie może być puste.');
    } else if (!isPasswordSecure2(password2)) {
        showError2(passwordE2, 'Hasło musi mieć długość od 8 do 20 znaków, minimum 1 dużą literę, 1 małą litere i 1 cyfrę. ');
    } else {
        showSuccess2(passwordE2);
        valid = true;
    }

    return valid;
};

const isPasswordSecure2 = (password) => {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,20}$/;
    return re.test(password);
};

const isRequired2 = value => value === '' ? false : true;
const isBetween2 = (length, min, max) => length < min || length > max ? false : true;


const showError2 = (input, message) => {
    // get the form-field element
    const formField = input.parentElement;
    // add the error class
    formField.classList.remove('success');
    formField.classList.add('error');

    // show the error message
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess2 = (input) => {
    // get the form-field element
    const formField = input.parentElement;

    // remove the error class
    formField.classList.remove('error');
    formField.classList.add('success');

    // hide the error message
    const error = formField.querySelector('small');
    error.textContent ='\xa0';
}

form2.addEventListener('submit', function (e) {
    // prevent the form from submitting
    e.preventDefault();

    // validate fields
    let isUsernameValid = checkUsername2(),
        isPasswordValid = checkPassword2();
        

    let isFormValid = isUsernameValid &&
        isPasswordValid ;

    // submit to the server if the form is valid
    if (isFormValid) {
        
        const jsonString2 = JSON.stringify({login: usernameE2.value, password: passwordE2.value});
        const xhr2 = new XMLHttpRequest();

       xhr2.onreadystatechange = function()

         {
        if(xhr2.readyState == 4 && xhr2.status == 200)
   {
     document.getElementById("response2").innerHTML = xhr2.responseText;
   }
}
        xhr2.open("POST", "logowania.php");
        xhr2.setRequestHeader("Content-type", "application/json");
       xhr2.send(jsonString2);
    }

});


const debounce2 = (fn, delay = 500) => {
    let timeoutId;
    return (...args) => {
        // cancel the previous timer
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        // setup a new timer
        timeoutId = setTimeout(() => {
            fn.apply(null, args)
        }, delay);
    };
};

form2.addEventListener('input', debounce2(function (e) {
    switch (e.target.id) {
        case 'username':
            checkUsername2();
            break;
        case 'password':
            checkPassword2();
            break;
     
    }
}));



// 
