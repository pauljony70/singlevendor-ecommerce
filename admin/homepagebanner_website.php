<?php
include('session.php');
//if
if (isset($_POST['code'])) {
	if ($_POST['product_id'] && $_POST['bannerprod_type']) {
		$stmt = $conn->prepare("SELECT id FROM popular_product WHERE product_id=? AND type =?");
		$stmt->bind_param("ss",  $_POST['product_id'], $_POST['bannerprod_type']);
		$stmt->execute();

		$stmt->bind_result($img_url);

		$exist = '';
		while ($stmt->fetch()) {
			$exist = 'yes';
		}
		if ($exist != 'yes') {

			$stmt11 = $conn->prepare("INSERT INTO `popular_product`( `product_id`,type)  VALUES (?,?)");
			$stmt11->bind_param('ss', $_POST['product_id'], $_POST['bannerprod_type']);

			$stmt11->execute();
			$stmt11->store_result();
			$rows = $stmt11->affected_rows;
			if ($rows > 0) {
				echo $_POST['bannerprod_type'] . " Product Added Successfully.";
			} else {
				echo "Failed to add " . $_POST['bannerprod_type'] . " Product.";
			}
		} else {
			echo $_POST['bannerprod_type'] . " Product already exist.";
		}
		die();
	}

	if ($_POST['code'] == $_SESSION['_token'] && $_POST['page']) {
	}
}
?>
<?php include("header.php"); ?>
<style>
	#country-list {
		float: left;
		list-style: none;
		margin-top: -3px;
		padding: 0;
		width: 190px;
		position: absolute;
	}

	#country-list li {
		padding: 10px;
		background: #f0f0f0;
		border-bottom: #bbb9b9 1px solid;
	}

	#country-list li:hover {
		background: #ece3d2;
		cursor: pointer;
	}

	#search-box {
		padding: 10px;
		border: #a8d4b1 1px solid;
		border-radius: 4px;
	}
</style>
<link href="<?php echo BASEURL; ?>admin/assets/custom-style.css" rel="stylesheet">
<!-- ======= Hero Section ======= -->
<!-- End Hero -->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Homepage Banners</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<section id="featured" class="featured homehero">
								<div class="container">
									<section id="top-category" class="top-category">
										<h3 class="text-center mb-3">Shop By Category</h3>
										<div class="row">
											<div class="col-md-3">
												<div class="card" style="background-image: url('<?= BASEURL . 'assets/images/category1.jpeg' ?>');">
													<div class="card-body d-flex align-items-center justify-content-center" onclick="uploadTopCategory()">
														<button type="button" class="btn btn-success">Upload</button>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="card" style="background-image: url('<?= BASEURL . 'assets/images/category1.jpeg' ?>');">
													<div class="card-body d-flex align-items-center justify-content-center" onclick="uploadTopCategory()">
														<button type="button" class="btn btn-success">Upload</button>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="card" style="background-image: url('<?= BASEURL . 'assets/images/category1.jpeg' ?>');">
													<div class="card-body d-flex align-items-center justify-content-center" onclick="uploadTopCategory()">
														<button type="button" class="btn btn-success">Upload</button>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="card" style="background-image: url('<?= BASEURL . 'assets/images/category1.jpeg' ?>');">
													<div class="card-body d-flex align-items-center justify-content-center" onclick="uploadTopCategory()">
														<button type="button" class="btn btn-success">Upload</button>
													</div>
												</div>
											</div>
										</div>
									</section>
									<div class="row">

										<?php
										$section1_image1 = $section1_link1 =  $section1_image2 = $section1_link2 = $section1_type2 = $section1_image3 = $section1_link3 = $section1_type3 = '';
										//sql for top banner
										$query1 = $conn->query("SELECT * FROM `layoutsection` WHERE name = 'section1'");
										$section1_type1 = 'top1';
										$section1_type2 = 'top2';
										$section1_type3 = 'top3';
										if ($query1->num_rows > 0) {


											while ($rows1 = $query1->fetch_assoc()) {
												$layoutsection_id = $rows1['sno'];

												$query_sub = $conn->query("SELECT * FROM `sectionvalue` WHERE layoutsection_id = $layoutsection_id");
												while ($rows_sub = $query_sub->fetch_assoc()) {

													if ($rows1['type'] == 'top1') {
														$section1_image1 = '../media/' . $rows_sub['image'];
														$section1_link1 = $rows_sub['onclick_url'];
														$section1_title1 = $rows_sub['title'];
														$section1_description1 = $rows_sub['description'];
														$section1_btn1 = $rows_sub['button'];
													}
													if ($rows1['type'] == 'top2') {
														$section1_image2 = '../media/' . $rows_sub['image'];
														$section1_link2 = $rows_sub['onclick_url'];
														$section1_title2 = $rows_sub['title'];
														$section1_description2 = $rows_sub['description'];
														$section1_btn2 = $rows_sub['button'];
													}
													if ($rows1['type'] == 'top3') {
														$section1_image3 = '../media/' . $rows_sub['image'];
														$section1_link3 = $rows_sub['onclick_url'];
														$section1_title3 = $rows_sub['title'];
														$section1_description3 = $rows_sub['description'];
														$section1_btn3 = $rows_sub['button'];
													}
												}
											}
										}
										$base_url = "http://" . $_SERVER['SERVER_NAME'] . '/';

										?>
										<div class="col-lg-4 mb-2">
											<div class="icon-box" style="height:200px; background-image: url('<?php echo $section1_image1; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<h3><b>Banner 1</b></h3>
													<button type="button" class="btn btn-success" onclick="add_banner_full_width('<?php  //echo $section1_image1; 
																																	?>', '<?php echo  $section1_link1; ?>', '<?php echo  $section1_type1; ?>','<?php echo  $section1_title1; ?>','<?php echo  $section1_description1; ?>','<?php echo  $section1_btn1; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-lg-4 mb-2">
											<div class="icon-box" style="height:200px; background-image: url('<?php echo $section1_image2; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<h3><b>Banner 2</b></h3>
													<button type="button" class="btn btn-success" onclick="add_banner_full_width('<?php  //echo $section1_image2; 
																																	?>', '<?php echo  $section1_link2; ?>', '<?php echo  $section1_type2; ?>','<?php echo  $section1_title2; ?>','<?php echo  $section1_description2; ?>','<?php echo  $section1_btn2; ?>');">Upload</button>
												</div>
											</div>
										</div>
										<div class="col-lg-4 mb-2">
											<div class="icon-box" style="height:200px; background-image: url('<?php echo $section1_image3; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

												<div class="icon-img">
													<h3><b>Banner 3</b></h3>
													<button type="button" class="btn btn-success" onclick="add_banner_full_width('<?php  //echo $section1_image3; 
																																	?>', '<?php echo  $section1_link3; ?>', '<?php echo  $section1_type3; ?>','<?php echo  $section1_title3; ?>','<?php echo  $section1_description3; ?>','<?php echo  $section1_btn3; ?>');">Upload</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							<!-- ======= Featured Section ======= -->

							<?php
							$section2_image1 = $section2_link1 =  $section2_image2 = $section2_link2  = $section2_image3 = $section2_link3 = $section2_image4 = $section2_link4 =
								$section2_image5 = $section2_link5 = $section2_image6 = $section2_link6 = $section2_image7 = $section2_link7 = '';
							//sql for top banner

							$query2 = $conn->query("SELECT * FROM `layoutsection` WHERE name = 'section2'");
							$section2_type1 = 'cat1';
							$section2_type2 = 'cat2';
							$section2_type3 = 'cat3';
							if ($query2->num_rows > 0) {

								while ($rows2 = $query2->fetch_assoc()) {
									$layoutsection_id = $rows2['sno'];

									$query2_sub = $conn->query("SELECT * FROM `sectionvalue` WHERE layoutsection_id = $layoutsection_id");
									while ($rows2_sub = $query2_sub->fetch_assoc()) {

										if ($rows2['type'] == 'cat1') {
											$section2_image1 = '../media/' . $rows2_sub['image'];
											$section2_link1 = $rows2_sub['onclick_url'];
											$section2_title1 = $rows2_sub['title'];
											$section2_description1 = $rows2_sub['description'];
											$section2_btn1 = $rows2_sub['button'];
										}
										if ($rows2['type'] == 'cat2') {
											$section2_image2 = '../media/' . $rows2_sub['image'];
											$section2_link2 = $rows2_sub['onclick_url'];
											$section2_title2 = $rows2_sub['title'];
											$section2_description2 = $rows2_sub['description'];
											$section2_btn2 = $rows2_sub['button'];
										}
										if ($rows2['type'] == 'cat3') {
											$section2_image3 = '../media/' . $rows2_sub['image'];
											$section2_link3 = $rows2_sub['onclick_url'];
											$section2_title3 = $rows2_sub['title'];
											$section2_description3 = $rows2_sub['description'];
											$section2_btn3 = $rows2_sub['button'];
										}
									}
								}
							}
							?>
							<section id="featured" class="featured">
								<div class="container">
									<div class="row">
										<div class="col-lg-12 col-md-4 col-xs-12">
											<div class="row">
												<div class="col-lg-4 mb-2">
													<div class="icon-box" style="height:200px; background-image: url('<?php echo $section2_image1; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">
														<div class="icon-img">

															<h3><b>Category 1</b></h3>
															<button type="button" class="btn btn-success" onclick="add_banner_section2( '<?php echo  $section2_link1; ?>', '<?php echo  $section2_type1; ?>','<?php echo  $section2_title1; ?>','<?php echo  $section2_description1; ?>','<?php echo  $section2_btn1; ?>');">Upload</button>
														</div>
														<div class="icon-img">
															<img src="">
														</div>
													</div>

												</div>
												<div class="col-lg-4 mb-2">
													<div class="icon-box" style="height:200px; background-image: url('<?php echo $section2_image2; ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">
														<div class="icon-img">

															<h3><b>Category 2</b></h3>
															<button type="button" class="btn btn-success" onclick="add_banner_section2( '<?php echo  $section2_link2; ?>', '<?php echo  $section2_type2; ?>','<?php echo  $section2_title2; ?>','<?php echo  $section2_description2; ?>','<?php echo  $section2_btn2; ?>');">Upload</button>
														</div>
														<div class="icon-img">
															<img src="">
														</div>
													</div>

												</div>
												<div class="col-lg-4 mb-2">
													<div class="icon-box" style="height:200px; background-image: url('<?php echo $section2_image3 ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">
														<div class="icon-img">

															<h3><b>Category 3</b></h3>
															<button type="button" class="btn btn-success" onclick="add_banner_section2( '<?php echo  $section2_link3; ?>', '<?php echo  $section2_type3; ?>','<?php echo  $section2_title3; ?>','<?php echo  $section2_description3; ?>','<?php echo  $section2_btn3; ?>');">Upload</button>
														</div>
														<div class="icon-img">
															<img src="">
														</div>
													</div>

												</div>

											</div>

										</div>

									</div>

								</div>
							</section><!-- End Featured Section -->
							<!-- ======= Portfolio Section ======= -->

							<?php
							$section2_image1 = $section2_link1 =  $section2_image2 = $section2_link2  = $section2_image3 = $section2_link3 = $section2_image4 = $section2_link4 =
								$section2_image5 = $section2_link5 = $section2_image6 = $section2_link6 = $section2_image7 = $section2_link7 = '';
							//sql for top banner

							$query3 = $conn->query("SELECT * FROM `layoutsection` WHERE name = 'section3'");
							$section3_type_new_1 = 'new1';
							$section3_type_new_2 = 'new2';
							$section3_type_new_3 = 'new3';
							if ($query2->num_rows > 0) {

								while ($rows3 = $query3->fetch_assoc()) {
									$layoutsection_id = $rows3['sno'];

									$query3_sub = $conn->query("SELECT * FROM `sectionvalue` WHERE layoutsection_id = $layoutsection_id");
									while ($rows3_sub = $query3_sub->fetch_assoc()) {

										if ($rows3['type'] == 'new1') {
											$section3_image1 = '../media/' . $rows3_sub['image'];
											$section3_link1 = $rows3_sub['onclick_url'];
											$section3_title1 = $rows3_sub['title'];
											$section3_description1 = $rows3_sub['description'];
											$section3_btn1 = $rows3_sub['button'];
										}
										if ($rows3['type'] == 'new2') {
											$section3_image2 = '../media/' . $rows3_sub['image'];
											$section3_link2 = $rows3_sub['onclick_url'];
											$section3_title2 = $rows3_sub['title'];
											$section3_description2 = $rows3_sub['description'];
											$section3_btn2 = $rows3_sub['button'];
										}
										if ($rows3['type'] == 'new3') {
											$section3_image3 = '../media/' . $rows3_sub['image'];
											$section3_link3 = $rows3_sub['onclick_url'];
											$section3_title3 = $rows3_sub['title'];
											$section3_description3 = $rows3_sub['description'];
											$section3_btn3 = $rows3_sub['button'];
										}
									}
								}
							}
							?>

							<section id="portfolio" class="portfolio">
								<div class="container">
									<div class="row">
										<div class="col-lg-12">
											<ul id="portfolio-flters" class="text-center p-2 m-0 nav nav-tabs">
												<li data-filter="*" class="filter-active active"><a data-toggle="tab" href="#new_div">New</a></li>
												<li data-filter=".filter-app"><a data-toggle="tab" href="#popular_div">Popular</a></li>
												<li data-filter=".filter-card"><a data-toggle="tab" href="#recommended_div">Recommended</a></li>
												<li data-filter=".filter-web"><a data-toggle="tab" href="#offers_div">Offers</a></li>
											</ul>
											<div class="tab-content">
												<div id="new_div" class="tab-pane fade in active show">
													<?php
													//sql for top banner
													$query3 = $conn->query("SELECT pp.id, pd.prod_name, pd.prod_img_url FROM productdetails pd,popular_product pp WHERE pp.product_id= pd.prod_id  AND pp.type = 'New' order by pp.id asc");


													?>
													<?php if ($query3->num_rows <= 15) { ?>
														<div class="col-md-12 ">
															<button type="button" class="btn btn-primary mb-2" onclick="add_banner_section3('New');">Add New Products</button></h4>
														</div>
													<?php } ?>
													<div class="d-flex flex-wrap">
														<?php
														if ($query3->num_rows > 0) {
															while ($rows3 = $query3->fetch_assoc()) {
																$imgarray = json_decode($rows3['prod_img_url'], true);
																//print_r($imgarray);
																$imageurl = '../media/' . $imgarray[0]['url'];
														?>
																<div class="col-md-3 m-0" id="popdiv<?php echo $rows3['id']; ?>">
																	<div class="tabb-color">
																		<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?php echo $rows3['id']; ?>');"><i class="fa fa-trash"></i></a></span>
																		<div class="yello-img">
																			<img src="<?php echo $imageurl;  ?>">
																		</div>
																		<div class="yello-text">

																			<p><b><?php echo $rows3['prod_name']; ?></b></p>


																		</div>
																	</div>
																</div>
														<?php }
														} ?>
													</div>
												</div>
												<div id="popular_div" class="tab-pane fade">
													<?php
													//sql for top banner

													$query4 = $conn->query("SELECT pp.id, pd.prod_name, pd.prod_img_url FROM productdetails pd,popular_product pp WHERE pp.product_id= pd.prod_id  AND pp.type = 'Popular' order by pp.id asc");


													?>
													<?php if ($query4->num_rows <= 15) { ?>
														<div class="col-md-12 ">
															<button type="button" class="btn btn-primary mb-2" onclick="add_banner_section3('Popular');">Add Popular Products</button></h4>
														</div>
													<?php } ?>
													<div class="d-flex flex-wrap">
														<?php
														if ($query4->num_rows > 0) {
															while ($rows4 = $query4->fetch_assoc()) {
																$imgarray1 = json_decode($rows4['prod_img_url'], true);
																$imageurl1 = '../media/' . $imgarray[0]['url'];


														?>
																<div class="col-md-3 m-0" id="popdiv<?php echo $rows4['id']; ?>">
																	<div class="tabb-color">
																		<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?php echo $rows4['id']; ?>');"><i class="fa fa-trash"></i></a></span>

																		<div class="yello-img">
																			<img src="<?php echo $imageurl1;  ?>">
																		</div>
																		<div class="yello-text">
																			<p><b><?php echo $rows4['prod_name']; ?></b></p>
																			<p class="mb-1"></p>

																		</div>
																	</div>
																</div>
														<?php }
														} ?>
													</div>
												</div>
												<div id="recommended_div" class="tab-pane fade">
													<?php
													//sql for top banner
													$query5 = $conn->query("SELECT pp.id, pd.prod_name, pd.prod_img_url FROM productdetails pd,popular_product pp WHERE  pp.product_id= pd.prod_id  AND pp.type = 'Recommended' order by pp.id asc");


													?>
													<?php if ($query5->num_rows <= 15) { ?>
														<div class="col-md-12 ">
															<button type="button" class="btn btn-primary mb-2" onclick="add_banner_section3('Recommended');">Add Recommended Products</button></h4>
														</div>
													<?php } ?>
													<div class="d-flex flex-wrap">
														<?php
														if ($query5->num_rows > 0) {
															while ($rows5 = $query5->fetch_assoc()) {
																$imgarray2 = json_decode($rows5['prod_img_url'], true);
																$imageurl2 = '../media/' . $imgarray2[0]['url'];

														?>
																<div class="col-md-3 m-0" id="popdiv<?php echo $rows5['id']; ?>">
																	<div class="tabb-color">
																		<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?php echo $rows5['id']; ?>');"><i class="fa fa-trash"></i></a></span>

																		<div class="yello-img">
																			<img src="<?php echo $imageurl2;  ?>">
																		</div>
																		<div class="yello-text">
																			<p><b><?php echo $rows5['prod_name']; ?></b></p>
																			<p class="mb-1"></p>

																		</div>
																	</div>
																</div>
														<?php }
														} ?>
													</div>
												</div>
												<div id="offers_div" class="tab-pane fade">
													<?php
													//sql for top banner
													$query6 = $conn->query("SELECT pp.id, pd.prod_name, pd.prod_img_url FROM productdetails pd,popular_product pp WHERE pp.product_id= pd.prod_id  AND pp.type = 'Offers' order by pp.id asc");


													?>
													<?php if ($query6->num_rows <= 15) { ?>
														<div class="col-md-12 ">
															<button type="button" class="btn btn-primary mb-2" onclick="add_banner_section3('Offers');">Add Offers Products</button></h4>
														</div>
													<?php } ?>
													<div class="d-flex flex-wrap">
														<?php
														if ($query6->num_rows > 0) {
															while ($rows6 = $query6->fetch_assoc()) {
																$imgarray3 = json_decode($rows6['prod_img_url'], true);
																$imageurl3 = '../media/' . $imgarray3[0]['url'];

														?>
																<div class="col-md-3 m-0" id="popdiv<?php echo $rows6['id']; ?>">
																	<div class="tabb-color">
																		<span style="position: absolute;float: right;right: 20px;top: 2px;"><a href="javascript:void(0)" onclick="delete_products('<?php echo $rows6['id']; ?>');"><i class="fa fa-trash"></i></a></span>

																		<div class="yello-img">
																			<img src="<?php echo $imageurl3;  ?>">
																		</div>
																		<div class="yello-text">
																			<p><b><?php echo $rows6['prod_name']; ?></b></p>
																			<p class="mb-1"></p>

																		</div>
																	</div>
																</div>
														<?php }
														} ?>
													</div>
												</div>
											</div>
										</div>
									</div>

									<?php
									$section3_image1 = $section3_link1 = '';
									//sql for top banner
									$query_sec_4 = $conn->query("SELECT * FROM `layoutsection` WHERE name = 'section4'");
									$section4_type1 = 'img1';
									$section4_type2 = 'img2';
									if ($query_sec_4->num_rows > 0) {

										while ($rows4 = $query_sec_4->fetch_assoc()) {

											$layoutsection_id = $rows4['sno'];
											$query4_sub = $conn->query("SELECT * FROM `sectionvalue` WHERE layoutsection_id = $layoutsection_id");
											while ($rows4_sub = $query4_sub->fetch_assoc()) {

												if ($rows4['type'] == 'img1') {
													$section4_image1 = '../media/' . $rows4_sub['image'];
													$section4_link1 = $rows4_sub['onclick_url'];
													$section4_title1 = $rows4_sub['title'];
													$section4_description1 = $rows4_sub['description'];
													$section4_btn1 = $rows4_sub['button'];
												}
												if ($rows4['type'] == 'img2') {
													$section4_image2 = '../media/' . $rows4_sub['image'];
													$section4_link2 = $rows4_sub['onclick_url'];
													$section4_title2 = $rows4_sub['title'];
													$section4_description2 = $rows4_sub['description'];
													$section4_btn2 = $rows4_sub['button'];
												}
											}
										}
									}
									?>
									<div class="row mt-5">
										<div class="col-md-12 portfolio-item filter-app">

										</div>
										<div class="col-md-12 portfolio-item filter-app">

										</div>
										<div class="col-md-6 portfolio-item filter-app">
											<div class="section-header portfolio-wrap p-2">
												<img style="width:inherit" src="<?php echo $section4_image1; ?>" class="img-fluid" alt="">
												<h3> Section4 Line Banner 1</h3>
												<button type="button" class="btn btn-success" onclick="add_banner_section4( '<?php echo  $section4_link1; ?>', '<?php echo  $section4_type1; ?>','<?php echo  $section4_title1; ?>','<?php echo  $section4_description1; ?>','<?php echo  $section4_btn1; ?>');">Upload</button>

											</div>
										</div>
										<div class="col-md-6 portfolio-item filter-app">
											<div class="section-header portfolio-wrap p-2">
												<img style="width:inherit" src="<?php echo $section4_image2; ?>" class="img-fluid" alt="">
												<h3> Section4 Line Banner 2</h3>
												<button type="button" class="btn btn-success" onclick="add_banner_section4( '<?php echo  $section4_link2; ?>', '<?php echo  $section4_type2; ?>','<?php echo  $section4_title2; ?>','<?php echo  $section4_description2; ?>','<?php echo  $section4_btn2; ?>');">Upload</button>

											</div>
										</div>
										<div class="col-md-12 portfolio-item filter-card">

										</div>

									</div>


								</div>
							</section><!-- End Portfolio Section -->




							<?php
							$section8_image1 = $section8_link1 =  $section8_image2 = $section8_link2 = $section8_type2 = $section8_image3 = $section8_link3 = $section8_type3 = '';
							//sql for top banner
							$query5 = $conn->query("SELECT * FROM `layoutsection` WHERE name = 'section5'");

							$section5_type1 = 'bottom1';
							$section5_type2 = 'bottom2';
							$section5_type3 = 'bottom3';
							$section5_type4 = 'bottom4';
							$section5_type5 = 'bottom5';
							$section5_type6 = 'bottom6';
							if ($query5->num_rows > 0) {


								while ($rows5 = $query5->fetch_assoc()) {

									$layoutsection_id = $rows5['sno'];

									$query5_sub = $conn->query("SELECT * FROM `sectionvalue` WHERE layoutsection_id = $layoutsection_id");
									while ($rows5_sub = $query5_sub->fetch_assoc()) {

										if ($rows5['type'] == 'bottom1') {
											$section5_image1 = '../media/' . $rows5_sub['image'];
											$section5_link1 = $rows5_sub['onclick_url'];
											$section5_title1 = $rows5_sub['title'];
											$section5_description1 = $rows5_sub['description'];
											$section5_btn1 = $rows5_sub['button'];
										}
										if ($rows5['type'] == 'bottom2') {
											$section5_image2 = '../media/' . $rows5_sub['image'];
											$section5_link2 = $rows5_sub['onclick_url'];
											$section5_title2 = $rows5_sub['title'];
											$section5_description2 = $rows5_sub['description'];
											$section5_btn2 = $rows5_sub['button'];
										}
										if ($rows5['type'] == 'bottom3') {
											$section5_image3 = '../media/' . $rows5_sub['image'];
											$section5_link3 = $rows5_sub['onclick_url'];
											$section5_title3 = $rows5_sub['title'];
											$section5_description3 = $rows5_sub['description'];
											$section5_btn3 = $rows5_sub['button'];
										}

										if ($rows5['type'] == 'bottom4') {
											$section5_image4 = '../media/' . $rows5_sub['image'];
											$section5_link4 = $rows5_sub['onclick_url'];
											$section5_title4 = $rows5_sub['title'];
											$section5_description4 = $rows5_sub['description'];
											$section5_btn4 = $rows5_sub['button'];
										}

										if ($rows5['type'] == 'bottom5') {
											$section5_image5 = '../media/' . $rows5_sub['image'];
											$section5_link5 = $rows5_sub['onclick_url'];
											$section5_title5 = $rows5_sub['title'];
											$section5_description5 = $rows5_sub['description'];
											$section5_btn5 = $rows5_sub['button'];
										}

										if ($rows5['type'] == 'bottom6') {
											$section5_image6 = '../media/' . $rows5_sub['image'];
											$section5_link6 = $rows5_sub['onclick_url'];
											$section5_title6 = $rows5_sub['title'];
											$section5_description6 = $rows5_sub['description'];
											$section5_btn6 = $rows5_sub['button'];
										}
									}
								}
							}
							?>
							<section class="sector">
								<div class="container">
									<h3 style="text-align:center;"> Section5 Banner</h3>
									<div class="row">
										<div class="col-lg-4 text-light mb-2">
											<div class="icon-boxx" style="background-image: url('<?php echo $section5_image1; ?>');">
												<div class="icon-text">

													<h4><b>Banner 1</b></h4>
													<button type="button" class="btn btn-success" onclick="add_banner_section5('<?php  //echo $section1_image2; 
																																?>', '<?php echo  $section5_link1; ?>', '<?php echo  $section5_type1; ?>','<?php echo  $section5_title1; ?>','<?php echo  $section5_description1; ?>','<?php echo  $section5_btn1; ?>');">Upload</button>
												</div>

											</div>

										</div>
										<div class="col-lg-4 text-light mb-2">
											<div class="icon-boxx" style="background-image: url('<?php echo $section5_image2; ?>');">
												<div class="icon-text">

													<h4><b>Banner 2</b></h4>
													<button type="button" class="btn btn-success" onclick="add_banner_section5('<?php  //echo $section1_image2; 
																																?>', '<?php echo  $section5_link2; ?>', '<?php echo  $section5_type2; ?>','<?php echo  $section5_title2; ?>','<?php echo  $section5_description2; ?>','<?php echo  $section5_btn2; ?>');">Upload</button>
												</div>

											</div>

										</div>
										<div class="col-lg-4 text-light mb-2">
											<div class="icon-boxx" style="background-image: url('<?php echo $section5_image3; ?>');">
												<div class="icon-text">


													<h4><b>Banner 3</b></h4>
													<button type="button" class="btn btn-success" onclick="add_banner_section5('<?php  //echo $section1_image2; 
																																?>', '<?php echo  $section5_link3; ?>', '<?php echo  $section5_type3; ?>','<?php echo  $section5_title3; ?>','<?php echo  $section5_description3; ?>','<?php echo  $section5_btn3; ?>');">Upload</button>
												</div>

											</div>

										</div>
										<div class="col-lg-4 text-light mb-2">
											<div class="icon-boxx" style="background-image: url('<?php echo $section5_image4; ?>');">
												<div class="icon-text">


													<h4><b>Banner 4</b></h4>
													<button type="button" class="btn btn-success" onclick="add_banner_section5('<?php  //echo $section1_image2; 
																																?>', '<?php echo  $section5_link4; ?>', '<?php echo  $section5_type4; ?>','<?php echo  $section5_title4; ?>','<?php echo  $section5_description4; ?>','<?php echo  $section5_btn4; ?>');">Upload</button>
												</div>

											</div>

										</div>
										<div class="col-lg-4 text-light mb-2">
											<div class="icon-boxx" style="background-image: url('<?php echo $section5_image5; ?>');">
												<div class="icon-text">


													<h4><b>Banner 5</b></h4>
													<button type="button" class="btn btn-success" onclick="add_banner_section5('<?php  //echo $section1_image2; 
																																?>', '<?php echo  $section5_link5; ?>', '<?php echo  $section5_type5; ?>','<?php echo  $section5_title5; ?>','<?php echo  $section5_description5; ?>','<?php echo  $section5_btn5; ?>');">Upload</button>
												</div>

											</div>

										</div>
										<div class="col-lg-4 text-light mb-2">
											<div class="icon-boxx" style="background-image: url('<?php echo $section5_image6; ?>');">
												<div class="icon-text">


													<h4><b>Banner 6</b></h4>
													<button type="button" class="btn btn-success" onclick="add_banner_section5('<?php  //echo $section1_image2; 
																																?>', '<?php echo  $section5_link6; ?>', '<?php echo  $section5_type6; ?>','<?php echo  $section5_title6; ?>','<?php echo  $section5_description6; ?>','<?php echo  $section5_btn6; ?>');">Upload</button>
												</div>

											</div>

										</div>

									</div>
								</div>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Modal -->
<div id="myModalsection1" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Banner</h4>
			</div>
			<div class="modal-body">
				<form class="form" id="add_brand_form" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name">Banner Title</label>
						<input type="text" class="form-control" id="banner_title" placeholder="Banner Title">
					</div>
					<div class="form-group">
						<label for="name">Banner Description</label>
						<input type="text" class="form-control" id="banner_description" placeholder="Banner Description">
					</div>
					<div class="form-group">
						<label for="name">Banner Button Text</label>
						<input type="text" class="form-control" id="banner_btn" placeholder="Banner Description">
					</div>
					<div class="form-group">
						<label for="name">Banner Link (Category, Product or any landing page)</label>
						<input type="text" class="form-control" id="banner_link" placeholder="Banner Link">
					</div>
					<div class="form-group">
						<label for="image">Image</label>
						<input type="file" name="banner_image" id="banner_image" class="form-control" onchange="uploadFile1('banner_image')" required accept="image/png, image/jpeg,image/jpg,image/gif">
					</div>
					<input type="hidden" id="banner_type">
					<input type="hidden" id="banner_section">
					<button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="add_banner_btn">Add</button>
				</form>
			</div>

		</div>

	</div>
</div>

<div id="topCategoryModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Banner</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div id="new_cat_div">
					<div class="form-group" id="parent_cat_div">
						<label for="name">Select Category</label>
						<select class="form-control" id="selectcategory" name="selectcategory" style="">
                            <?php

                            echo '<option value="0:none">Select Category </option>';
                            function categoryTreeSelect($parent_id = 0, $sub_mark = '')
                            {
                              global $conn;
                              $query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id ORDER BY cat_name ASC");

                              if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                                  echo '<option value="' . $row['cat_id'] . ':' . $row['cat_name'] . '">' . $sub_mark . $row['cat_name'] . '</option>';
                                  categoryTreeSelect($row['cat_id'], $sub_mark . '---');
                                }
                              }
                            }
                            categoryTreeSelect();


                            ?>
                          </select>

					</div>
				</div>
				<div class="form-group">
					<label for="image">Image</label>
					<input type="file" name="banner_imagecat" id="banner_imagecat" class="form-control-file" required accept="image/png, image/jpeg,image/jpg,image/gif">
				</div>
				<input type="hidden" id="banner_typecat">
				<input type="hidden" id="banner_sectioncat">
				<button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="add_catbanner_btn">Add</button>
			</div>
		</div>
	</div>
</div>

<div id="myModalcat" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Banner</h4>
			</div>
			<div class="modal-body">
				<div id="new_cat_div">
					<div class="form-group" id="parent_cat_div">
						<label for="name">Select Category</label>
						<div class="dropdownss">
							<div id="treeSelect">
								<?php

								$query = $conn->query("SELECT * FROM category WHERE parent_id = '0' AND status ='1' ORDER BY cat_name ASC");

								if ($query->num_rows > 0) {
									while ($row = $query->fetch_assoc()) {
										$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1'");
										if ($query1->num_rows > 0) {
											echo '<span class="expand" ><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" id="cat' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList">' . $row['cat_name'] . '</span>
											<br />    
											<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';
											echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
											echo	'</ul>';
										} else {
											echo '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" id="cat' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList"> ' . $row['cat_name'] . '</span>
											<br />';
										}
									}
								}


								?>
							</div>

						</div>

					</div>
				</div>
				<div class="form-group" style="display:none;">
					<label for="name">Banner Link (Category, Product or any landing page)</label>
					<input type="text" class="form-control" id="banner_linkcat" placeholder="Banner Link">
				</div>
				<div class="form-group">
					<label for="image">Image</label>
					<input type="file" name="banner_imagecat" id="banner_imagecat" class="form-control" onchange="uploadFile1('banner_imagecat')" required accept="image/png, image/jpeg,image/jpg,image/gif">
				</div>
				<input type="hidden" id="banner_typecat">
				<input type="hidden" id="banner_sectioncat">
				<button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="add_catbanner_btn">Add</button>
			</div>
		</div>
	</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Product</h4>
			</div>
			<div class="modal-body">
				<form class="form" id="add_brand_form" enctype="multipart/form-data">
					<input type="hidden" id="bannerprod_type">

					<div class="form-group" id="product_div">
						<label for="name">Select Product</label>
						<div class="frmSearch">
							<input type="text" class="form-control1" id="search-box" placeholder="Product Name" />
							<input type="hidden" id="product-id" />
							<div id="suggesstion-box"></div>
						</div>
					</div>


					<button type="submit" class="btn btn-success" value="Upload" href="javascript:void(0)" id="add_product_btn">Add</button>
				</form>
			</div>

		</div>

	</div>
</div>

<?php
function categoryTree($parent_id, $sub_mark = '')
{
	global $conn;
	$query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id AND status = '1' ORDER BY cat_name ASC");

	if ($query->num_rows > 0) {
		while ($row = $query->fetch_assoc()) {
			$query1 = $conn->query("SELECT cat_id FROM category WHERE parent_id = '" . $row['cat_id'] . "' AND status ='1'");
			if ($query1->num_rows > 0) {
				echo '<span class="expand"><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" id="cat' . $row['cat_id'] . '" class="check_category_limit"></span><span class="mainList">' . $row['cat_name'] . '</span>
						<br />    
						<ul id="' . $row['cat_name'] . '" class="subList" style="display:block;">';
				echo categoryTree($row['cat_id'], $sub_mark . "&nbsp;&nbsp;&nbsp;");
				echo '</ul>';
			} else {
				echo '<li><input type="radio" name="parent_cat" value="' . $row['cat_id'] . '" id="cat' . $row['cat_id'] . '" class="check_category_limit"> ' . $row['cat_name'] . '</li>';
			}
		}
	}
}

?>
<?php include('footernew.php'); ?>
<script src="<?php echo BASEURL; ?>admin/js/homepage_web.js"></script>