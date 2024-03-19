var code_ajax = $("#code_ajax").val();

$(document).ready(function () {
    //getnew_notification();

    $(".notificationLink").click(function () {
        $("#notificationContainer").fadeToggle(300);
        $("#notification_count").fadeOut("slow");
        return false;
    });

    $(".notificationLink1").click(function () {
        $("#notificationContainer1").fadeToggle(300);
        $("#notification_count").fadeOut("slow");
        return false;
    });

    //Document Click hiding the popup 
    $(document).click(function () {
        $("#notificationContainer").hide();
        $("#notificationContainer1").hide();
    });

    //Popup on click
    $("#notificationContainer, #notificationContainer1").click(function () {
        return false;
    });

    $("#login_btn").click(function (event) {
        event.preventDefault();


        var emailvalue = $('#user_name').val();

        var passwords = $('#password').val();

        if (emailvalue == '') {

            successmsg("Please enter user name");
        } else if (validate_email(emailvalue) == 'invalid') {

            successmsg("Email id is invalid");
        } else if (passwords == "" || passwords == null) {

            successmsg("Password is empty");
        } else {
            showloader();
            $("#login_form").submit();
        }
    });

});

function showloader() {
    $(".loading").show();
}

function hideloader() {
    $(".loading").hide();
}

function page_redirect(page) {
    location.href = page;
}


function strong_check_password(passwords) {
    var strength = 1;

    /*length 5 characters or more*/
    if (passwords.length >= 5) {
        strength++;
    }

    /*contains lowercase characters*/
    if (passwords.match(/[a-z]+/)) {
        strength++;
    }

    /*contains digits*/
    if (passwords.match(/[0-9]+/)) {
        strength++;
    }

    /*contains uppercase characters*/
    if (passwords.match(/[A-Z]+/)) {
        strength++;
    }
    if (strength >= 5) {
        return 'yes';
    } else {
        return 'fail';
    }

}

function validate_email(email) {
    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
    if (!pattern.test(email)) {
        return 'invalid';
    } else {
        return 'valid';
    }
}



function uploadFile1(elementId) {
    if (!validateTempFile1(elementId)) return false;
    return true;
}
var _URL = window.URL || window.webkitURL;
// Function to validate file
function validateTempFile1(elementId) {
    var filePath = jQuery('#' + elementId).val();
    if (jQuery.trim(filePath) == '') {
        successmsg('Please select Image file.')
        jQuery('#' + elementId).focus();
        return false;
    }
    var fi = jQuery('#' + elementId)[0];

    var file;
    if ((file = fi.files[0])) {
        var img = new Image();
        var objectUrl = _URL.createObjectURL(file);
        img.onload = function () {
            if (this.width < 10 || this.height < 10) {
                jQuery('#' + elementId).val('');
                successmsg("Please Upload Min (10*10) Pixel Image");
                jQuery('#' + elementId).focus();
                return false;
            }
            _URL.revokeObjectURL(objectUrl);
        };
        img.src = objectUrl;
    }
    if (!uploadFilter1(elementId, "jpg|jpeg|png|gif", 'Please select Image file.')) {
        return false;
    }
    return true;
}


function uploadFile2(elementId, size) {
    if (!validateTempFile2(elementId, size)) return false;
    return true;
}

// Function to validate file
function validateTempFile2(elementId, sizes) {
    var filePath = jQuery('#' + elementId).val();
    if (jQuery.trim(filePath) == '') {
        successmsg('Please select Image file.')
        jQuery('#' + elementId).focus();
        return false;
    }
    var fi = jQuery('#' + elementId)[0];
    var file = fi.files[0];

    if (file.size > sizes) {
        jQuery('#' + elementId).val('');
        successmsg('File size too large.')
        jQuery('#' + elementId).focus();
        return false;
    }

    if (!uploadFilter1(elementId, "pdf|jpg|jpeg|png|gif", 'Please select Image or Pdf file.')) {
        return false;
    }
    return true;
}

function uploadFilter1(elementId, allowedExtensions, msg) {
    var obj = jQuery('#' + elementId);
    if (obj) {
        var filePath = obj.val();
        var fileParts = filePath.toLowerCase().split('.');
        var fileType = fileParts[fileParts.length - 1];
        var validExtensions = allowedExtensions.toLowerCase().split('|');

        if (validExtensions.indexOf(fileType) < 0) {
            jQuery('#' + elementId).val('');
            successmsg(msg);
            obj.focus();
            return false;
        }
    }
    return true;
}

function back_page(page) {
    location.href = page;
}



function successmsg(msg) {
    xdialog.confirm(msg, function () {
        // do work here if ok/yes selected...

    }, {
        style: 'width:420px;font-size:0.8rem;',
        buttons: {
            ok: 'OK '
        },
        oncancel: function () {
            // console.warn('Cancelled!');
        }
    });
}


function successmsg1(msg, locations) {
    xdialog.confirm(msg, function () {
        location.href = locations;

    }, {
        style: 'width:420px;font-size:0.8rem;',
        buttons: {
            ok: 'OK '
        },
        oncancel: function () {
            // console.warn('Cancelled!');
        }
    });
}


function confirm_box(msg) {
    xdialog.confirm(msg, function () {
        // do work here if ok/yes selected...

    }, {
        style: 'width:420px;font-size:0.8rem;',
        buttons: {
            ok: 'yes ',
            cancel: 'no '
        },
        oncancel: function () {
            // console.warn('Cancelled!');
        }
    });
}

function getnew_notification() {
    var code_ajax = $("#code_ajax").val();
    $.ajax({
        method: 'POST',
        url: 'pending_notification.php',
        data: {
            code: code_ajax
        },
        success: function (response) {

            var count = 1;
            var data = $.parseJSON(response);
            $("#new_noti_html").empty();
            if (data["status"] == "1") {

                $("#new_noti_count").text(data['count']);
                $("#new_noti_html").html(data['html_code']);
                $("#support_noti_count").text(data['chat_count']);
                $("#conv-notf-show").html(data['chat_html']);


            } else {
                $("#new_noti_count").text(0);
                $("#new_noti_html").html('');
                $("#support_noti_count").text(0);
                $("#conv-notf-show").html('');
            }

        }
    });
}

function redirect_page(page) {
    location.href = page;
}

