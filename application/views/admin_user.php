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
                                            <h2 class="nk-block-title fw-normal">Admin User</h2>
                                              <?php echo @$message; ?>

                                        </div>
                                    </div><!-- .nk-block -->
                                    <div class="nk-block nk-block-lg">
                                        
                                        <div class="row g-gs">
                                            
                                            <div class="col-lg-12">
                                                <div class="card h-100">
                                                    <div class="card-inner">
                                                        
                                                        <form method="post" action="<?php echo base_url(); ?>AdminUser/add_user">
                                                            <div class="form-group">
                                                                <label class="form-label" for="cf-full-name">Full Name</label>
                                                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                                                            </div>
															<div class="form-group">
                                                                <label class="form-label" for="cf-phone-no">Phone No</label>
                                                                <input type="text" class="form-control" id="phone_no" name="phone_no" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="cf-email-address">Role</label>
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap ">
                                                                        <div class="form-control-select">
                                                                            <select class="form-control required invalid" data-msg="Required" id="role" name="role" required="">
                                                                                <option value="">Select Role</option>
                                                                                <option value="admin">Admin</option>
                                                                                <option value="app user">App User</option>
                                                                                <option value="inventory user">Inventory User</option>
                                                                            </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label class="form-label" for="cf-subject">Password</label>
                                                                <input type="text" class="form-control" name="password" id="password" required>
                                                            </div>
															<!--<div class="form-group">
                                                                <label class="form-label" for="cf-subject">Re-Password</label>
                                                                <input type="text" class="form-control" name="repassword" id="repassword" required>
                                                            </div>-->
                                                            
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-lg btn-primary">Add User</button>
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
														  <th>All</th>
														  <th>Sno</th>
														  <th>Name</th>
														  <th>Mobile No</th>
														  <th>Role</th>                        
														  <th></th>                     
														  
													  </tr>
                                                    </thead>
                                                    <tbody id="tbodyPostid">
                                                        <?php 
															$sno = 0;		
														 foreach ($user_data->result() as $row)  
														 {  
														?>
														<tr class="nk-tb-item">
                                                            <td class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                                    <label class="custom-control-label" for="uid1"></label>
                                                                </div>
                                                            </td>
															<td class="nk-tb-col tb-col-lg">
                                                                <span><?php echo $sno; ?></span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-lg">
                                                                <span><?php echo $row->full_name; ?></span>
                                                            </td>
															<td class="nk-tb-col tb-col-lg">
                                                                <span><?php echo $row->phone_no; ?></span>
                                                            </td>
															<td class="nk-tb-col tb-col-lg">
                                                                <span><?php echo $row->role; ?></span>
                                                            </td>
															<td class="nk-tb-col tb-col-lg">
																<ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="<?php echo site_url('admin_user/delete/'.$row->sno); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                           <em class="icon ni ni-trash"></em>
                                                                        </a>
                                                                    </li>
                                                                    
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="<?php echo site_url('admin_user/edit/'.$row->sno); ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
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