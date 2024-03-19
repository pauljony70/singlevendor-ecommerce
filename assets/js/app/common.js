function enforceMaxLength(input) {
    const maxLength = input.getAttribute('maxlength');
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);
    }
}

function setErrorMsg(ele, errormsgs) {
    const formGroup = ele.parentElement;
    const formInput = formGroup.querySelector('.form-control');
    const span = formGroup.querySelector('#error');
    span.innerHTML = errormsgs;
    formInput.classList.add('is-invalid');
    span.className = "invalid-feedback fw-bolder";
}

function setSuccessMsg(ele) {
    const formGroup = ele.parentElement;
    const formInput = formGroup.querySelector('.form-control');
    formInput.classList.remove('is-invalid');
}

function setSelectErrorMsg(ele, errormsgs) {
    const formGroup = ele.parentElement;
    const formInput = formGroup.querySelector('.form-select');
    const span = formGroup.querySelector('#error');
    span.innerHTML = errormsgs;
    formInput.classList.add('is-invalid');
    span.className = "invalid-feedback fw-bolder";
}

function setSelectSuccessMsg(ele) {
    const formGroup = ele.parentElement;
    const formInput = formGroup.querySelector('.form-select');
    formInput.classList.remove('is-invalid');
}

// function to convert hex color to RGB
function hexToRgb(hex) {
    // remove the "#" symbol
    hex = hex.replace("#", "");
    // convert to RGB
    const r = parseInt(hex.substring(0, 2), 16);
    const g = parseInt(hex.substring(2, 4), 16);
    const b = parseInt(hex.substring(4, 6), 16);

    return {
        r,
        g,
        b
    };
}

const validateAddressForm = async () => {
    var fullname = document.querySelector("#fullname");
    var email = document.querySelector("#email");
    var mobile = document.querySelector("#phone");
    var fulladdress = document.querySelector("#address");
    var pincode = document.querySelector("#pincode");
    var state = document.querySelector("#state");
    var city = document.querySelector("#city");

    var flag_fullname = 0;
    var flag_email = 0;
    var flag_mobile = 0;
    var flag_fulladdress = 0;
    var flag_pincode = 0;
    var flag_state = 0;
    var flag_city = 0;

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var firstErrorElement = null;

    if (fullname.value == '') {
        flag_fullname = 0;
        setErrorMsg(fullname, '<i class="fa-solid fa-circle-xmark"></i> Full name is required.');
        if (!firstErrorElement) {
            firstErrorElement = fullname;
        }
    } else {
        flag_fullname = 1;
        setSuccessMsg(fullname);
    }
    if (email.value == '') {
        flag_email = 0;
        setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Email is required.');
        if (!firstErrorElement) {
            firstErrorElement = email;
        }
    } else if (!emailRegex.test(email.value)) {
        flag_email = 0;
        setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Please enter a valid email address.');
        if (!firstErrorElement) {
            firstErrorElement = email;
        }
    } else {
        flag_email = 1;
        setSuccessMsg(email);
    }
    if (mobile.value == '') {
        flag_mobile = 0;
        setErrorMsg(mobile, '<i class="fa-solid fa-circle-xmark"></i> Mobile is required.');
        if (!firstErrorElement) {
            firstErrorElement = mobile;
        }
    } else {
        flag_mobile = 1;
        setSuccessMsg(mobile);
    }
    if (fulladdress.value == '') {
        flag_fulladdress = 0;
        setErrorMsg(fulladdress, '<i class="fa-solid fa-circle-xmark"></i> Address is required.');
        if (!firstErrorElement) {
            firstErrorElement = fulladdress;
        }
    } else {
        flag_fulladdress = 1;
        setSuccessMsg(fulladdress);
    }
    if (pincode.value == '') {
        flag_pincode = 0;
        setErrorMsg(pincode, '<i class="fa-solid fa-circle-xmark"></i> Pincode is required.');
        if (!firstErrorElement) {
            firstErrorElement = pincode;
        }
    } else {
        flag_pincode = 1;
        setSuccessMsg(pincode);
    }
    if (state.value == '') {
        flag_state = 0;
        setSelectErrorMsg(state, '<i class="fa-solid fa-circle-xmark"></i> State is required.');
        if (!firstErrorElement) {
            firstErrorElement = state;
        }
    } else {
        flag_state = 1;
        setSelectSuccessMsg(state);
    }

    if (city.value == '') {
        flag_city = 0;
        setSelectErrorMsg(city, '<i class="fa-solid fa-circle-xmark"></i> City is required.');
        if (!firstErrorElement) {
            firstErrorElement = city;
        }
    } else {
        flag_city = 1;
        setSelectSuccessMsg(city);
    }

    // Set focus on the first error element
    if (firstErrorElement) {
        firstErrorElement.focus();
    }

    if (flag_fullname === 1 && flag_email === 1 && flag_mobile === 1 && flag_fulladdress === 1 && flag_pincode === 1 && flag_state === 1 && flag_city === 1) {
        return true;
    } else if (flag_fullname === 0 && flag_email === 0 && flag_mobile === 0 && flag_fulladdress === 0 && flag_pincode === 0 && flag_state === 0 && flag_city === 0) {
        Swal.fire({
            text: 'Please select or add address!',
            type: "error",
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: theme_colour,
        });
        throw new Error('Please select or add address!'); // Throw an error if condition not met
    } else {
        Swal.fire({
            text: 'Please complete the address!',
            type: "warning",
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: theme_colour,
        });
        throw new Error('Validation failed'); // Throw an error if validation fails
    }
}