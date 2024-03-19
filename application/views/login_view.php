<!DOCTYPE html>
<html lang="zxx" class="js">

<?php include("includes/head.php") ?>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <?php // include("includes/sidebar.php") ?>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <?php // include("includes/header.php") ?>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="<?php echo base_url; ?>images/logo.png" srcset="<?php echo base_url; ?>images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="<?php echo base_url; ?>images/logo-dark.png" srcset="<?php echo base_url; ?>images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Login</h4>
                                        <div class="nk-block-des">
                                            <?php echo @$message; ?>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="<?php echo base_url(); ?>Login/register_user">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" name="email" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" name="Password" class="form-control form-control-lg" id="password" placeholder="Enter your Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
				
				
                <!-- content @e -->
                <!-- footer @s -->
                <?php // include("includes/footer.php") ?>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
   
    <!-- JavaScript -->
    <?php include("includes/script.php") ?>
	
</body>

</html>