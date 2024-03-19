<?php
include('session.php');

if(!isset($_SESSION['admin'])){
  header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<script>
	var pageno =1; var rowno =0;
    $(document).ready(function(){

	getOrderStatus(pageno, rowno);
		//addclick();
	
	   setInterval(function() {

 	        getOrderStatus(pageno, rowno);
        }, 30000);
    
});

function getOrderStatus(pagenov, rownov){
              
            var count =1;
           // alert("--"+pagenov+"--"+ rownov );
            $.ajax({
              method: 'POST',
              url: 'get_home_banner_data.php',
              data: {
                code: "1",
                page: pagenov,
                rowno: rownov
              },
              success: function(response){
                         //  alert(response); // display response from the PHP script, if any
                            var data = $.parseJSON(response);
                            
                          if(data["status"]=="1"){
                             // alert("total "+data["totalrow"] );
                              if(rowno <data["totalrow"]){
                                 // alert("total "+data["totalrow"] );
                                   $("#tbodyPostid").empty();
                         
                                    rowno = data["totalrow"];	 
                                    pageno = data["pageno"];
                                    
                                    $('#pagenovalue').html(pageno );
                                    $('#pagenovalue2').html(parseInt(pageno)+1 );
                                    $('#pagenovalue3').html(parseInt(pageno)+2 );
                                    $('#pagenovalue4').html(parseInt(pageno)+3 );  
                                    $('#pagenovalue5').html(parseInt(pageno)+4 );
                                    $('#totalrowvalue').html(rowno );
                                
                                     $(data["details"]).each(function() {
                                		//alert(this.rollno);
                                	
                                	
                                	//	alert( "btn "+btnstatus);
                                		$("#tbodyPostid").append('<tr> <td>'+this.home_banner_id+'</td><td>'+this.title+'</td><td><img height="50" width="50" src="../media/'+this.img_url+'" /></td> <td>	<button type = "button" class = "btn-warning">'+"Edit"+'</button></td></tr> ');
                                   			
                                   	count = count+1;	
                                });
                                
                                $(".btn-warning").click(function() {
                                      var $row = $(this).closest("tr");    // Find the row
                                     var $text = $row.find(".nr").text(); // Find the text
                                  
                                   // alert("prod ID "+$text+$stock); 
                                     editOrder($text);
                              
                                });
                                // createtable();
                                    
                                    
                            } // if rowno < total
                          } // status =1
                        }
            });
        }

</script>

<script>
    function editCategory() {
            //alert(item);
            var editstring ="";
            var count =0;
             
            $('input:checkbox[name=chkbox]:checked').each(function() 
            {
              // alert( $(this).val());
               
                if(count==0){
                    editstring =  $(this).val();       
                }else{
                   // deletestring = deletestring +", "+ $(this).val();   
                }
                count = count+1;
             
            });
            if(count>1){
                alert("Please Select One Category only.");
            }else{
              //  alert("catid "+editstring);
                 var mapForm = document.createElement("form");
                mapForm.target = "_self";
                mapForm.method = "POST"; // or "post" if appropriate
                mapForm.action = "edit_category.php";
            
                var mapInput = document.createElement("input");
                mapInput.type = "text";
                mapInput.name = "catid";
                mapInput.value = editstring;
                mapForm.appendChild(mapInput);
            
            
                document.body.appendChild(mapForm);
            
                map = window.open("", "_self" );
            
                if (map) {
                    mapForm.submit();
                } else {
                    alert('You must allow popups for this map to work.');
                }   
                
            }
            
             
        }
        
    function deleteCategory(){
        
      // alert("delete call");
        var event_idarray = new Array();
        var deletestring ="";
        var count =0;
         
        $('input:checkbox[name=chkbox]:checked').each(function() 
        {
           //alert( $(this).val());
            event_idarray.push($(this).val());
            if(count==0){
                deletestring =  $(this).val();       
            }else{
                deletestring = deletestring +", "+ $(this).val();   
            }
            count = count+1;
         
        });
        
         // alert(deletestring );
         
            $.ajax({
                  method: 'POST',
                  url: 'delete_category.php',
                  data: {
                    deletearray: deletestring
                  
                  },
                  success: function(response){
                                alert(response); // display response from the PHP script, if any
                               getCategory();
                           
                            }
                });
    }
    
</script>


<script type="text/javascript">
 var imagejson = "";
        function uploadImage(element) {
          
           //  alert( "input name---"+ element+"---" );
            var file_data = $('#'+element).prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
          //  alert("sdfsdf");                             
                $.ajax({
                            url: 'add_banner_image.php', // point to server-side PHP script 
                            dataType: 'text',  // what to expect back from the PHP script, if anything
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,                         
                            type: 'post',
                            success: function(response){
                                 // alert(response); // display response from the PHP script, if any
                                  var thumname = response.replace("Upload successfully--", "");   
                            
                                    imagejson = thumname  ;
                                addcategory(1);
                            }
                 });
                 
            }
     	
        function addcategory(element) {
          
          var titlevalue = $('#title').val();
          var descriptionvalue = $('#description').val();
         // var myJSON = JSON.stringify(imagejson);
        // alert( "kaka");
        
         $.ajax({
              method: 'POST',
              url: 'add_home_banner_process.php',
              data: {
                title: titlevalue,
                description : descriptionvalue,
                code: "123",
                img: imagejson,
                parentid: parentvalue
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          //  window.open("events.php","_self");  
                           $(':input','#myform')
                                  .not(':button, :submit, :reset, :hidden')
                                  .val('');
                          getCategory();
                          imagejson ="";
                        }
            });
        }
</script>
<script>
    function goHome(){
        parentvalue = 0;
        getCategory();
    }
    
    
</script>
<script>
        function getCategory(){
          
          //  alert( "sdfs" );
            var count =1;
            $.ajax({
              method: 'POST',
              url: 'get_category_data.php',
              data: {
                code: "123",
                parentid: parentvalue
              },
              success: function(response){
                         //  alert(response); // display response from the PHP script, if any
                           // var data = $.parseJSON(response);
                              $("#cat_list").empty();
                             var parsedJSON = JSON.parse(response);
                             
                              $("#bredcrum").text(parsedJSON.parentv); 
                            //  alert(" parent "+parsedJSON.parentv);
                             var data = parsedJSON.subcat; 
                             //   alert("data size "+data.length);
                            var order = data.length;    
                            $(data).each(function() {
                            		//alert(this.rollno);
                            		var optionsAsString = "";
                                    for(var i = 0; i < data.length; i++) {
                                        if(this.orderno == i){
                                             optionsAsString += "<option value='" + i + "' selected >" + i + "</option>";
                                            
                                        }else{
                                            optionsAsString += "<option value='" + i + "' >" + i + "</option>";
                                            
                                        }
                                    }
                            	//	$("#cat_list").append('<li><input type="checkbox" name="chkbox"  value="'+this.id+'"/><lable>'+this.name+'</label> </li>');
                               	    $("#cat_list").append('<li> <div class="checkbox-inline1"><input  type="checkbox" class="chkboxx" name="chkbox" value="'+this.id+'"><select name="catorderlist" class="catorderlist" style="margin-left:10px; margin-right:10px;">'+optionsAsString+'</select><label class = "cat-name"> '+this.name+'</label> <img src='+this.img+' style="width: 72px; height: 72px;  border-radius: 50%;">'+
                               	                           '</div></li>');
                          		
                               	count = count+1;	
                            });
                            
                            $(".cat-name").click(function() {
                                 var $row = $(this).closest("li");    // Find the row
                                 var text = $row.find(".chkboxx").val(); 
                                 parentvalue = text;
                                // alert("cat ID "+text); 
                                 getCategory()
                          
                            });
                            
                            $('select[name="catorderlist"]').on('change', function(){   
                                   var $row = $(this).closest("li");    // Find the row
                                 var text = $row.find(".chkboxx").val(); 
                              
                               // alert("catid "+text+"---"+$(this).val());   
                                editCatOrder(text,$(this).val() );
                            });
                            
                          
                    }
            }); 
        }
</script>
<script>
    
    function editCatOrder(idvalue, orderno){
           $.ajax({
              method: 'POST',
              url: 'edit_category_order.php',
              data: {
               
                catid: idvalue,
                ordernumber: orderno
              },
              success: function(response){
                            alert(response); // display response from the PHP script, if any
                          //  window.open("events.php","_self");  
                         // getCategory();
                          //imagejson ="";
                        }
            });
    }
</script>

<script>
var parentvalue = 0;
    $(document).ready(function(){
	
	getCategory();
    
});
</script>

		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			    <div class="panel-info widget-shadow">
                
		           <h4>Add Home Banner</h4>
						
				<div class="form-two widget-shadow">
					
						<div class="form-body" data-example-id="simple-form-inline">
						    
							<form class="form-inline" id="myform">
							     <div class="form-group"> 
							        <label for="name">Title</label> 
							        <input type="text" class="form-control" id="title" placeholder="Title"> </input>
							     
							     </div>
							     <div class="form-group"> 
							        <label for="name">Description</label> 
							        <input type="text" class="form-control" id="description" placeholder="Description"> </input>
							     
							     </div>
							      <div class="form-group">
    							      <label for="image">Image</label>
    							      <input type="file" name="1" id="1" required></input> 
    							 </div>           
                            
							   
								<button type="submit" class="btn btn-default" value="Upload" href="javascript:void(0)" onclick="uploadImage('1'); return false;">Add</button> 
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
                                            <h4 class="widget-title">Home Banners</h4>
                                          
                                        </header>
							<hr class="widget-separator">
                            <div class="table-responsive">
                        	<table class="table table-hover"  id="tblname" > 
            			          <thead>
                                    <tr>
                                      <th>Banner ID</th>
                                      <th>Title</th>
                                      <th>Image</th>                     
                                      <th>Action</th>
                                  </tr>
                              </thead>
                           	<tbody id="tbodyPostid"> 
            			
                          </tbody>
                      </table>
                  </div>
             </div>

                     <div  class="pull-right" style="float:left; margin-right:10px;">  
                 
                   
                      <button  style='margin-right:30px;' type="submit" class="label pull-left label-warning" value="delete" name="delete" href="javascript:void(0)" onclick="deleteCategory(this); return false;">DELETE</button>
               
                    <button   type="submit" class="label pull-left label-warning" value="edit" name="edit" href="javascript:void(0)" onclick="editCategory(this); return false;">EDIT</button>
                				
                     </div>
				  <h2>Category Name</h2>
				  <lable>Click on name to create subcategory</lable>
                  <i class="fa fa-home fa-2x" onclick="goHome(this); return false;"></i>  <label id="bredcrum" style="color:blue;"></label>
                </br>
					<ul class="bt-list" id="cat_list">

								
					</ul>
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