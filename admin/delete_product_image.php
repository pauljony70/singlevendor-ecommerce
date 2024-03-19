<?php

include('session.php');
include('common_functions.php');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
} else {
	$delete_id = $_POST['delete_id'];
	$prod_id = $_POST['prod_id'];

	$delete_id =   stripslashes($delete_id);
	$prod_id =   stripslashes($prod_id);

	// echo " delete array ".$delete_id."--".$prod_id ;

	function deleteimage($img_array, $prod_id, $conns)
	{

		$stmt11 = $conns->prepare("UPDATE productdetails SET prod_img_url =? WHERE prod_id=?");
		$stmt11->bind_param("si", $img_array, $prod_id);
		$stmt11->execute();
		// echo " delete id ".$prod_id;
		$rows = $stmt11->affected_rows;
		if ($rows > 0) {
			echo "Image is Deleted Successfully";
		} else {
			echo "Failed to Delete Image";
		}
	}

	if (isset($delete_id) && isset($prod_id) && $_SESSION['roll']  == "admin") {

		global $conn;

		if ($conn->connect_error) {
			die(" connecction has failed " . $conn->connect_error);
		}

		// echo " id ".$prod_id." delete ".$delete_id;
		$rowProdJsonArray = array();
		$notExist = true;
		$prodIDexist = false;

		$stmt = $conn->prepare("SELECT prod_img_url FROM productdetails WHERE prod_id=?");
		$stmt->bind_param("i", $prod_id);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($col1);

		while ($stmt->fetch()) {
			$notExist = false;
			$rowProdJsonArray = $col1;
		}

		if ($notExist) {
			echo "Fail to Delete.";
		} else {

			$oldarray = json_decode($rowProdJsonArray, true);
			$i = 0;
			foreach ($oldarray as $arraykey) {

				if ($delete_id == $i) {
					$prodIDexist = true;

					if (!empty($oldarray[$i])) {
						unlinkFile($oldarray[$i]);
					}
					
					unset($oldarray[$i]);
				}
				$i++;
			}
			if ($prodIDexist) {

				$oldarray =	array_values($oldarray);
				$tempnewarray = json_encode($oldarray);
				deleteimage($tempnewarray, $prod_id, $conn);
			} else {
				echo "Failed to Delete.";
			}
		}
		die;
	} else {
		echo "Failed to Delete..";
	}
}
