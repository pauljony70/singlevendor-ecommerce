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
                        <h4 class="page-title">Products Reviews</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">



                            <div class="work-progres">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tblname">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Image</th>
                                                <th>Prod. Name</th>
                                                <th>Rating</th>
                                                <th>Review</th>
                                                <th>feedback</th>
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



                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>


    <div class="clearfix"></div>
</div>



<div class="col_1">


    <div class="clearfix"> </div>

</div>


<!--footer-->
<?php include('footernew.php'); ?>

<!--   
	add click event on table	-->


<script language="javascript">
    function createtable() {
        var tbl = document.getElementById("tblname");
        if (tbl != null) {

            for (var i = 0; i < tbl.rows.length; i++) {
                //   alert("kamal se");
                tbl.rows[i].onclick = function() {
                    getval(this);
                };
            }
        }

        function getval(cel) {

            //  alert(cel.cells[0].innerHTML);
            // open edit news page
            //  alert(item);

            var mapForm = document.createElement("form");
            mapForm.target = "_self";
            mapForm.method = "POST"; // or "post" if appropriate
            mapForm.action = "edit_student.php";

            var mapInput = document.createElement("input");
            mapInput.type = "text";
            mapInput.name = "id";
            mapInput.value = cel.cells[0].innerHTML;
            mapForm.appendChild(mapInput);

            var mapInput2 = document.createElement("input");
            mapInput2.type = "text";
            mapInput2.name = "title";
            mapInput2.value = cel.cells[3].innerHTML;
            mapForm.appendChild(mapInput2);

            var mapInput3 = document.createElement("input");
            mapInput3.type = "text";
            mapInput3.name = "details";
            mapInput3.value = cel.cells[3].innerHTML;
            mapForm.appendChild(mapInput3);

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
<script type="application/javascript">
    function readReview(item, pname) {
        //  alert(item + pname);

        var mapForm = document.createElement("form");
        mapForm.target = "_self";
        mapForm.method = "POST"; // or "post" if appropriate
        mapForm.action = "review_single.php";

        var mapInput = document.createElement("input");
        mapInput.type = "text";
        mapInput.name = "reviewid";
        mapInput.value = item;
        mapForm.appendChild(mapInput);

        var mapInput = document.createElement("input");
        mapInput.type = "text";
        mapInput.name = "pname";
        mapInput.value = pname;
        mapForm.appendChild(mapInput);

        document.body.appendChild(mapForm);

        map = window.open("", "_self");

        if (map) {
            mapForm.submit();
        } else {
            alert('You must allow popups for this map to work.');
        }
    }
</script>


<script>
    function getOrder(action) {
        // alert("action "+action);
        if (action == "first") {
            rowno = 0;
            getProducts(1, rowno);
        } else if (action == "previous") {
            rowno = 0;
            getProducts(parseInt(pageno) - 1, rowno);
        } else if (action == "next") {
            rowno = 0;
            getProducts(parseInt(pageno) + 1, rowno);
        } else if (action == "last") {
            rowno = 0;
            getProducts(99999, rowno);

        }
    }

    function getProducts(pagenov, rownov) {

        var count = 1;
        //alert(classvalue );
        $.ajax({
            method: 'POST',
            url: 'get_review_data.php',
            data: {
                code: "123",
                page: pagenov,
                rowno: rownov
            },
            success: function(response) {
                //  alert(response); // display response from the PHP script, if any
                var data = $.parseJSON(response);

                if (data["status"] == "1") {
                    // alert("total "+data["totalrow"] );
                    if (rowno < data["totalrow"]) {
                        // alert("total "+data["totalrow"] );
                        $("#tbodyPostid").empty();

                        rowno = data["totalrow"];
                        pageno = data["pageno"];
                        $('#pagenovalue').html(pageno);
                        $('#totalrowvalue').html(rowno);

                        $(data["details"]).each(function() {
                            //alert(this.rollno);
                            $("#tbodyPostid").append('<tr> <th scope="row">' + count + '</th><td><img src=' + this.img + ' style="width: 121px; height: 72px;"></td><td style="display:none" class="nr">' + this.reviewid + '</td><td class="pname">' + this.name + '</td> <td> ' + this.rating + '</td><td>' + this.rating_count + '</td> <td class="stk"> ' + this.feedback + '</td> <td>	<button type = "button" class = "btn-success">' + "Read All" + '</button></td></tr> ');

                            count = count + 1;
                        });


                        $(".btn-success").click(function() {
                            var $row = $(this).closest("tr"); // Find the row
                            var $text = $row.find(".nr").text(); // Find the text
                            var $pname = $row.find(".pname").text(); // Find the text

                            // alert("prod ID "+$text); 
                            readReview($text, $pname);

                        });


                    } // row>

                } // status =1


            }
        });
    }
</script>


<script>
    var pagecount = 1;
    var rowno = 0;
    $(document).ready(function() {

        getProducts(pagecount, rowno);

    });
</script>