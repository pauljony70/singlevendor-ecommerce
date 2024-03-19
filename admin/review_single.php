<?php
include('session.php');
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}
$reviewid = $_POST['reviewid'];
$pname = $_POST['pname'];
?>

<?php include("header.php"); ?>

<style>
	.checked {
		color: orange;
	}
</style>

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


							<div class="card-body widget-shadow">
								<div class="card">
									<div class="card-header">

										Product Name : <?php echo $pname; ?>
									</div>
									<input type="hidden" class="form-control1" id="review_id" value=<?php echo $reviewid; ?>></input>

									<div class="inbox-page" id="reviewlist">
										<?php
										//	echo "review id ".$reviewid;
										include('../app/db_connection.php');
										/*
				    $stmt = $conn->prepare("SELECT review_array FROM review WHERE review_id =?");
                    $stmt->bind_param(i, $reviewid);
                    $stmt->execute();
                    $data = $stmt->bind_result($col1);
                    //  echo " get col data ";
                    
                    while ($stmt->fetch()) {
                       // echo " prod data is " .$col1;  
                    	$oldarray = json_decode( $col1, true) ;
            	  	$feedback_id =0;
            	  	 foreach($oldarray as $arraykey) {
            			 //  echo "prod id ".$arraykey['prod_id'];
            		
					echo '<div class="inbox-row widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">';
						echo '<div class="mail mail-name">'; 
						   echo '<h6>'.$arraykey['username'].'</h6>';
						 
						    
					        	 $starNumber  =$arraykey['rating'];
						      
                                for($x=1;$x<=$starNumber;$x++) {
                                       echo '<span class="fa fa-star checked"></span>';
                                }
                                if (strpos($starNumber,'.')) {
                                    echo '<span class="fa fa-star-half-o checked"></span>';
                                    $x++;
                                }
                                while ($x<=5) {
                                      echo '<span class="fa fa-star-o"></span>';
                                    $x++;
                                }
            					 echo '<strong>'. $starNumber .'</strong>';
                        
						echo '</div>';
					
					echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">';
							echo '<p><strong>'.$arraykey['title'].'</strong> </p>';
							echo '<div class="mail" ><p>'.$arraykey['feedback'].' </p></div>';
						echo '</a>';
						echo '<div class="mail-right dots_drop">';
							echo '<div class="dropdown">';
								echo '<a href="#"  data-toggle="dropdown" aria-expanded="false">';
									echo '<p><i class="fa fa-ellipsis-v mail-icon"></i></p>';
								echo '</a>';
								echo '<ul class="dropdown-menu float-right">';
							
									echo '<li>';
										echo '<a href="javascript:void(0)" onclick="deletereview(this, '.$feedback_id.' ); return false;" class="font-red" title="">';
											echo '<i class="fa fa-trash-o mail-icon"></i>';
											echo 'Delete';
										echo '</a>';
								echo '	</li>';
							echo '	</ul>';
						echo '	</div> ';
					echo '	</div>';
					echo '	<div class="mail-right"><p>'.$arraykey['date'].'</p></div>';
					echo '	<div class="clearfix"> </div>';
					
				echo '	</div>';
			    	$feedback_id = $feedback_id+1;
			    	
			
				} // foreach close
                    }//while close
					
				*/
										?>

									</div>


								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="row align-items-center">
								<div class="col-md-6">
									<!-- <div class="pull-right" style="float:left;">
										Total Row : <a id="totalrowvalue" class="totalrowvalue"></a>
									</div> -->
								</div>
								<div class="col-md-6">
									<div class="pull-right page_div ml-auto" style="float:right;">
										<ul class="pagination">
											<li><a onclick="getnewProduct(1);" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
											<li class="active"><a onclick="getnewProduct(1);">1 <span class="sr-only">(current)</span></a></li>
											<li><a onclick="getnewProduct(2);">2</a></li>
											<li><a onclick="getnewProduct(3);">3</a></li>
											<li><a onclick="getnewProduct(4);">4</a></li>
											<li><a onclick="getnewProduct(5);">5</a></li>
											<li><a onclick="getnewProduct(6);">6</a></li>
											<li><a onclick="getnewProduct(7);">7</a></li>
											<li><a aria-label="Next"><span aria-hidden="true">»</span></a></li>
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


	<div class="clearfix"></div>
</div>


<div class="col_1">


	<div class="clearfix"> </div>

</div>

<!--footer-->
<?php include('footernew.php'); ?>
<script type="application/javascript">
	function deletereview(item, feedbackid) {
		var reviewidv = $('#review_id').val();


		//  alert("review id " +reviewidv + " -- "+feedbackid );

		$.ajax({
			method: 'POST',
			url: 'delete_review_process.php',
			data: {
				code: "123",
				reviewid: reviewidv,
				feedid: feedbackid.toString()
			},
			success: function(response) {
				alert(response); // display response from the PHP script, if any
				// var data = $.parseJSON(response);
				getReviewlist();
			}
		});
	}
</script>
<script>
	function getReviewlist() {
		//   alert("start");
		var reviewidv = $('#review_id').val();

		// alert( "sdfs---" + reviewidv);

		$.ajax({
			method: 'POST',
			url: 'get_review_single_data.php',
			data: {
				code: "123",
				reviewid: reviewidv
			},
			success: function(response) {
				//      alert(response); // display response from the PHP script, if any
				var data = $.parseJSON(response);
				$("#reviewlist").empty();

				$(data).each(function() {
					// alert(this.name)
					var starNumber = this.rating;
					var x = 1;
					var finalrating = "";
					for (x = 1; x <= starNumber; x++) {
						finalrating = finalrating + '<span class="fa fa-star checked"></span>';
					}

					if (starNumber.includes(".5")) {
						//  alert("halt");
						finalrating = finalrating + '<span class="fa fa-star-half-o checked"></span>';
						x++;
					}

					while (x <= 5) {
						finalrating = finalrating + '<span class="fa fa-star-o"></span>';
						x++;
					}
					finalrating = finalrating + '<strong>' + starNumber + '</strong>';

					$("#reviewlist").append(`
						<div class="inbox-row widget-shadow" id="accordion" role="tablist" aria-multiselectable="true">
							<div class="d-flex">
								<div class="mail mail-name">
									<h6>${this.name}</h6>
									${finalrating}
								</div>

								<a class="ml-5 text-dark" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<p><strong>${this.title}</strong></p>
									<div class="mail"><p>${this.feedback}</p></div>
								</a>
							</div>

							<div class="pull-right page_div ml-auto" style="float:right;">
								<div class="d-flex">
									<div class="mr-3"><p>${this.date}</p></div>
									<div class="mail-right dots_drop">
										<div class="dropdown">
											<a class="text-dark" href="#" data-toggle="dropdown" aria-expanded="false">
												<p><i class="fa fa-ellipsis-v mail-icon"></i></p>
											</a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li>
													<a class="text-dark" href="javascript:void(0)" onclick="deletereview(this, ${this.id}); return false;" class="font-red" title="">
														<i class="fa fa-trash-o mail-icon"></i>
														Delete
													</a>
												</li>
											</ul>
										</div>
									</div>
								</
							</div>
						</div>
					`);



				}); // foreach data close

			} // success
		}); // ajax close


	}
</script>
<script>
	$(document).ready(function() {

		getReviewlist();

	});
</script>