var code_ajax = $("#code_ajax").val();
var imagejson = [];
var attrjson = [];
var multiPriceMainjson = [];
var multipriceimagecount = 1;
var notiimage = "";

var atr_id = 102;
var attvalue_id = 202;
var attstockvalue_id = 302;
var attmrpvalue_id = 402;
var attskuvalue_id = 602;

var id = multipriceimagecount;
var high = "50";

$(document).ready(function () {
    $('#myform').parsley();
    getVariant();
    var id = multipriceimagecount;
    var high = "50";

    $("#moreAttribute").click(function () {
        /* var showId = ++atr_id;
        var valueid = ++attvalue_id;
        var stockvalueid = ++attstockvalue_id;
        var mrpvalueid = ++attmrpvalue_id;
        var skuvalueid = ++attskuvalue_id;


        $(".add-attr").append('<br><div style="border:1px solid #D3D3D3; padding:12px;" class="pb-3">' +
            '<a class="btn btn-warning" aria-hidden="true"  onclick="moreMultiPriceImage(' + showId + '); return false;" ><i class="fa fa-plus"></i> Add Image</a>' +
            '<div class="input-files' + showId + '"> </div> ' +
            '<br><br>' +
            '<select class="form-control" id="' + showId + '" style="width:100px; float:left; display: inline-block; margin-right:20px;">' + variantarray + '</select> ' +
            //'<input type="text"  id="'+showId+'" class="form-control"  placeholder="Size" style="width:100px; float:left; display: inline-block; margin-right:20px;"> </input> '+
            '<input type="text"  id="' + mrpvalueid + '" class="form-control"  placeholder="MRP" style="width:100px; float:left; margin-right:20px;"> </input> ' +
            '<input type="text"  id="' + valueid + '" class="form-control"  placeholder="Price" style="width:100px; float:left; display: inline-block; margin-right:20px;"> </input> ' +
            '<input type="text"  id="' + stockvalueid + '" class="form-control"  placeholder="stock" style="width:100px; float:left; display: inline; margin-right:20px;"> </input> ' +
            '<input type="text"  id="' + skuvalueid + '" class="form-control"  placeholder="SKU" style="width:100px; float:left; display: inline-block; margin-right:20px;"> </input> ' +
            '<button name="btn_save-' + showId + '" type="submit" class="btn btn-success" onclick="saveInfoCheck(' + showId + '); return false;" style="float:left; display: inline-block; margin-right:20px;">Save</button>' +
            '<button name="btnremove-' + showId + '" type="submit" class="btn btn-danger" onclick="removeInfo(' + showId + '); return false;" style="float:left; display: inline-block; margin-right:20px;">Remove</button><br></div>'); */
        check_product();
    });


    $("#moreImg").click(function () {
        multipriceimagecount = ++multipriceimagecount;
        //   alert("file id "+multipriceimagecount)
        var showId = multipriceimagecount;
        if (showId <= high) {
            //	$(".input-files").append('<br><input type="file" id="'+showId+'"> </input>  <button name="btn_upload-'+showId+'" type="submit" class="btn btn-default" onclick="uploadImage('+showId+'); return false;">Upload</button></br>  ');
            $(".input-files").append('<br><input type="file" id="' + showId + '" name="prod_image[]" style="float:left; display: inline-block; margin-right:20px;"> </input> ' +
                '<button name="btn_remove-' + showId + '" type="submit" class="btn btn-danger" onclick="removeImage(' + showId + '); return false;" style="float:left; display: inline-block; margin-right:20px;">Remove</button> <br>');
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
 * Add Product
 * ---------------------------------------------------
 */
$('#myform').on('submit', function (event) {
    event.preventDefault();
    // Get the TinyMCE content
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
            url: 'add_product_process.php',
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

var variantarray = "";
function getVariant() {
    // alert( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_variant_data_tree.php',
        data: {
            code: "123"
        },
        success: function (response) {
            variantarray = response;
        }
    });
}

/* 
 * ---------------------------------------------------
 * Upload Product Image
 * ---------------------------------------------------
 */
function uploadImage(element) {
    var file_data = $('#' + element).prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);

    $.ajax({
        url: 'add_product_image.php',
        dataType: 'json', // Expecting JSON response
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {

            if (response.status === "success") {
                // Do something with the success response
                var thumname = response.data.filePath;
                imagejson.push({
                    "id": element,
                    "url": thumname
                });
                notiimage = thumname;
            } else {
                // Handle the error response

            }
            alert(response.message);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error: " + textStatus, errorThrown);
        }
    });
}

/* 
 * ---------------------------------------------------
 * Upload Attribute Image
 * ---------------------------------------------------
 */
function uploadMultiPriceImage(element, filenumber) {
    console.log(element);
    var imagefile = Number(filenumber);
    var file_data = $('#' + imagefile).prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);

    $.ajax({
        url: 'add_product_image.php',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {

            if (response.status === "success") {
                // Check if filenumber already exists in the array
                var existingItem = multiPriceMainjson.find(item => item.filenumber == filenumber);

                if (existingItem) {
                    // Make an AJAX call to remove the old file from the directory
                    $.ajax({
                        url: 'remove_old_file.php', // Replace with the actual URL to remove the old file
                        type: 'post',
                        data: { oldFilePath: existingItem.url },
                        dataType: 'json',
                        success: function (removeResponse) {
                            if (removeResponse.status === "success") {
                                console.log("Old file removed successfully");
                            } else {
                                console.error("Error removing old file:", removeResponse.message);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error("AJAX Error (remove old file): " + textStatus, errorThrown);
                        }
                    });

                    // Update the existing item in the array
                    existingItem.url = response.data.filePath;
                } else {
                    // Push a new item to the array
                    multiPriceMainjson.push({
                        "id": element,
                        "filenumber": filenumber,
                        "url": response.data.filePath
                    });
                }

                // Update multiPriceMainvalue with the modified array
                multiPriceMainvalue = JSON.stringify(multiPriceMainjson);
            } else {
                // Handle the error response
            }

            alert(response.message);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error: " + textStatus, errorThrown);
        }
    });
}


/* 
 * ---------------------------------------------------
 * Save Attribute Details
 * ---------------------------------------------------
 */
function saveInfoCheck(element) {
    var count = Number(element) + 100;
    var stockcount = Number(element) + 200;
    var mrpcount = Number(element) + 300;
    var imagefile = Number(element) + 400;
    var attrpricevalue = $('#' + count).val();
    var skucount = Number(element) + 500;

    var attrstockvalue = $('#' + stockcount).val();
    var attrmrpvalue = $('#' + mrpcount).val();
    var attrskuvalue = $('#' + skucount).val();

    var selectedOption = $('#' + element);
    var optgroupLabel = selectedOption.find(':selected').parent().attr('label');
    var attrname = selectedOption.val();

    var parsedJSON = multiPriceMainjson;
    var multiimagearray = [];

    for (var i = 0; i < parsedJSON.length; i++) {
        var counter = parsedJSON[i];
        if (counter.id === imagefile) {
            multiimagearray.push({
                "id": i,
                "url": counter.url
            });
        }
    }
    var imageurl = multiimagearray;

    // Check if attrname already exists in attrjson
    var existingIndex = -1;
    for (var i = 0; i < attrjson.length; i++) {
        if (attrjson[i].attrvalue === attrname) {
            existingIndex = i;
            break;
        }
    }

    if (existingIndex !== -1) {
        // Modify the existing item in attrjson
        attrjson[existingIndex] = {
            "attrname": optgroupLabel,
            "attrvalue": attrname,
            "attrpricevalue": attrpricevalue,
            "attrmrpvalue": attrmrpvalue,
            "attrstockvalue": attrstockvalue,
            "attrimage": imageurl,
            "attrskuvalue": attrskuvalue
        };
    } else {
        // Push a new item to attrjson
        attrjson.push({
            "attrname": optgroupLabel,
            "attrvalue": attrname,
            "attrpricevalue": attrpricevalue,
            "attrmrpvalue": attrmrpvalue,
            "attrstockvalue": attrstockvalue,
            "attrimage": imageurl,
            "attrskuvalue": attrskuvalue
        });
    }

    $('#' + count).prop("disabled", true);
    $('#' + element).prop("disabled", true);
    $('#' + stockcount).prop("disabled", true);
    $('#' + mrpcount).prop("disabled", true);
    $('#' + skucount).prop("disabled", true);
}

function removeInfo(element) {

    var count = Number(element) + 100;
    var stockcount = Number(element) + 200;
    var mrpcount = Number(element) + 300;
    var skucount = Number(element) + 500;
    var attrvalue = $('#' + count).val();
    // var attrname = $('#'+element).val();
    var cat = document.getElementById(element);
    var attrname = cat.options[cat.selectedIndex].value;

    var parsedJSON = attrjson;

    for (var i = 0; i < parsedJSON.length; i++) {
        var counter = parsedJSON[i];

        if (counter.attrvalue.includes(attrname)) {

            parsedJSON.splice(i, 1);

        }
        //  alert( parsedJSON);
    }

    $('#' + count).prop("disabled", false);
    $('#' + element).prop("disabled", false);
    $('#' + stockcount).prop("disabled", false);
    $('#' + mrpcount).prop("disabled", false);
    $('#' + skucount).prop("disabled", false);

    $('#' + element).val('');
    $('#' + count).val('');
    $('#' + stockcount).val('');
    $('#' + mrpcount).val('');
    $('#' + skucount).val('');


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