var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;

function getConfAttribute(pagenov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();

    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get-attribute-conf-data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            perpage: perpage
        },
        success: function (response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);

            var data = parsedJSON.data;
            $(data).each(function () {
                var html = '<tr id="tr' + this.id + '"> <td>' + ((pagenov - 1) * perpage + count) + '</td><td > ' + this.attribute + '</td>';
                html += '<td><div class="d-flex"> <button type="submit" class= "btn btn-dark waves-effect waves-light btn-sm pull-left" name="delete" onclick="view_attr_value(' + this.id + ');">View</button>';
                html += '<button style=" margin-left: 10px;" type="submit" class= "btn btn-primary waves-effect waves-light btn-sm pull-left" name="delete" onclick="deletebrand(' + this.id + ');">DELETE</button>';

                html += '<button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.attribute + '","' + this.attribute_ar + '")\';>EDIT</button></div></td></tr>';
                $("#cat_list").append(html);

                count++;
            });



        }
    });
}


$(document).ready(function () {
    getConfAttribute(pageno);

    $("#add_attributes_btn").click(function (event) {
        event.preventDefault();
    
        var namevalue = $('#attributes').val();
        var namevalue_ar = '';
    
        if (!namevalue) {
            successmsg("Please enter Attributes Name");
        }
    
        if (namevalue) {
            $.busyLoadFull("show");
            var form_data = new FormData();
            form_data.append('namevalue', namevalue);
            form_data.append('namevalue_ar', namevalue_ar);
            form_data.append('type', 'add');
            form_data.append('code', code_ajax);
    
            $.ajax({
                method: 'POST',
                url: 'attribute-conf-process.php',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    $.busyLoadFull("hide");
                    $("#myModal").modal('hide');
                    $('#attributes').val('');
                    // $('#attributes_ar').val('');
                    getConfAttribute(1);
                    successmsg(response);
                }
            });
        }
    });
        

    $("#update_attributes_btn").click(function (event) {
        event.preventDefault();

        var namevalue = $('#update_attributes').val();
        var namevalue_ar = '';
        var attribute_id = $('#attribute_id').val();

        if (!namevalue) {
            successmsg("Please enter Attribute (ENG)");
        }
       

        if (namevalue && attribute_id) {
            $.busyLoadFull("show");
            var form_data = new FormData();
            form_data.append('namevalue', namevalue);
            form_data.append('namevalue_ar', namevalue_ar);
            form_data.append('attribute_id', attribute_id);
            form_data.append('type', 'edit');
            form_data.append('code', code_ajax);

            $.ajax({
                method: 'POST',
                url: 'attribute-conf-process.php',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    $.busyLoadFull("hide");
                    $("#myModalupdate").modal('hide');
                    $('#update_attributes').val('');
                    // $('#update_attributes_ar').val('');
                    $('#attribute_id').val('');
                    var page = $(".pagination .active .current").text();
                    getConfAttribute(page)
                    successmsg(response);

                }
            });
        }

    });



});


function editbrand(id, name, name_ar) {
    $("#myModalupdate").modal('show');
    $("#attribute_id").val(id);
    $("#update_attributes").val(name);
    $("#update_attributes_ar").val(name_ar);
}

function deletebrand(id) {
    xdialog.confirm('Are you sure want to delete?', function () {
        $.busyLoadFull("show");
        $.ajax({
            method: 'POST',
            url: 'attribute-conf-process.php',
            data: { deletearray: id, type: 'delete', code: code_ajax },
            success: function (response) {
                $.busyLoadFull("hide");
                if (response == 'Failed to Delete.') {
                    successmsg("Failed to Delete.");
                } else if (response == 'Deleted') {
                    $("#tr" + id).remove();
                    successmsg("Attribute Deleted Successfully.");
                } else {
                    successmsg(response);
                }
            }
        });
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

function view_attr_value(id) {
    location.href = "manage-conf-attributes-val.php?attribute_id=" + id;
}

