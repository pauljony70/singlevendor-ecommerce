<?php
include('session.php');
$code = $_POST['code'];
$catid = $_POST['catid'];
$catname = $_POST['catname'];
$catimg = $_POST['catimg'];

$catid =    stripslashes($catid);
$catname =   stripslashes($catname);
$catimg =   stripslashes($catimg);

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else if (isset($catid) && isset($catname) && isset($catid) && isset($catname)) {

    include('../app/db_connection.php');
    global $conn;
    try {

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        date_default_timezone_set("Asia/Kolkata");
        $datetime = date('Y-m-d H:i:s');

        $rowProdJsonArray = "";
        //  echo "inside ".$catimg;
        $stmt11 = $conn->prepare("UPDATE category SET cat_name =?, cat_img=? WHERE cat_id=?");
        $stmt11->bind_param("ssi", $catname, $catimg,  $catid);
        $stmt11->execute();
        $stmt11->store_result();

        //  echo " insert done ";
        $rows = $stmt11->affected_rows;
        if ($rows > 0) {
            echo " Category has update Successfully ";
        } else {
            echo "Failed to Update Category. Please try again";
            if (!empty($catimg)) {
                $mediaDirectory = '../media/';
                $imagePath = $mediaDirectory . $catimg;

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
    } //catch exception
    catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}
