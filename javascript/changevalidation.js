

const emailEl = document.querySelector('#email');
const passwordEl = document.querySelector('#passwordE');


const form = document.querySelector('#emailchange');


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

    let isEmailValid = checkEmail(),
        isPasswordValid = checkPassword();

    let isFormValid = 
        isEmailValid &&
        isPasswordValid;

    if (isFormValid) {
         const jsonString = JSON.stringify({email: emailEl.value, password: passwordEl.value});
         const xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function()
 
          {
         if(xhr.readyState == 4 && xhr.status == 200)
    {
      document.getElementById("response3").innerHTML = xhr.responseText;
    }
}
         xhr.open("POST", "email.php");
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
        case 'email':
            checkEmail();
            break;
        case 'password':
            checkPassword();
            break;
    }
}));



// 



const passwordE2 = document.querySelector('#passwordold');
const passwordE3 = document.querySelector('#passwordnew');
const confirmPasswordEl = document.querySelector('#passwordcon');

const form2 = document.querySelector('#haslo');


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

const checkPassword3 = () => {
    let valid = false;


    const password3 = passwordE3.value.trim();
    const password2 = passwordE2.value.trim();

    if (!isRequired2(password3)) {
        showError2(passwordE3, 'To pole nie może być puste.');
    } else if (!isPasswordSecure3(password3)) {
        showError2(passwordE3, 'Hasło musi mieć długość od 8 do 20 znaków, minimum 1 dużą literę, 1 małą litere i 1 cyfrę. ');
    } else if (password3 == password2) {
        showError2(passwordE3, 'Nowe hasło nie może być takie samo jak stare.');
    } else {
        showSuccess2(passwordE3);
        valid = true;
    }

    return valid;
};

const checkConfirmPassword = () => {
    let valid = false;

    const confirmPassword = confirmPasswordEl.value.trim();
    const password3 = passwordE3.value.trim();

    if (!isRequired2(confirmPassword)) {
        showError2(confirmPasswordEl, 'Proszę powtórzyć hasło.');
    } else if (password3 !== confirmPassword) {
        showError2(confirmPasswordEl, 'Hasła nie są takie same.');
    } else {
        showSuccess2(confirmPasswordEl);
        valid = true;
    }

    return valid;
};

const isPasswordSecure2 = (password) => {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,20}$/;
    return re.test(password);
};

const isPasswordSecure3 = (password) => {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,20}$/;
    return re.test(password);
};


const isRequired2 = value => value === '' ? false : true;
const isBetween2 = (length, min, max) => length < min || length > max ? false : true;


const showError2 = (input, message) => {

    const formField = input.parentElement;

    formField.classList.remove('success');
    formField.classList.add('error');

 
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess2 = (input) => {
    
    const formField = input.parentElement;


    formField.classList.remove('error');
    formField.classList.add('success');

  
    const error = formField.querySelector('small');
    error.textContent ='\xa0';
}

form2.addEventListener('submit', function (e) {
 
    e.preventDefault();

    let 
        isPasswordValid2 = checkPassword2(),
        isPasswordValid3 = checkPassword3(),
        isConfirmPasswordValid = checkConfirmPassword();

    let isFormValid2 = isPasswordValid2 &&
        isPasswordValid3 &&
        isConfirmPasswordValid;
   
    if (isFormValid2) {
         const jsonString = JSON.stringify({passwordold: passwordE2.value, passwordnew: passwordE3.value, passwordcon: confirmPasswordEl.value});
         const xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function()
 
          {
         if(xhr.readyState == 4 && xhr.status == 200)
    {
      document.getElementById("response4").innerHTML = xhr.responseText;
    }
}
         xhr.open("POST", "haslo.php");
         xhr.setRequestHeader("Content-type", "application/json");
        xhr.send(jsonString);
    }
});


const debounce2 = (fn, delay = 500) => {
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

form2.addEventListener('input', debounce2(function (e) {
    switch (e.target.id) {
       
        case 'password':
            checkPassword2();
            break;
            case 'password':
            checkPassword3();
            break;
        case 'confirm-password':
            checkConfirmPassword();
            break;
    }
}));





// 


const passwordE4 = document.querySelector('#passwordDel');
const form3 = document.querySelector('#del');





const checkPassword4 = () => {
    let valid = false;


    const password4 = passwordE4.value.trim();

    if (!isRequired4(password4)) {
        showError4(passwordE4, 'To pole nie może być puste.');
    } else if (!isPasswordSecure4(password4)) {
        showError4(passwordE4, 'Hasło musi mieć długość od 8 do 20 znaków, minimum 1 dużą literę, 1 małą litere i 1 cyfrę. ');
    } else {
        showSuccess4(passwordE4);
        valid = true;
    }

    return valid;
};


const isPasswordSecure4 = (password) => {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,20}$/;
    return re.test(password);
};

const isRequired4 = value => value === '' ? false : true;
const isBetween4 = (length, min, max) => length < min || length > max ? false : true;


const showError4 = (input, message) => {

    const formField = input.parentElement;

    formField.classList.remove('success');
    formField.classList.add('error');

 
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess4 = (input) => {
    
    const formField = input.parentElement;


    formField.classList.remove('error');
    formField.classList.add('success');

  
    const error = formField.querySelector('small');
    error.textContent ='\xa0';
}

form3.addEventListener('submit', function (e) {
 
    e.preventDefault();

    let 
        isPasswordValid4 = checkPassword4();


    let isFormValid4 = 
        isPasswordValid4 ;

    if (isFormValid4) {
         const jsonString = JSON.stringify({passwordDel: passwordE4.value});
         const xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function()
 
          {
         if(xhr.readyState == 4 && xhr.status == 200)
    {
      document.getElementById("response5").innerHTML = xhr.responseText;
    }
}
         xhr.open("POST", "del.php");
         xhr.setRequestHeader("Content-type", "application/json");
        xhr.send(jsonString);
    }
});
