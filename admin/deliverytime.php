<?php
include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}
 $productid = $_POST['productid'];
 $stock = $_POST['stock'];
 $rowProdJsonArray = "";
?>
<?php include("header.php"); ?>

<script>
  var imagejson = [];
  var attrjson = [];
  var atr_id =0; var attvalue_id = 0;
		$(document).ready(function(){
		  
		
			$("#moreAttribute").click(function(){
				var showId = ++atr_id;
					$(".add-attr").append('<br><input type="text"  id="'+showId+'" class="form-control"  placeholder="Attribute" style="width:200px; float:left; display: inline-block; margin-right:20px;"> </input> '+
				
					'<button name="btn_save-'+showId+'" type="submit" class="btn btn-sm btn-success" onclick="saveInfo('+showId +'); return false;" style="float:left; display: inline-block; margin-right:20px;">Save</button>'+
					'<button name="btnremove-'+showId+'" type="submit" class="btn btn-sm btn-danger" onclick="removeInfo('+showId+'); return false;" style="float:left; display: inline-block; margin-right:20px;">Remove</button><br>');
		
			});
			
		});
		

</script>
<script>
    function saveInfo(element){
          //var file_data = $('#'+element).prop('files')[0]; 
        var count = Number(element);
       
       var attrname = $('#'+element).val();
      // alert("save "+attrname+" --"+count);
          $.ajax({
              method: 'POST',
              url: 'add_deliverytime_process.php',
              data: {
                code: "123",
                newtime: attrname,
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                           location.reload();
                        }
            });
      
    }
    
</script>
<script>
    function removeInfo(element){
          //var file_data = $('#'+element).prop('files')[0]; 
         var count = Number(element);
         var attrname = $('#'+element).val();
       // alert("remove "+attrname+" --"+count);
       $.ajax({
              method: 'POST',
              url: 'delete_deliverytime_process.php',
              data: {
                code: "123",
                timevalue: attrname,
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                           location.reload();
                        }
            });
        
    }
    
</script>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			  	    	<div class="tables">
        			    <!--	<div class="bs-example widget-shadow" data-example-id="hoverable-table"> -->
        					
        						<?PHP
        						     $timearray=array(); 
        						     $count =0;
                                    $stmt = $conn->prepare("SELECT timevalue FROM deliverytime");
                                    $stmt->execute();
                                    $stmt->store_result();
                                    $stmt->bind_result($col1 );
                                    
                                    while ($stmt->fetch()) {
                                       //  echo "json ".$size;
                                      
                                       $timearray[$count] = array( 'attrnam' => $col1 );
                                       $count = $count +1;
                                    }
                               	
        						?>
        					
        					    <div class="form-three widget-shadow">
        					        	<h4>Select Delivery Time </h4>
        							<form class="form-horizontal" id="myform">
        								<div class="form-group">
                                             
                                            <label for="exampleInputFile" class="col-sm-2 control-label"></label> 
                                           
                                            <div class="input-files1">
                                                <a class="fa fa-plus fa-4 btn btn-primary" aria-hidden="true"  id="moreAttribute">Add Mote Time</a>
                                            </div>
                                            
                                            </br>
                                            <label for="exampleInputFile" class="col-sm-2 control-label"></label> 
                                            
                                             <div class="col-sm-9"> 
                                                   <div class="add-attr">
                                                    
            								         
                                				 </div>
                                	       </div>
                                        </div>
        								
        								<script>
        								
        							            // pass PHP variable declared above to JavaScript variable
                                                attrjson = <?php echo json_encode($timearray); ?>;
                                              
                                              //  alert("lenght "+ attrjson.length);
                                                
                                                   // var  atr_id =301; var attvalue_id = 401;
                                                   for (var i=0; i<attrjson.length; i++) {
                                                        var counter = attrjson[i];
                                                       // alert( counter.attrnam + "-- "+counter.attrvalue);
                                                        var showId = ++atr_id;
                                        				$(".add-attr").append('<br><input type="text"  id="'+showId+'" class="form-control"  value="'+counter.attrnam+'" style="width:200px; float:left; display: inline-block; margin-right:20px;"  disabled> </input> '+
                                        				
                                        					'<button name="btn_save-'+showId+'" type="submit" class="btn btn-sm btn-success" onclick="saveInfo('+showId +'); return false;" style="float:left; display: inline-block; margin-right:20px;">Save</button>'+
                                        					'<button name="btnremove-'+showId+'" type="submit" class="btn btn-sm btn-danger" onclick="removeInfo('+showId+'); return false;" style="float:left; display: inline-block; margin-right:20px;">Remove</button><br>');
                                        		
                                                   }
                                            
                                                
                                                //var imagejson = [];
                                        </script> 
        								
        								
                                    
        							
        								</br></br>
        								 <div class="col-sm-offset-2">
        								          <button type="submit" class="btn btn-default" href="javascript:void(0)" onclick="saveProduct(this); return false;">Save</button>
        								          <button type="submit" class="btn btn-default" href="javascript:void(0)" onclick="javascript:history.back()">Cancel</button>
        							
        								</div>
                                        
                                        
        							</form>
        						</div>	
        							
        			<!--		</div>  -->
    					</div>
			
				
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