<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
} else if (!isset($_REQUEST['attribute_id'])) {
    header("Location: manage-conf-attributes.php");
}

$stmt1 = $conn->prepare("SELECT attribute FROM product_attributes_set WHERE id ='" . $_REQUEST['attribute_id'] . "'");
$stmt1->execute();
$data = $stmt1->bind_result($col11);
while ($stmt1->fetch()) {
    $main_attr = $col11;
}

if ($stmt1->num_rows == 0) {
    header("Location: manage-conf-attributes.php");
}

?>
<?php include("header.php"); ?>


<input type="hidden" class="form-control" id="main_attribute_id" value="<?= $_REQUEST['attribute_id']; ?>">
<!-- main content start-->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">All Attribute Value</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div data-example-id="simple-form-inline">
                                <div class="row align-items-center">
                                    <div class="col-md-6 mb-2">
                                        <button type="button" class="btn btn-dark waves-effect waves-light" onclick="back_page();"><i class="fa fa-arrow-left"></i> Back</button>
                                        <button type="button" class="btn btn-primary waves-effect waves-light" id="" data-toggle="modal" data-target="#myModal">Add Attribute Value</button>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex align-items-center">
                                            <div class="ml-md-auto">
                                                <div class="d-flex align-items-center">
                                                    <span>Show</span>
                                                    <select class="form-control mx-1" id="perpage" name="perpage" onchange="getConfAttributeVal(1)" style="float:left;">

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
                                    <table class="table table-hover" id="tblname">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Sno</th>
                                                <th>Main Attributes</th>
                                                <th>Attributes</th>
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
<script src="js/admin/manage-attributes-val.js"></script>
<!--//footer-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Attributes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="add_attributes_form" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name">Attributes</label>
                        <input type="text" class="form-control" id="attributes" placeholder="Attributes">
                    </div>


                    <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="add_attributes_btn">Add</button>
                </form>
            </div>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalupdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Attributes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="update_attributes_form" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name">Attributes</label>
                        <input type="text" class="form-control" id="update_attributes" placeholder="Attributes">
                    </div>


                    <input type="hidden" class="form-control" id="attribute_id">
                    <button type="submit" class="btn btn-dark waves-effect waves-light" value="Upload" href="javascript:void(0)" id="update_attributes_btn">Update </button>
                </form>
            </div>

        </div>

    </div>
</div>