var code_ajax = $("#code_ajax").val();
var multipriceimagecount = 1;

var id = multipriceimagecount;
var high = "50";

$(document).ready(function () {
  $('#myform').parsley();

  $("#moreAttribute").click(function () {
    check_product();
  });

  $("#moreImg").click(function () {
    multipriceimagecount = ++multipriceimagecount;
    //   alert("file id "+multipriceimagecount)
    var showId = multipriceimagecount;
    if (showId <= high) {
      $(".input-files").append('<br><input type="file" id="' + showId + '" name="prod_image[]" style="float:left; display: inline-block; margin-right:20px;"> </input> ' +
        '<button name="btn_remove-' + showId + '" type="submit" class="btn btn-danger" onclick="removeImage(' + showId + '); return false;" style="float:left; display: inline-block; margin-right:20px;">Remove</button> <br>');

    }
  });

  $("#skip_sale_price").click(function (event) {
    var prod_mrp = $("#prod_mrp").val();
    var prod_price = $("#prod_price").val();

    if (!prod_mrp) {
      successmsg("Please enter Product MRP");
      $("#skip_sale_price").prop("checked", false);
      $("#prod_mrp").focus();
    } else if (!prod_price) {
      successmsg("Please enter Product Sale Price");
      $("#skip_sale_price").prop("checked", false);
    } else if ($("#skip_sale_price").prop('checked') == true) {
      $(".sale_prices").val(prod_price);
      $(".mrp_price").val(prod_mrp);
      $(".sale_prices").attr('readonly', 'readonly');
      $(".mrp_price").attr('readonly', 'readonly');
    } else {
      $(".sale_prices").removeAttr('readonly', 'readonly');
      $(".mrp_price").removeAttr('readonly', 'readonly');
    }

  });
});
/* 
 * ---------------------------------------------------
 * Tinymce Editor
 * ---------------------------------------------------
 */
tinymce.init({
  selector: "textarea#prod_details",
  theme: "modern",
  height: 300,
  plugins: [
    "advlist lists print",
    //  "wordcount code fullscreen",
    "save table directionality emoticons paste textcolor"
  ],
  toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

});

/* 
 * ---------------------------------------------------
 * Remove Image
 * ---------------------------------------------------
 */
function removeImage(element) {
  $('#' + element).val('');
}

/* 
 * ---------------------------------------------------
 * Delete Image
 * ---------------------------------------------------
 */
function deleteImg(id) {

  var prod_id = $('#prod_id').val();

  $.ajax({
    method: 'POST',
    url: 'delete_product_image.php',
    data: {
      code: "123",
      delete_id: id,
      prod_id: prod_id
    },
    success: function (response) {
      alert(response); // display response from the PHP script, if any
      getProductImage(prod_id);
    }
  });
}

/* 
 * ---------------------------------------------------
 * Get Product Image
 * ---------------------------------------------------
 */
function getProductImage(id) {
  // alert( "prod id "+id );
  var count = 1;
  $.ajax({
    method: 'POST',
    url: 'get_product_image.php',
    data: {
      code: "123",
      prod_id: id
    },
    success: function (response) {
      // alert(response); // display response from the PHP script, if any
      var data = $.parseJSON(response);

      $("#bt_list").empty();
      var count = 0;
      $(data).each(function () {

        var prod_url = $('#media_url').val() + this;

        // $("#bt_list").append('<a class="label label-warning" onclick="deleteImg(' + count + ')" >DELETE</a><img src="' + prod_url + '" alt="' + prod_url + '" height="150" width="270" hspace="20" vspace="20"> ');
        $("#bt_list").append(
          `<div style="position: relative">
            <a class="label font-weight-bolder text-danger position-absolute" style="right: 3px; cursor: pointer;" onclick="deleteImg(${count})" >DELETE</a>
            <img src='${prod_url}' alt='${prod_url}' height="150">
          </div>`
        );

        count++;
      });

    }
  });
}

/* 
 * ---------------------------------------------------
 * Attribute Setting
 * ---------------------------------------------------
 */
function check_product() {
  var prod_name = $("#prod_name").val();
  if (!prod_name) {
    successmsg("Please enter Product Name first");
    return false;
  } else {
    $("#myModal").modal();
    getproduct_attr();
    $("#manage_configurations_btn").attr('onclick', 'manage_configurations();');
  }
}

function getproduct_attr(counts = '') {
  var selected_attr = '';
  jQuery("#myform_attr").find('select').each(function () {
    var vau = jQuery(this).val();
    if (vau) {
      selected_attr = '';
    }
  });

  $.ajax({
    method: 'POST',
    url: 'get_attributes.php',
    data: {
      code: code_ajax,
      selected_attr: selected_attr
    },
    success: function (response) {

      var data = $.parseJSON(response);

      if (data["status"] == "1") {
        $("#selectattrs_div").html('')
        $(data["data"]).each(function () {
          var html =
            `<tr>
                          <td>
                              <select class="form-control" id="selectattrs" name="selectattrs[]" required style="float:left; display:inline-block; margin-right:20px; width:140px; appearance:none; -webkit-appearance:none; -moz-appearance:none; pointer-events:none;" readonly>
                                  <option value="${this.id}" attrs="${this.attribute_value}">${this.attribute}</option>
                              </select>
                          </td>
                          <td>
                              <div id="cselectattrs" class="d-flex flex-wrap">
                                  ${select_attr_val(this.id, this.attribute_value, this.attribute)}
                              </div>
                          </td>
                      </tr>`;
          $("#selectattrs_div").append(html)
        });

      } else {
        $("#selectattrs_div" + counts).remove();
        successmsg(data["msg"]);
      }
    }
  });

}

function select_attr_val(element_id, myTag, element_name) {
  var tag_arr = myTag.split(',');
  var tag_html = '';
  for (var j = 0; j < tag_arr.length; j++) {
    let firstChar = tag_arr[j].charAt(0);
    if (firstChar == '#') {
      var rgb = hexToRgb(tag_arr[j]);
      var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
      tag_html += '<div class="d-flex align-items-center mb-1"><input type="checkbox" name="attr' + element_id + '[]" value="' + tag_arr[j] + '" class="attr' + element_id + '"><span style="padding: 13px;background-color:' + tag_arr[j] + ';margin:0px 6px;font-size:1px;border-radius:30px;border:1px solid ' + darkerColor + ';"></span></div>';
    } else {
      tag_html += '<input type="checkbox" name="attr' + element_id + '[]" value="' + tag_arr[j] + '" class="attr' + element_id + '"><span style="padding: 9px;">' + tag_arr[j] + '</span>';
    }
  }

  return tag_html;
}

function manage_configurations() { //
  var prod_name = $("#prod_name").val();

  if (!prod_name) {
    successmsg("Please enter Product Name first");
  }

  if (prod_name) {
    $.busyLoadFull("show");
    $('#myform_attr').append('<input type="hidden" name="product_name" value="' + prod_name + '" /> ');
    $('#myform_attr').append('<input type="hidden" name="code" value="' + code_ajax + '" /> ');
    var formData = $('#myform_attr').serialize();

    $.ajax({
      method: 'POST',
      url: 'get_attributes_conf_data.php',
      data: formData,
      success: function (response) {
        $.busyLoadFull("hide");
        var data = response;
        $("#myModal").modal('hide');
        $("#skip_pric").show();
        $('#configurations_div_html').html(data);

      }
    });
  }
}

/* 
 * ---------------------------------------------------
 * Edit Product
 * ---------------------------------------------------
 */
$('#myform').on('submit', function (event) {
  event.preventDefault();

  var content = tinymce.get('prod_details').getContent();

  // // Set the content to the textarea for Parsley validation
  $('#prod_details').val(content);

  // // Validate the form using Parsley
  var isValid = $('#myform').parsley().isValid();

  if (isValid) {
    $.busyLoadFull("show");

    // return isValid;
    var formData = new FormData(document.getElementById('myform'));
    formData.append('prod_details', content);

    $.ajax({
      method: 'POST',
      url: 'edit_product_process.php',
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        $.busyLoadFull("hide");

        $(':input', '#myform')
          .not(':button, :submit, :reset, :hidden')
          .val('')

        successmsg1(response, 'manage_product_filter.php');

      }
    });
  } else {
    console.log('aa');
  }
  /* var prod_idvalue = $('#prod_id').val();

  var prod_namevalue = $('#prod_name').val();
  var prod_shortvalue = $('#prod_short').val();
  var prod_detailsvalue = $('#prod_details').val();
  var prod_namevalue_ar = $('#prod_name_ar').val();
  var prod_shortvalue_ar = $('#prod_short_ar').val();
  var prod_detailsvalue_ar = $('#prod_details_ar').val();
  var prod_pricevalue = $('#prod_price').val();
  var prod_mrpvalue = $('#prod_mrp').val();
  var prod_cgstvalue = $('#prod_cgst').val();
  var prod_sgstvalue = $('#prod_sgst').val();
  var prod_igstvalue = $('#prod_igst').val();
  var prod_shipvalue = $('#prod_shipping').val();
  var prod_hsnvalue = $('#prod_hsn').val();
  var prod_wpricevalue = $('#prod_w_price').val();
  var prod_wqtyvalue = $('#prod_w_qty').val();
  var prod_colorvalue = $('#prod_color').val();
  var prod_sizevalue = $('#prod_size').val();
  var prod_weightvalue = $('#prod_weight').val();
  var prod_qtyvalue = $('#prod_qty').val();
  var prod_unitvalue = $('#prod_unit').val();
  var prod_videovalue = ""; //$('#prod_videoid').val();
  var prod_discountcoins = $('#prod_discountcoins').val();
  var prod_refercoins = $('#prod_refercoins').val();
  var displaystockvalue = $('#displaystock').val();
  var sellernamevalue = $('#sellername').val();
  var remarkvalue = $('#prod_remark').val();
  var ratingvalue = $('#prod_rating').val();
  var ratingcountvalue = $('#prod_ratingcount').val();


  var cat = document.getElementById("selectcategory");
  var catvalue = cat.options[cat.selectedIndex].value;

  var bra = document.getElementById("selectbrand");
  var bravalue = bra.options[bra.selectedIndex].value;

  var freeship = document.getElementById("freeshipessential");
  var freeshipvalue = freeship.options[freeship.selectedIndex].value;

  var myJSON = imagejson;
  //  alert("my jsn "+myJSON);
  // multi qty price
  var prod_multiqtyvalue = JSON.stringify(attrjson);

  var count = 1;
  // alert( prod_shortvalue + " --"+prod_multiqtyvalue+"---" );
  if (prod_namevalue == "" || prod_namevalue == null) {

    alert("Name is empty");
  } else if (prod_pricevalue == "" || prod_pricevalue == null && attrjson.length <= 0) {

    alert("Price is empty");
  } else if (catvalue == "blank") {

    alert("Please Select Category");
  } else if (bravalue == "blank") {

    alert("Please Select Brand");
  } else {
    //  alert(" ready to store "+myJSON + "--"+prod_idvalue);

    $.ajax({
      method: 'POST',
      url: 'edit_product_process.php',
      data: {
        name: prod_namevalue,
        short: prod_shortvalue,
        full: prod_detailsvalue,
        name_ar: prod_namevalue_ar,
        short_ar: prod_shortvalue_ar,
        full_ar: prod_detailsvalue_ar,
        mrp: prod_mrpvalue,
        price: prod_pricevalue,
        cgst: prod_cgstvalue,
        sgst: prod_sgstvalue,
        igst: prod_igstvalue,
        shipping: prod_shipvalue,
        hsn: prod_hsnvalue,
        w_price: prod_wpricevalue,
        w_qty: prod_wqtyvalue,
        color: prod_colorvalue,
        size: prod_sizevalue,
        weight: prod_weightvalue,
        stock_qty: prod_qtyvalue,
        unit: prod_unitvalue,
        cat: catvalue,
        brand: bravalue,
        imagejson: myJSON,
        prod_id: prod_idvalue,
        videoid: prod_videovalue,
        pricearray: prod_multiqtyvalue,
        discountcoins: prod_discountcoins,
        refercoins: prod_refercoins,
        displaystock: displaystockvalue,
        sellername: sellernamevalue,
        remark: remarkvalue,
        freeship: freeshipvalue,
        ratingstar: ratingvalue,
        ratingcount: ratingcountvalue

      },
      success: function (response) {
        alert(response); // display response from the PHP script, if any

      }
    });



  } */
});