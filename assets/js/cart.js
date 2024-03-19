var csrfName = $(".txt_csrfname").attr("name"); // 
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash
var securecode = $(".securecode").val();
var user_id = $("#user_id").val();
//alert('ddddd');
$(function () {
	window.onload = product_details(user_id);
	//window.onload = related_product();
});

function product_details(user_id) {
	event.preventDefault();
	//alert(prod_id);
	$.ajax({
		type: "POST",
		url: site_url + 'getusercartdetails',
		data: { language: 1, securecode: securecode, user_id: user_id, [csrfName]: csrfHash },
		success: function (html) {
			$(".loader").remove();
			var catObj = JSON.parse(html);
			var cartArray = catObj.Information;
			var cart_totalprice = cartArray.totalprice;

			var cart_prod_array = cartArray.prod_details;
			var cart_price = cartArray.price;

			var total_cart = cart_prod_array.length;

			$("#total_cart_price").text(cart_totalprice);
			$("#total_cart_items").text(total_cart);
			$("#total_prices").val(cart_totalprice);
			$("#total_price").text(cart_totalprice);

			var cart_html = '';


			for (var i = 0; i < total_cart; i++) {
				var prod_cart_detail = cart_prod_array[i];
				var imageObj = JSON.parse(prod_cart_detail.img_url);

				var qty = prod_cart_detail.qty;
				if (prod_cart_detail.color) {
					var color = ", " + prod_cart_detail.color;
				} else {
					var color = '';
				}
				if (prod_cart_detail.size) {
					var size = ", " + prod_cart_detail.size;
				} else {
					var size = "";
				} var stock = prod_cart_detail.stock; var prod_total_price = prod_cart_detail.prod_total_price;
				var prod_id = prod_cart_detail.id;
				var option_html = '';
				for (j = 1; j <= 20; j++) {
					if (qty == j) { var selected = 'selected' } else { var selected = '' }
					option_html += '<option value="' + j + '" ' + selected + '>' + j + '</option>';
				}

				cart_html += '<tr id="cart_tr' + prod_id + '"><td style="text-align:left;"><img width="80px;" class="_1Nyybr _30XEf0 cart_prod_img" alt="' + prod_cart_detail.name + '" src="../media/' + imageObj[0].url + '">';
				cart_html += '<span>' + prod_cart_detail.name + color + size + '</span> <span style="float: right;margin: 25px;" class="single-cart-product-x-icon"><a href="javascript:void(0);" onclick="delete_cart_item(' + prod_id + ')"><i class="bx bx-x bx-sm"></i></a></span></td><td>₹ ' + prod_cart_detail.price + '</td>';
				cart_html += ' <td>Qty - <select id="cart_qty' + prod_id + '" onchange="update_cart(' + prod_id + ',' + prod_cart_detail.price + ',' + stock + ')">' + option_html;
				cart_html += ' </select><br><div class="delete-cart-item"></div></td><td>₹ <span id="total_cart_price"> ' + prod_total_price + '</span></td></tr>';

			}
			$("#cart_item_trs").after(cart_html);

		}
	});

}

function update_cart(product_id, product_price, stock, qty, type) {
	var quantity = qty;
	if (type == "0") {
		quantity = parseInt(quantity) - 1;
	} else {
		quantity = parseInt(quantity) + 1;
	}
	if (quantity > 0) {
		if (product_id) {
			if (quantity > stock) { toastr.error('only ' + stock + ' Qty Available'); } else {
				$("#loader_div").html('<div class="loader"><img class="loader_img" src="<?php echo $MEDIA_URL;  ?>home/loader.gif" ></div>');

				$.ajax({
					//url: "<?php echo $API_URL; ?>editcartitem2.php",
					type: "POST",
					url: site_url + 'editcartitem',
					data: {
						language: 1,
						securecode: securecode,
						user_id: user_id,
						prod_id: product_id,
						prod_qtyprice: product_price,
						prod_qty: quantity,
						[csrfName]: csrfHash
					},

					success: function (html) {
						toastr.success("Cart Updated")
						setInterval(() => {
							location.href = site_url + "cart";
						}, 500);
						// $(".loader").remove();
						//$("#cart"+product_id).html('<i class="fa fa-cart-plus" aria-hidden="true"></i>');
						var catObj = JSON.parse(html);
						var cartArray = catObj.Information;
						var status = catObj.status;
						if (status == 2) {
							alert(catObj.msg);
						} else {
							//alert('ddddddd');
							update_cart_price(user_id);
						}

					}
				});
			}
		}
	}

}

function update_cart_price(ids) {
	if (ids) {
		$.ajax({
			//url: "<?php echo $API_URL; ?>getusercartdetails.php",
			type: "POST",
			url: site_url + 'getusercartdetails',
			data: { language: 1, securecode: securecode, user_id: user_id, [csrfName]: csrfHash },
			success: function (html) {
				var catObj = JSON.parse(html);
				var cartArray = catObj.Information;
				var cart_totalprice = cartArray.totalprice;

				var cart_prod_array = cartArray.prod_details;

				var total_cart = cart_prod_array.length;

				$("#total_cart_price").text(cart_totalprice);
				$("#total_cart_items").text(total_cart);
				$("#total_cart_count").text(total_cart);
				$("#total_price").val(cart_totalprice);

			}
		});
	}
}

function delete_cart_item(product_id) {
	if (confirm("Are you sure want to remove product?")) {
		if (product_id) {
			$.ajax({
				//url: "<?php echo $API_URL; ?>deletecartitem.php",
				type: "POST",
				url: site_url + 'deletecartitem',
				data: { language: 1, securecode: securecode, user_id: user_id, prod_id: product_id, [csrfName]: csrfHash },
				success: function (html) {
					window.location = site_url + "cart";
					get_cart_products(user_id);
					$("#cart_tr" + product_id).remove();
					var catObj = JSON.parse(html);
					var cartArray = catObj.Information;
					update_cart_price(user_id);



				}
			});
		}
	}

}

function order_summary_page() {
	var cart_totalprice = $("#total_prices").val();
	var minordervalue = $("#minordervalue").val();
	var price = cart_totalprice.replace(/,/g, "");




	if (parseInt(price) != 0) {
		if (parseInt(price) <= minordervalue) {
			alert('Minimum Order Value is ' + minordervalue);
		}
		else {
			location.href = site_url + "checkout";
		}
	} else {
		alert("Please select an item to purchase.");
	}
}