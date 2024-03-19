<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <?php include("includes/head.php") ?>
    <title>Address Book - <?= get_store_settings('store_name') ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashboard.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/address.css') ?>">
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

    <!-- main content -->
    <main class="my-5">
        <div class="container">
            <section class="row">
                <div class="col-lg-3 d-none d-lg-block">
                    <!-- Sidebar -->
                    <?php include('includes/usersidebardesktop.php') ?>
                </div>
                <div class="col-12 col-lg-9">
                    <?php include('includes/sidebarmobile.php') ?>
                    <h1 class="font-family-lora mb-4 mb-md-5">Add New Address</h1>

                    <form action="#" method="post" id="addressForm" class="mb-5">
                        <div class="row mb-4">
                            <input type="hidden" name="address_id" id="address_id" value="<?= $address['address_id'] ?>">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control ps-1" id="fullname" name="fullname" placeholder="John Doe" value="<?= $address['fullname'] ?>">
                                    <label class="ps-0" for="fullname">Full name</label>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control ps-1" id="email" name="email" placeholder="john@hotmail.com" value="<?= $address['email'] ?>">
                                    <label class="ps-0" for="email">Email</label>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control ps-1" id="phone" name="phone" placeholder="0123456789" value="<?= $address['phone'] ?>" oninput="enforceMaxLength(this)" maxlength="10">
                                    <label class="ps-0" for="phone">Phone</label>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control ps-1" id="address" name="address" placeholder="Address" value="<?= $address['address'] ?>">
                                    <label class="ps-0" for="address">Address</label>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control ps-1" id="pincode" name="pincode" placeholder="123456" value="<?= $address['pincode'] ?>" oninput="enforceMaxLength(this)" maxlength="6">
                                    <label class="ps-0" for="pincode">Pincode</label>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select ps-1" id="state" name="state" aria-label="Select state">
                                        <option value="">Select state</option>
                                        <?php foreach ($states as $state) : ?>
                                            <option value="<?= $state['stateid'] ?>" <?= $address['state_id'] == $state['stateid'] ? 'selected' : '' ?>><?= $state['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label class="ps-0" for="state">Select state</label>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select ps-1" id="city" name="city" aria-label="Select city">
                                        <option value="">Select city</option>
                                        <?php foreach ($cities as $city) : ?>
                                            <option value="<?= $city['city_id'] ?>" <?= $address['city_id'] == $city['city_id'] ? 'selected' : '' ?>><?= $city['city_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label class="ps-0" for="city">Select city</label>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="defaultaddress" name="defaultaddress" <?= $address['address_id'] == $address['defaultaddress'] ? 'checked' : '' ?>>
                                    <label class="form-check-label ms-2" for="defaultaddress">
                                        Default Shipping address
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary fe-semibold w-100">Save</button>
                    </form>
                </div>
            </section>
        </div>
    </main>


    <!-- Footer Area -->
    <?php include("includes/footer.php") ?>
    <!-- Footer Area End -->

    <?php include("includes/script.php") ?>

    <script>
        document.getElementById('state').addEventListener('change', function() {
            getCitydata(this.value);
        })

        document.getElementById('addressForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            var submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            try {
                await validateAddressForm();
                // Get form data
                var formData = new FormData(this);

                // Get selected state text and append to FormData
                var stateDropdown = document.getElementById('state');
                var selectedStateText = stateDropdown.options[stateDropdown.selectedIndex].text;
                formData.append('state_value', selectedStateText);

                // Get selected city text and append to FormData
                var cityDropdown = document.getElementById('city');
                var selectedCityText = cityDropdown.options[cityDropdown.selectedIndex].text;
                formData.append('city_value', selectedCityText);

                // Make an AJAX call using jQuery
                $.ajax({
                    url: site_url + 'edit-address/' + $('#address_id').val(),
                    type: 'POST', // Adjust the type accordingly
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                text: response.msg,
                                type: "success",
                                showCancelButton: true,
                                showCloseButton: true,
                                confirmButtonColor: theme_colour,
                            }).then(function(res) {
                                window.location.href = site_url + 'address';
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
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    },
                    complete: function() {
                        submitButton.disabled = false;
                    }
                });


            } catch (error) {
                console.error('Error:', error);
                submitButton.disabled = false;
            }
        });
    </script>

</body>

</html>