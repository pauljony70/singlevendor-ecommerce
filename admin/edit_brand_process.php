<?php
include('session.php');
$code = $_POST['code'];
$brandid = $_POST['catid'];
$brandname = $_POST['catname'];
$brandimg = $_POST['catimg'];

$brandid =    stripslashes($brandid);
$brandname =   stripslashes($brandname);
$brandimg =   stripslashes($brandimg);

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else if (isset($brandid) && isset($brandname) && isset($brandid) && isset($brandname)) {

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
        $stmt11 = $conn->prepare("UPDATE brand SET brand_name =?, brand_img=? WHERE brand_id=?");
        $stmt11->bind_param("ssi", $brandname, $brandimg,  $brandid);
        $stmt11->execute();
        $stmt11->store_result();

        //  echo " insert done ";
        $rows = $stmt11->affected_rows;
        if ($rows > 0) {
            echo "Brand has update Successfully ";
        } else {
            echo "Failed to Update Brand. Please try again";
            if (!empty($brandimg)) {
                $mediaDirectory = '../media/';
                $imagePath = $mediaDirectory . $brandimg;

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
