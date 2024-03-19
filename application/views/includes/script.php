<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/nouislider.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap-5.3.2/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/app/common.js') ?>"></script>

<script>
	var csrfName = $(".txt_csrfname").attr("name"); // 
	var csrfHash = $(".txt_csrfname").val(); // CSRF hash
	var site_url = '<?= base_url() ?>';
	var media_url = '<?= MEDIA_URL ?>';
	var theme_colour = '<?= get_settings('theme_color') ?>';
	var securecode = $(".securecode").val();
	var user_id = $("#user_id").val();

	get_cart_products(user_id);
	get_wishlist_products(user_id);

	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
			return false;
		return true;
	}

	function toggleSearch(event) {
		// Get the search form div and overlay
		var searchFormDiv = document.querySelector('.search-form-div');
		var searchFormOverlay = document.querySelector('.search-form-overlay');
		if (searchFormDiv) {
			// Check if the click was on the toggle button
			if (event.target === document.querySelector('.fa-magnifying-glass')) {
				// Toggle classes to show/hide the search form
				if (searchFormDiv.classList.contains('d-none')) {
					// Show search form
					searchFormDiv.classList.remove('d-none');
					searchFormDiv.classList.add('d-block');

					// Show overlay and disable body scroll
					searchFormOverlay.classList.add('show');
					document.body.style.overflow = 'hidden';

					// Change the icon to close
					document.querySelector('.fa-magnifying-glass').classList.add('fa-xmark');
					document.querySelector('.fa-magnifying-glass').classList.remove('fa-magnifying-glass');
				} else {
					// Hide search form
					searchFormDiv.classList.remove('d-block');
					searchFormDiv.classList.add('d-none');

					// Hide overlay and enable body scroll
					searchFormOverlay.classList.remove('show');
					document.body.style.overflow = '';

					// Change the icon back to search
					document.querySelector('.cross-btn.fa-xmark').classList.add('fa-magnifying-glass');
					document.querySelector('.cross-btn.fa-xmark').classList.remove('fa-xmark');
				}
			} else if (!searchFormDiv.contains(event.target)) {
				// Close the form if the click is outside and not inside the form
				// and the click was not on the toggle button
				// Hide search form
				if (searchFormDiv.classList.contains('d-block')) {
					searchFormDiv.classList.remove('d-block');
					searchFormDiv.classList.add('d-none');

					// Hide overlay and enable body scroll
					searchFormOverlay.classList.remove('show');
					document.body.style.overflow = '';

					// Change the icon back to search
					if (document.querySelector('.cross-btn.fa-xmark')) {
						document.querySelector('.cross-btn.fa-xmark').classList.add('fa-magnifying-glass');
						document.querySelector('.cross-btn.fa-xmark').classList.remove('fa-xmark');
					}
				}
			}
		}
	}

	// Add an event listener to handle clicks
	document.addEventListener('click', toggleSearch);


	$(document).on('focus', '#search', function() {
		$(this).addClass('focus-within');
		$(this).siblings('#searchButton').addClass('focus-within');
	});

	$(document).on('blur', '#search', function() {
		$(this).removeClass('focus-within');
		$(this).siblings('#searchButton').removeClass('focus-within');
	});

	function getStatedata(stateid = '') {
		$.ajax({
			method: 'GET',
			url: site_url + "all-state",
			success: function(response) {
				if (response.status) {
					$('#state').empty();
					$('#state').append('<option value="">Select state</option>');
					$.each(response.data, function() {
						$('#state').append('<option value="' + this.stateid + '">' + this.name + '</option>');
					});
				} else {
					console.error('Failed to fetch states: ' + response.message);
				}
			}
		});
	}

	function getCitydata(stateid, cityid = '') {
		$.ajax({
			method: 'GET',
			url: site_url + "all-city",
			data: {
				stateid: stateid
			},
			success: function(response) {
				if (response.status) {
					$('#city').empty();
					$('#city').append('<option value="">Select city</option>');
					$.each(response.data, function() {
						$('#city').append('<option value="' + this.city_id + '">' + this.city_name + '</option>');
					});
				} else {
					console.error('Failed to fetch cities: ' + response.message);
				}
			}
		});
	}

	function get_category() {
		$.ajax({
			type: "POST",
			url: site_url + 'getcategory',
			data: {
				language: 1,
				securecode: securecode,
				[csrfName]: csrfHash
			},
			success: function(response) {
				var catObj = JSON.parse(response);
				var categoryArray = catObj.Information;

				categoryArray.slice(0, 9).forEach(function(maincat) {
					var menuLi = $('<li>').addClass('menu-li');
					var menuLink = $('<a>').attr('href', site_url + 'sub_category/' + maincat.cat_id).addClass('menu-item py-3').text(maincat.cat_name);
					menuLi.append(menuLink);

					if (maincat.subcat_1.length > 0) {
						var megaMenu = $('<div>').addClass('mega-menu');
						var content = $('<div>').addClass('content box-shadow-0');

						for (var i = 0; i < 4; i++) {
							if (maincat.subcat_1[i * 2]) {
								var subcat = maincat.subcat_1[i * 2];
								var subcatCol = $('<div>').addClass('col px-2 py-4');
								var section = $('<section>');

								var subcatHeading = $('<a>').attr('href', site_url + 'sub_category/' + subcat.cat_id).addClass('item-heading').text(subcat.cat_name);
								section.append(subcatHeading);

								if (subcat.subsubcat_2.length > 0) {
									var subsubcatUl = $('<ul>').addClass('mega-links px-0');

									for (var j = 0; j < Math.min(subcat.subsubcat_2.length, 5); j++) {
										var subsubcat = subcat.subsubcat_2[j];
										var subsubcatLi = $('<li>').append(
											$('<a>').attr('href', site_url + 'sub_category/' + subsubcat.cat_id).text(subsubcat.cat_name)
										);
										subsubcatUl.append(subsubcatLi);
									}

									section.append(subsubcatUl);

									if (subcat.subsubcat_2.length > 5) {
										section.append(
											$('<a>').addClass('view-all').attr('href', site_url + 'sub_category/' + subcat.cat_id).text('view all ').append(
												$('<i>').addClass('fa-solid fa-arrow-right')
											)
										);
									}
								}

								subcatCol.append(section);
								content.append(subcatCol);
							}

							if (maincat.subcat_1[i * 2 + 1]) {
								var subcat = maincat.subcat_1[i * 2 + 1];
								var subcatCol = $('<div>').addClass('col px-2 py-4');
								var section = $('<section>');

								var subcatHeading = $('<a>').attr('href', site_url + 'sub_category/' + subcat.cat_id).addClass('item-heading').text(subcat.cat_name);
								section.append(subcatHeading);

								if (subcat.subsubcat_2.length > 0) {
									var subsubcatUl = $('<ul>').addClass('mega-links px-0');

									for (var j = 0; j < Math.min(subcat.subsubcat_2.length, 3); j++) {
										var subsubcat = subcat.subsubcat_2[j];
										var subsubcatLi = $('<li>').append(
											$('<a>').attr('href', site_url + 'sub_category/' + subsubcat.cat_id).text(subsubcat.cat_name)
										);
										subsubcatUl.append(subsubcatLi);
									}

									section.append(subsubcatUl);

									if (subcat.subsubcat_2.length > 3) {
										section.append(
											$('<a>').addClass('view-all').attr('href', site_url + 'sub_category/' + subcat.cat_id).text('view all ').append(
												$('<i>').addClass('fa-solid fa-arrow-right')
											)
										);
									}
								}

								subcatCol.append(section);
								content.append(subcatCol);
							}
						}

						var colImage = $('<div>').addClass('col col-image px-2 pb-5');
						var row = $('<div>').addClass('row g-2 justify-content-center mt-3');
						var col12a = $('<div>').addClass('col-12');
						var col12b = $('<div>').addClass('col-12');
						var img1 = $('<img>').addClass('nav-img').attr('src', site_url + 'media/' + maincat.imgurl).attr('alt', 'google-store');
						// var img2 = $('<img>').addClass('nav-img').attr('src', site_url + 'media/' + maincat.web_banner).attr('alt', 'app-store');

						col12a.append($('<a>').attr('href', '#').append(img1));
						// col12b.append($('<a>').attr('href', '#').append(img2));
						row.append(col12a, $('<br>'), col12b);
						colImage.append(row);
						content.append(colImage);
						megaMenu.append(content);
						menuLi.append(megaMenu);
					}

					$('#category-container').append(menuLi);
				});
			}
		});
	}

	function create_product_url(strings) {
		if (strings) {
			product_name = strings.replace(/,/g, "");
			product_name = product_name.replace(/  /g, "-");
			product_name = product_name.replace(/ /g, "-");
			product_name = product_name.replace(/_/g, "-");
			product_name = product_name.replace(/&/g, "");
			product_name = product_name.replace(/$/g, "-");
			product_name = product_name.replace(/@/g, "-");
			product_name = product_name.replace(/'/g, "");
			product_name = product_name.replace(/"/g, "");
			product_name = product_name.replace(/,/g, "");
			product_name = product_name.replace(/#/g, "");

			product_name = product_name.replace(/%/g, "");

			product_name = product_name.replace(/^/g, "");

			product_name = product_name.replace(/\(|\)/g, "");

			product_name = product_name.replace(/\+/g, "");

			product_name = product_name.replace(/=/g, "");

			product_name = product_name.replace(/!/g, "");

			product_name = product_name.replace(/{/g, "");

			product_name = product_name.replace(/}/g, "");

			//	product_name=	product_name.replace(/\[\/g, "");

			product_name = product_name.replace(/--/g, "-");

			product_name = product_name.replace(/|/g, "");

			product_name = product_name.replace(/\//g, "");

			product_name = product_name.replace(".", "");

			return product_name;

		}

	}

	function get_wishlist_products(user_id) {
		if (user_id) {
			$.ajax({
				type: "POST",
				url: site_url + 'getuserwishlist',
				data: {
					language: 1,
					securecode: securecode,
					user_id: user_id,
					[csrfName]: csrfHash
				},
				success: function(response) {
					$('#badge-wishlist-count').text(response.data.length);
				}
			});
		}
	}

	function get_cart_products(user_id) {
		if (user_id) {
			$.ajax({
				type: "POST",
				url: site_url + 'getusercartdetails',
				data: {
					language: 1,
					securecode: securecode,
					user_id: user_id,
					[csrfName]: csrfHash
				},
				success: function(response) {
					if (response.status) {
						$('#badge-cart-count').text(response.data.cart_result.length);
						$('.total-cart-item').text(response.data.cart_result.length);
						$('.total-cart-value').text(response.data.total_cart_value);
						$('#cartOffcanvas .offcanvas-body').empty();
						if (response.data.cart_result.length > 0) {
							$("#cart-icon").attr({
								"data-bs-toggle": "offcanvas",
								"href": "#cartOffcanvas",
								"role": "button",
								"aria-controls": "cartOffcanvas"
							});
							$(response.data.cart_result).each(function() {
								$('#cartOffcanvas .offcanvas-body').append(
									`<div class="row">
										<div class="col-3">
											<img src="${media_url}${this.prod_img_url[0]}" alt="${this.prod_name}" class="w-100 object-fit-cover">
										</div>
										<div class="col-9">
											<div class="product-name mb-2 fw-medium">${this.prod_name}</div>
											<div class="product-attributes d-flex justify-content-between mb-2">
												<div class="arributes">
													${this.config_attr.length > 0 ? 
														this.config_attr.map(element => {
															if (element.attr_value.startsWith("#")) {
																var rgb = hexToRgb(element.attr_value);
																var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
																return `<div class="d-flex align-items-center">${element.attr_name}: <label class="Color ms-1" style="background-color: ${element.attr_value}; border:1px solid ${darkerColor};"></label></div>`;
															} else {
																return '<div>' + element.attr_name + ': ' + element.attr_value + '</div>';
															}
														}).join('') 
														: ''}
												</div>
												<div class="row">
													<label for="prod-qty" class="col-2 col-form-label px-0">Qty: </label>
													<div class="col-10">
														<select name="cart-qty" id="cart-qty" class="form-select" onchange="updateCartQty(this, '${this.prod_id}')">
														${(() => {
															let options = '';
															for (let i = 1; i <= 10; i++) {
																options += `<option value="${i}" ${this.qty == i ? 'selected' : ''}>${i}</option>`;
															}
															return options;
														})()}
														</select>
													</div>
												</div>
											</div>
											<div class="cart-prod-price mb-2">${this.prod_price}</div>
											<div class="d-flex">
												<a href="javascript:void(0)" class="text-dark fs-6" onclick="delete_cart_item(${this.prod_id})"><i class="fa-regular fa-trash-can"></i></a>
												<a href="javascript:void(0)" class="ms-4 text-dark fs-6" onclick="product_add_wishlist(${this.prod_id})"><i class="fa-regular fa-heart"></i></a>
											</div>
										</div>
									</div>
									<hr>`
								);
							});
							if ($('.cart_products').length > 0) {
								$('.cart_products').empty();
								$(response.data.cart_result).each(function() {
									$('.cart_products').append(
										`<div class="row">
											<div class="col-3">
												<a href="${site_url}productdetail/${this.prod_name}/${this.prod_id}" title="${this.prod_name}">
													<img src="${media_url}${this.prod_img_url[0]}" alt="${this.prod_name}" class="w-100">
												</a>
												<p class="fs-6 mt-2 ${this.stock > 0 ? 'text-success' : 'text-danger'}">${this.stock > 0 ? 'IN STOCK' : 'OUT OF STOCK'}</p>
											</div>
											<div class="col-9">
												<a href="${site_url}productdetail/${this.prod_name}/${this.prod_id}" class="prod-name text-dark font-family-lora" title="${this.prod_name}">
													<div class="mb-3">${this.prod_name}</div>
												</a>
												<div class="product-attributes d-flex justify-content-between mb-2">
													<div class="arributes">
														${this.config_attr.length > 0 ? 
															this.config_attr.map(element => {
																if (element.attr_value.startsWith("#")) {
																	var rgb = hexToRgb(element.attr_value);
																	var darkerColor = `rgb(${rgb.r * 0.8}, ${rgb.g * 0.8}, ${rgb.b * 0.8})`;
																	return `<div class="d-flex align-items-center">${element.attr_name}: <label class="Color ms-1" style="background-color: ${element.attr_value}; border:1px solid ${darkerColor};"></label></div>`;
																} else {
																	return '<div>' + element.attr_name + ': ' + element.attr_value + '</div>';
																}
															}).join('') 
															: ''}
													</div>
													<div class="row">
														<label for="prod-qty" class="col-2 col-form-label px-0">Qty: </label>
														<div class="col-10">
															<select name="cart-qty" id="cart-qty" class="form-select" onchange="updateCartQty(this, ${this.prod_id})">
																${(() => {
																	let options = '';
																	for (let i = 1; i <= 10; i++) {
																		options += `<option value="${i}" ${this.qty == i ? 'selected' : ''}>${i}</option>`;
																	}
																	return options;
																})()}
															</select>
														</div>
													</div>
												</div>
												<div class="price-div row py-1">
													<div class="col-6 col-sm-4 sell-price fw-medium">${this.prod_price}</div>
													${this.prod_price !== this.prod_mrp ? 
													`<div class="col-6 col-sm-4 mrp-price text-decoration-line-through fw-light">${this.prod_mrp}</div>
													<div class="col-6 col-sm-4 discount text-danger fw-medium">${this.offpercent}%OFF</div>` : ``}
												</div>
												<div class="d-flex mt-5">
													<a href="javascript:void(0)" class="text-dark fs-6" onclick="delete_cart_item(${this.prod_id})"><i class="fa-regular fa-trash-can"></i></a>
													<a href="javascript:void(0)" class="ms-4 text-dark fs-6" onclick="product_add_wishlist(${this.prod_id})"><i class="fa-regular fa-heart"></i></a>
												</div>
											</div>
										</div>
										<hr>`
									);
								});
							}
						} else {
							$("#cart-icon").removeAttr("data-bs-toggle role aria-controls");
							$("#cart-icon").attr({
								"href": site_url + "cart",
							});
							$('#cartOffcanvas').offcanvas('hide');
							if ($('#cart-page-container').length > 0) {
								$('#cart-page-container').html(
									`<div class="d-flex flex-column align-items-center">
										<img src="${site_url}assets/images/empty-product.png" alt="Empty Product" class="text-center w-25">
										<div class="text-center page-heading font-family-lora fw-semibold mb-1">Your Cart is Empty!</div>
										<p class="mb-3 mb-md-4">There is a lot for you to shop from. So, why wait?</p>
										<a href="${site_url}" class="btn btn-lg btn-secondary rounded-5">Continue Shopping</a>
									</div>`
								);
							}
						}
					}
				}
			});
		}
	}
</script>

<script>
	// Add to Wishlist
	function product_add_wishlist(product_id) {
		var quantity = 1;
		let user_id = $("#user_id").val();
		// alert(user_id);
		if (user_id != "") {
			if (product_id) {
				$.ajax({
					type: "POST",
					url: site_url + "add_prod_into_wishlist",

					data: {
						language: 1,
						securecode: securecode,
						user_id: user_id,
						prod_id: product_id,
						[csrfName]: csrfHash,
					},

					success: function(response) {
						if (response.status) {
							$('#badge-wishlist-count').text(response.data.total_products);
							Swal.fire({
								text: response.msg,
								type: "success",
								showCancelButton: true,
								showCloseButton: true,
								confirmButtonColor: theme_colour,
							});
						} else {
							Swal.fire({
								text: response.msg,
								type: "error",
								showCancelButton: true,
								showCloseButton: true,
								confirmButtonColor: theme_colour,
							});
						}
					},
				});
			}
		} else {
			Swal.fire({
				text: "Please Login to add product in wishlist",
				type: "error",
				showCancelButton: true,
				showCloseButton: true,
				confirmButtonColor: theme_colour,
			}).then(function(res) {
				if (res.value) {
					window.location.href = site_url + 'login';
				}
			});
		}
	}

	// Add to Cart
	function single_product_add_cart(product_id, product_price) {
		let user_id = $("#user_id").val();

		if (user_id == '') {
			window.location.href = site_url.concat('login');
		} else {
			if (product_id) {
				$("#add-to-cart-btn").html('<i class="fa fa-spinner fa-spin"></i>');
				$('#add-to-cart-btn').prop('disabled', true);
				$.ajax({

					type: "POST",
					url: site_url + 'add_to_cart',
					data: {
						language: 1,
						securecode: securecode,
						user_id: user_id,
						prod_id: product_id,
						config_attr: $('#config_attr').val(),
						qty: $('#quantity').val(),
						[csrfName]: csrfHash
					},
					success: function(response) {
						$("#add-to-cart-btn").html('Buy Now');
						$('#add-to-cart-btn').prop('disabled', false);
						if (response.status) {
							$('#badge-cart-count').text(response.data.total_products);
							get_cart_products(user_id);
							$('#cartOffcanvas').offcanvas('show');
						} else {
							Swal.fire({
								text: response.msg,
								type: "error",
								showCancelButton: true,
								showCloseButton: true,
								confirmButtonColor: theme_colour,
							});
						}

					}
				});
			} else {
				Swal.fire({
					text: 'Product not found',
					type: "warning",
					showCancelButton: true,
					showCloseButton: true,
				}).then(function(res) {
					if (res.value) {
						location.reload();
					}
				});
			}
		}

	}

	function updateCartQty(ele, product_id) {
		let user_id = $("#user_id").val();
		if (user_id == '') {
			window.location.href = site_url.concat('login');
		} else {
			if (product_id) {

				$.ajax({

					type: "POST",
					url: site_url + 'editcartitem',
					data: {
						language: 1,
						securecode: securecode,
						user_id: user_id,
						prod_id: product_id,
						qty: ele.value,
						[csrfName]: csrfHash
					},
					success: function(response) {
						if (response.status) {
							get_cart_products(user_id);
							// $('#cartOffcanvas').offcanvas('show');
						} else {
							Swal.fire({
								text: response.msg,
								type: "error",
								showCancelButton: true,
								showCloseButton: true,
								confirmButtonColor: theme_colour,
							});
						}

					}
				});
			} else {
				Swal.fire({
					text: 'Product not found',
					type: "warning",
					showCancelButton: true,
					showCloseButton: true,
				}).then(function(res) {
					if (res.value) {
						location.reload();
					}
				});
			}
		}
	}

	function delete_cart_item(product_id) {
		Swal.fire({
			text: 'Are you sure to remove this product?',
			type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: theme_colour,
		}).then(function(res) {
			if (res.value) {
				$.ajax({
					type: "POST",
					url: site_url + 'deletecartitem',
					data: {
						language: 1,
						securecode: securecode,
						user_id: user_id,
						prod_id: product_id,
						[csrfName]: csrfHash
					},
					success: function(response) {
						if (response.status) {
							get_cart_products(user_id);
							// $('#cartOffcanvas').offcanvas('show');
						} else {
							Swal.fire({
								text: response.msg,
								type: "error",
								showCancelButton: true,
								showCloseButton: true,
								confirmButtonColor: theme_colour,
							});
						}
					}
				});
			}
		});
	}
</script>