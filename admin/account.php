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
            <h4 class="page-title">Orders</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row" data-example-id="simple-form-inline" style="margin-bottom:5px;">
                <div class="col-12 d-flex flex-wrap align-items-center">


                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Order id.." name="search" style="width:200px;" id="search_order">
                      <button type="submit" class="btn btn-dark" href="javascript:void(0)" onclick="searchOrder(this); return false;"><i class="fa fa-search"></i></button>
                    </div>
                  </div>

                  <div class="form-group mx-2">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Customer Name.." name="search" style="width:200px;" id="search_name">
                      <button type="submit" class="btn btn-dark" href="javascript:void(0)" onclick="searchName(this); return false;"><i class="fa fa-search"></i></button>
                    </div>
                  </div>

                  <div class="form-group">
                    <a style="font-weight: bolder;">&nbsp;&nbsp; Apply Filter &nbsp;&nbsp;</a> <input type="checkbox" id="Checkcmp" onclick="myFilter()"> Completed <a>&nbsp;&nbsp;</a>
                    <input type="checkbox" id="Checkdis" onclick="myFilter()">Dispatch<a>&nbsp;&nbsp;</a>
                    <input type="checkbox" id="Checkcan" onclick="myFilter()">Cancelled<a>&nbsp;&nbsp;</a>
                    <input type="checkbox" id="Checkin" onclick="myFilter()">In-Progress <a>&nbsp;&nbsp;</a>
                  </div>
                </div>
                <div class="col-12 d-flex flex-wrap align-items-center">
                  <div class="form-group">
                    <input type="text" class="form-control" id="from" placeholder="From" name="from">
                  </div>
                  <div class="form-group ml-2">
                    <input type="text" class="form-control" id="to" placeholder="To" name="to">
                  </div>
                  <div class="form-group">
                    <button type="button" onclick="DateFilter()" class="btn btn-primary  pull-right" style="margin-left:10px;">Apply</button>
                    <button type="button" id="cmd" onclick="pdfclick();" class="btn btn-success  pull-right" style="margin-left:5px; margin-right:10px">PDF</button>
                    <button type="button" id="btnExport" onclick="fnExcelReport();" class="btn btn-success  pull-right" style="margin-left:5px; margin-right:10px"> Excel </button>
                  </div>
                </div>
              </div>
              </br>

              <div class="work-progres">

                <!-- <iframe id="txtArea1" style="display:none"></iframe> -->
                <!-- <hr class="widget-separator"> -->
                <div class="table-responsive">
                  <table class="table table-hover" id="tblname">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Shipping</th>
                        <th>Grand Total</th>
                        <th>Status</th>
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
                <!--- hidden table-->
                <table class="table table-hover" id="tblname2" style="display:none">
                  <thead>
                    <tr>
                      <th>Sno</th>
                      <th>Order ID</th>
                      <th>Date</th>
                      <th>Customer Name</th>
                      <th>Total Price</th>
                      <th>CGST(Rs.)</th>
                      <th>SGST(Rs.)</th>
                      <th>Shipping</th>
                      <th>Grand Total</th>
                    </tr>
                  </thead>
                  <tbody id="tbodyPostid2">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="clearfix"> </div>
  </div>


  <div class="clearfix"></div>
</div>
<!-- //calendar -->





<!-- for amcharts js -->
<script src="js/amcharts.js"></script>
<script src="js/serial.js"></script>
<script src="js/export.min.js"></script>
<link rel="stylesheet" href="css/export.css" type="text/css" media="all" />
<script src="js/light.js"></script>
<!-- for amcharts js -->

<script src="js/index1.js"></script>


<div class="col_1">


  <div class="clearfix"> </div>

</div>

</div>
</div>
<!--footer-->
<?php include('footernew.php'); ?>

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

  function searchOrder(orderid) {

    var count = 1;
    var search_ordervalue = $('#search_order').val();

    // alert("search "+search_ordervalue );
    if (search_ordervalue == "" || search_ordervalue == null) {

      alert("Invalid Order ID");
    } else {

      $.ajax({
        method: 'POST',
        url: 'get_order_data_search.php',
        data: {
          code: "1",
          order_id: search_ordervalue,

        },
        success: function(response) {
          // alert(response); // display response from the PHP script, if any
          var data = $.parseJSON(response);

          if (data["status"] == "1") {
            //	alert("if "+data["details"]);
            $("#tbodyPostid").empty();
            $("#tbodyPostid2").empty();
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
              $("#tbodyPostid").append('<tr> <th class="nr" style="display:none;">' + this.sno + '</th><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td align="right">' + this.price + '</td><td align="right">' + this.ship + '</td><td align="right">' + this.grandtotal + '</td><td align="right">' + btnstatus + '</td><td>	<button type = "button" class = "btn-info">' + "View" + '</button></td></tr> ');
              $("#tbodyPostid2").append('<tr><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td align="right">' + this.price + '</td><td align="right">' + this.ship + '</td><td align="right">' + this.grandtotal + '</td></tr> ');

              count = count + 1;
            });

            $(".btn-info").click(function() {
              var $row = $(this).closest("tr"); // Find the row
              var $text = $row.find(".nr").text(); // Find the text

              // alert("prod ID "+$text+$stock); 
              editOrder($text);

            });
            // createtable();
          } else {
            alert(" no record found. please try again");
          }
        }
      });


    } //else close

  }

  function searchName(orderid) {

    var count = 1;
    var search_namevalue = $('#search_name').val();

    // alert("search "+search_namevalue );
    if (search_namevalue == "" || search_namevalue == null) {

      alert("Invalid Name");
    } else {

      $.ajax({
        method: 'POST',
        url: 'get_order_data_search_name.php',
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
            $("#tbodyPostid2").empty();
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
              $("#tbodyPostid").append('<tr> <th class="nr" style="display:none;">' + this.sno + '</th><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td align="right">' + this.price + '</td><td align="right">' + this.ship + '</td><td align="right">' + this.grandtotal + '</td><td align="right">' + btnstatus + '</td><td>	<button type = "button" class = "btn-info">' + "View" + '</button></td></tr> ');
              $("#tbodyPostid2").append('<tr><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td align="right">' + this.price + '</td><td align="right">' + this.ship + '</td><td align="right">' + this.grandtotal + '</td></tr> ');

              count = count + 1;
            });

            $(".btn-info").click(function() {
              var $row = $(this).closest("tr"); // Find the row
              var $text = $row.find(".nr").text(); // Find the text

              // alert("prod ID "+$text+$stock); 
              editOrder($text);

            });
            // createtable();
          } else {
            alert(" no record found. please try again");
          }
        }
      });


    } //else close

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
      //    alert("clci 1 ");
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
  function myFilter() {
    // Get the checkbox
    var checkBoxcmp = document.getElementById("Checkcmp");
    var checkBoxdis = document.getElementById("Checkdis");
    var checkBoxcan = document.getElementById("Checkcan");
    var checkBoxin = document.getElementById("Checkin");

    // If the checkbox is checked, display the output text
    var temp = "";
    if (checkBoxcmp.checked == true) {
      // alert("cmplete");
      temp = temp + "'Completed'";
    }
    if (checkBoxdis.checked == true) {
      // alert("dispatch");
      temp = temp + "'Dispatch'";
    }
    if (checkBoxcan.checked == true) {
      //alert("cancel");
      temp = temp + "'Cancelled'";
    }
    if (checkBoxin.checked == true) {
      //alert("in progress");
      temp = temp + "'Placed'";
    }
    /* if( temp.charAt(temp.length - 1)==","){
         alert("remove ,");
         temp.slice(temp.charAt(temp.length - 1),"");
     }*/
    while (temp.includes("''")) {
      //  alert("remove , beg");
      temp = temp.replace("''", "','");
    }
    if (temp == "") {
      getOrderStatus(pagecount, rowno);
    } else {
      var count = 1;
      //alert(" ss "+temp+"---");
      $.ajax({
        method: 'POST',
        url: 'get_order_data_account_filter.php',
        data: {
          code: "1",
          cust_name: temp,

        },
        success: function(response) {
          //   alert(response); // display response from the PHP script, if any
          var data = $.parseJSON(response);

          if (data["status"] == "1") {
            //	alert("if "+data["details"]);
            $("#tbodyPostid").empty();
            $("#tbodyPostid2").empty();
            $(data["details"]).each(function() {
              //	alert(this.sno);

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

              $("#tbodyPostid").append('<tr> <th class="nr" style="display:none;">' + this.sno + '</th><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td align="right">' + this.price + '</td><td align="right">' + this.ship + '</td><td align="right">' + this.grandtotal + '</td><td align="right">' + btnstatus + '</td><td>	<button type = "button" class = "btn-info">' + "View" + '</button></td></tr> ');
              $("#tbodyPostid2").append('<tr><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td align="right">' + this.price + '</td><td align="right">' + this.ship + '</td><td align="right">' + this.grandtotal + '</td></tr> ');

              //	alert( "btn "+btnstatus);

              count = count + 1;
            });

            $(".btn-info").click(function() {
              var $row = $(this).closest("tr"); // Find the row
              var $text = $row.find(".nr").text(); // Find the text

              // alert("prod ID "+$text+$stock); 
              editOrder($text);

            });
            // createtable();
          } else {
            alert(" no record found. please try again");
          }
        }
      });

    } // else close



  }
</script>



<script>
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

  function getOrderStatus(pagenov, rownov) {

    var count = 1;
    //  alert(pagenov+"--"+ rownov );
    $.ajax({
      method: 'POST',
      url: 'get_order_data_account.php',
      data: {
        code: "1",
        page: pagenov,
        rowno: rownov
      },
      success: function(response) {
        // alert(response); // display response from the PHP script, if any
        var data = $.parseJSON(response);

        if (data["status"] == "1") {
          //	alert("if "+data["details"]);
          if (rowno < data["totalrow"]) {
            // alert("total "+data["totalrow"] );
            $("#tbodyPostid").empty();
            $("#tbodyPostid2").empty();
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
              $("#tbodyPostid").append('<tr> <th class="nr" style="display:none;">' + this.sno + '</th><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td align="right">' + this.price + '</td><td align="right">' + this.ship + '</td><td align="right">' + this.grandtotal + '</td><td align="right">' + btnstatus + '</td><td>	<button type = "button" class = "btn-info">' + "View" + '</button></td></tr> ');
              $("#tbodyPostid2").append('<tr><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td align="right">' + this.price + '</td><td align="right">' + this.ship + '</td><td align="right">' + this.grandtotal + '</td></tr> ');

              count = count + 1;
            });

            $(".btn-info").click(function() {
              var $row = $(this).closest("tr"); // Find the row
              var $text = $row.find(".nr").text(); // Find the text

              // alert("prod ID "+$text+$stock); 
              editOrder($text);

            });
            // createtable();
          } // // if rowno < total
        } // status =1
      }
    });
  }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
<script>
  $(function() {

    from = $("#from")
      .datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on("change", function() {
        to.datepicker("option", "minDate", getDate(this));
        // alert("from "+ getDate( this ));
      }),
      to = $("#to").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on("change", function() {
        from.datepicker("option", "maxDate", getDate(this));
        //  alert("to "+ $("#to").val());


      });

    function getDate(element) {
      var date;
      try {
        // var dateFormat = "dd-mm-yyyy";
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }
      //  alert(date);
      return date;
    }
  });
</script>
<script>
  function DateFilter() {

    var parts = $("#from").val().split("-");
    var fromdate = new Date(parts[1] + "/" + parts[0] + "/" + parts[2]);

    var parts = $("#to").val().split("-");
    var todate = new Date(parts[1] + "/" + parts[0] + "/" + parts[2]);

    // alert(fromdate+"---"+todate);
    var future = moment(todate);
    var start = moment(fromdate);
    var d = future.diff(start, 'days'); // 9   


    if (d < 0) {
      alert("Invalid Date Range");
    } else {

      //   alert(d );
      var parts = $("#from").val().split("-");
      var fromdate = parts[2] + "-" + parts[1] + "-" + parts[0] + " 00:00:00";

      var parts = $("#to").val().split("-");
      var todate = parts[2] + "-" + parts[1] + "-" + parts[0] + " 23:59:59";
      // alert(fromdate+"---"+todate);
      var count = 1;
      $.ajax({
        method: 'POST',
        url: 'get_order_data_account_date.php',
        data: {
          code: "1",
          startdate: fromdate,
          enddate: todate

        },
        success: function(response) {
          //    alert(response); // display response from the PHP script, if any
          var data = $.parseJSON(response);

          if (data["status"] == "1") {
            //	alert("if "+data["details"]);
            $("#tbodyPostid").empty();
            $("#tbodyPostid2").empty();

            $(data["details"]).each(function() {
              //	alert(this.sno);

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

              $("#tbodyPostid").append('<tr> <th class="nr" style="display:none;">' + this.sno + '</th><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td align="right">' + this.price + '</td><td align="right">' + this.ship + '</td><td align="right">' + this.grandtotal + '</td><td align="right">' + btnstatus + '</td><td>	<button type = "button" class = "btn-info">' + "View" + '</button></td></tr> ');
              $("#tbodyPostid2").append('<tr><th scope="row">' + count + '</th><td>' + this.orderid + '</td><td>' + this.orderdate + '</td> <td> ' + this.name + '</td><td align="right">' + this.price + '</td><td align="right">' + this.ship + '</td><td align="right">' + this.grandtotal + '</td></tr> ');

              //	alert( "btn "+btnstatus);

              count = count + 1;
            });

            $(".btn-info").click(function() {
              var $row = $(this).closest("tr"); // Find the row
              var $text = $row.find(".nr").text(); // Find the text

              // alert("prod ID "+$text+$stock); 
              editOrder($text);

            });
            // createtable();
          } else {
            alert(" no record found. please try again");
          }
        }
      });


    } // else close
    // alert(diffDays);


  }
</script>

<script>
  function pdfclick() {
    // var pdfsize = ;
    var pdf = new jsPDF('p', 'pt', 'a0');

    var res = pdf.autoTableHtmlToJson(document.getElementById("tblname2"));
    pdf.autoTable(res.columns, res.data, {
      startY: 60,
      styles: {
        overflow: 'linebreak',
        fontSize: 30,
        rowHeight: 60,
        columnWidth: 'auto'
      },
      columnStyles: {
        1: {
          columnWidth: 'wrap'
        }
      }
    });

    pdf.save("order_report" + ".pdf");
  };
</script>


<script>
  function fnExcelReport() {
    var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange;
    var j = 0;
    tab = document.getElementById('tblname2'); // id of table


    for (j = 0; j < tab.rows.length; j++) {
      var row = tab.rows[j];
      var numberOfCells = row.cells.length;
      tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";

    }

    tab_text = tab_text + "</table>";
    tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
    tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
    {
      txtArea1.document.open("txt/html", "replace");
      txtArea1.document.write(tab_text);
      txtArea1.document.close();
      txtArea1.focus();
      sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
    } else //other browser not tested on IE 11
      sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

    return (sa);
  }
</script>

<script>
  var pageno = 1;
  var rowno = 0;

  $(document).ready(function() {

    getOrderStatus(pageno, rowno);
    addclick();

  });
</script>