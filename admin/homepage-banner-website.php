<?php
include('session.php');
include("header.php");
?>
<link href="<?php echo BASEURL; ?>admin/assets/custom-style.css" rel="stylesheet">

<div class="modal fade" id="topbarUploadModal" tabindex="-1" aria-labelledby="topbarUploadModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="topbarUploadModalLabel">Add Topbar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="topbarUploadForm" action="homepage-banner-process.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" id="uploadId" value="">
					<input type="hidden" name="bannerType" id="bannerType" value="">
					<div class="form-group">
						<label for="uploadLink">Topbar Link</label>
						<input type="text" class="form-control" id="uploadLink" name="uploadLink" data-parsley-required-message="Link is required." required>
					</div>
					<div class="form-group">
						<label for="image">Topbar Text</label>
						<input type="text" class="form-control" id="image" name="image" data-parsley-required-message="Link text is required." required>
					</div>
					<button type="submit" class="btn btn-dark">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="videoUploadModal" tabindex="-1" aria-labelledby="videoUploadModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="videoUploadModalLabel">Add Video</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="videoUploadForm" action="homepage-banner-process.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" id="uploadId" value="">
					<input type="hidden" name="bannerType" id="bannerType" value="">
					<div class="form-group">
						<label for="uploadLink">Link</label>
						<input type="text" class="form-control" id="uploadLink" name="uploadLink" data-parsley-required-message="Link is required." required>
					</div>
					<div class="form-group">
						<label for="image">Video</label>
						<input type="file" class="form-control-file" id="image" name="image" accept="video/mp4,video/x-m4v,video/*" data-parsley-required-message="Video is required." required>
					</div>
					<button type="submit" class="btn btn-dark">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="imageUploadModal" tabindex="-1" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="imageUploadModalLabel">Add Banner</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="imageUploadForm" action="homepage-banner-process.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" id="uploadId" value="">
					<input type="hidden" name="bannerType" id="bannerType" value="">
					<div class="form-group">
						<label for="uploadLink">Link</label>
						<input type="text" class="form-control" id="uploadLink" name="uploadLink" data-parsley-required-message="Link is required." required>
					</div>
					<div class="form-group">
						<label for="image">Image</label>
						<input type="file" class="form-control-file" id="image" name="image" accept="image/png, image/jpeg" data-parsley-required-message="Image is required." required>
					</div>
					<button type="submit" class="btn btn-dark">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="buttonUploadModal" tabindex="-1" aria-labelledby="buttonUploadModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="buttonUploadModalLabel">Button Upload</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="buttonUploadForm" action="homepage-banner-process.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" id="uploadId" value="">
					<input type="hidden" name="bannerType" id="bannerType" value="">
					<div class="form-group">
						<label for="uploadLink">Link</label>
						<input type="text" class="form-control" id="uploadLink" name="uploadLink" data-parsley-required-message="Link is required." required>
					</div>
					<div class="form-group">
						<label for="image">Link Text</label>
						<input type="text" class="form-control" id="image" name="image" data-parsley-required-message="Link text is required." required>
					</div>
					<button type="submit" class="btn btn-dark">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

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
						<!--
							--------------------------------------------------- 
							Topbar
							---------------------------------------------------
						-->
						<?php
						$sql = "SELECT * FROM homepage_banner WHERE section = 'topbar_section'";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) : ?>
							<div class="bg-primary">
								<div class="container">
									<?php while ($row = $result->fetch_assoc()) : ?>
										<div class="d-flex align-items-center justify-content-center position-relative w-100 py-2">
											<a href="<?= $row['link'] ?>" target="_blank" id="<?= $row['type'] ?>" class="text-light"><?= $row['image'] ?></a>
											<button type="button" class="btn btn-success waves-effect waves-light position-absolute" data-id="<?= $row['id'] ?>" data-link="<?= $row['link'] ?>" data-type="<?= $row['type'] ?>" data-link-text="<?= $row['image'] ?>" onclick="uploadTopbar(event)" style="right: 0;">Edit</button>
										</div>
									<?php endwhile; ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="card-body">
							<div class="container">
								<!--
									--------------------------------------------------- 
									Top full height video
									---------------------------------------------------
								-->
								<?php
								$sql = "SELECT * FROM homepage_banner WHERE section = 'top_video'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) : ?>
									<section id="top-video" class="top-video">
										<?php while ($row = $result->fetch_assoc()) : ?>
											<a href="<?= $row['link'] ?>" target="_blank" id="<?= $row['type'] ?>" class="d-flex align-items-center justify-content-center position-relative mb-3">
												<video src="<?= BASEURL . 'media/' . $row['image'] ?>" class="w-100" autoplay loop muted></video>
												<button type="button" class="btn btn-success waves-effect waves-light position-absolute" data-id="<?= $row['id'] ?>" data-link="<?= $row['link'] ?>" data-type="<?= $row['type'] ?>" onclick="uploadTopVideo(event)">Upload</button>
											</a>
										<?php endwhile; ?>
									</section>
								<?php endif; ?>
								<!--
									--------------------------------------------------- 
									Top Links
									---------------------------------------------------
								-->
								<?php
								$sql = "SELECT * FROM homepage_banner WHERE section = 'top_link_section'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) : ?>
									<div class="top-links pb-4">
										<div class="row">
											<?php while ($row = $result->fetch_assoc()) : ?>
												<div class="col-md-4 d-flex flex-column align-items-center justify-content-center mb-2">
													<a href="<?= $row['link'] ?>" target="_blank" id="<?= $row['type'] ?>" class="btn btn-outline-primary w-100 h-100 mb-1">
														<div class="d-flex align-items-center justify-content-center h-100"><?= $row['image'] ?></div>
													</a>
													<button type="button" class="btn btn-success waves-effect waves-light" data-id="<?= $row['id'] ?>" data-link="<?= $row['link'] ?>" data-type="<?= $row['type'] ?>" data-link-text="<?= $row['image'] ?>" onclick="uploadButton(event)" style="height: 49px;">
														<div class="d-flex align-items-center justify-content-center h-100">Edit</div>
													</button>
												</div>
											<?php endwhile; ?>
										</div>
									</div>
								<?php endif; ?>
								<!--
									--------------------------------------------------- 
									Custom Sections
									---------------------------------------------------
								-->
								<div class="mb-4 text-center">
									<a href="custom-navigations.php" class="btn btn-lg btn-primary waves-effect waves-light">Add More Custom Sections at Navigation Bar</a>
								</div>
								<!--
									--------------------------------------------------- 
									Top category
									---------------------------------------------------
								-->
								<?php
								$sql = "SELECT * FROM homepage_banner WHERE section = 'top_category'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) : ?>
									<section id="top-category" class="top-category">
										<h3 class="text-center mb-3">Shop By Category</h3>
										<div class="row">
											<?php while ($row = $result->fetch_assoc()) : ?>
												<a href="<?= $row['link'] ?>" target="_blank" id="<?= $row['type'] ?>" class="col-6 col-md-3 mb-3 d-flex align-items-center justify-content-center position-relative">
													<img src="<?= BASEURL . 'media/' . $row['image'] ?>" alt="<?= $row['type'] ?>" srcset="" class="w-100">
													<button type="button" class="btn btn-success waves-effect waves-light position-absolute" data-id="<?= $row['id'] ?>" data-link="<?= $row['link'] ?>" data-type="<?= $row['type'] ?>" onclick="uploadBanner(event)">Upload</button>
												</a>
											<?php endwhile; ?>
										</div>
									</section>
								<?php endif; ?>
								<!--
									--------------------------------------------------- 
									Trending Now
									---------------------------------------------------
								-->
								<?php
								$sql = "SELECT * FROM homepage_banner WHERE section = 'trending_section'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) : ?>
									<section id="trending-section" class="trending-section">
										<h3 class="text-center mb-3">Trending Now</h3>
										<div class="row">
											<?php while ($row = $result->fetch_assoc()) : ?>
												<a href="<?= $row['link'] ?>" target="_blank" id="<?= $row['type'] ?>" class="col-md-4 mb-3 d-flex align-items-center justify-content-center position-relative">
													<img src="<?= BASEURL . 'media/' . $row['image'] ?>" alt="<?= $row['type'] ?>" srcset="" class="w-100">
													<button type="button" class="btn btn-success waves-effect waves-light position-absolute" data-id="<?= $row['id'] ?>" data-link="<?= $row['link'] ?>" data-type="<?= $row['type'] ?>" onclick="uploadBanner(event)">Upload</button>
												</a>
											<?php endwhile; ?>
										</div>
									</section>
								<?php endif; ?>
								<!--
									--------------------------------------------------- 
									Promo Section
									---------------------------------------------------
								-->
								<?php
								$sql = "SELECT * FROM homepage_banner WHERE section = 'promotion_section'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) : ?>
									<section id="promotion-section" class="promotion-section">
										<?php while ($row = $result->fetch_assoc()) : ?>
											<a href="<?= $row['link'] ?>" target="_blank" id="<?= $row['type'] ?>" class="d-flex align-items-center justify-content-center position-relative mb-3">
												<img src="<?= BASEURL . 'media/' . $row['image'] ?>" alt="<?= $row['type'] ?>" srcset="" class="w-100">
												<button type="button" class="btn btn-success waves-effect waves-light position-absolute" data-id="<?= $row['id'] ?>" data-link="<?= $row['link'] ?>" data-type="<?= $row['type'] ?>" onclick="uploadBanner(event)">Upload</button>
											</a>
										<?php endwhile; ?>
									</section>
								<?php endif; ?>
								<!--
									--------------------------------------------------- 
									Bottom Links
									---------------------------------------------------
								-->
								<?php
								$sql = "SELECT * FROM homepage_banner WHERE section = 'bottom_link_section'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) : ?>
									<div class="bottom-links pb-4">
										<div class="row">
											<?php while ($row = $result->fetch_assoc()) : ?>
												<div class="col-md-3 d-flex flex-column align-items-center justify-content-center mb-2">
													<a href="<?= $row['link'] ?>" target="_blank" id="<?= $row['type'] ?>" class="btn btn-outline-primary w-100 h-100 mb-1">
														<div class="d-flex align-items-center justify-content-center h-100"><?= $row['image'] ?></div>
													</a>
													<button type="button" class="btn btn-success waves-effect waves-light" data-id="<?= $row['id'] ?>" data-link="<?= $row['link'] ?>" data-type="<?= $row['type'] ?>" data-link-text="<?= $row['image'] ?>" onclick="uploadButton(event)" style="height: 49px;">
														<div class="d-flex align-items-center justify-content-center h-100">Edit</div>
													</button>
												</div>
											<?php endwhile; ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include('footernew.php'); ?>
<script src="<?php echo BASEURL; ?>admin/js/homepage-web.js"></script>