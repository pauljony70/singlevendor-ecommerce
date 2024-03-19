<!DOCTYPE html>
<html lang="zxx" class="js"> 
<?php
header('Access-Control-Allow-Origin: *');
if(empty($this->session->userdata('user_id')))
{
	redirect('login'); 
}
?> 

<?php include("includes/head.php") ?>

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
                                            <h2 class="nk-block-title fw-normal">Plans</h2>
                                              <?php echo @$message; ?>

                                        </div>
                                    </div><!-- .nk-block -->
                                    <div class="nk-block nk-block-lg">
                                        
                                        <div class="row g-gs">
                                            
                                            <div class="col-lg-12">
                                                <div class="card h-100">
                                                    <div class="card-inner">
                                                        
                                                        <form method="post" action="<?php echo base_url(); ?>Plans/add_data">
                                                            <div class="row" > 
															
															<div class="form-group col-md-8">
																<div class="form-label-group">
																	<label class="form-label" for="default-01">Plan Name</label>
																</div>
																<div class="form-control-wrap">
																	<input type="text" name="plan_name" class="form-control form-control-lg" required id="plan_name" placeholder="Enter Plan Name">
																</div>
															</div>
															<div class="form-group col-md-8">
                                                                <label class="form-label" for="cf-full-name">Price</label>
                                                                <input type="number" class="form-control" id="price" name="price" required placeholder="Enter Price">
                                                            </div>
															<div class="form-group col-md-8">
																<div class="form-label-group">
																	<label class="form-label" for="default-01">Sort Description</label>
																</div>
																<div class="form-control-wrap">
																	<textarea class="form-control form-control-lg" name="sort_desc" required placeholder="Enter Sort Description"></textarea>
																</div>
															</div>
															<div class="form-group col-md-8">
																<div class="form-label-group">
																	<label class="form-label" for="default-01">Full Description</label>
																</div>
																<div class="form-control-wrap">
																	<textarea class="form-control form-control-lg" name="full_desc" required placeholder="Enter Full Description"></textarea>
																</div>
															</div>
															
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-lg btn-primary">Add Plan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="card card-bordered card-preview">
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
														  <th>Sno</th>
														  <th>Name</th>
														  <th>Price</th>
														  <th>Sort Description</th>
														  <th>Full Description</th>
														  <th></th>                     
														  
													  </tr>
                                                    </thead>
                                                    <tbody id="tbodyPostid">
                                                        <?php 
															$sno = 1;		
														 foreach ($plan_data->result() as $row)  
														 {  
														?>
														<tr class="nk-tb-item">
                                                            
															<td class="nk-tb-col tb-col-lg">
                                                                <span><?php echo $sno; ?></span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-lg">
                                                                <span><?php echo $row->plan_name; ?></span>
                                                            </td>
															<td class="nk-tb-col tb-col-lg">
                                                                <span><?php echo $row->price; ?></span>
                                                            </td>
															<td class="nk-tb-col tb-col-lg">
                                                                <span><?php echo $row->sort_desc; ?></span>
                                                            </td>
															<td class="nk-tb-col tb-col-lg">
                                                                <span><?php echo $row->full_desc; ?></span>
                                                            </td>
															
															<td class="nk-tb-col tb-col-lg">
																<ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="<?php echo site_url('Plans/delete/'.$row->plan_id); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                           <em class="icon ni ni-trash"></em>
                                                                        </a>
                                                                    </li>
                                                                    
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="<?php echo site_url('Plans/edit/'.$row->plan_id); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                            <em class="icon ni ni-pen2"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                           
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            
                                                        </tr><!-- .nk-tb-item  -->
														 <?php $sno++; } ?>
                                                        
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
    <div class="modal fade" tabindex="-1" role="dialog" id="region">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="title mb-4">Select Your Country</h5>
                    <div class="nk-country-region">
                        <ul class="country-list text-center gy-2">
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/arg.png" alt="" class="country-flag">
                                    <span class="country-name">Argentina</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/aus.png" alt="" class="country-flag">
                                    <span class="country-name">Australia</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/bangladesh.png" alt="" class="country-flag">
                                    <span class="country-name">Bangladesh</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/canada.png" alt="" class="country-flag">
                                    <span class="country-name">Canada <small>(English)</small></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/china.png" alt="" class="country-flag">
                                    <span class="country-name">Centrafricaine</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/china.png" alt="" class="country-flag">
                                    <span class="country-name">China</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/french.png" alt="" class="country-flag">
                                    <span class="country-name">France</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/germany.png" alt="" class="country-flag">
                                    <span class="country-name">Germany</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/iran.png" alt="" class="country-flag">
                                    <span class="country-name">Iran</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/italy.png" alt="" class="country-flag">
                                    <span class="country-name">Italy</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/mexico.png" alt="" class="country-flag">
                                    <span class="country-name">México</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/philipine.png" alt="" class="country-flag">
                                    <span class="country-name">Philippines</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/portugal.png" alt="" class="country-flag">
                                    <span class="country-name">Portugal</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/s-africa.png" alt="" class="country-flag">
                                    <span class="country-name">South Africa</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/spanish.png" alt="" class="country-flag">
                                    <span class="country-name">Spain</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/switzerland.png" alt="" class="country-flag">
                                    <span class="country-name">Switzerland</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/uk.png" alt="" class="country-flag">
                                    <span class="country-name">United Kingdom</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="<?php echo base_url; ?>images/flags/english.png" alt="" class="country-flag">
                                    <span class="country-name">United State</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .modal-content -->
        </div><!-- .modla-dialog -->
    </div><!-- .modal -->
    <!-- JavaScript -->
    <?php include("includes/script.php") ?>
	<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-database.js"></script>
	</body>

</html>