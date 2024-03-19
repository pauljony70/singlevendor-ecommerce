<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php include("header.php"); ?>

<!-- main content start-->
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">All Spinners</h4>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div data-example-id="simple-form-inline">
								<div class="row align-items-center">
									<div class="col-md-6 mb-2"></div>
									<div class="col-md-6 mb-2">
										<div class="d-flex align-items-center">
											<div class="ml-md-auto">
												<div class="d-flex align-items-center">
													<span>Show</span>
													<select class="form-control mx-1" id="perpage" name="perpage" onchange="getSpinners(1)" style="float:left;">

														<option value="10">10</option>

														<option value="25">25</option>

														<option value="50">50</option>

													</select>
													<span class="pull-right per-pag">entries</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="work-progres">

								<div class="table-responsive">
									<table class="table table-centered table-hover" id="tblname">
										<thead class="thead-light">
											<tr>
												<th>Sno</th>
												<th>Name</th>
												<th>Value</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="cat_list">
										</tbody>
									</table>
								</div>
								<div class="clearfix"> </div>
								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="pull-right" style="float:left;">
											Total Row : <a id="totalrowvalue" class="totalrowvalue"></a>
										</div>
									</div>
									<div class="col-md-6">
										<div class="pull-right page_div ml-auto" style="float:right;"> </div>
									</div>
								</div>
							</div>

							<div class="col_1">

								<div class="clearfix"> </div>

							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<!--footer-->
<?php include("footernew.php"); ?>
<script src="js/admin/manage-spinners.js"></script>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModalupdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Spinner</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form" id="update_spinner_form" enctype="multipart/form-data">

					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" placeholder="">
					</div>
					<div class="form-group">
						<label for="name">Value</label>
						<input type="text" class="form-control" id="value" placeholder="">
					</div>
					<div class="form-group">
						<label for="name">Image</label>
						<input type="file" name="image" id="image">
					</div>

					<input type="hidden" class="form-control" id="spinner_id" value="">
					<button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_spinner_btn">Update </button>
				</form>
			</div>

		</div>

	</div>
</div>