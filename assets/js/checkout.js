var csrfName = $(".txt_csrfname").attr("name"); //
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash
var securecode = $(".securecode").val();
var user_id = $("#user_id").val();

$(function () {
  // window.onload = get_user_address(user_id);
  window.onload = get_products_summery(user_id);
  window.onload = get_delivery_address();
});

function change_address() {
  location.href = site_url + "address_list";
}

function get_user_address(user_id) {
  event.preventDefault();

  console.log("user id "+user_id);
  $.ajax({
    //url: "<?php echo $API_URL; ?>getUserAddress.php",
    type: "POST",

    url: site_url + "getUserAddress",

    data: {
      language: 1,
      user_id: global_user_id,
      securecode: securecode,
      [csrfName]: csrfHash,
    },

    success: function (html) {
      console.log(html);
      var catObj = JSON.parse(html);
      var addressArray = catObj.Information.address_details;
      var defaultaddress = catObj.Information.defaultaddress;
      $("#delivery_add_id").val(defaultaddress);
      var address_html = "";
      var addressArray_len = addressArray.length;
      console.log(addressArray_len);
      for (a = 0; a < addressArray_len; a++) {
        var address_list = addressArray[a];
        var address_id = address_list["address_id"];
        var address1 = address_list["address1"];
        var address2 = address_list["address2"];
        var city = address_list["city"];
        var email = address_list["email"];
        var fullname = address_list["fullname"];
        var phone = address_list["phone"];
        var pincode = address_list["pincode"];
        var state = address_list["state"];
        if (defaultaddress == address_id) {
          address_html +=
            '<div class="w-12 rounded-3 px-3 py-2 mb-3 border-cust" id="address_div' +
            address_id +
            '"> <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> <p class="mb-0 fw-500 black-text fs-6">' +
            fullname +
            '</p> <p class="mb-0 black-text fs-6">' +
            address1 +
            ", " +
            address2 +
            '</p> <p class="mb-0 black-text fs-6">' +
            city +
            ", " +
            state +
            '</p> <p class="mb-0 black-text fs-6">' +
            pincode +
            '</p> <p class="mb-0 black-text fs-6">' +
            phone +
            '</p> <p class="mb-0 black-text fs-6">' +
            email +
            "</p> </div> </div>";

          //   address_html += "<p>" + email + "</p> ";
          //   address_html +=;

          //   address_html += "</div>";
        }
      }

      var shippingfees = catObj.Information.shippingfees;

      //	$("#shippingfee").text(shippingfees);

      $("#totalshipping_fee").val(shippingfees);

      /*	var deliverytime = catObj.Information.deliverytime;

        var deli_length = deliverytime.length;

        var delivery_html = '<option value="">Select Time</option>';

        for(d=0;d<deli_length;d++){

          var time = deliverytime[d];

          delivery_html += '<option value="'+time+'">'+time+'</option>';

        }*/

      //alert('cccccc');

      $("#delivery_address_id").html(address_html);

      $.ajax({
        url: site_url + "get_shopi_data",
        type: "POST" /* or type:"GET" or type:"PUT" */,
        data: {
          email: email,
          phone: phone,
          csrfName: csrfHash,
        },

        success: function (result) {
          var catObj = JSON.parse(result);
          var score = catObj.Information.score;
          var phone = catObj.Information.phone;
          var name = catObj.Information.name;
          var email = catObj.Information.email;
          var total = catObj.Information.total;
          var completed = catObj.Information.completed;
          var returns = catObj.Information.returns;
          var cancelled = catObj.Information.cancelled;
          var pending = catObj.Information.pending;
          var confirm = catObj.Information.confirm;

          // alert($('input[type=radio][name="flexRadioDefault"][value="3"]'));

          var radio_html = "";

          /*  if (score < 40) {
              $('input[type=radio][name="flexRadioDefault"][value="2"]').prop(
                "disabled",
                true
              );
            } else if (score >= 40 && score < 70) {
              // pay shipping fee only
  
              $('input[type=radio][name="flexRadioDefault"][value="2"]').prop(
                "disabled",
                true
              );
  
              radio_html +=
                '<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="3"><label class="form-check-label" for="flexRadioDefault2">pay shipping fee only</label><p>Pay with shipping fee upon delivery.</p>';
  
              $("#cod_divs").hide();
            } else if (score >= 70) {
              // both enabled
            }*/

          $("#radio_data").html(radio_html);

          var score_html = "";

          score_html +=
            '<table class="table" border="1" style="text-align:center"><thead><tr><th colspan="3">Trust Score <br><span style="color:green;">' +
            score +
            "%</span></th></tr></thead><tbody><tr><td>Total Order: " +
            total +
            "</td><td>Completed : " +
            completed +
            "</td><td>Confirm : " +
            confirm +
            "</td></tr><tr><td>Pending : " +
            pending +
            "</td><td>Returned : " +
            returns +
            "</td><td>Cancelled : " +
            cancelled +
            "</td></tr></tbody></table>";

          //$("#Score_data").html(score_html);
        },
      });
    },
  });
}

function get_delivery_address() {
  console.log("user id "+global_user_id);
  $.ajax({
    //url: "<?php echo $API_URL; ?>getUserAddress.php",

    type: "POST",
    url: site_url + "getUserAddress",
    data: {
      language: 1,
      securecode: securecode,
      user_id: global_user_id,
      [csrfName]: csrfHash,
    },

    success: function (html) {
      console.log("2"+html)
      var catObj = JSON.parse(html);
      var addressArray = catObj.Information.address_details;
      var defaultaddress = catObj.Information.defaultaddress;
      $("#delivery_add_id").val(defaultaddress);
      var address_html = "";
      var addressArray_len = addressArray.length;
      for (a = 0; a < addressArray_len; a++) {
        var address_list = addressArray[a];
        var address_id = address_list["address_id"];
        var address1 = address_list["address1"];
        var address2 = address_list["address2"];
        var city = address_list["city"];
        var email = address_list["email"];
        var fullname = address_list["fullname"];
        var phone = address_list["phone"];
        var pincode = address_list["pincode"];
        var state = address_list["state"];
        address_html +=
          '<div class="w-12 rounded-3 px-2 py-3 px-md-3 px-xl-4 mb-2 border-cust" id="address_div' +
          address_id +
          '"> <div class="row"> <div class="col-12 col-sm-12 col-md-9 col-lg-8 col-xl-7"> <p class="mb-0 fw-500 black-text fs-6">' +
          fullname +
          '</p> <p class="mb-0 text-muted fs-6">' +
          address1 +
          ", " +
          address2 +
          '</p> <p class="mb-0 text-muted fs-6">' +
          city +
          ", " +
          state +
          '</p> <p class="mb-0 text-muted fs-6">' +
          pincode +
          '</p> <p class="mb-0 text-muted fs-6">' +
          phone +
          '</p> <p class="mb-0 text-muted fs-6">' +
          email +
          '</p> </div> <div class="col-12 col-sm-12 col-md-3 col-lg-4 col-xl-5 mt-3 mt-md-0"> <div class="col-12 h-100 d-flex flex-md-column justify-content-around">';

        address_html +=
          '<a class="d-flex justify-content-end" role="button" id="delete_address' +
          address_id +
          '" onclick="delete_address(' +
          address_id +
          ');"> <i class="bx bxs-trash-alt fs-4 black-text" title="delete address" aria-hidden="true"></i></a>';

        if (defaultaddress == address_id) {
          address_html +=
            '<a class="d-flex justify-content-end" role="button" id="default_add' +
            address_id +
            '"> <i class="bx bxs-check-square fs-4 accent-color" title="selected address" aria-hidden="true"></i> </a> ';
        } else {
          address_html +=
            '<a class="d-flex justify-content-end" role="button" id="default_add' +
            address_id +
            '" onclick="add_default_address(' +
            address_id +
            ');"> <i class="bx bx-check-square fs-4 black-text" title="select address" aria-hidden="true"></i> </a> ';
        }

        address_html += " </div> </div> </div> </div> ";
        // address_html +=
        //   '<div class="delivery-add inner-wish" id="address_div' +
        //   address_id +
        //   '"><p>' +
        //   fullname +
        //   "</p>  <p>" +
        //   address1 +
        //   ", " +
        //   address2 +
        //   "</p>  <p>" +
        //   city +
        //   ", " +
        //   state +
        //   "</p> <p>" +
        //   pincode +
        //   "</p> <p>" +
        //   phone +
        //   "</p>";

        // address_html += "<p>" + email + '</p> <div class="right">';

        // if (defaultaddress == address_id) {
        //   address_html +=
        // '<span class="cart" id="default_add' +
        // address_id +
        // '"><i class="fa fa-check-square"></i></span>';
        // } else {
        //   address_html +=
        // '<span class="cart" id="default_add' +
        // address_id +
        // '" onclick="add_default_address(' +
        // address_id +
        // ');"><i class="fa fa-square"></i></span>';
        // }

        // address_html +=
        //   '<span class="close" id="delete_address' +
        //   address_id +
        //   '" onclick="delete_address(' +
        //   address_id +
        //   ');"><i class="fa fa-times" aria-hidden="true"></i></span>';

        // address_html += "</div></div>";
      }

      $("#delivery_address_id1").html(address_html);
    },
  });
}

function add_default_address(address_id) {
  if (address_id) {
    $("#default_add" + address_id).html(
      '<i class="fa fa-spinner fa-spin"></i>'
    );

    $.ajax({
      type: "POST",

      url: site_url + "update_defaultaddress",

      data: {
        language: 1,
        securecode: securecode,
        user_id: user_id,
        default_addressid: address_id,
        [csrfName]: csrfHash,
      },

      success: function (html) {
        $("#default_add" + address_id).html(
          '<i class="bx bxs-check-square fs-4 accent-color"></i>'
        );

        //$("#address_div"+address_id).remove();
      },
    });
  }
}

//function for delete user address

function delete_address(address_id) {
  if (confirm("Are you sure you want to delete this address?")) {
    $("#delete_address" + address_id).html(
      '<i class="fa fa-spinner fa-spin"></i>'
    );

    $.ajax({
      //url: "<?php echo $API_URL; ?>delete_address.php",

      type: "POST",

      url: site_url + "delete_address",

      data: {
        language: 1,
        securecode: securecode,
        user_id: user_id,
        address_id: address_id,
        [csrfName]: csrfHash,
      },

      success: function (html) {
        $("#address_div" + address_id).remove();
      },
    });
  }
}

function get_products_summery(user_id) {
  //alert('dddd');

  $.ajax({
    //url: "<?php echo $API_URL; ?>getordersummery.php", 

    type: "POST",

    url: site_url + "getordersummery",

    data: {
      language: 1,
      securecode: securecode,
      user_id: global_user_id,
      [csrfName]: csrfHash,
    },

    success: function (html) {
      $(".loader").remove();

      var catObj = JSON.parse(html);
      var cartArray = catObj.Information;
      var cart_prod_array = cartArray.prod_details;
      var total_cart = cart_prod_array.length;
      var shippingfee = cartArray.shippingfee;
      var cart_totalprice = cartArray.subtotal;
      cart_totalprice = cart_totalprice.replace(/,/g, "");
      var cgst = cartArray.cgst;
      var igst = cartArray.igst;

      //var shippingfee = 	parseInt($("#shippingfee").text());// cartArray.shippingfee;

      //console.log(shippingfee);

      var total_cart_final = Number(cart_totalprice) + Number(shippingfee) + Number(cgst) + Number(igst); // ; 
      //alert(total_cart_final);

      $("#cart_totalprice").text("₹ " + total_cart_final);
      $("#merchant_total").val(total_cart_final);
      $("#merchant_amount").val(total_cart_final);
      //alert(total_cart_final);

      $("#total_cart_final").text("₹ " + cart_totalprice);

      //alert(cartArray.shippingfee);
      var gst = parseInt(cgst) + parseInt(igst);
      $("#gst").text("₹ " + gst);
      $("#cgst").text(cgst);
      $("#igst").text(igst);

      if (shippingfee == 0) {
        $("#shippingfee").text("Free Shipping");
      } else {
        $("#shippingfee").text("₹ " + shippingfee);
      }

      $("#totalshipping_fee").val(shippingfee);

      //	$("#total_price_payment").val(total_cart_final);

      $("#total_price_payment").val(total_cart_final);
    },
  });
}

$(document).ready(function () {
  $("#address_save_btn").click(function () {
    event.preventDefault();
    // alert("jiof")
    var valid_user_name = false;
    var valid_user_email = false;
    var valid_address_phone = false;
    var valid_address_line1 = false;
    var valid_address_city = false;
    var valid_address_state = false;
    var valid_address_pincode = false;

    var user_name = $("#address_full_name").val();
    var user_emails = $("#address_email").val();
    var address_phone = $("#address_phone").val();
    var address_line1 = $("#address_line1").val();
    var address_line2 = $("#address_line2").val();
    var address_city = $("#address_city").val();
    var address_state = $("#address_state").val();
    var address_pincode = $("#address_pincode").val();

    if (user_name == "") {
      $("input#address_full_name + .error").remove();

      $("#address_full_name").after(
        "<div class='error'>Please enter full name.</div>"
      );
    } else {
      $("input#address_full_name + .error").remove();

      valid_user_name = true;
    }
    if (address_line1 == "") {
      $("input#address_line1 + .error").remove();

      $("#address_line1").after(
        "<div class='error'>Please enter address line 1.</div>"
      );
    } else {
      $("input#address_line1 + .error").remove();

      valid_address_line1 = true;
    }

    if (address_city == "") {
      $("input#address_city + .error").remove();

      $("#address_city").after("<div class='error'>Please enter city.</div>");
    } else {
      $("input#address_city + .error").remove();

      valid_address_city = true;
    }

    if (address_state == "") {
      $("input#address_state + .error").remove();

      $("#address_state").after("<div class='error'>Please enter state.</div>");
    } else {
      $("input#address_state + .error").remove();

      valid_address_state = true;
    }

    if (address_pincode == "") {
      $("input#address_pincode + .error").remove();

      $("#address_pincode").after(
        "<div class='error'>Please enter pincode.</div>"
      );
    } else {
      $("input#address_pincode + .error").remove();

      valid_address_pincode = true;
    }

    var phone_length = address_phone.length;

    if (address_phone == "") {
      $("input#address_phone + .error").remove();

      $("#address_phone").after("<div class='error'>Please enter phone.</div>");
    } else if (phone_length != 10) {
      $("input#address_phone + .error").remove();

      $("#address_phone").after(
        "<div class='error'>Please enter valid phone.</div>"
      );
    } else {
      $("input#address_phone + .error").remove();

      valid_address_phone = true;
    }

    if (
      valid_user_name &&
      valid_address_phone &&
      valid_address_line1 &&
      valid_address_city &&
      valid_address_state &&
      valid_address_pincode
    ) {
      $("#address_save_btn").html('<i class="fa fa-spinner fa-spin"></i>');

      $.ajax({

        type: "POST",
        url: site_url + "add_address",
        data: {
          language: 1,
          securecode: securecode,
          user_id: user_id,
          fullname: user_name,
          email: user_emails,
          address1: address_line1,
          address2: address_line2,
          city: address_city,
          state: address_state,
          pincode: address_pincode,
          phone: address_phone,
          [csrfName]: csrfHash,
        },

        success: function (html) {
          var catObj = JSON.parse(html);

          var sts = catObj.status;
          var msg = catObj.msg;

          if (sts == 0) {
            alert(msg);
          }
          else {
            jQuery(".succ-msg").remove();

            $("#address_save_btn").html("Save");
            //  location.href = site_url + "checkout";
            location.reload();
          }
        },
      });
    }
  });
});
