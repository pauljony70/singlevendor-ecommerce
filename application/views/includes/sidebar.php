<div class="col-lg-4 d-none d-lg-block">
	<div class="right-block p-1">
		<div class="wrap box-shadow-4">
			<div class="wrap-block align-items-center">
				<img src="<?php echo base_url; ?>/assets_web/images/icons/avtar.png" class="" />
				<div class="wrap-details">
					<h6><?= $this->lang->line('user-hello'); ?>,</h6>
					<h5><?php echo $this->session->userdata("user_name") ?></h5>
				</div>
			</div>
		</div>
		<div class="wrap box-shadow-4">
			<div class="wrap-block">
				<img src="<?php echo base_url; ?>/assets_web/images/icons/order.png" class="" />
				<div class="wrap-details">
					<h5><?= $this->lang->line('user-my-orders'); ?></h5>
					<h6><a href="<?php echo base_url; ?>order"><?= $this->lang->line('all-orders'); ?></a></h6>
					<h6><a href="<?php echo base_url; ?>my-wallet"><?= $this->lang->line('my-wallet'); ?></a></h6>
					<h6><a href="<?php echo base_url ?>track"><?= $this->lang->line('track-orders'); ?></a></h6>
				</div>
			</div>
			<hr />
			<div class="wrap-block">
				<img src="<?php echo base_url; ?>/assets_web/images/icons/account.png" class="" />
				<div class="wrap-details">
					<h5><?= $this->lang->line('user-account-settings'); ?></h5>
					<h6><a href="<?php echo base_url; ?>personal_info"><?= $this->lang->line('user-personal-info'); ?></a></h6>
					<h6><a href="<?php echo base_url; ?>myaddress"><?= $this->lang->line('user-manage-address'); ?></a></h6>
				</div>
			</div>
			<hr />
			<div class="wrap-block">
				<img src="<?php echo base_url; ?>/assets_web/images/icons/stuff.png" class="" />
				<div class="wrap-details">
					<h5><?= $this->lang->line('user-my-stuff'); ?></h5>
					<h6><a href="<?php echo base_url; ?>offers"><?= $this->lang->line('user-my-coupons'); ?></a></h6>
					<h6><a href="javascript:void(0);"><?= $this->lang->line('user-my-review-and-rating'); ?></a></h6>
					<h6><a href="<?php echo base_url; ?>notification"><?= $this->lang->line('user-notification'); ?></a></h6>
					<h6><a href="<?php echo base_url; ?>wishlist"><?= $this->lang->line('user-wishlist'); ?></a></h6>
				</div>
			</div>
			<hr />
			<div class="wrap-block">
				<img src="<?php echo base_url; ?>/assets_web/images/icons/logout.png" class="" />
				<div class="wrap-details">
					<h5><a href="<?php echo base_url; ?>logout"><?= $this->lang->line('user-logout'); ?></a></h5>
				</div>
			</div>
		</div>

		<div class="wrap box-shadow-4 mb-0">
			<h6><a href="javascript:void(0);"><?= $this->lang->line('user-help-center'); ?></a></h6>
		</div>

	</div>
</div>