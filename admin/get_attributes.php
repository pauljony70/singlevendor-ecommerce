<?php
include('session.php');

$code = $_POST['code'];
$code =   stripslashes($code);

$error = '';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else if ($code == $_SESSION['_token']) {
    try {

        $status = 0;
        $msg = "Unable to Get Data";
        $return = array();
        $selected_attr = '';
        if (!empty($_POST['selected_attr'])) {

            $selected_attr = " AND id NOT IN(" . rtrim($_POST['selected_attr'], ',') . ") ";
        }

        $stmt = $conn->prepare("SELECT id, attribute FROM `product_attributes_set` " . $selected_attr . "  order by attribute asc ");

        $stmt->execute();
        $data = $stmt->bind_result($col1, $col2);
        $return = array();
        $i = 0;
        $attr_array = array();
        $attr_array_final = array();
        $msg = "Details here";
        while ($stmt->fetch()) {
            $attr_array['id'] = $col1;
            $attr_array['attribute'] = $col2;
            $attr_array_final[] = $attr_array;
        }

        foreach ($attr_array_final as $attr_val) {
            $stmt1 = $conn->prepare("SELECT attribute_value FROM `product_attributes_conf` WHERE attribute_id ='" . $attr_val['id'] . "' order by attribute_value asc ");

            $stmt1->execute();
            $data = $stmt1->bind_result($col12);

            $arr = array();
            while ($stmt1->fetch()) {
                $arr[] = $col12;
            }

            if (count($arr) > 0) {
                $return[$i] =
                    array(
                        'id' => $attr_val['id'],
                        'attribute' => $attr_val['attribute'],
                        'attribute_value' => implode(',', $arr)
                    );
                $i = $i + 1;
                $status = 1;
            }
        }
        if ($status == 0) {
            $msg = "No attribute avaliable.";
        }
        $information = array(
            'status' => $status,
            'msg' =>   $msg,
            'data' => $return
        );
        echo  json_encode($information);
        //return json_encode($return);    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
