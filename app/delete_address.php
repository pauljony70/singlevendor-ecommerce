<?php
include('db_connection.php');
$language   = htmlentities($_POST['language']);
$securecode = htmlentities($_POST['securecode']);
$address_id = htmlentities($_POST['address_id']);
$user_id    = htmlentities($_POST['user_id']);
// remove back slash from the variable if any...
$langauge   = stripslashes($language);
$securecode = stripslashes($securecode); //   "1234567890";//
$address_id = stripslashes($address_id); //  "1";//
$user_id    = stripslashes($user_id); // "12";//
//echo "  outside ";
if (isset($langauge) && !empty($langauge) && isset($securecode) && !empty($securecode) && isset($address_id) && !empty($address_id) && !empty($user_id)) {
    global $conn;
    if ($conn->connect_error) {
        die(" connecction has failed " . $conn->connect_error);
    }
    // get current date
    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d");
    if ($langauge === "default") {
        $msg = "fail to delete address.";
    } else {
        $msg = "पता हटाने में विफल।";
    }
    $information      = $msg;
    $detailsarray     = array();
    //echo "inside if";
    $status           = 0;
    $defaultaddress   = 0;
    // check userID exist or not
    $notExist         = true;
    $rowProdJsonArray = array();
    $stmt             = $conn->prepare("SELECT addressarray, defaultaddress FROM address WHERE user_id=?");
    $stmt->bind_param(i, $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($col1, $col2);
    while ($stmt->fetch()) {
        $notExist         = false;
        $rowProdJsonArray = $col1;
        $defaultaddress   = $col2;
    }
    if ($notExist) {
        /// no  userid doens't exist on table
    } else {
        /// yes userid exist
        //    echo " hh";         
        $oldarray       = json_decode($rowProdJsonArray, true);
        $addressIDexist = false;
        $i              = 0;
        foreach ($oldarray as $arraykey) {
            // echo "prod id ".$arraykey['address_id']."  ".$address_id;
            if ($address_id == $arraykey['address_id']) {
                $addressIDexist = true;
                unset($oldarray[$i]);
                //     echo " prodId exist in table ";
            }
            $i++;
        }
        if ($addressIDexist) {
            //echo " don't update table";
            $oldarray     = array_values($oldarray);
            $tempnewarray = json_encode($oldarray);
            $stmt2        = $conn->prepare("UPDATE address SET addressarray=? WHERE user_id=?");
            $stmt2->bind_param(si, $tempnewarray, $user_id);
            $stmt2->execute();
            $rows = $stmt2->affected_rows;
            //echo " row ".$rows;
            if ($rows > 0) {
                //    echo " row affected is ";
                $status = 1;
                if ($langauge === "default") {
                    $msg = "Address Deleted Successfully";
                } else {
                    $msg = "पता सफलतापूर्वक हटा दिया गया";
                }
            } else {
                $status = 0;
                if ($langauge === "default") {
                    $msg = "fail to delete address.";
                } else {
                    $msg = "पता हटाने में विफल।";
                }
            }
        }
    }
    $post_data = array(
        'status' => $status,
        'msg' => $msg,
        'Information' => $msg
    );
    $post_data = json_encode($post_data);
    echo $post_data;
    mysqli_close($conn);
}
?> 