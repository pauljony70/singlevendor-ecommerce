<?php
include('session.php');
$code = $_POST['code'];
$prod_name = $_POST['prod_name'];
$catid = $_POST['catid'];
$error = '';  // Variable To Store Error Message

$code =   stripslashes($code);
$search =   stripslashes($prod_name);
$catid =  stripslashes($catid);

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else
if ($code == "1") {

    $seller_id =  $_SESSION['seller_id'];
    //Calculating start for every given page number
    //    $limit = 30; 
    // $start = ($page - 1) * $limit; 

    include('../app/db_connection.php');
    global $conn;
    try {

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $Exist = false;
        $status = 0;
        $information = array();
        //  echo  "old array is ".$oldarray;
        $return = array();
        $i      = 0;
        $status = "active";
        $search = "%" . $search . "%";
        if ($catid !== "blank") {
            // echo " cat not balnl ";
            $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_price, pt.prod_img_url, pr.prod_stock, ct.cat_name, pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id AND pt.cat_id=? AND ( pt.prod_name LIKE ? OR pt.hsn_code LIKE ?) ORDER BY pt.prod_id DESC");
            $stmt->bind_param("iss", $catid, $search, $search);
        } else {
            $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_price, pt.prod_img_url, pr.prod_stock, ct.cat_name, pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id AND ( pt.prod_name LIKE ? OR pt.hsn_code LIKE ?) ORDER BY pt.prod_id DESC");
            $stmt->bind_param("ss", $search, $search);
        }
        $stmt->execute();
        $data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
        //  echo " get col data ";

        while ($stmt->fetch()) {
            //echo " prod data is " .$col1;  
            $Exist = true;
            $imgarray = json_decode($col5, true);
            $imageurl = "";
            $count    = 1;

            $imageurl = MEDIA_URL . $imgarray[0];


            $return[$i] = array(
                'id' => $col1,
                'name' => $col2,
                'desc' => $col3,
                'price' => $col4,
                'img' => $imageurl,
                'stock' => $col6,
                'cat' => $col7,
                'active' => $col8,
                'hsncode' => $col9
            );
            $i          = $i + 1;
            //echo " array created".json_encode($return);
        }
        if ($Exist) {

            $status = 1;
            $information = array(
                'status' => $status,
                'totalrow' =>   $i,
                'pageno' => 1,
                'details' => $return
            );
        } else {

            $status = 0;
            $information = array(
                'status' => $status,
                'totalrow' => 0,
                'pageno' => 1,
                'details' => $return
            );
        }

        echo  json_encode($information);


        //return json_encode($return);    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
