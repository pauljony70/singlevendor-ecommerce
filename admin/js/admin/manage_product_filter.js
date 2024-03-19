var pageno = 1;
var rowno = 0;
var searchenable = false;
var sharelistid = 0;

$(document).ready(function () {
    getfiltername();
    getProducts(pageno, rowno);
});

function getProducts(pagenov) {
    var checkBoxcat = document.getElementById("Checkcat");
    var tempcat = "false";
    if (checkBoxcat.checked == true) {
        // alert("cmplete");
        tempcat = "true";
    }
    var checkBoxlow = document.getElementById("Checklowstock");
    var templow = "false";
    if (checkBoxlow.checked == true) {
        // alert("cmplete");
        templow = "true";
    }
    var count = 1;
    var cat = document.getElementById("selectcategory");
    var catvalue = cat.options[cat.selectedIndex].value;

    // var szz = document.getElementById("selectsize");
    // var sizevalue = szz.options[szz.selectedIndex].value;

    // var cll = document.getElementById("selectcolor");
    // var colorvalue = cll.options[cll.selectedIndex].value;

    $.ajax({
        method: 'POST',
        url: 'get_product_data_filter_lowstockkk.php',
        data: {
            code: "123",
            page: pagenov,
            sortcat: tempcat,
            catid: catvalue,
            size: '',
            color: '',
            lowstock: templow
        },
        success: function (response) {
            //  alert(response); // display response from the PHP script, if any
            var data = $.parseJSON(response);

            if (data["status"] == "1") {

                var myList = data["filterarray"]; //JSON.parse(data.details);
                // alert(myList.length); 
                if (data["bothfilter"] == 1 && myList.length <= 0) {
                    alert("No match found");
                } else {
                    $("#tbodyPostid").empty();
                    searchenable = false;
                    rowno = data["totalrow"];
                    pageno = data["pageno"];

                    $("#totalrowvalue").html(rowno);
                    $(".page_div").html(data["page_html"]);

                    if (myList.length > 0) {
                        //  alert(" filterarra");
                        $(data["filterarray"]).each(function () {
                            //	alert(this.active);
                            var btnactive = "";
                            if (this.active == "active") {
                                btnactive = '<button type = "button" class = "btn-success">' + this.active + '</button>';
                            } else if (this.active == "inactive") {
                                btnactive = '<button type = "button" class = "btn-info">' + this.active + '</button>';
                            }

                            var btnstatus = '<button type = "button" class = "btn-danger">DELETE</button>';


                            $("#tbodyPostid").append('<tr> <th scope="row">' + count + '</th><td><img src=' + this.img + ' style="height: 75px;"></td><td class="nr">' + this.id + '</td><td class="nimg" style="display:none"> ' + this.img + '</td><td class="nname">' + this.name + '</td> <td class="nhsn">' + this.hsncode + '</td><td class="nprice">' + this.price + '</td> <td class="stk"> ' + this.stock + '</td> <td class="nsize">' + this.size + '</td> <td class="ncolor">' + this.color + '</td><td> ' + this.cat + '</td> <td>	<button type = "button" class = "btn-warning">' + "Edit" + '</button></td><td>' + btnstatus + '</td><td>' + btnactive + '</td></tr> ');

                            count = count + 1;
                        });

                    } else {

                        $(data["details"]).each(function () {
                            //	alert(this.active);
                            var btnactive = "";
                            if (this.active == "active") {
                                btnactive = '<button type = "button" class = "btn-success">' + this.active + '</button>';
                            } else if (this.active == "inactive") {
                                btnactive = '<button type = "button" class = "btn-info">' + this.active + '</button>';
                            }

                            var btnstatus = '<button type = "button" class = "btn-danger">DELETE</button>';

                            $("#tbodyPostid").append('<tr> <th scope="row">' + count + '</th><td><img src=' + this.img + ' style="height: 75px;"></td><td class="nr">' + this.id + '</td><td class="nimg" style="display:none"> ' + this.img + '</td><td class="nname">' + this.name + '</td> <td class="nhsn">' + this.hsncode + '</td><td class="nprice">' + this.price + '</td> <td class="stk"> ' + this.stock + '</td> <td class="nsize">' + this.size + '</td> <td class="ncolor">' + this.color + '</td><td> ' + this.cat + '</td> <td>	<button type = "button" class = "btn-warning">' + "Edit" + '</button></td><td>' + btnstatus + '</td><td>' + btnactive + '</td></tr> ');

                            count = count + 1;
                        });
                    }

                }

                $(".btn-danger").click(function () {
                    var $row = $(this).closest("tr"); // Find the row
                    var $text = $row.find(".nr").text(); // Find the text
                    deleteProduct($text);
                    //alert("prod ID "+$text); 


                });
                $(".btn-success").click(function () {
                    var $row = $(this).closest("tr"); // Find the row
                    var $text = $row.find(".nr").text(); // Find the text
                    activateProduct($text, "active");
                    // alert("prod ID "+$text); 


                });
                $(".btn-info").click(function () {
                    var $row = $(this).closest("tr"); // Find the row
                    var $text = $row.find(".nr").text(); // Find the text
                    activateProduct($text, "inactive");
                    // alert("prod ID "+$text); 


                });
                $(".btn-warning").click(function () {
                    //alert("here");
                    var $row = $(this).closest("tr"); // Find the row
                    var $text = $row.find(".nr").text(); // Find the text
                    var $stock = $row.find(".stk").text();
                    // alert("here "+$row+"--"+$text );
                    editProduct($text, $stock);

                });
                // createtable();
            } else {
                alert(" no product found. please try again");
            }

        }
    });
}