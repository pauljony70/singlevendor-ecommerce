// var csrfName = $(".txt_csrfname").attr("name");
var csrfHash = $(".txt_csrfname").val(); // CSRF hash
var site_url = $(".site_url").val(); // CSRF hash
var securecode = $(".securecode").val();
var prod_id = $("#prod_id").val();
var user_id = $("#user_id").val();

$(function () {
  // window.onload = product_details(prod_id);
  // window.onload = attr_data_change(event);
  //window.onload = related_product();
});
/* 
 * ---------------------------------------------------
 * check Device Type
 * ---------------------------------------------------
 */
(function () {
  function checkDeviceType() {
    var userAgent = navigator.userAgent.toLowerCase();

    if (userAgent.match(/mobile|android|iphone|ipad|ipod|blackberry|iemobile|opera mini/i)) {
      // Mobile device
      document.body.classList.add('responsive-body');
    } else if (userAgent.match(/tablet|ipad/i)) {
      // Tablet device
      document.body.classList.add('responsive-body');
    } else {
      // Desktop device
      document.body.classList.remove('responsive-body');
    }
  }

  window.addEventListener('load', checkDeviceType);
  window.addEventListener('resize', checkDeviceType);
})();

/* 
 * ---------------------------------------------------
 * Share Button
 * ---------------------------------------------------
 */
var shareIcon = document.querySelector('.share-icon');
var hoverCard = document.querySelector('.hover-card');

shareIcon.addEventListener('click', function () {
  if (hoverCard.style.display === 'block') {
    shareIcon.classList.remove('active');
    hoverCard.style.display = 'none';
  } else {
    shareIcon.classList.add('active');
    hoverCard.style.display = 'block';
  }
});

document.addEventListener('click', function (e) {
  if (!shareIcon.contains(e.target) && !hoverCard.contains(e.target)) {
    shareIcon.classList.remove('active');
    hoverCard.style.display = 'none';
  }
});

function mobileShareLink(url) {
  if (navigator.share) {
    navigator.share({
      title: document.title,
      url: url
    })
      .then(() => console.log('Link shared successfully.'))
      .catch((error) => console.log('Error sharing link:', error));
  } else {
    console.log('Sharing not supported on this device.');
  }
}

/* 
 * ---------------------------------------------------
 * Initialize Desktop Gallery
 * ---------------------------------------------------
 */
var swiperDesktopThumbs = new Swiper(".product-details-swiper-sm-desktop", {
  spaceBetween: 15,
  slidesPerView: 3.14,
  direction: 'vertical',
  mousewheel: {
    releaseOnEdges: true,
    sensitivity: 1
  },
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {
    1200: {
      slidesPerView: 3.12,
      spaceBetween: 15,
    },
    1400: {
      slidesPerView: 3.1,
      spaceBetween: 15,
    }
  },
});

var swiperDesktopMain = new Swiper(".product-details-swiper-desktop", {
  spaceBetween: 10,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiperDesktopThumbs,
  },
});

new Swiper('.similar-prod-swiper', {
  slidesPerView: 2,
  spaceBetween: 15,
  freeMode: true,
  grabCursor: true,
  mousewheel: {
    forceToAxis: true,
  },
  forceToAxis: false,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    768: {
      slidesPerView: 3,
      spaceBetween: 15,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 15,
    }
  },
  // slidesPerGroup: 4,
  // speed: 1200,
});

/* 
 * ---------------------------------------------------
 * Get Attribute Product Price
 * ---------------------------------------------------
 */
function get_product_attributes(tag) {
  $("#" + tag.replace(/[^a-zA-Z0-9]/g, '_') + "_attr_id").attr("checked", true);

  var numberOfChecked = $(".product_attributes:checkbox:checked").length;
  var totalCheckboxes = $(".product_attributes:checkbox").length;

  if (totalCheckboxes == numberOfChecked) {
    var attribute_array = [];

    $.each($(".attribute-values:checked"), function () {
      var attributes_id = $(this).attr("attribute-label");

      attribute_array.push({
        attr_id: $("#" + attributes_id + "_attr_id").val(),
        attr_name: attributes_id,
        attr_value: $(this).val(),
      });
    });
    var prod_id = $("#prod_id").val();

    var config_attr = JSON.stringify(attribute_array);

    $('#config_attr').val(config_attr);

    $.ajax({
      method: "post",
      url: site_url + "getProductPrice",
      data: {
        pid: prod_id,
        config_attr: config_attr
      },
      success: function (response) {
        if (response.status) {
          if (response.data.imgurl) {
            var conf_images = JSON.parse(response.data.imgurl);
            if (conf_images) {
              swiperDesktopMain.removeAllSlides();
              swiperDesktopThumbs.removeAllSlides();

              $.each(conf_images, function () {
                swiperDesktopMain.appendSlide(`<a class="swiper-slide spotlight zoom-img" data-fancybox="mobile-group" href="${media_url}${this}"><img src="${media_url}${this}" class="w-100 h-100"></a>`);
                swiperDesktopThumbs.appendSlide(`<div class="swiper-slide"><img src="${media_url}${this}" class="w-100 h-100"></div>`);
              });
            }
          }
          $('#price-div').html(
            `<div class="product-price">${response.data.product_price}</div>`
          );
          if (response.data.product_mrp !== response.data.product_price) {
            $('#price-div').append(
              `<div class="product-mrp text-decoration-line-through fw-light ms-3">${response.data.product_mrp}</div>
              <span class="badge rounded-pill text-bg-secondary fw-semibold offpercent ms-3">SAVE ${response.data.offpercent}%</span>`
            );
          }
        }
      },
    });
  }
}

function product_details(prod_id) {
  event.preventDefault();

  //alert(prod_id);

  $.ajax({
    method: "post",
    url: site_url + "index.php/" + "productdetaildata",

    data: {
      language: 1,
      securecode: securecode,
      prod_id: prod_id,
      [csrfName]: csrfHash,
    },

    success: function (response) {
      //alert(response);

      var parsedJSON = $.parseJSON(response);

      $(parsedJSON["Information"]).each(function () {
        $("#product_name_bc").html(this.name);
        $("#product_name").html(this.name);

        $("#mrp").html(this.price);
        $("#price").html(this.mrp);
        attr_data_change(event);
        //alert('dddd'+this.mrp+'--'+this.price);
        var mrp = this.mrp;
        var price = this.price;
        if (mrp == price) {
          //alert('dddddd');
          $("#price_div").hide();
        }
        else {
          $("#price_div").show();
        }



        $("#prod_rating_count").html(this.prod_rating_count);

        // $("#short_desc").html(this.short_desc);

        $("#brand").html(this.brand);

        $("#fulldetail").html(this.fulldetail);

        var myArray = JSON.parse(this.img_url);

        //alert(this.name);

        $(myArray).each(function () {
          var img = "http://mkkirana.com/media/" + this.url;


          $("#meta_img").html("<meta property='og:image' content=" + img + "/>");
          //alert(img);

          $("#prod_img").html("<img style='width:100%' src=" + img + ">");
        });

        var cart_btn_html = "";

        $("#cart_btn").empty();

        var qoute_id = "";

        cart_btn_html +=
          '<button class="btn-border" onclick="add_to_cart_products(event,' +
          "'" +
          prod_id +
          "','" +
          this.sku +
          "','" +
          this.vendor_id +
          "','','1','0','2'," +
          "'" +
          qoute_id +
          "'" +
          ')">Add to Cart</button>';

        $(".pBtns").html(cart_btn_html);
      });

      var product_html = "";

      $("#related_product").empty();

      $(parsedJSON["related"]).each(function () {
        var img_Array = JSON.parse(this.img_url);

        var img = "";

        var titles = this.name.slice(0, 30) + (this.name.length > 30 ? "..." : "");

        $(img_Array).each(function () {
          img = "http://mkkirana.com/media/" + this.url;

          //alert(img);
        });

        product_html +=
          '<div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-6"><div class="home-one-product-box"><div class="home-one-product-img"><a href="' + site_url + 'productdetail/' + this.name + '/' + this.id + '"><img src="' +
          img +
          '" alt=""></a></div><div class="home-one-product-content text-center"><span><a href="' + site_url + 'productdetail/' + this.name + '/' + this.id + '">' +
          titles +
          '</a></span><div class="home-one-product-price-list"><ul><li>₹' +
          this.price +
          "</li><li><del>₹" +
          this.mrp +
          "</del></li></ul></div></div></div></div>";

        //alert(this.id);
      });

      $("#related_product").html(product_html);

      //alert(product_html);

      //    location.reload();
    },
  });
}

function attr_data_change(event) {
  //var selectElement = event.target;
  //var value = selectElement.value;
  value = $("#attr_data option:selected").val();
  // alert('llll');
  if (value != 'undefined') {
    $("#mrp").text(value);
  }
  //$("#price").html(this.price);
  //alert(value);
}

//alert('ddddd');
/*
$(function () {
  window.onload = product_details(prod_id);
  //window.onload = product_add_wishlist(prod_id,'');
  //window.onload = related_product();
});

function product_add_wishlist(product_id, product_price) {
  var quantity = 1;

  if (product_id) {
    $("#wishlist" + product_id).html('<i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
      type: "POST",
      url: site_url + "add_prod_into_wishlist",

      data: {
        language: 1,
        securecode: securecode,
        user_id: user_id,
        prod_id: prod_id,
        prod_price: product_price,
        qty: quantity,
        [csrfName]: csrfHash,
      },

      success: function (html) {
          get_wishlist_products(user_id); 
        $("#wishlist" + product_id).html(
          '<i class="fa fa-heart" aria-hidden="true"></i>'
        );

        var catObj = JSON.parse(html);
        var cartArray = catObj.Information;
      },
    });
  }
}

function product_details(prod_id) {
  event.preventDefault();

  //alert(prod_id);

  $.ajax({
    method: "post",
    url: site_url + "productdetaildata",

    data: {
      language: 1,
      securecode: securecode,
      prod_id: prod_id,
      [csrfName]: csrfHash,
    },

    success: function (response) {
      //alert(response);

      var parsedJSON = $.parseJSON(response);

      $(parsedJSON["Information"]).each(function () {
        $("#product_name_bc").html(this.name);
        $("#product_name").html(this.name);

        $("#mrp").html(this.mrp);
        $("#price").html(this.price);
        console.log('dddddddd');
        var mrp = this.mrp;
        var price = this.price;
        if(mrp == price)
        {
            //alert('dddddd');
            $("#price_div").hide();
        }
        else
        {
            $("#price_div").show();
        }

        

        $("#prod_rating_count").html(this.prod_rating_count);

        $("#short_desc").html(this.short_desc);

        $("#brand").html(this.brand);

        $("#fulldetail").html(this.fulldetail);

        var myArray = JSON.parse(this.img_url);

        //alert(this.name);

        $(myArray).each(function () {
          var img = "http://girgitt.com/media/" + this.url;
          
          
          $("#meta_img").html("<meta property='og:image' content="+ img + "/>");
          //alert(img);

          $("#prod_img").html("<img style='width:100%' src=" + img + ">");
        });

        var cart_btn_html = "";

        $("#cart_btn").empty();

        var qoute_id = "";

        cart_btn_html +=
          '<button class="btn-border" onclick="add_to_cart_products(event,' +
          "'" +
          prod_id +
          "','" +
          this.sku +
          "','" +
          this.vendor_id +
          "','','1','0','2'," +
          "'" +
          qoute_id +
          "'" +
          ')">Add to Cart</button>';

        $(".pBtns").html(cart_btn_html);
      });

      var product_html = "";

      $("#related_product").empty();

      $(parsedJSON["related"]).each(function () {
        var img_Array = JSON.parse(this.img_url);

        var img = "";

        $(img_Array).each(function () {
          img = "http://girgitt.com/media/" + this.url;

          //alert(img);
        });

    product_html +=
          '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12"><div class="home-one-product-box"><div class="home-one-product-img"><a href="'+site_url+'productdetail/'+this.name+'/'+this.id+'"><img src="' +
          img +
          '" alt=""></a></div><div class="home-one-product-content"><h4><a href="'+site_url+'productdetail/'+this.name+'/'+this.id+'">' +
          this.name +
          '</a></h4><div class="home-one-product-price-list"><ul><li>₹' +
          this.price +
          "</li><li><del>₹" +
          this.mrp +
          "</del></li></ul></div></div></div></div>";

        //alert(this.id);
      });

      $("#related_product").html(product_html);

      //alert(product_html);

      //    location.reload();
    },
  });
}
*/

/* $(document).ready(function () {
  $("#review_save_btn").click(function () {
    event.preventDefault();

    var prod_id = $("#prod_id").val();
    var user_name = $("#user_name").val();
    var title = $("#title").val();
    var feedback = $("#feedback").val();
    var rating = $("input[name='rating1']:checked").val();
    //alert(rating); 

    $.ajax({
      //	url: "<?php echo $API_URL; ?>add_address.php",

      type: "POST",

      url: site_url + "add_review",

      data: {
        language: 'default',
        securecode: securecode,
        prod_id: prod_id,
        user_id: user_id,
        user_name: user_name,

        title: title,
        feedback: feedback,
        rating: rating,
        [csrfName]: csrfHash,
      },

      success: function (html) {
        var catObj = JSON.parse(html);
        //alert(catObj.msg); 
        $('#msg_data').text(catObj.msg);
        $("#title").val('');
        $("#feedback").val('');
        $('input[name="rating1"]').prop("checked", false);
        //jQuery(".succ-msg").remove();

        //$("#address_save_btn").html("Save");

        //location.href = site_url + "checkout";
      },
    });
  });
}); */