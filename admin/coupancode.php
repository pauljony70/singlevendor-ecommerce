<?php
include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<script type="text/javascript">
 	
        function addCoupan() {
          var name_value = $('#cname').val();
          var value_value = $('#cvalue').val();
          var capvalue_value = $('#capvalue').val();
          var minorder_value = $('#minorder').val();     
          var fromdate_value = $('#fromdate').val();
          var todate_value = $('#todate').val();
          
     
      //    alert(  name_value +" --"+ value_value+"--"+ fromdate_value+"--"+ todate_value );
        $.ajax({
              method: 'POST',
              url: 'add_coupan_process.php',
              data: {
                coupancode: name_value,
                cvalue: value_value,
                capvalue: capvalue_value,
                minorder: minorder_value,
                fromdate: fromdate_value,
                todate: todate_value ,
                code: "123"
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          //  window.open("events.php","_self");  
                           $(':input','#myform')
                                  .not(':button, :submit, :reset, :hidden')
                                  .val('');
                          getBrand();
                        }
            });
            
        }
</script>
<script type="text/javascript">
 	
        function editStatus(element, statusvalue) {
          
     
     //     alert(  namevalue  );
        $.ajax({
              method: 'POST',
              url: 'edit_coupan_status.php',
              data: {
                coupanid: element,
                statusid: statusvalue,
                code: "123"
              },
              success: function(response){
                           // alert(response); // display response from the PHP script, if any
                          //  window.open("events.php","_self");  
                           var data = $.parseJSON(response);
                            
                           alert(data["msg"]);
                           
                           $(':input','#myform')
                                  .not(':button, :submit, :reset, :hidden')
                                  .val('');
                          getBrand();
                        }
            });
            
        }
</script>
<script>
        function getBrand(){
          
           // alert( "sdfs" );
            var count =1;
            $.ajax({
              method: 'POST',
              url: 'get_coupancode_data.php',
              data: {
                code: "123"
              },
              success: function(response){
                          // alert(response); // display response from the PHP script, if any
                            var data = $.parseJSON(response);
                            $("#tbodyPostid").empty();
                            var data = $.parseJSON(response);
                            
                           if(data["status"]=="1"){
                             $(data["details"]).each(function() {
	                                	var btnstatus ="";
                                		if(this.activate == "active"){
                                		   // btnstatus=	'<span class="label label-success">Completed</span>';
                                		   btnstatus= '<button type = "button" class = "btn-success">'+"Active"+'</button>';
                                		}else if(this.activate == "inactive"){
                                		  //  btnstatus=	'<span class="label label-danger">Cancelled</span>';
                                		  btnstatus=  '<button type = "button" class = "btn-warning">'+"InActive"+'</button>';
                                		}
                                		
                                	//	alert( "btn "+btnstatus);
                                		$("#tbodyPostid").append('<tr> <th class="nr" style="display:none;">'+this.id+'</th><th scope="row">'+this.id+'</th><td>'+this.name+'</td><td>'+this.value+'</td><td>'+this.cap_value+'</td> <td>'+this.minorder+'</td> <td> '+this.fromdate+'</td><td> '+this.todate+'</td><td>'+btnstatus+'</td></tr> ');
                                   			
                                   	count = count+1;
                            });
                           }  
                           
                             $(".btn-warning").click(function() {
                                      var $row = $(this).closest("tr");    // Find the row
                                     var $text = $row.find(".nr").text(); // Find the text
                                   // alert(" counapm id "+$text);
                                     editStatus($text, "active");
                              
                            });
                              $(".btn-success").click(function() {
                                      var $row = $(this).closest("tr");    // Find the row
                                     var $text = $row.find(".nr").text(); // Find the text
                                 //   alert(" counapm id "+$text);
                                   editStatus($text, "inactive");
                              
                            });
                    }
            }); 
        }
</script>
<script>
    $(document).ready(function(){
	
	getBrand();
    
});
</script>

		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			    <div class="panel-info widget-shadow">
                
		           
				<div class="form-two widget-shadow">
						<div class="form-title">
							<h4>Add Coupan Code</h4>
						
						</div>
						<div class="form-body" data-example-id="simple-form-inline">
							<form class="form-inline" id="myform">
							     <div class="form-group"> 
							        <label for="name">Coupan Code</label> 
						            <input type="text" class="form-control" id="cname" placeholder="Coupan Code"> 
							     </div>
							       <div class="form-group"> 
							        <label for="name">Value(%)</label> 
						            <input type="text" class="form-control" id="cvalue" placeholder="Coupan Value in %"> 
							     </div>
							     <br><br>
							     <div class="form-group"> 
							        <label for="name">Cap Value(KWD)</label> 
						            <input type="text" class="form-control" id="capvalue" placeholder="Max Discount value in KWD."> 
							     </div>
							     
							     <div class="form-group"> 
							        <label for="name">Min Order(KWD)</label> 
						            <input type="text" class="form-control" id="minorder" placeholder="Min Order value in KWD."> 
							     </div>
							     <br><br>
							      <div class="form-group"> 
							        <label for="name">Start Date</label> 
						            <input type="text" class="form-control" id="fromdate" placeholder="YYYY-MM-DD"> 
							     </div>
							      <div class="form-group"> 
							        <label for="name">End Date</label> 
						            <input type="text" class="form-control" id="todate" placeholder="YYYY-MM-DD"> 
							     </div>
								<button type="submit" class="btn btn-default" value="Upload" href="javascript:void(0)" onclick="addCoupan(this); return false;">Add</button> 
		       </form> 
						</div>
				</div>
				<div class="clearfix"> </div>
			</br>
                      <div class="work-progres">
                                        <header class="widget-header">
                                              <div class="pull-right" style="float:left;">
                                        	        Total Row :	<a id="totalrowvalue" class="totalrowvalue"></a>
                                            </div>
                                            <h4 class="widget-title">All Coupans</h4>
                                          
                                        </header>
							<hr class="widget-separator">
                            <div class="table-responsive">
                        	<table class="table table-hover"  id="tblname" > 
            			          <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Coupan Code</th>
                                      <th>Value(%)</th>
                                      <th>Max Value(KWD)</th>
                                      <th>Min.Order(KWD)</th>
                                      <th>From Date</th>                     
                                      <th>To Date</th> 
                                      <th>Status</th>
                                    
                                  </tr>
                              </thead>
                           	<tbody id="tbodyPostid"> 
            			
                          </tbody>
                      </table>
                  </div>
             </div>
			
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
	<div class="footer">
		   <p>&copy; 2018 BlueApp Software. All Rights Reserved | Design by <a href="https://www.blueappsoftware.com/" target="_blank">BlueApp Software</a></p>
	</div>
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