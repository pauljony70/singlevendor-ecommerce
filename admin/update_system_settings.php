<?php
include('session.php');


$code = $_POST['code'];
$type = $_POST['type'];


// echo "seler is ".$seller_id;
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else if ($code == "123@384#$$65$" && $type == 'default_setting') {

	unset($_POST['code']);
	unset($_POST['type']);
	foreach ($_POST as $key => $value) {

		$query = $conn->query("SELECT * FROM `settings` WHERE type ='" . $key . "'");
		if ($query->num_rows > 0) {
			if ($key == 'system_currency') {
				$exp = explode('-', $value);
				
				$query = $conn->query("UPDATE  `settings` SET description = '" . $exp[0] . "' WHERE type ='system_currency'");
				$query = $conn->query("UPDATE  `settings` SET description = '" . $exp[1] . "' WHERE type ='system_currency_symbol'");
			} else {
				$query = $conn->query("UPDATE  `settings` SET description = '" . $value . "' WHERE type ='" . $key . "'");
				/* if (!$query) {
					// Query execution failed, capture and handle the error
					$error = mysqli_error($conn);
					echo "Error: " . $error;
				} else {
					// Query executed successfully
					echo "Update successful!";
				} */
			}
		} else {
			if ($key == 'system_currency') {
				$exp = explode('-', $value);

				$query = $conn->query("INSERT INTO `settings` (type, description) VALUES ('system_currency', '" . $exp[0] . "')");
				$query = $conn->query("INSERT INTO `settings` (type, description) VALUES ('system_currency_symbol', '" . $exp[1] . "')");
			} else {
				$query = $conn->query("INSERT INTO `settings` (type, description) VALUES ('" . $key . "', '" . $value . "')");
			}
		}
	}

	echo json_encode(array('status' => 1, 'msg' => 'Setting Updated Successfully.'));
} else if ($code == "123@384#$$65$" && $type == 'default_logo') {
	$prod_url1 = $prod_url2 = '';
	//code for upload images - START

	if ($_FILES['system_logo']['name']) {
		$Common_Function->img_dimension_arr = $img_dimension_arr;
		$system_logo1 = $Common_Function->file_upload('system_logo', $media_path);
		$system_logo = json_encode($system_logo1);


		$query = $conn->query("SELECT * FROM `settings` WHERE type ='system_logo'");
		if ($query->num_rows > 0) {
			$query = $conn->query("UPDATE  `settings` SET description = '" . $system_logo . "' WHERE type ='system_logo'");
		} else {
			$query = $conn->query("INSERT INTO `settings` (type, description) VALUES ('system_logo', '" . $system_logo . "')");
		}

		$img_decode1 = json_decode($system_logo);
		$prod_url1 = MEDIAURL . $img_decode1->{$img_dimension_arr[0][0] . '-' . $img_dimension_arr[0][1]};
	}

	if ($_FILES['system_loader']['name']) {
		$Common_Function->img_dimension_arr = $img_dimension_arr;
		$system_loader1 = $Common_Function->file_upload('system_loader', $media_path);
		$system_loader = json_encode($system_loader1);


		$query = $conn->query("SELECT * FROM `settings` WHERE type ='system_loader'");
		if ($query->num_rows > 0) {
			$query = $conn->query("UPDATE  `settings` SET description = '" . $system_loader . "' WHERE type ='system_loader'");
		} else {
			$query = $conn->query("INSERT INTO `settings` (type, description) VALUES ('system_loader', '" . $system_loader . "')");
		}

		$img_decode2 = json_decode($system_loader);
		$prod_url2 = MEDIAURL . $img_decode2->{$img_dimension_arr[0][0] . '-' . $img_dimension_arr[0][1]};
	}



	echo json_encode(array('status' => 1, 'msg' => 'Setting Updated Successfully.', 'system_logo' => $prod_url1, 'system_banner' => $prod_url2));
} else if ($code == "123@384#$$65$" && $type == 'sms_services') {
	$active_sms_service = $_POST['active_sms_service'];
	$query = $conn->query("SELECT * FROM `settings` WHERE type ='active_sms_service'");
	if ($query->num_rows > 0) {
		$query = $conn->query("UPDATE  `settings` SET description = '" . $active_sms_service . "' WHERE type ='active_sms_service'");
	} else {
		$query = $conn->query("INSERT INTO `settings` (type, description) VALUES ('active_sms_service', '" . $active_sms_service . "')");
	}

	echo json_encode(array('status' => 1, 'msg' => 'SMS Setting Updated Successfully.'));
} else if ($code == "123@384#$$65$" && $type == 'smtp_settings') {

	$active_sms_service = $_POST['active_sms_service'];
	$query = $conn->query("SELECT * FROM `settings` WHERE type ='active_sms_service'");
	if ($query->num_rows > 0) {
		$query = $conn->query("UPDATE  `settings` SET description = '" . $active_sms_service . "' WHERE type ='active_sms_service'");
	} else {
		$query = $conn->query("INSERT INTO `settings` (type, description) VALUES ('active_sms_service', '" . $active_sms_service . "')");
	}

	unset($_POST['active_sms_service']);
	unset($_POST['code']);
	unset($_POST['type']);
	foreach ($_POST as $key => $value) {
		$query = $conn->query("SELECT * FROM `settings` WHERE type ='" . $key . "'");
		if ($query->num_rows > 0) {
			$query = $conn->query("UPDATE  `settings` SET description = '" . $value . "' WHERE type ='" . $key . "'");
		} else {
			$query = $conn->query("INSERT INTO `settings` (type, description) VALUES ('" . $key . "', '" . $value . "')");
		}
	}
	echo json_encode(array('status' => 1, 'msg' => 'SMTP Setting Updated Successfully.'));
} else {
	echo "Invalid Parameters. Please fill all required fields.";
}
die;
