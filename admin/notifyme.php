<?php
include('session.php');
//include('../db_connection.php');
//session_start();// Starting Session

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
}

?>
<?php include("header.php"); ?>


<!-- main content start-->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Recent Request</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div data-example-id="simple-form-inline" style="margin-bottom:5px; display:none;">

                                <form class="form-inline" style="float:left;">

                                    <div class="form-group">
                                        <input type="text" placeholder="Search Name.." name="search" style="width:200px;" id="search_name">
                                        <button type="submit" href="javascript:void(0)" onclick="searchName(this); return false;"><i class="fa fa-search"></i></button>
                                    </div>

                                </form>

                                </br>

                            </div>
                            </br>
                            </br>


                            <div class="work-progres">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tblname">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Prod Name</th>
                                                <th>Phone</th>
                                                <th>email</th>
                                                <th style="width:150px;">Remark</th>
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyPostid">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="pull-right" style="float:left;">
                                            Total Row : <a id="totalrowvalue" class="totalrowvalue"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="pull-right page_div ml-auto" style="float:right;">
                                            <ul class="pagination pagination-sm" style="margin-top:5px;">
                                                <li><a onclick="getOrder('first'); return false;"><</a>
                                                </li>
                                                <li><a onclick="getOrder('previous'); return false;"><<</a>
                                                </li>
                                                <li class="active"><a id="pagenovalue" class="pagenovalue">1</a></li>
                                                <li class="inactive"><a id="pagenovalue2" class="pagenovalue2">2</a></li>
                                                <li class="inactive"><a id="pagenovalue3" class="pagenovalue3">3</a></li>
                                                <li class="inactive"><a id="pagenovalue4" class="pagenovalue4">4</a></li>
                                                <li class="inactive"><a id="pagenovalue5" class="pagenovalue5">5</a></li>

                                                <li><a onclick="getOrder('next'); return false;">>></a></li>
                                                <li><a onclick="getOrder('last'); return false;">></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="clearfix"></div>
</div>



<div class="col_1">


    <div class="clearfix"> </div>

</div>


<!--footer-->
<?php include('footernew.php'); ?>
<!--//footer-->

<!--   
	add click event on table	-->


<script language="javascript">
    function createtable() {
        var tbl = document.getElementById("tblname");
        if (tbl != null) {

            for (var i = 0; i < tbl.rows.length; i++) {
                // alert("kamal se");
                tbl.rows[i].onclick = function() {
                    getval(this);
                };
            }
        }

        function getval(cel) {

            // alert(cel.cells[0].innerHTML);
            // open edit news page
            // alert("row"+item);

            var mapForm = document.createElement("form");
            mapForm.target = "_self";
            mapForm.method = "POST"; // or "post" if appropriate
            mapForm.action = "edit_order.php";

            var mapInput = document.createElement("input");
            mapInput.type = "text";
            mapInput.name = "orderid";
            mapInput.value = cel.cells[0].innerHTML;
            mapForm.appendChild(mapInput);

            document.body.appendChild(mapForm);

            map = window.open("", "_self");

            if (map) {
                mapForm.submit();
            } else {
                alert('You must allow popups for this map to work.');
            }
        }

    }
</script>


<script>
    function searchName(orderid) {

        var count = 1;
        var search_namevalue = $('#search_name').val();

        // alert("search "+search_namevalue );
        if (search_namevalue == "" || search_namevalue == null) {

            alert("Invalid Name");
        } else {

            $.ajax({
                method: 'POST',
                url: 'get_deliveryboy_search.php',
                data: {
                    code: "1",
                    cust_name: search_namevalue,

                },
                success: function(response) {
                    // alert(response); // display response from the PHP script, if any
                    var data = $.parseJSON(response);

                    if (data["status"] == "1") {
                        //	alert("if "+data["details"]);
                        $("#tbodyPostid").empty();

                        $(data["details"]).each(function() {
                            //alert(this.rollno);

                            var btnstatus = "";
                            if (this.orderstatus == "Placed") {
                                btnstatus = '<span class="label label-default">In-progress</span>';
                            } else if (this.orderstatus == "Dispatch") {
                                btnstatus = '<span class="label label-info">Dispatch</span>';
                            } else if (this.orderstatus == "Completed") {
                                btnstatus = '<span class="label label-success">Completed</span>';
                            } else if (this.orderstatus == "Cancelled") {
                                btnstatus = '<span class="label label-danger">Cancelled</span>';
                            }

                            //	alert( "btn "+btnstatus);
                            $("#tbodyPostid").append('<tr> <th class="nr" style="display:none;">' + this.sno + '</th><th scope="row">' + count + '</th><td>' + this.fullname + '</td><td>' + this.address + '</td> <td> ' + this.city + '</td><td> ' + this.phone + '</td><td> ' + this.date + '</td> <td>	<button type = "button" class = "btn-warning">' + "Delete" + '</button></td></tr> ');

                            count = count + 1;
                        });

                        $(".btn-warning").click(function() {
                            var $row = $(this).closest("tr"); // Find the row
                            var $text = $row.find(".nr").text(); // Find the text

                            // alert("prod ID "+$text+$stock); 
                            deleteRecord($text);

                        });
                        // createtable();
                    } else {
                        alert(" no record found. please try again");
                    }
                }
            });


        } //else close

    }


    function getOrder(action) {
        // alert("action "+action);
        if (action == "first") {
            rowno = 0;
            getOrderStatus(1, rowno);
        } else if (action == "previous") {
            rowno = 0;
            getOrderStatus(parseInt(pageno) - 1, rowno);
        } else if (action == "next") {
            rowno = 0;
            getOrderStatus(parseInt(pageno) + 1, rowno);
        } else if (action == "last") {
            rowno = 0;
            getOrderStatus(99999, rowno);

        }
    }

    function myFilter() {
        rowno = 0;
        getOrderStatus(pageno, rowno);
    }

    function getOrderStatus(pagenov, rownov) {


        var count = 1;
        // alert("--"+pagenov+"--"+ rownov );
        $.ajax({
            method: 'POST',
            url: 'get_notifyme_data.php',
            data: {
                code: "1",
                page: pagenov,
                rowno: rownov
            },
            success: function(response) {
                // alert(response); // display response from the PHP script, if any
                var data = $.parseJSON(response);

                if (data["status"] == "1") {
                    // alert("total "+data["totalrow"] );
                    if (rowno < data["totalrow"]) {
                        // alert("total "+data["totalrow"] );
                        $("#tbodyPostid").empty();

                        rowno = data["totalrow"];
                        pageno = data["pageno"];

                        $('#pagenovalue').html(pageno);
                        $('#pagenovalue2').html(parseInt(pageno) + 1);
                        $('#pagenovalue3').html(parseInt(pageno) + 2);
                        $('#pagenovalue4').html(parseInt(pageno) + 3);
                        $('#pagenovalue5').html(parseInt(pageno) + 4);
                        $('#totalrowvalue').html(rowno);

                        $(data["details"]).each(function() {
                            //alert(this.rollno);

                            var btnstatus = "";
                            if (this.orderstatus == "Placed") {
                                btnstatus = '<span class="label label-default">In-progress</span>';
                            } else if (this.orderstatus == "Dispatch") {
                                btnstatus = '<span class="label label-info">Dispatch</span>';
                            } else if (this.orderstatus == "Completed") {
                                btnstatus = '<span class="label label-success">Completed</span>';
                            } else if (this.orderstatus == "Cancelled") {
                                btnstatus = '<span class="label label-danger">Cancelled</span>';
                            }

                            //	alert( "btn "+btnstatus);
                            $("#tbodyPostid").append('<tr> <th class="nr" style="display:none;">' + this.sno + '</th><th scope="row">' + count + '</th><td><img src=' + this.prodimg + ' style="width: 121px; height: 72px;"></td><td> ' + this.prodname + '</td><td>' + this.phone + '</td> <td style="width: 150px;"> ' + this.email + '</td> <td> ' + this.remark + '</td><td> ' + this.createby + '</td> <td>	<button type = "button" class = "btn-warning">' + "Delete" + '</button></td></tr> ');

                            count = count + 1;
                        });

                        $(".btn-warning").click(function() {
                            var $row = $(this).closest("tr"); // Find the row
                            var $text = $row.find(".nr").text(); // Find the text

                            // alert("prod ID "+$text+$stock); 
                            deleteRecord($text);

                        });
                        // createtable();


                    } // if rowno < total
                } // status =1
            }
        });
    }
</script>
<script>
    function deleteRecord(item) {
        //alert(item);

        $.ajax({
            method: 'POST',
            url: 'delete_notifyme.php',
            data: {
                code: "123",
                reqid: item
            },
            success: function(response) {
                alert(response); // display response from the PHP script, if any
                rowno = 0;
                getOrderStatus(pageno, rowno);
            }
        });


    }
</script>
<script>
    function addclick() {
        $(".pagenovalue").click(function() {

            rowno = 0;
            getOrderStatus(parseInt(pageno), rowno);
            //   alert("clci ");
        });
        $(".pagenovalue2").click(function() {
            rowno = 0;
            getOrderStatus(parseInt(pageno) + 1, rowno);
            //     alert("clci 1 ");
        });
        $(".pagenovalue3").click(function() {
            rowno = 0;
            getOrderStatus(parseInt(pageno) + 2, rowno);
        });
        $(".pagenovalue4").click(function() {
            rowno = 0;
            getOrderStatus(parseInt(pageno) + 3, rowno);
        });
        $(".pagenovalue5").click(function() {
            rowno = 0;
            getOrderStatus(parseInt(pageno) + 4, rowno);
        });

    }
</script>

<script>
    var pageno = 1;
    var rowno = 0;
    $(document).ready(function() {

        getOrderStatus(pageno, rowno);
        addclick();

        /*  setInterval(function() {

 	        getOrderStatus(pageno, rowno);
        }, 30000);
        */

    });
</script>