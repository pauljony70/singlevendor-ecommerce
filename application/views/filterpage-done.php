<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        <?= get_store_settings('store_name') ?>. - Filter
    </title>
    <?php include("includes/head.php") ?>
</head>

<body>
    <!-- Preloder -->
    <?php include("includes/preloader.php") ?>
    <!-- Preloder End -->
    <!-- back to to button start-->
    <a href="#" id="scroll-top" class="back-to-top-btn"><i class='bx bx-up-arrow-alt'></i></a>
    <!-- back to to button end-->
    <?php include("includes/topbar.php") ?>
    <!-- Header area -->
    <?php include("includes/navbar.php") ?>
    <!-- Header area end -->
    <main class="my-5">
        <section class="container-fluid">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="fs-9">Home</a></li>
                    <li class="breadcrumb-item"><a href="#" class="fs-9">Women</a></li>
                    <li class="breadcrumb-item active fs-9" aria-current="page">Data</li>
                </ol>
            </nav>
            <div class="row main_content">
                <div class="col-3 desktop_filters">
                    <h6 class="filter_head">Filter By:</h6>
                    <hr>
                    <div class="filter_accordian">
                        <!-- Accordian Start -->
                        <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                            <div class="accordion-item">
                                <h6 class="accordion-header" id="heading-price">
                                    <button class="accordion-button fw-bold rounded collapsed mt-1 px-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-0" aria-expanded="false"
                                        aria-controls="collapse-0">
                                        <span class="first_level_category">
                                            <?= "Price" ?>
                                        </span>
                                    </button>
                                </h6>
                                <div id="collapse-0" class="accordion-collapse collapse" aria-labelledby="heading-1"
                                    data-bs-parent="#accordionExample2">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-control-borderless">
                                            <label class="form-label">Price Range</label>
                                            <div class="position-relative">
                                                <div class="noui-wrapper">
                                                    <div class="d-flex justify-content-between">
                                                        <input type="text" class="text-body input-with-range-min">
                                                        <input type="text" class="text-body input-with-range-max">
                                                    </div>
                                                    <div class="noui-slider-range mt-2" data-range-min='500'
                                                        data-range-max='2000' data-range-selected-min='700'
                                                        data-range-selected-max='1500'></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php $i = 1;
                            for ($ji = 1; $ji <= 5; $ji++) {
                                ?>
                                <!-- Item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="heading-">
                                        <button class="accordion-button fw-bold rounded collapsed mt-1 px-0" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-<?= $i ?>"
                                            aria-expanded="false" aria-controls="collapse-<?= $i ?>">
                                            <span class="first_level_category">
                                                <?= "Category " . $i ?>
                                            </span>
                                        </button>
                                    </h6>
                                    <!-- Body -->
                                    <div id="collapse-<?= $i ?>" class="accordion-collapse collapse"
                                        aria-labelledby="heading-1" data-bs-parent="#accordionExample2">
                                        <div class="">
                                            <ul class="ps-0 m-0">
                                                <li class="my-1 sub_category_item">
                                                    <div class="form-check last_level_filter mb-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="sub_filter_<?= $i ?>">
                                                        <label class="form-check-label" for="sub_filter_<?= $i ?>">
                                                            New Arrivals
                                                            <?= $i ?>
                                                        </label>
                                                    </div>
                                                    <ul id="sub_cate_list<?= $i ?>" class="sub_sub_filter">
                                                        <?php for ($l = 10; $l < 14; $l++) { ?>
                                                            <li>
                                                                <div class="form-check last_level_filter my-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="sub_filter_<?= $l ?>">
                                                                    <label class="form-check-label" for="sub_filter_<?= $l ?>">
                                                                        New Arrivals
                                                                        <?= $l ?>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ruler">
                                <?php $i++;
                            } ?>
                        </div>
                        <!-- Accordian END -->
                    </div>
                </div>
                <div class="col-9 main_contetn_filter">
                    <div class="filter_products">
                        <p class="filter_font">1,343 Products</p>
                        <div class="sorting">
                            <p class="filter_font me-5">Sort By:</p>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle fs-9 filter_sort_btn"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Most Relevant
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Most Relevant</a></li>
                                    <li><a class="dropdown-item" href="#">Price Low to High</a></li>
                                    <li><a class="dropdown-item" href="#">Price High to Low</a></li>
                                    <li><a class="dropdown-item" href="#">New Arrivals</a></li>
                                    <li><a class="dropdown-item" href="#">Popular</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Mobiolr Sorting Menu -->
                        <div class="mobile_sorting">
                            <div class="d-flex">
                                <button class="btn btn-outline-secondary mobile_sorting_btn" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#mobilefilteroffcanvas"
                                    aria-controls="mobilefilteroffcanvas">filters</button>

                                <button class="btn btn-outline-secondary mobile_sorting_btn" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#mobilesortbyoffcanvas"
                                    aria-controls="mobilesortbyoffcanvas">sort by</button>
                            </div>
                        </div>
                    </div>
                    <!-- Sorting checks -->
                    <div class="sorting_checks"></div>
                    <div class="product_cards">
                        <div class="row">
                            <?php for ($pro = 0; $pro <= 10; $pro++) { ?>
                                <div class="col-md-3 col-sm-4 col-6 my-1 mb-4">
                                    <div class="card filter_product_card">
                                        <img class="card-img-top filter_product_image"
                                            src="<?= base_url() ?>assets/images/producta1.jpeg" alt="Title" />
                                        <img src="<?= base_url() ?>assets/images/icons/heart.svg" alt=""
                                            class="filter_wishlist_icon">
                                        <div class="card-body px-0">
                                            <span class="card-text filter_product_status">New</span>
                                            <h6 class="card-title filter_product_name">Emerald Elegance Set</h6>
                                            <h6 class="filter_product_prize">Rs 5,888</h6>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sort by Offcanvas -->
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="mobilesortbyoffcanvas"
            aria-labelledby="mobilesortbyoffcanvasLabel">
            <div class="offcanvas-header">
                <h3 class="offcanvas-title" id="mobilesortbyoffcanvasLabel">Sort By</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <ul class="dropdown_mob_sort_offcanvas p-0">
                    <hr>
                    <li class="mob_sort_active"><a class="mob_sort_offcanvas" href="#">Most Relevant</a></li>
                    <hr>
                    <li><a class="mob_sort_offcanvas" href="#">Price Low to High</a></li>
                    <hr>
                    <li><a class="mob_sort_offcanvas" href="#">Price High to Low</a></li>
                    <hr>
                    <li><a class="mob_sort_offcanvas" href="#">New Arrivals</a></li>
                    <hr>
                    <li><a class="mob_sort_offcanvas" href="#">Popular</a></li>
                    <hr>
                </ul>
            </div>
        </div>
        <!-- Mobile Filter Offcanvas -->
        <div class="offcanvas offcanvas-start w-100" tabindex="-1" id="mobilefilteroffcanvas"
            aria-labelledby="mobilefilteroffcanvasLabel">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title" id="mobilefilteroffcanvasLabel">Filters</h2>
                <button type="button" class="btn mob_close_btn" data-bs-dismiss="offcanvas" aria-label="Close">Reset
                    Filters</button>
            </div>
            <hr class="m-0">
            <div class="offcanvas-body p-0">
                <div class="row">
                    <div class="col-5 mob_filter_left p-0">
                        <ul class="mob_filter_left_ul p-0">
                            <li class="mob_filter_left_li"><button class="btn"
                                    onclick="showDetails('cate')">Category</button></li>
                            <li class="mob_filter_left_li"><button class="btn"
                                    onclick="showDetails('pri')">Price</button></li>
                            <li class="mob_filter_left_li"><button class="btn"
                                    onclick="showDetails('size')">Size</button></li>
                            <li class="mob_filter_left_li"><button class="btn"
                                    onclick="showDetails('color')">Color</button></li>
                        </ul>
                    </div>
                    <div class="col-7 mob_filter_right">
                        <div id="mobile_fitercategories" class="mobile_fitercategories mobile_filter_conditions">
                            <ul class="mob_filter_right_ul p-0">
                                <li><a href="#" class="mob_filter_right_ul mob_filter_right_ul_active">
                                        <img src="<?= base_url() ?>assets/images/icons/correct.svg" alt="correct_tick"
                                            class="mob_fitertick_img">Women</a></li>
                                <li><a href="#" class="mob_filter_right_ul">
                                        <img src="<?= base_url() ?>assets/images/icons/correct_uncolored.svg"
                                            alt="correct_tick" class="mob_fitertick_img">Girls</a></li>
                                <li><a href="#" class="mob_filter_right_ul">
                                        <img src="<?= base_url() ?>assets/images/icons/correct_uncolored.svg"
                                            alt="correct_tick" class="mob_fitertick_img">Collections</a></li>
                                <li><a href="#" class="mob_filter_right_ul">
                                        <img src="<?= base_url() ?>assets/images/icons/correct_uncolored.svg"
                                            alt="correct_tick" class="mob_fitertick_img">Hnadbags</a></li>
                                <li><a href="#" class="mob_filter_right_ul">
                                        <img src="<?= base_url() ?>assets/images/icons/correct_uncolored.svg"
                                            alt="correct_tick" class="mob_fitertick_img">Sale</a></li>
                            </ul>
                        </div>
                        <div id="mobile_fiterprize" class="mobile_fiterprize mobile_filter_conditions">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-control-borderless mt-4">
                                    <div class="position-relative">
                                        <div class="noui-wrapper">
                                            <div class="d-flex justify-content-between mobile_prize_inputbox">
                                                <input type="text" class="text-body input-with-range-min">
                                                <input type="text" class="text-body input-with-range-max">
                                            </div>
                                            <div class="noui-slider-range mt-2" data-range-min='500'
                                                data-range-max='2000' data-range-selected-min='700'
                                                data-range-selected-max='1500'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="mobile_fitercolor" class="mobile_fitercolor mobile_filter_conditions">
                            <div class="row me-2 filter_color_div_div">
                                <?php for ($i = 0; $i < 10; $i++) { ?>
                                    <div class="col-2 filter_color_div">
                                        <a href="#" class="filter_color_<?php echo ($i % 2 == 0) ? 'even' : 'odd' ?>"></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div id="mobile_fitersize" class="mobile_fitersize mobile_filter_conditions">
                            <?php for ($i = 6; $i < 14; $i++) { ?>
                                <ul class="mob_filter_right_ul p-0">
                                    <li><a href="#" class="mob_filter_right_ul mob_filter_right_ul_active">
                                            <img src="<?= base_url() ?>assets/images/icons/correct.svg" alt="correct_tick"
                                                class="mob_fitertick_img"><?=$i?></a></li>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-footer d-flex">
                <button type="button" class="btn mob_close_btn" data-bs-dismiss="offcanvas"
                    aria-label="Close">Close</button>
                <hr class="vertical_line">
                <button class="btn btn-outline-primary fw-bolder">Apply Filters</button>
            </div>
        </div>

    </main>
    <!-- Footer Area -->
    <?php include("includes/footer.php") ?>
    <!-- Footer Area End -->
    <?php include("includes/script.php") ?>
    <script>
        // START: 19 noUislider
        let e = {
            init: function () {
                e.rangeSlider();
            },
            rangeSlider: function () {
                var rangeSliders = document.querySelectorAll('.noui-slider-range');
                rangeSliders.forEach(slider => {
                    var nouiMin = parseInt(slider.getAttribute('data-range-min'));
                    var nouiMax = parseInt(slider.getAttribute('data-range-max'));
                    var nouiSelectedMin = parseInt(slider.getAttribute('data-range-selected-min'));
                    var nouiSelectedMax = parseInt(slider.getAttribute('data-range-selected-max'));

                    var rangeText = slider.previousElementSibling;
                    var imin = rangeText.firstElementChild;
                    var imax = rangeText.lastElementChild;
                    var inputs = [imin, imax];

                    noUiSlider.create(slider, {
                        start: [nouiSelectedMin, nouiSelectedMax],
                        connect: true,
                        step: 1,
                        range: {
                            min: [nouiMin],
                            max: [nouiMax]
                        }
                    });

                    slider.noUiSlider.on("update", function (values, handle) {
                        inputs[handle].value = values[handle];
                    });
                });
            }
        };

        e.init();
    </script>
    <!-- Mobile Category script -->
    <script>
        const showDetails = (para) => {
            let filter_all_divs = document.querySelectorAll('.mob_filter_left_li')
            let mobile_filter_conditions = document.querySelectorAll('.mobile_filter_conditions')

            for (i = 0; i < filter_all_divs.length; i++) {
                filter_all_divs[i].classList.remove("mob_filter_left_li_active")
            }
            for (i = 0; i < mobile_filter_conditions.length; i++) {
                mobile_filter_conditions[i].style.display = "none"
            }

            if (para == "cate") {
                document.getElementById("mobile_fitercategories").style.display = "block";
                filter_all_divs[0].classList.add('mob_filter_left_li_active');
            }
            else if (para == "pri") {
                document.getElementById("mobile_fiterprize").style.display = "block";
                filter_all_divs[1].classList.add('mob_filter_left_li_active')
            }
            else if (para == "color") {
                document.getElementById("mobile_fitercolor").style.display = "block";
                filter_all_divs[3].classList.add('mob_filter_left_li_active')
            }
            else if (para == "size") {
                document.getElementById("mobile_fitersize").style.display = "block";
                filter_all_divs[3].classList.add('mob_filter_left_li_active')
            }
        }
    </script>
</body>

</html>