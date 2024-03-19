var devicetype = 1;
var filter_array = [];
var price_object = {
    'min_price': '',
    'max_price': ''
};
var sort_id = '';
var rating = '';
var total_pages = 1;
var pageNo = 0;
let isFetching = false;
var functionDelayTimeout;
var pageLoadCount = 0;
var navigation_id = $("#navigation_id").val();

function get_navigation_product(navigation_id, sortby, pageno, callback) {
    pageNo = pageno;
    $('.loading-container').removeClass('d-none');
    $.ajax({
        method: "post",
        url: site_url + "get-navigation-product",
        data: {
            navigation_id: navigation_id,
            sortby: sortby,
            pageno: pageno,
            [csrfName]: csrfHash,
            language: 1,
            min_price: price_object['min_price'],
            max_price: price_object['max_price'],
            rating: rating,
            devicetype: devicetype,
            config_attr: JSON.stringify(filter_array),
        },
        success: function (response) {
            total_pages = response.data.total_pages;
            var product_html = "";
            if (pageno === 0)
                $("#navigation_product").empty();
            if (response.data.product_array.length > 0 && response.status) {
                $('#total_products').text(response.data.total_products);
                for (let i = 0; i < 1; i++) {
                    $(response.data.product_array).each(function () {
                        product_html +=
                            `<div class="col-6 col-md-4 col-lg-3 mb-4">
                                <a href="${site_url}productdetail/${this.prod_name}/${this.prod_id}" class="d-flex flex-column card product-card rounded-0">
                                    <div class="product-card-img zoom-img rounded-0">
                                        <img src="${media_url}${this.prod_img_url[0]}" class="card-img-top rounded-0" alt="${this.prod_name}">
                                    </div>
                                    <div class="card-body d-flex flex-column product-card-body px-0">
                                        <h5 class="card-title product-title pb-3 fs-6">${this.prod_name}</h5>
                                        <div class="card-text d-flex flex-wrap py-1">
                                            <div class="sell-price fw-medium">${this.prod_price}</div>
                                            ${this.prod_mrp !== this.prod_price ? `<div class="mrp-price text-decoration-line-through fw-light">${this.prod_mrp}</div>
                                            <div class="discount text-danger fw-medium">${this.offpercent}% OFF</div>` : ``}
                                        </div>
                                    </div>
                                </a>
                            </div>`;

                    });
                }
            } else {
                $('#total_products').text('0');
                product_html =
                    `<div class="d-flex flex-column align-items-center">
                        <img src="${site_url}assets/images/empty-product.png" alt="Empty Product" class="text-center w-25">
                        <div class="text-center page-heading font-family-lora fw-semibold mb-3 mb-md-4">Sorry! We couldn’t find what you’re looking for.</div>
                        <a href="${site_url}" class="btn btn-lg btn-secondary rounded-5">Go to homepage</a>
                    </div>`;
            }
            setTimeout(() => {
                $('.loading-container').addClass('d-none');
                $("#navigation_product").append(product_html);
                callback();
            }, 500);
        },
    });
}

$(document).on('change', '#sort_data_id', function () {
    sort_id = $("#sort_data_id").val();
    isFetching = true;
    get_navigation_product(navigation_id, sort_id, 0, () => {
        isFetching = false;
    });
});

$(document).on('change', '#flexCheckChecked', function () {
    sort_id = $("#sort_data_id").val();
    if (this.checked) {
        var check_val = $(this).val();
        var attr_id = $(this).closest('div').find('#attr_id').val();
        var attr_name = $(this).closest('div').find('#attr_name').val();
        filter_array.push({
            "attr_id": attr_id,
            "attr_name": attr_name,
            "attr_value": check_val
        });
    } else {
        var check_val = $(this).val();
        var parsedJSON = filter_array;
        for (var i = 0; i < parsedJSON.length; i++) {
            var counter = parsedJSON[i];
            if (counter.attr_value.includes(check_val)) {
                parsedJSON.splice(i, 1);
            }
        }
    }
    isFetching = true;
    get_navigation_product(navigation_id, sort_id, 0, () => {
        isFetching = false;
    });
});

// Pagination
window.addEventListener('scroll', () => {
    if (isFetching) return;
    const {
        scrollHeight,
        scrollTop,
        clientHeight
    } = document.documentElement;
    if (scrollTop + clientHeight >= scrollHeight - 500) {
        if (pageNo < total_pages - 1) {
            pageNo++;
            sort_id = $("#sort_data_id").val();
            isFetching = true;
            get_navigation_product(navigation_id, sort_id, pageNo, () => {
                isFetching = false;
            });
        }
    }
});

function rangeSlider() {
    var rangeSlider = document.getElementsByClassName('noui-slider-range');
    if (rangeSlider.length > 0) {
        var rangeSliders = Array.from(rangeSlider);
        rangeSliders.forEach(slider => {
            var nouiMin = parseFloat(slider.getAttribute('data-range-min'));
            var nouiMax = parseFloat(slider.getAttribute('data-range-max'));
            var nouiSelectedMin = parseFloat(slider.getAttribute('data-range-selected-min'));
            var nouiSelectedMax = parseFloat(slider.getAttribute('data-range-selected-max'));
            var rangeText = slider.parentElement.previousElementSibling;
            var imin = rangeText.firstElementChild;
            var imax = rangeText.lastElementChild;
            var inputs = [imin, imax];

            noUiSlider.create(slider, {
                start: [nouiSelectedMin, nouiSelectedMax],
                connect: true,
                step: 0.01,
                range: {
                    min: [nouiMin],
                    max: [nouiMax]
                }
            });

            slider.noUiSlider.on("update", function (values, handle) {
                inputs[handle].value = values[handle];
                if (pageLoadCount > 0) {
                    clearTimeout(functionDelayTimeout);
                    functionDelayTimeout = setTimeout(function () {
                        price_object['min_price'] = values[0];
                        price_object['max_price'] = values[1];
                        sort_id = $("#sort_data_id").val();
                        isFetching = true;
                        get_navigation_product(navigation_id, sort_id, 0, () => {
                            isFetching = false;
                        });
                    }, 500);
                }
            });
        });
    }
}

window.addEventListener('load', () => {
    rangeSlider();

    isFetching = true;
    get_navigation_product(navigation_id, '', 0, () => {
        isFetching = false;
    });

    pageLoadCount++;
});