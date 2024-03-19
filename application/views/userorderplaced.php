<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Order Placed - Rehmandhaage</title>
    <?php include("includes/head.php") ?>
</head>

<body>
    <!-- Preloder -->
    <?php include("includes/preloader.php") ?>
    <!-- Preloder End -->

    <!-- back to to button start-->
    <a href="#" id="scroll-top" class="back-to-top-btn"><i class='bx bx-up-arrow-alt'></i></a>
    <!-- back to to button end-->

    <!-- Header area -->
    <?php include("includes/navbar.php") ?>
    <!-- Header area end -->

    <main class="order_placed my-5 w-50" style="margin: auto;">
        <div class="text-center">
            <h3>Thank you for your Order</h3>
            <p class="order_placed_msg">You will receive email on <br>yuvraj@gmail.com</p>
            <div class="order_placed_details">
                <p><strong>Order Number: </strong>475832998345</p>
                <p><strong>Order Date: </strong>24 Dec 2023</p>
            </div>
            <div class="order_placed_backgeoung">
                <div class="row" style="margin: auto; width: 80%;">
                    <div class="col-4">
                        <img src="<?= base_url() ?>assets/images/icons/bag.svg" alt="bag" class="order_placed_icons">
                    </div>
                    <div class="col-8 order_placed_backgeoung_right">
                        <h5>Track and manage your orders easily</h5>
                        <a href="<?= base_url() ?>userorder" class="btn-outline-primary btn">View orders</a>
                    </div>
                </div>
            </div>
            <div class="order_placed_backgeoung_second">
                <div class="" style="margin: auto; width: 80%;">
                    <h5>Add one more fabulous stles in your collection</h5>
                    <button class="btn btn-outline-primary">Continue Shopping</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Area -->
    <?php include("includes/footer.php") ?>
    <!-- Footer Area End -->

    <?php include("includes/script.php") ?>
    <script src="<?php echo base_url . 'assets/js/register.js'; ?>"></script>

</body>

</html>