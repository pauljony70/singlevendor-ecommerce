<?php
include('../app/db_connection.php');
session_start();
$_SESSION = array();
// Starting Session
$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) {

    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "email or Password is invalid";
    } else {


        // Define $username and $password
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = stripslashes($email);
        $password = stripslashes($password);
        $notExist  = true;
        //   echo "email is ".$notExist;
        $stmt = $conn->prepare("SELECT email, seller_id, fname, lname, roll FROM seller_login WHERE email=? AND password=?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($col1, $col2, $col3, $col4, $col5);



        while ($stmt->fetch()) {
            // echo " yes";
            $notExist         = false;
            $_SESSION['admin'] = $email;
            $_SESSION['seller_id'] = $col2;
            $_SESSION['seller_name'] = $col3 . " " . $col4;
            $_SESSION['roll'] = $col5;
        }
        //echo " not wxsist is ".$notExist;
        if ($notExist != 1) {
            if ($_SESSION['roll']  == "admin") {
                header("location: dashboard.php"); // Redirecting To Other Page

            } else {
                header("location: orders.php"); // Redirecting To Order page

            }
            //  $error = " sucess valid";
            // echo " go to dashborad";
        } else {
            // $password = base64_decode ( $password );
            $error = "Email or Password is invalid";
            // echo $error;
        }
        // mysql_close($conn); // Closing Connection
    }
}
?>
<!--
Author: kamal bunkar
Author URL: https://www.blueappsoftware.com
-->
<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="">
    <!-- font-awesome icons CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- //font-awesome icons CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets/login/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>assets/login/main.css">
    <meta name="robots" content="noindex, follow">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= BASEURL . 'assets/images/favicon_io/favicon.ico' ?>">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt="" style="will-change: transform; transform: perspective(300px) rotateX(-1.61deg) rotateY(-4.28deg) scale3d(1.1, 1.1, 1.1);">
                    <img src="<?php echo BASEURL; ?>assets/login/img-01.png" alt="IMG">
                </div>
                <form class="login100-form validate-form" method="post" id="login_form">
                    <span class="login100-form-title">
                        Admin Login
                    </span>
                    <span style="color:red;"><?php echo $error; ?></span>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" id="user_name" name="email" placeholder="Enter Your Email" required="">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" id="password" placeholder="Password" required="">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input200">

                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" id="login_btn" name="submit">
                            Login
                        </button>
                    </div>
                    <br><a href="forget_password.php">Forgot Password</a>
                </form>
            </div>
        </div>
    </div>



    <!-- js-->
    <script src="<?php echo BASEURL; ?>assets/js/jquery-1.11.1.min.js"></script>

    <script src="<?php echo BASEURL; ?>assets/login/popper.js"></script>
    <script src="<?php echo BASEURL; ?>assets/js/bootstrap.js"> </script>

    <script src="<?php echo BASEURL; ?>assets/login/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>



</body>

</html>