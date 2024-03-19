var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;

function getSpinners(pagenov) {
    $.busyLoadFull("show");
    var perpage = $('#perpage').val();

    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get-spinner-data.php',
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
                var html = '<tr id="tr' + this.id + '"> <td>' + ((pagenov - 1) * perpage + count) + '</td><td>' + this.image + this.name + '</td><td>' + this.value + '</td>';
                html += '<td><button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'editbrand("' + this.id + '","' + this.name + '","' + this.value + '")\';>EDIT</button></div></td></tr>';
                $("#cat_list").append(html);

                count++;
            });



        }
    });
}


$(document).ready(function () {
    getSpinners(pageno);
    $("#update_spinner_btn").click(function (event) {
        event.preventDefault();

        var namevalue = $('#name').val();
        var value = $('#value').val();

        if (!namevalue) {
            successmsg("Please enter Name");
        }
        if (!value) {
            successmsg("Please enter Value");
        }

        if (namevalue && value) {
            $.busyLoadFull("show");
            var form_data = new FormData();
            form_data.append('id', $('#spinner_id').val());
            form_data.append('name', namevalue);
            form_data.append('value', value);
            form_data.append('image', $('#image').prop('files')[0]);
            form_data.append('code', code_ajax);

            $.ajax({
                method: 'POST',
                url: 'spinner-process.php',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    $.busyLoadFull("hide");
                    $("#myModalupdate").modal('hide');
                    $('#name').val('');
                    $('#value').val('');
                    $('#image').val('');
                    var page = $(".pagination .active .current").text();
                    getSpinners(page)
                    successmsg(response);

                }
            });
        }

    });



});


function editbrand(id, name, value) {
    $("#myModalupdate").modal('show');
    $("#spinner_id").val(id);
    $("#name").val(name);
    $("#value").val(value);
}

