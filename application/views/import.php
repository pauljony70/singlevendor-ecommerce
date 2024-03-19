<!DOCTYPE html>
<html lang="zxx" class="js">
<?php
header('Access-Control-Allow-Origin: *');
if(empty($this->session->userdata('user_id')))
{
	redirect('login'); 
}
?>

<?php include("includes/head.php"); 

$interval_source = "01:01";
$time_now = strtotime( "now" ) / 60;
$interval = substr($interval_source,0,2) * 60 + substr($interval_source,3,2);


if( $time_now % $interval == 0){
/** do cronjob */
$date = $this->date_time = date('Y-m-d H:i:s');
$query=$this->db->query("insert into order_data set order_id='cscs',name='csc',email='ccscs',phone='95563562363',state='cscs',order_status='cscs',telecallerid='66636',add_date='$date'");

}

?>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <?php include("includes/sidebar.php") ?>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <?php include("includes/header.php") ?>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="components-preview wide-md mx-auto">
                                    <div class="nk-block-head nk-block-head-lg wide-sm">
                                        <div class="nk-block-head-content">
                                            <h2 class="nk-block-title fw-normal">Import</h2>
                                              <?php echo @$message; ?>

                                        </div>
                                    </div><!-- .nk-block -->
                                    <div class="nk-block nk-block-lg">
                                        
                                        <div class="row g-gs">
                                            
                                            <div class="col-lg-12">
                                                <div class="card h-100">
                                                    <div class="card-inner">
                                                        
                                                        <form method="post" id="upload_csv_form" enctype="multipart/form-data" action="">
                                                            <div class="form-group">
                                                                <label class="form-label" for="cf-full-name">Upload Excel File (Only CSV File)</label>
                                                                <input type="file" class="form-control" id="file" name="file" required>
                                                            </div>
															<?php // print_r($_SESSION); ?>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-lg btn-primary">Import Data</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="card card-bordered card-preview">
											<br><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="checkALL" name="checkedAll" id="checkedAll" />&nbsp;&nbsp;&nbsp;&nbsp;<button  id="delete_all_img" class="btn btn-danger">Delete All</button></span>
                                            <div class="card-inner">
                                                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                                    <thead>
                                                       <!-- <tr class="nk-tb-item nk-tb-head">
                                                            <th class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                                    <label class="custom-control-label" for="uid"></label>
                                                                </div>
                                                            </th>
                                                            <th class="nk-tb-col"><span class="sub-text">User</span></th>
                                                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Balance</span></th>
                                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></th>
                                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Verified</span></th>
                                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Last Login</span></th>
                                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                                            <th class="nk-tb-col nk-tb-col-tools text-end">
                                                            </th>
                                                        </tr>-->
														<tr>
														  <th>All</th>
														  <th>order Id</th>
														  <th>Date</th>
														  <th>Confirm Status</th>
														  <th>Name / Mobile No</th>
														  <th>State</th>                     
														  <th>cal1 Emp</th>                     
														  <th>cal2 Emp</th>                     
														  <th>cal3 Emp</th>                     
														  <th>call Id</th>                     
														  <th>Action</th>                     
														  <th></th>                    
														  
													  </tr>
                                                    </thead>
                                                    <tbody id="tbodyPostid">
                                                            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- .card-preview -->
                                    </div><!-- .nk-block -->
                                   
                                </div><!-- .components-preview -->
                            </div>
                        </div>
                    </div>
                </div>
				
				
                <!-- content @e -->
                <!-- footer @s -->
                <?php include("includes/footer.php") ?>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- select region modal -->
    
    <!-- JavaScript -->
    <?php include("includes/script.php") ?>
	<!--<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-database.js"></script>-->
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-firestore.js"></script>
<script>
var site_url = $('.site_url').val(); // CSRF hash

 // const firebaseConfig = {
  // apiKey: "AIzaSyAq_TcYIcBlvfLInnk2EQC_1_tSEQwxA8M",
  // authDomain: "shopify-bb8ba.firebaseapp.com",
  // databaseURL: "https://shopify-bb8ba-default-rtdb.asia-southeast1.firebasedatabase.app",
  // projectId: "shopify-bb8ba",
  // storageBucket: "shopify-bb8ba.appspot.com",
  // messagingSenderId: "116534693499",
  // appId: "1:116534693499:web:0bb356dec50633cb47dcde",
  // measurementId: "G-KBE3NMH3K1"
// };

const firebaseConfig = {
  apiKey: "AIzaSyC_qT_kqfoCMLg1BlzQ9e3REaYpmM06xkg",
  authDomain: "shopifycms-ad5d0.firebaseapp.com",
  projectId: "shopifycms-ad5d0",
  storageBucket: "shopifycms-ad5d0.appspot.com",
  messagingSenderId: "681852331152",
  appId: "1:681852331152:web:d657f2140304a710456415",
  measurementId: "G-DWSZQGEMVF"
};

firebase.initializeApp(firebaseConfig);

const db = firebase.firestore();

// firebase.firestore().collection("mainadmin/subid1/orderlist").add({
  // title: "East of Eden",
// });

// const bookRef = firebase.firestore().collection("mainadmin").doc("subid1");
// const userBooksRef = firebase.firestore().collection('mainadmin').doc('subid1').collection('orderlist');

// userBooksRef
  // .update({
    // year: 1869,
  // })
  // .then(() => {
    // console.log("Document updated"); 
  // })
  // .catch((error) => {
    // console.error("Error updating doc", error);
  // });	

const booksRef = firebase.firestore().collection('mainadmin').doc('subid2').collection('orderlist');







// const app = initializeApp(firebaseConfig);
// const db = getFirestore(app);

// async function getCities(db) {
  // const citiesCol = collection(db, 'cities');
  // const citySnapshot = await getDocs(citiesCol);
  // const cityList = citySnapshot.docs.map(doc => doc.data());
  // return cityList;
// }

// firestore.instance.collection("mainadmin").doc("subid1").set({
        // 'name':"John Cena",
        // 'email':"youcantseeme@email.com",
       
      // });



 // var messagesRef = firestore.database().ref('orderlist'); 
				 // messagesRef.set({
					 // name : 'cscs'
				 // });
 
$('#upload_csv_form').on('submit', function(e) {
 e.preventDefault();

	alert('ddd');
	

    var file_data = $('#file').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    //alert(form_data);                             
    $.ajax({
        url: site_url+'Import/importdata',
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data:new FormData(this),                           
        type: 'post',
        success: function(php_script_response){
            //console.log(php_script_response);
			alert(php_script_response);
			//alert(php_script_response); // <-- display response from the PHP script, if any
			var parsedJSON = JSON.parse(php_script_response);
			var product_html = "";
			$(parsedJSON).each(function () {
				//console.log(parsedJSON);
				//alert(this.name);
				
				//firebase.firestore().collection('mainadmin').doc('subid2').collection('orderlist').doc(this.id).add({
				firebase.firestore().collection("mainadmin/subid2/orderlist").doc(this.id).set({
				//messagesRef.set({
					order_id : this.id,
					name : this.name,
					date : this.date,
					order_status : this.order_status ,
					confirmation_status : '' ,
					email : this.email ,
					phone : this.phone ,
					state : this.state ,
					totalcall : '' ,
					call1_empname : '' ,
					call1note : '' ,
					call1datetime : '' ,
					call2_empname : '' ,
					call2note : '' ,
					call2datetime : '' ,
					call3_empname : '' ,
					call3note : '' ,
					call1_sid : '' ,
					call1_recordingurl : '' ,
					call2_sid : '' ,
					call2_recordingurl : '' ,
					call3_sid : '' ,
					call3_recordingurl : '' ,
					call3datetime : '' ,
					telecallerid : this.telecallerid 
				
					});
				//}
				   
			});
			//$('#featured_img').val();
			alert('Import file Successfully');
			//location.reload();

        }
     });
});
$(function () {
  var pagecount =1;
  window.onload = getOrderStatus();
});
	
	function getOrderStatus(){
          
            //var count =1;
			//var rowno = 0; 
			//var pagenov = 1;
			
		//	var  search_name = $('#search_name').val();
		//	var  order_id = $('#order_id').val();
		//	var  order_date = $('#order_date').val();
		//	var now = new Date(order_date);
			//var dout = Date.parse(now);

		//	var ymd  = now.getDate() + '-' + (now.getMonth() + 1) + '-' +  now.getFullYear();
          //  const formattedDate = ("0" + now.getDate()).slice(-2) + '-' + ("0" + (now.getMonth() + 1)).slice(-2) + '-' + now.getFullYear();

			//alert(date);
			//alert(formattedDate);
			//search_table(search_name);  

			//var database = firebase.database();
			//$("#tbodyPostid").empty();
			
			
			
			

			//rowno = '34';	 
			// $('#pagenovalue').html(pageno );
			// $('#pagenovalue2').html(parseInt(pageno)+1 );
			// $('#pagenovalue3').html(parseInt(pageno)+2 );
			// $('#pagenovalue4').html(parseInt(pageno)+3 );  
			// $('#pagenovalue5').html(parseInt(pageno)+4 );
			// $('#totalrowvalue').html(rowno );

			booksRef.get().then((snapshot) => {
    const table_data = snapshot.docs.map((doc) => ({id: doc.id,order_id : doc.order_id,...doc.data(), }));
    //console.log(table_data); 
    // [ { id: 'glMeZvPpTN1Ah31sKcnj', title: 'The Great Gatsby' } ]
  //});
			var content = ''; 
			//database.ref('orderlist').once('value', function(snapshot) {
			 	table_data.forEach(function(table_data) {
					//console.log(table_data.order_id);
				 // var val = table_data.val();
				  
				
				  content += '<tr class="nk-tb-item">';
				  content += '<td class="nk-tb-col tb-col-lg"><input type="checkbox" name="checkAll" class="checkSingle" value="' + table_data.order_id + '" id="' + table_data.order_id + '" /></td>';
				  content += '<td class="nk-tb-col tb-col-lg">' + table_data.order_id + '</td>';
				  content += '<td class="nk-tb-col tb-col-lg">' + table_data.date + '</td>';
				  content += '<td class="nk-tb-col tb-col-lg">' + table_data.confirmation_status + '</td>';
				  content += '<td class="nk-tb-col tb-col-lg">' + table_data.name + '<br>' + table_data.phone + '</td>';
				  content += '<td class="nk-tb-col tb-col-lg">' + table_data.state + '</td>';
				  content += '<td class="nk-tb-col tb-col-lg">' + table_data.call1_empname + '</td>';
				  content += '<td class="nk-tb-col tb-col-lg">' + table_data.call2_empname + '</td>';
				  content += '<td class="nk-tb-col tb-col-lg">' + table_data.call3_empname + '</td>';
				  content += '<td class="nk-tb-col tb-col-lg">' + table_data.telecallerid + '</td>';
				  content += '<td class="nk-tb-col tb-col-lg"><a onclick="delete_data(' + "'" + table_data.order_id + "'" + ')" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete"> <em class="icon ni ni-trash"></em></a></td>';
				  content += '</tr>';
				//	}
				 //}
				});
				
				$('#tbodyPostid').append(content);
				//count = count+1;
			});

               
        }
		function delete_data(user_id)
		{
			
			var data_list = firebase.firestore().collection("mainadmin/subid2/orderlist").doc(user_id); 
			data_list.delete();
			location.reload();
		}

		$("#checkedAll").change(function(){
			  if(this.checked){
                $(".checkSingle").each(function(){
                  this.checked=true;
                })              
              }else{
                $(".checkSingle").each(function(){
                  this.checked=false;
                })              
              }
            });

            $(".checkSingle").click(function () {
              if ($(this).is(":checked")){
                var isAllChecked = 0;
                $(".checkSingle").each(function(){
                  if(!this.checked)
                     isAllChecked = 1;
                })              
                if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }     
              }else {
                $("#checkedAll").prop("checked", false);
              }
            });
			
			$("#delete_all_img").on("click", function() {
              //alert(" delete call ");
				//var data_array = "";
				var data_array =[];
				$(".checkSingle").each( function(i, obj ){
						//console.log(this.value);
						//console.log($(".checkSingle").prop("checked"));
					if( $(this).is(":checked")){
						/*if(data_array ==""){
							data_array = this.value;
						}else{
							data_array = data_array +", " + this.value;
						}*/
						data_array.push(this.value);
						//var data_list = firebase.database().ref('orderlist/'+this.value); 
						//data_list.remove();
						// alert(this.value);
						var data_list = firebase.firestore().collection("mainadmin/subid2/orderlist").doc(this.value); 
						data_list.delete();
						
						
					}

					});
				//console.log(data_array);	
				location.reload();
				//deleteAlbumImg(data_array);
				//alert(data_array);
            });
		
</script>
	</body>

</html>