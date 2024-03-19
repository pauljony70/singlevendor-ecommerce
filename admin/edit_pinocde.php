<?php
include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

 $pincodeid = $_POST['pincodeid'];
 
?>
<?php include("header.php"); ?>

<script type="text/javascript">
 
     	
        function editPincodefees(element) {
          
          var pincodevalue = $('#pincodev').val();
          var namevalue = $('#name').val();
          var shipfeesvalue = $('#shipvalue').val();
         // var myJSON = JSON.stringify(imagejson);
        // alert( "kaka "+ imagejson);
        
         $.ajax({
              method: 'POST',
              url: 'edit_pincode_shipfees_process.php',
              data: {
                code: "325846122", 
                pincodeid: pincodevalue,
                areaname: namevalue,
                shipfees: shipfeesvalue
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          //  window.open("events.php","_self");  
                           $(':input','#myform')
                                  .not(':button, :submit, :reset, :hidden')
                                  .val('');
                        
                        }
            });
        }
</script>


		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			    <div class="panel-info widget-shadow">
                
		           <h4>Edit Pincode</h4>
						
				<div class="form-two widget-shadow">
					
						<div class="form-body" data-example-id="simple-form-inline">
						    <input type="hidden" class="form-control1" id="cat_id" value=<?php echo $pincodeid; ?> ></input>
							<form class="form-inline" id="myform">
							     <div class="form-group"> 
							     <?php
							         $areaname ="";  $shipfees =0;
    							      $stmt = $conn->prepare("SELECT name, shippingfee FROM pincode WHERE pincode=?");
                                	   $stmt->bind_param( i,  $pincodeid );
                                	   $stmt->execute();	 
                                 	   $data = $stmt->bind_result( $col1, $col2);
                                       $return = array();
                                	   $i =0;
                                   	   while ($stmt->fetch()) { 
                                	       
                                    	   $areaname = $col1;  $shipfees = $col2;		  
                                           // echo " array created".json_encode($return);
                                	    }
							     ?>
								<div class="form-body" data-example-id="simple-form-inline">
        							<form class="form-inline" id="myform">
        							     <div class="form-group"> 
        							        <label for="name">Area</label> 
        						            <input type="text" class="form-control" id="name" placeholder="Area Name" value="<?php echo $areaname; ?>"> 
        							     </div>
        							       <div class="form-group"> 
        							        <label for="name">Pincode</label> 
        						            <input type="text" class="form-control" id="pincodev" disabled placeholder="Pin Code" value="<?php echo $pincodeid; ?>"> 
        							     </div>
        							     <div class="form-group"> 
        							        <label for="name">Shipping Fees</label> 
        						            <input type="text" class="form-control" id="shipvalue" placeholder="Shipping Fees" value="<?php echo $shipfees; ?>"> 
        							     </div>
        								<button type="submit" class="btn btn-default" value="Upload" href="javascript:void(0)" onclick="editPincodefees(this); return false;">Save</button> 
        		                     </form> 
        						</div>
							     
							     </div>
						    
							   
					        </form> 
						</div>
				

				</div>
				<div class="clearfix"> </div>
			</br>

				
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