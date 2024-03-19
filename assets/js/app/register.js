const sendOtpBtn = document.getElementById('send-otp-btn');
const signinBtn = document.getElementById('signin_button');
var fullname = document.getElementById('fullname');
var email = document.getElementById('email');
var emailOtp = document.getElementById('emailOtp');
var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const sendSignupOtp = () => {
    sendOtpBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    sendOtpBtn.disabled = true;

    if (email.value == "" || email.value == null) {
        sendOtpBtn.innerHTML = 'Send OTP';
        sendOtpBtn.disabled = false;
        setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Email is required.');
    } else if (!emailRegex.test(email.value)) {
        sendOtpBtn.innerHTML = 'Send OTP';
        sendOtpBtn.disabled = false;
        setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Invalid email.');;
    } else {
        setSuccessMsg(email);
        $.ajax({
            method: 'POST',
            url: 'send-signup-otp',
            data: {
                email: email.value
            },
            success: function (response) {
                if (response.status) {
                    setSuccessMsg(email);
                    var phoneRemainingSeconds = 31;
                    phoneCountdownInterval = setInterval(function () {
                        phoneRemainingSeconds--;
                        var phoneFormattedSeconds = phoneRemainingSeconds < 10 ? "0" + phoneRemainingSeconds : phoneRemainingSeconds;
                        sendOtpBtn.innerHTML = '<span class="fw-bolder text-dark">00:' + phoneFormattedSeconds + '</span>';

                        if (phoneRemainingSeconds <= 0) {
                            // Reset the timer element and enable the button
                            clearInterval(phoneCountdownInterval);
                            sendOtpBtn.innerText = "Send OTP";
                            sendOtpBtn.disabled = false;
                        }
                    }, 1000);
                } else {
                    sendOtpBtn.innerHTML = 'Send OTP';
                    sendOtpBtn.disabled = false;
                    setErrorMsg(email, `<i class="fa-solid fa-circle-xmark"></i> ${response.message}`);
                }
            },
            error: function (response) {
                sendOtpBtn.innerHTML = 'Send OTP';
                sendOtpBtn.disabled = false;
                setErrorMsg(email, `<i class="fa-solid fa-circle-xmark"></i> ${response.responseJSON.msg}.`);
            }
        });
    }
}

const submitSignupForm = () => {
    signinBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    signinBtn.disabled = true;

    var fullnameFlag = false;
    var emailFlag = false;
    var emailOtpFlag = false;

    if (fullname.value == "" || fullname.value == null) {
        signinBtn.innerHTML = 'Submit';
        signinBtn.disabled = false;
        setErrorMsg(fullname, '<i class="fa-solid fa-circle-xmark"></i> Fullname is required.');
        fullnameFlag = false;
    } else {
        setSuccessMsg(fullname);
        fullnameFlag = true;
    }

    if (email.value == "" || email.value == null) {
        signinBtn.innerHTML = 'Submit';
        signinBtn.disabled = false;
        setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Email is required.');
        emailFlag = false;
    } else if (!emailRegex.test(email.value)) {
        signinBtn.innerHTML = 'Submit';
        signinBtn.disabled = false;
        setErrorMsg(email, '<i class="fa-solid fa-circle-xmark"></i> Invalid email.');;
        emailFlag = false;
    } else {
        setSuccessMsg(email);
        emailFlag = true;
    }

    if (emailOtp.value == "" || emailOtp.value == null) {
        signinBtn.innerHTML = 'Submit';
        signinBtn.disabled = false;
        setErrorMsg(emailOtp, '<i class="fa-solid fa-circle-xmark"></i> Otp is required.');
        emailOtpFlag = false;
    } else if (emailOtp.value.length !== 6) {
        signinBtn.innerHTML = 'Submit';
        signinBtn.disabled = false;
        setErrorMsg(emailOtp, '<i class="fa-solid fa-circle-xmark"></i> Invalid Otp. Otp should be 6 in length');
        emailOtpFlag = false;
    } else {
        setSuccessMsg(emailOtp);
        emailOtpFlag = true;
    }

    if (emailFlag == true && emailOtpFlag == true) {
        $.ajax({
            method: "POST",
            url: site_url + "register_data",
            data: {
                language: 1,
                securecode: securecode,
                fullname: fullname.value,
                email: email.value,
                otp: emailOtp.value,
                [csrfName]: csrfHash,
            },
            success: function (response) {
                signinBtn.innerHTML = 'Submit';
                signinBtn.disabled = false;

                if (response.status == 1) {
                    location.href = site_url;
                } else {
                    setErrorMsg(emailOtp, `<i class="fa-solid fa-circle-xmark"></i> ${response.message}`);
                }
            },
        });
    }
}

if (sendOtpBtn) {
    sendOtpBtn.addEventListener('click', (event) => {
        event.preventDefault();
        sendSignupOtp();
    });
}

if (signinBtn) {
    signinBtn.addEventListener('click', (event) => {
        event.preventDefault();
        submitSignupForm();
    })
}