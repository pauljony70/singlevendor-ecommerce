function getStatedata(stateid = '') {
    $.ajax({
        method: 'GET',
        url: site_url + "all-state",
        success: function (response) {
            if (response.status) {
                $('#state').empty();
                $('#state').append('<option value="0">Select state</option>');
                $.each(response.data, function () {
                    $('#state').append('<option value="' + this.stateid + '">' + this.name + '</option>');
                });
            } else {
                console.error('Failed to fetch states: ' + response.message);
            }
        }
    });
}

function getCitydata(stateid, cityid = '') {
    $.ajax({
        method: 'GET',
        url: site_url + "all-city",
        data: {
            stateid: stateid
        },
        success: function (response) {
            if (response.status) {
                $('#city').empty();
                $('#city').append('<option value="0">Select sity</option>');
                $.each(response.data, function () {
                    $('#city').append('<option value="' + this.city_id + '">' + this.city_name + '</option>');
                });
            } else {
                console.error('Failed to fetch cities: ' + response.message);
            }
        }
    });
}

async function place_order_data(ele) {
    ele.disabled = true;
    ele.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    try {
        // Wait for both functions to complete
        // await validateAddressForm();

        var form_data = new FormData();
        form_data.append('language', 1);
        form_data.append('fullname', $("#fullname").val());
        form_data.append('email', $("#email").val());
        form_data.append('mobile', $("#phone").val());
        form_data.append('fulladdress', $("#address").val());
        form_data.append('city', $('#city').find(":selected").text());
        form_data.append('city_id', $("#city").val());
        form_data.append('state', $('#state').find(":selected").text());
        form_data.append('state_id', $("#state").val());
        form_data.append('pincode', $("#pincode").val());
        form_data.append('addresstype', 'Home');
        form_data.append('payment_id', 'Pay12345');
        form_data.append('payment_mode', $('input[name="flexRadioDefault"]:checked').val());

        $.ajax({
            method: "post",
            url: site_url + "placeorder",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {

                if (response.status) {
                    location.href = site_url + "thankyou/" + response.data.order_id;
                } else {
                    ele.disabled = false;
                    ele.innerHTML = "Place Order"
                    Swal.fire({
                        text: response.msg,
                        type: "error",
                        showCancelButton: true,
                        showCloseButton: true,
                    });
                }
            },
        });

    } catch (error) {
        // At least one of the functions failed
        // console.error('Error:', error);

        ele.disabled = false;
        ele.innerHTML = "Place Order"
    }
}


getStatedata();
getCitydata(0);
document.getElementById('state').addEventListener('change', function () {
    getCitydata(this.value);
})

$(document).on('change', '.defaultAdderess', function () {
    var address_id = $('.defaultAdderess:checked').val();
    var user_id = $("#user_id").val();
    $.ajax({
        method: "post",
        url: site_url + "getUserAddress",
        data: {
            user_id: user_id,
            address_id: address_id
        },
        success: function (response) {
            $("#fullname").val(response.fullname);
            $("#email").val(response.email);
            $("#phone").val(response.phone);
            $("#address").val(response.address);
            $("#pincode").val(response.pincode);
            $("#state").val(response.state_id);
            $('#city').val(response.city_id);
        }
    });
});