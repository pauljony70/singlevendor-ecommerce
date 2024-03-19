<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
}

?>
<?php include("header.php"); ?>

<style>
    .col-md-4.col-xl-3 {
        cursor: pointer;
    }

    .widget-rounded-circle .fa-solid {
        display: flex;
    }

    .card-box .col-4 {
        transition: transform .5s ease;
    }

    .col-md-4.col-xl-3:hover .card-box .col-4 {
        transform: scale(1.1);
    }
</style>

<!-- main content start-->
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">

                <a class="col-md-4 col-xl-3" onclick="redirect_page('orders.php')">
                    <div class="widget-rounded-circle card-box">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <div class="avatar-md rounded-circle bg-soft-light border-dark border">
                                    <i class="fa-solid fa-shopping-cart font-22 avatar-title text-dark"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="mt-1">
                                        <span data-plugin="counterup" id="ordertotalvalue"></span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Orders</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </a> <!-- end col-->

                <a class="col-md-4 col-xl-3" onclick="redirect_page('account.php')">
                    <div class="widget-rounded-circle card-box">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <div class="avatar-md rounded-circle bg-soft-light border-dark border">
                                    <i class="fa-solid fa-dollar-sign font-22 avatar-title text-dark"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="mt-1">
                                        <span data-plugin="counterup" id="totalsalevalue"></span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Total Sale</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </a> <!-- end col-->

                <a class="col-md-4 col-xl-3" onclick="redirect_page('manage_product_filter.php')">
                    <div class="widget-rounded-circle card-box">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <div class="avatar-md rounded-circle bg-soft-light border-dark border">
                                    <i class="fa-solid fa-pie-chart font-22 avatar-title text-dark"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="mt-1">
                                        <span data-plugin="counterup" id="prodtotalvalue"></span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Products</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </a> <!-- end col-->

                <a class="col-md-4 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <div class="avatar-md rounded-circle bg-soft-light border-dark border">
                                    <i class="fa-solid fa-shopping-cart font-22 avatar-title text-dark"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="mt-1">
                                        <span data-plugin="counterup" id="pendingvalue"></span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Pending Order</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </a> <!-- end col-->

                <a class="col-md-4 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <div class="avatar-md rounded-circle bg-soft-light border-dark border">
                                    <i class="fa-solid fa-shopping-cart font-22 avatar-title text-dark"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="mt-1">
                                        <span data-plugin="counterup" id="completevalue"></span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Completed Order</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </a> <!-- end col-->

                <a class="col-md-4 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <div class="avatar-md rounded-circle bg-soft-light border-dark border">
                                    <i class="fa-solid fa-shopping-cart font-22 avatar-title text-dark"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="mt-1">
                                        <span data-plugin="counterup" id="cancelvalue"></span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Cancelled Sale</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </a> <!-- end col-->

            </div><!-- end row-->

            <div class="clearfix"> </div>

            <div class="card">
                <div class="card-body">
                    <div class="work-progres">
                        <header class="widget-header">
                            <h4 class="widget-title">Recent Orders</h4>
                        </header>
                        <hr class="widget-separator">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tblname">
                            <thead class="thead-light">
                                    <tr>
                                        <th>Sno</th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody id="tbodyPostid">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"> </div>
        </div>


        <div class="clearfix"></div>
    </div>

</div>



<div class="col_1">


    <div class="clearfix"> </div>

</div>

<!--footer-->
<?php include('footernew.php'); ?>
<!--//footer-->
</div>

<!-- calendar -->
<script type="text/javascript" src="js/monthly.js"></script>
<script type="text/javascript">
    $(window).load(function() {

        $('#mycalendar').monthly({
            mode: 'event',

        });

        $('#mycalendar2').monthly({
            mode: 'picker',
            target: '#mytarget',
            setWidth: '250px',
            startHidden: true,
            showTrigger: '#mytarget',
            stylePast: true,
            disablePast: true
        });

        switch (window.location.protocol) {
            case 'http:':
            case 'https:':
                // running on a server, should be good.
                break;
            case 'file:':
                alert('Just a heads-up, events will not work when run locally.');
        }

    });
</script>
<script type="application/javascript">
    function editOrder(item) {
        //alert(item);

        var mapForm = document.createElement("form");
        mapForm.target = "_self";
        mapForm.method = "POST"; // or "post" if appropriate
        mapForm.action = "edit_order.php";

        var mapInput = document.createElement("input");
        mapInput.type = "text";
        mapInput.name = "orderid";
        mapInput.value = item;
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
    function getOrderStatus(pageno) {

        var count = 1;
        //alert(classvalue );
        $.ajax({
            method: 'POST',
            url: 'get_order_data.php',
            data: {
                code: "1",
                page: pageno
            },
            success: function(response) {
                // alert(response); // display response from the PHP script, if any
                var data = $.parseJSON(response);
                $("#tbodyPostid").empty();
                //  alert("status "+data["status"]);

                if (data["status"] == "1") {
                    //	alert("if "+data["details"]);

                    $(data["details"]).each(function() {


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
                        $("#tbodyPostid").append('<tr> <th class="nr" style="display:none;">' + this.sno + '</th><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td>' + btnstatus + '</td> <td>	<button type = "button" class = "btn-warning">' + "Edit" + '</button></td></tr> ');

                        count = count + 1;
                    });

                    $(".btn-warning").click(function() {
                        var $row = $(this).closest("tr"); // Find the row
                        var $text = $row.find(".nr").text(); // Find the text

                        // alert("prod ID "+$text+$stock); 
                        editOrder($text);

                    });
                    //  createtable();

                } else {
                    // alert("else");

                }

            }
        });
    }

    function getOrderSummery() {
        // alert("order");

        $.ajax({
            method: 'POST',
            url: 'get_order_summery.php',
            data: {
                code: "123"
            },
            success: function(response) {
                //  alert(response); // display response from the PHP script, if any
                //$('#msgdiv').val("subsdfa");
                var data = $.parseJSON(response);
                document.getElementById('ordertotalvalue').innerHTML = data.total_order;
                document.getElementById('totalsalevalue').innerHTML = data.total_sale;
                document.getElementById('prodtotalvalue').innerHTML = data.prod;
                document.getElementById('pendingvalue').innerHTML = data.pending;
                document.getElementById('completevalue').innerHTML = data.completed;
                document.getElementById('cancelvalue').innerHTML = data.cancel;
            }
        });

    }
</script>
<script>
    $(document).ready(function() {
        var pagecount = 1;

        getOrderStatus(pagecount);
        getOrderSummery();

        // setInterval( 	getOrderSummery(), 15 * 1000);
        //  setInterval( 	getOrderStatus(1), 15 * 1000);
        setInterval(function() {

            getOrderStatus(pagecount);
        }, 15000);

    });
</script>
</body>

</html>