<?php
include('session.php');
include('common_functions.php');

$code = $_POST['code'];
$page  = $_POST['page'];
$main_attribute_id = $_POST['main_attribute_id'];

$code = stripslashes($code);
$page =  stripslashes($page);

$error = '';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token'] && isset($main_attribute_id)) {

    try {
        if ($_POST['perpage']) {
            $limit = $_POST['perpage'];
        } else {
            $limit = 10;
        }

        $start = ($page - 1) * $limit;
        $totalrow = 0;

        $status = 0;
        $msg = "Unable to Get Data";
        $return = array();

        $stmt1 = $conn->prepare("SELECT attribute FROM product_attributes_set WHERE id ='" . $main_attribute_id . "'");
        $stmt1->execute();
        $data = $stmt1->bind_result($col11);
        $main_attr = '';
        while ($stmt1->fetch()) {
            $main_attr = $col11;
        }


        $stmt = $conn->prepare("SELECT id,attribute_value FROM product_attributes_conf WHERE attribute_id ='" . $main_attribute_id . "' ORDER BY attribute_value ASC LIMIT  " . $start . ", " . $limit . "");
        //$stmt->bind_param( s,  $inactive );
        $stmt->execute();
        $data = $stmt->bind_result($col1, $col2);
        $return = array();
        $i = 0;
        while ($stmt->fetch()) {

            $return[$i] =
                array(
                    'id' => $col1,
                    'main_attr' => $main_attr,
                    'attribute_value' => $col2
                );
            $i = $i + 1;
            $status = 1;
            $msg = "Details here";
            // echo " array created".json_encode($return);
        }

        $information = array(
            'status' => $status,
            'msg' =>   $msg,
            'data' => $return
        );


        $stmt12 = $conn->prepare("SELECT count(id) FROM product_attributes_conf WHERE attribute_id ='" . $main_attribute_id . "' ");

        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result($col55);

        while ($stmt12->fetch()) {
            $totalrow = $col55;
        }

        $page_html =  pagination('getConfAttributeVal', $page, $limit, $totalrow);

        echo json_encode(array("status" => 1, "page_html" => $page_html, "data" => $return, "totalrowvalue" => $totalrow));
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
