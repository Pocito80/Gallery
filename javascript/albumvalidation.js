const albumnameE1 = document.querySelector('#albumname');

const form = document.querySelector('#albumadd');


const checkAlbumName = () => {

    let valid = false;

    const min = 1,
        max = 100;

    const albumname = albumnameE1.value.trim();

    if (!isRequired2(albumname)) {
        showError2(albumnameE1, 'To pole nie może być puste.');
    } else if (!isBetween2(albumname.length, min, max)) {
        showError2(albumnameE1, `Nazwa albumu nie może być dłuższa niż ${max} znaków.`);
    } else {
        showSuccess2(albumnameE1);
        valid = true;
    }
    return valid;
};


const isRequired2 = value => value === '' ? false : true;
const isBetween2 = (length, min, max) => length < min || length > max ? false : true;


const showError2 = (input, message) => {
   
    const formField = input.parentElement;
    // add the error class
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

form.addEventListener('submit', function (e) {
 
    e.preventDefault();


    let isAlbumNameValid = checkAlbumName();
        

    let isFormValid = isAlbumNameValid;

    if (isFormValid) {
        
        const jsonString2 = JSON.stringify({album: albumnameE1.value});
        const xhr2 = new XMLHttpRequest();

       xhr2.onreadystatechange = function()

         {
        if(xhr2.readyState == 4 && xhr2.status == 200)
   {
     document.getElementById("response2").innerHTML = xhr2.responseText;
   }
}
        xhr2.open("POST", "dodaj-album-ok.php");
        xhr2.setRequestHeader("Content-type", "application/json");
       xhr2.send(jsonString2);
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

form.addEventListener('input', debounce2(function (e) {
    switch (e.target.id) {
        case 'albumname':
            checkAlbumName();
           
     
    }
}));


// 
