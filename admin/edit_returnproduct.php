<?php
include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}
 $orderid = $_POST['orderid'];
 $prodid = $_POST['prodid'];
 
?>
<?php include("header.php"); ?>

<script type="text/javascript">
        function saveRefund(element) {
          var phonevalue  = document.getElementById("custphonevalue").innerText;
          var orderidvalue = $('#orderid').val();
          var prodidvalue = $('#prodid').val();
          var refundamtvalue = $('#refundamt').val();
          var refundtxnnovalue = $('#refundtxnno').val();
          var refunddatevalue = $('#refunddate').val();
          
          alert( "--"+phonevalue+"---"+prodidvalue );
         $.ajax({
              method: 'POST',
              url: 'add_refund_process.php',
              data: {
                 orderid: orderidvalue,
                prodid: prodidvalue,
                refundamt: refundamtvalue,
                refundtxn: refundtxnnovalue,
                refunddate: refunddatevalue,
                phone: phonevalue,
                code: "123"
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          
                          //  refreshdata();
                        }
            });
            
            
        }
</script>
<script type="text/javascript">
 	
        function savePickup(element) {
          var phonevalue  = document.getElementById("custphonevalue").innerText;
          var pickupdatevalue = $('#pickupdate').val();
          var orderidvalue = $('#orderid').val();
          var prodidvalue = $('#prodid').val();
          
         // alert(  pickupdatevalue+"--"+orderidvalue+"---"+prodidvalue );
         $.ajax({
              method: 'POST',
              url: 'add_pickupdate_process.php',
              data: {
                orderid: orderidvalue,
                prodid: prodidvalue,
                pickupdate: pickupdatevalue,
                phone: phonevalue,
                code: "123"
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          
                          //  refreshdata();
                        }
            });
            
            
        }
</script> 

<script type="text/javascript">
 	
        function returnDone() {
          var orderidvalue = $('#orderid').val();
          var prodidvalue = $('#prodid').val();
          var phonevalue  = document.getElementById("custphonevalue").innerText;
          
         // alert(  pickupdatevalue+"--"+orderidvalue+"---"+prodidvalue );
         $.ajax({
              method: 'POST',
              url: 'add_returncomplete_process.php',
              data: {
                orderid: orderidvalue,
                prodid: prodidvalue,
                phone: phonevalue,
                code: "123"
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          
                          //  refreshdata();
                        }
            });
            
            
        }
</script> 
<script type="text/javascript">
 	
        function saveReason(element) {
          
          var reasonvalue = $('#reason').val();
          var orderidvalue = $('#orderid').val();
          var prodidvalue = $('#prodid').val();
           var phonevalue  = document.getElementById("custphonevalue").innerText;
         
         // alert(  pickupdatevalue+"--"+orderidvalue+"---"+prodidvalue );
         $.ajax({
              method: 'POST',
              url: 'add_cancelreason_process.php',
              data: {
                orderid: orderidvalue,
                prodid: prodidvalue,
                reason: reasonvalue,
                phone: phonevalue,
                code: "123"
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          
                          //  refreshdata();
                        }
            });
            
            
        }
</script>

<script>
    $(document).ready(function(){
       
         refreshdata();
   
    
    });
    
      function refreshdata(){   
	        var order_id = $('#orderid').val();
            var prod_id = $('#prodid').val();
                                                           
          // alert("--"+order_id+"--"+prod_id); 
             $.ajax({
              method: 'POST',
              url: 'edit_returnproduct_data.php',
              data: {
                code: "123",
                orderid: order_id,
                prodid: prod_id
              },
              success: function(response){
                         //   alert(response); // display response from the PHP script, if any
                          //$('#msgdiv').val("subsdfa");
                         var data = $.parseJSON(response);
                        
                        if(data["status"]=="1"){
                             //  alert("status "+data["orderId"]);
                               $('#orderidvalue').html(data["orderId"]);
                               $('#orderdate').html(data["orderdate"]);
                               $('#custname').html(data["username"]);
                                $('#custphonevalue').html(data["phone"]);
                                $('#custemailvalue').html(data["email"]);
                               $('#shipping').html(data["address"]);
                               $('#orderstatus').html(data["orderstatus"]);
                               $('#deliverymode').html(data["deliverymode"]);
                               $('#paymentid').html(data["paymentid"]);
                               $('#subtotal').html(data["subtotal"]);
                               $('#ship').html(data["ship"]);
                               $('#grandtotal').html(data["grandtotal"]);
                               $('#deliveryid').html(data["deliveryid"]);
                               $('#discount').html(data["discountvalue"]);
                                $('#couriername').val(data["curriername"]);
                                $('#trackingid').val(data["trackid"]);
                                $('#pickupdate').val(data["pickupdate"]);
                                $('#reason').val(data["reason"]);
                                $('#refundamt').val(data["refund_amt"]);
                                $('#refundtxnno').val(data["refund_txnno"]);
                                $('#refunddate').val(data["refund_date"]); 
                                $('#reqdate').html(data["status_date"]);  
                                $('#returnstatus').html(data["return_status"]);
                                $('#returnupdateby').html(data["return_updateby"]);
                               // add prod details
                               $("#tbodyPostid").empty();
                            var count =1;    	 
                               $(data["proddetails"]).each(function() {
                            	
                            	//	alert( "btn "+btnstatus);
                            		$("#tbodyPostid").append('<tr> <th style="display:none;"><input type="text" class="nrprodid" style="width:30px;" value="'+this.prodid+'"></input></th><th scope="row">'+count+'</th><td  style="display:none;"><img   src='+this.img+' style="width: 121px; height: 72px;"></td><td class="dontprint">'+this.sellername+'</td><td>'+this.prodname+'</td> <td> '+this.otherart+'</td><td >'+this.price+'</td><td style="display:none;">'+this.ship+'</td><td>'+this.total+'</td><td class="dontprint" style="color:red">'+this.prodstatus+'</td></tr> ');
                               	//	alert(this.orgqty);
                            			
                               	count = count+1
                            });
                            
                         
                            
                        }else{
                            
                            
                        }
                        
         
                    }
            });
        }
        
</script>
<script>

	 
        
	   function updateOrder(id){   
	       
            var order_id = $('#orderid').val();
            var  phone  = document.getElementById("custphonevalue").innerText;
            var  email  = document.getElementById("custemailvalue").innerText;
            var  grandtotal  = document.getElementById("grandtotal").innerText;
            var couriervalue = $('#couriername').val();
            var trackidvalue = $('#trackingid').val();
            var orderidvalue =document.getElementById("orderidvalue").innerText; 
            var custnamevalue =document.getElementById("custname").innerText; 
                            
                                                        
           // alert("order--"+order_id+" phone "+phone+" email "+email+" actionid "+id); 
           // alert("cur "+couriervalue+"--track "+trackidvalue);
             $.ajax({
              method: 'POST',
              url: 'update_order_status.php',
              data: {
                code: "123",
                orderid: order_id,   /// it is order sno only
                action: id,
                phone: phone,
                email: email,
                grandtotal: grandtotal,
                couriername: couriervalue,
                trackingid: trackidvalue,
                custname: custnamevalue,
                orderidvalue : orderidvalue,
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          //$('#msgdiv').val("subsdfa");
                          $("#test1").html("<b>"+response+" : "+id+"</b>");
                          $("#orderstatus").html("<b>"+id+"</b>");  
                           // getProductImage(prod_id);
                    }
            });
        }
        
</script>
		<!-- main content start-->
			    <?php
                                 $sellername =""; $selleraddress="";$sellerphone =""; $sellergstn="";
                                 $stmt11 = $conn->prepare("SELECT store_name, address, phone, tax_no FROM store_setting");
                                 $stmt11->execute();
                            	 $stmt11->store_result();
                            	 $stmt11->bind_result (  $col1, $col2, $col3, $col4);
                            	 
                            	 while($stmt11->fetch() ){
                            	   //  echo " order id ".$col1;
                            	 	
                            	    $sellername = $col1; $selleraddress =$col2; $sellerphone=$col3; $sellergstn=$col4; 
                            	 }
      
               ?>
		<div id="page-wrapper">
			<div class="main-page">
			  <div class="tables">
	
 		 
        	    <div class="bs-example widget-shadow" data-example-id="hoverable-table"> 
        <div id="printableArea">	         
        	    	<input type="hidden" class="form-control1" id="orderid" value=<?php echo $orderid; ?> ></input>
        	        <input type="hidden" class="form-control1" id="prodid" value=<?php echo $prodid; ?> ></input>
        
        			<input type="hidden" class="form-control1" id="cust_phone" value=<?php echo $cust_phone; ?> ></input>
        			<input type="hidden" class="form-control1" id="cust_email" value=<?php echo $cust_email; ?> ></input>
 
  <!-- title row -->
      <div class="row">

      <div class="col-xs-12">
           <div style="text-align:center;">
            <h3 >INVOICE</h3>    
          </div>
          <h4 class="page-header">
               <div class="pull-right"> 
                    Invoice# : <span id="orderidvalue" class="orderidvalue" ></span><br>
                    <small class="pull-right" style="margin-top:10px;"> <span id="orderdate"></span></small>
            
                </div> 
            
             <p style="color:black;font-size:26px; ">   <img src="../logo.png" style="width:100px; height=80px; margin-right:20px;"> </img>  <b><?php echo $sellername ;  ?></b>
      		    <input type="hidden" class="form-control1" id="orderid"  ></input>
    	    </p>
            
          </h4>
        </div>
        <!-- /.col -->
        
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <strong>  Customer Name </strong> 
          <address>
             <span id="custname"></span><br>
            <span id="custphonevalue" style="display:none"></span> <br>
             <span id="custemailvalue" style="display:none" ></span> </address>
    
          
        
        </div>
        
        <div class="col-sm-4 invoice-col" style="display: none;">
          <strong>  Customer Name </strong> 
          <address>
            <span id="custname"></span><br>
            <span id="custemail"></span>      </address>
        </div>
        
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <strong>  Shipping Address </strong> 
          <address>
        
             <span id="shipping"></span>
            
          </address>
        </div>
        <!-- /.col -->
         
        <div class="col-sm-4 invoice-col">
         
          <b>Order Status: </b> <br> <strong> <a id="orderstatus" style="color:red"> <span id="orderstatus"></span></a></strong> <br>
          <b>Return Request: </b> <br> <strong> <a id="orderstatus" style="color:red"> <span id="reqdate"></span></a></strong> <br><br> 
          <b>Last Action: </b> <br> <strong> <a id="orderstatus" style="color:green"> <span id="returnstatus"></span></a></strong> <br>
          <b>Action Date: </b> <br> <strong> <a id="orderstatus" style="color:green"> <span id="returnupdateby"></span></a></strong> <br><br> 
  
        </div>
      
        <!-- /.col -->
         <div class="col-sm-4 invoice-col" style="display:none;">
           </br>  </br>
          <b>Delivery Date: </b> <br> <strong> <a id="deliveryid" style="color:green"> <span id="deliveryid"></span></a></strong> <br>
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
       <!-- Table row -->
      <div class="row">
           <div class="row invoice-info">
     
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped" style="border: 1px solid black;">
            <thead>
            <tr>
              <th>Sr no</th>
              <th style="display:none;">Image</th>
              <th class="dontprint">StockistName</th>
              <th>Product Name</th>
               <th>Prod. Details</th>
              <th>Price(KWD)</th>
              <th>Qty</th>
              <th style="display:none;">Ship.(KWD)</th>
              <th>Total(KWD)</th>
              <th class="dontprint">Status</th>  
            </tr>
            </thead>
            
            <tbody id="tbodyPostid">
            
            <tr>
                 
                  
                
         	<input type="hidden" class="form-control1" id="prodid" value=<?php echo   $sno; ?> ></input>
    
            </tr>
                                   
            </tbody>
          </table>
        </div>
        </div>
        <!-- /.col -->
      
         
      </div>
      <!-- /.row -->
  
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <strong>Payment Methods:</strong> <br>
          <a style="color:black;"><span id="deliverymode"></span></a><br><br>
          <strong>Payment TXN ID: </strong><br>
          <a style="color:black;"><span id="paymentid"></span></a>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal (KWD):</th>
                <td><span id="subtotal"></span></td>
              </tr>
              <tr>
                <th>Shipping (KWD):</th>
                <td><span id="ship"></span></td>
              </tr>
               <tr >
                <th>Coupan Value (KWD):</th>
                <td><span id="discount"></span></td>
              </tr>
              <tr>
                <th>Total (KWD):</th>
                <td><span id="grandtotal"></span></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!--- /.row -->
   </div> 	<!-- print area close-->   
   
<script>
        function myPrint(divName) {
            var printContents = document.getElementById(divName).innerHTML;
             var originalContents = document.body.innerHTML;
             document.body.innerHTML = printContents;
        
             window.print();
        
             document.body.innerHTML = originalContents;
        }
        
</script>
            <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
      
            <button  type="submit"   href="javascript:void(0)" onclick="myPrint('printableArea'); return false;"  class="btn btn-primary pull-right" style="margin-right: 5px;" >
                <i class="fa fa-download"></i> Generate Invoice
            </button>  
          
         
          
       	<form class="form-inline" id="myform">
				    <div class="form-group"> 
					    <input type="text" class="form-control" id="couriername" placeholder="Courier Name"> 
					</div>
				    <div class="form-group"> 
					       <input type="text" class="form-control" id="trackingid" placeholder="Tracking ID"> 
					</div>
		 </form>
		 </br>
		   	<form class="form-inline" id="myform">
				<button type="submit" class="btn btn-warning" value="Upload" href="javascript:void(0)" onclick="savePickup(this); return false;">Update Pickup Date</button> 
	
				    <div class="form-group"> 
					    <input type="text" style="width:300px;" class="form-control" id="pickupdate" placeholder="PickupDate DD-MM-YYYY"> 
					</div>
				   
		
		 </form> 
          
         </br>
		 <form class="form-inline" id="myform">
				<button type="submit" class="btn btn-danger" value="Upload" href="javascript:void(0)" onclick="saveReason(this); return false;">Cancel Return Req.</button> 
	
				    <div class="form-group"> 
					    <input type="text" style="width:400px;" class="form-control" id="reason" placeholder="Reason for cancel return request"> 
					</div>
				   
		 </form>
		 </br> 
		 <form class="form-inline" id="myform">
					<button type="submit" class="btn btn-default" value="Upload" href="javascript:void(0)" onclick="saveRefund(this); return false;">Update Refund Amt.</button> 
	
				    <div class="form-group"> 
					    <input type="text" class="form-control" id="refundamt" placeholder="Refund Amount"> 
					</div>
				    <div class="form-group"> 
					       <input type="text" class="form-control" id="refundtxnno" placeholder="Transation ID"> 
					</div>
					<div class="form-group"> 
					       <input type="text" class="form-control" id="refunddate" placeholder="Refund Date DD-MM-YYYY"> 
					</div>
		  </form> 
            </br>
           <button type="submit"  href="javascript:void(0)" onclick="returnDone(); return false;" class="btn btn-success" style="margin-right: 5px;"> Return Successful  </button>
                
        
        </div>
      </div></br></br>
      	         <center> <p id="test1" style="color:green;"></p></center>
        					
        		     
             <div class="clearfix"> </div>
		</div>  
		 
      
			<div class="clearfix"> </div>
			
		</div>
			    
	
	<!-- for amcharts js -->
			<script src="js/amcharts.js"></script>
			<script src="js/serial.js"></script>
			<script src="js/export.min.js"></script>
			<link rel="stylesheet" href="css/export.css" type="text/css" media="all" />
			<script src="js/light.js"></script>
	<!-- for amcharts js -->

    <script  src="js/index1.js"></script>
	
		
		<div class="col_1">
			
			
			<div class="clearfix"> </div>
			
		</div>
				
			</div>
		</div>
		<!--footer-->
              <?php    include('footernew.html'); ?>
        <!--//footer-->
	</div>
		


	
	<!-- Classie --><!-- for toggle left push menu script -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->
		
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	

	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->
	
</body>
</html>