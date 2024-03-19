<?php
include('session.php');
include("header.php");
?>
<link href="<?php echo BASEURL; ?>admin/assets/custom-style.css" rel="stylesheet">

<style>
    .product-image {
        width: 50px;
        height: 70px;
        margin-right: 10px;
        object-fit: contain;
    }

    .select2-results__option[aria-selected=true] {
        display: none;
    }
</style>

<div class="modal fade" id="newNavigationModal" tabindex="-1" aria-labelledby="newNavigationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newNavigationModalLabel">Add New Navigation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm" class="addForm" action="custom-navigations-process.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="code" value="<?= $_SESSION['_token'] ?>">
                    <input type="hidden" name="type" value="addNewNavigation">
                    <label for="navigationName">Navigation Name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="navigationName" name="navigationName" data-parsley-required-message="Navigation is required." required>
                    </div>
                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Custom Navigations</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <button type="button" class="btn btn-primary waves-effect waves-light mb-4" data-toggle="modal" data-target="#newNavigationModal">
                                    Add New Navigation
                                </button>
                                <?php
                                $productDetailsData = [];

                                // Select all rows from productdetails table
                                $selectProductDetailsQuery = "SELECT * FROM productdetails";
                                $resultProductDetails = $conn->query($selectProductDetailsQuery);

                                if ($resultProductDetails->num_rows > 0) {
                                    $productDetailsData = $resultProductDetails->fetch_all(MYSQLI_ASSOC);
                                }
                                ?>
                                <?php
                                $navigations = [];

                                // Select all rows from custom_navigations table
                                $selectNavigationsQuery = "SELECT * FROM custom_navigations";
                                $resultNavigations = $conn->query($selectNavigationsQuery);

                                if ($resultNavigations->num_rows > 0) {
                                    $rowsNavigations = $resultNavigations->fetch_all(MYSQLI_ASSOC);

                                    foreach ($rowsNavigations as $rowNavigation) {
                                        // Display custom_navigations.name
                                        $navigationId = $rowNavigation["id"];
                                        $navigationName = $rowNavigation["name"];

                                        // Select rows from custom_navigation_products for the associated navigation_id
                                        $selectProductsQuery = "SELECT * FROM custom_navigation_products WHERE navigation_id = $navigationId";
                                        $resultProducts = $conn->query($selectProductsQuery);

                                        // Check if there are exactly 4 rows for the associated navigation_id
                                        if ($resultProducts->num_rows == 4) {
                                            $navigations[] = [
                                                'id' => $navigationId,
                                                'name' => $navigationName,
                                                'custom_navigation_products' => $resultProducts->fetch_all(MYSQLI_ASSOC),
                                            ];
                                        }
                                    }
                                }
                                ?>
                                <?php
                                $count = 0;
                                foreach ($navigations as $navigation) : ?>
                                    <div class="d-flex justify-content-between mb-3">
                                        <input type="hidden" name="navigation_id" id="navigation_id" value="<?= $navigation['id'] ?>">
                                        <h3><?= $navigation['name'] ?></h3>
                                        <button class="btn btn-danger waves-effect waves-light delete-navigation" type="button">Delete Navigation</button>
                                    </div>
                                    <div class="row">
                                        <?php
                                        foreach ($navigation['custom_navigation_products'] as $key => $custom_navigation_product) :
                                            $products = [];
                                        ?>
                                            <div class="col-md-6 mb-2">
                                                <form id="addForm" class="addForm" action="custom-navigations-process.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="code" value="<?= $_SESSION['_token'] ?>">
                                                    <input type="hidden" name="type" value="editBanner">
                                                    <input type="hidden" name="custom_navigation_product_id" value="<?= $custom_navigation_product['id'] ?>">
                                                    <div class="form-group">
                                                        <input type="file" name="banner" id="banner" class="dropify" <?= $custom_navigation_product['banner'] ? 'data-default-file="' . MEDIA_URL . $custom_navigation_product['banner'] . '"' : '' ?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Search for products</label>
                                                        <select id="product<?= $count ?>" class="product" name="products[]" data-parsley-errors-container="#product-error-<?= $count ?>"></select>
                                                        <div id="product-error-<?= $count ?>" role="alert"></div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mb-4">Save</button>
                                                </form>
                                                <div class="row">
                                                    <?php
                                                    if (!empty(json_decode($custom_navigation_product['products'], true))) {
                                                        // Generate a comma-separated string of product IDs
                                                        $productIds = implode(',', json_decode($custom_navigation_product['products'], true));

                                                        // Construct the SQL query to select product details based on product IDs
                                                        $selectProductsQuery = "SELECT prod_id, prod_name, prod_img_url FROM productdetails WHERE prod_id IN ($productIds)";

                                                        // Execute the query
                                                        $resultProducts = $conn->query($selectProductsQuery);

                                                        if ($resultProducts->num_rows > 0) {
                                                            // Fetch and print the product details
                                                            $products = $resultProducts->fetch_all(MYSQLI_ASSOC);
                                                        }
                                                    }
                                                    ?>
                                                    <?php foreach ($products as $product) : ?>
                                                        <div class="col-4 col-md-3 position-relative">
                                                            <input type="hidden" name="custom_navigation_product_id" id="custom_navigation_product_id" value="<?= $custom_navigation_product['id'] ?>">
                                                            <input type="hidden" name="product_id" id="product_id" value="<?= $product['prod_id'] ?>">
                                                            <img src="<?= MEDIA_URL . json_decode($product['prod_img_url'], true)[0] ?>" alt="<?= $product['prod_name'] ?>" class="img-fluid">
                                                            <p class="font-weight-bold"><?= $product['prod_name'] ?></p>
                                                            <button type="button" class="btn btn-danger position-absolute delete-product" style="top: 0; right: 12px;"><i class="fa-regular fa-trash-can"></i></button>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                        <?php
                                            $count++;
                                        endforeach ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include('footernew.php'); ?>

<script>
    $('.addForm').parsley();
    $('.dropify').dropify();

    $(".addForm").each(function() {
        // Bind the submit event to each form
        $(this).submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Display the loader
            $.busyLoadFull("show");

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                processData: false, // Prevent jQuery from processing data
                contentType: false, // Prevent jQuery from setting content type
                success: function(res) {
                    // Hide the loader on success
                    $.busyLoadFull("hide");

                    // Handle the response as needed
                    successmsg1(res, 'custom-navigations.php');

                },
                error: function(xhr, status, error) {
                    // Hide the loader on error
                    $.busyLoadFull("hide");

                    // Handle the error as needed
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $(".delete-product").each(function() {
        // Bind the submit event to each form
        $(this).click(function(event) {
            var deleteBtn = $(this);
            // Display the loader
            $.busyLoadFull("show");

            var formData = new FormData();

            formData.append('code', $("#code_ajax").val());
            formData.append('type', 'deleteProduct');
            formData.append('custom_navigation_product_id', deleteBtn.parent().find('#custom_navigation_product_id').val());
            formData.append('product_id', deleteBtn.parent().find('#product_id').val());

            $.ajax({
                type: "POST",
                url: 'custom-navigations-process.php',
                data: formData,
                processData: false, // Prevent jQuery from processing data
                contentType: false, // Prevent jQuery from setting content type
                success: function(res) {
                    // Hide the loader on success
                    $.busyLoadFull("hide");

                    // Handle the response as needed
                    successmsg1(res, 'custom-navigations.php');

                },
                error: function(xhr, status, error) {
                    // Hide the loader on error
                    $.busyLoadFull("hide");

                    // Handle the error as needed
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $(".delete-navigation").each(function() {
        // Bind the submit event to each form
        $(this).click(function(event) {
            var deleteBtn = $(this);
            // Display the loader
            $.busyLoadFull("show");

            var formData = new FormData();

            formData.append('code', $("#code_ajax").val());
            formData.append('type', 'deleteNavigation');
            formData.append('navigation_id', deleteBtn.parent().find('#navigation_id').val());

            $.ajax({
                type: "POST",
                url: 'custom-navigations-process.php',
                data: formData,
                processData: false, // Prevent jQuery from processing data
                contentType: false, // Prevent jQuery from setting content type
                success: function(res) {
                    // Hide the loader on success
                    $.busyLoadFull("hide");

                    // Handle the response as needed
                    successmsg1(res, 'custom-navigations.php');

                },
                error: function(xhr, status, error) {
                    // Hide the loader on error
                    $.busyLoadFull("hide");

                    // Handle the error as needed
                    console.error(xhr.responseText);
                }
            });
        });
    });

    // Iterate through all elements with the class 'product'
    $('.product').select2({
        placeholder: 'Search for products...',
        minimumInputLength: 1,
        closeOnSelect: false,
        multiple: true,
        escapeMarkup: function(m) {
            return m;
        },
        allowClear: false,
        ajax: {
            method: 'POST',
            url: 'get_product_search_filter.php',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    code: '1',
                    prod_name: params.term,
                    catid: 'blank',
                    page: 0,
                    rowno: 0,
                    sortcat: false,
                }
            },
            processResults: function(data, params) {
                if (data.details.length > 0) {
                    return {
                        results: data.details.map(function(product) {
                            return {
                                id: product.id,
                                text: product.name,
                                Poster: product.img
                            };
                        })
                    };
                } else {
                    return {
                        results: []
                    };
                }
            },
            cache: true
        },
        templateResult: formatProduct,
        templateSelection: function(selectedProduct) {
            return selectedProduct.text;
        },
    });

    function formatProduct(product) {
        if (!product.id) {
            return product.text;
        }
        const productId = product.id;
        const productTitle = product.text;
        const $product = $(
            `<div class="d-flex align-items-center"><img src="${product.Poster}" class="product-image" /><div class="product-title">${productTitle}</div></div>`
        );
        return $product;
    }
</script>