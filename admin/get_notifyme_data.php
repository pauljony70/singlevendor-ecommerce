<?php
include('session.php');
$code =  $_POST['code'];
$page = $_POST['page'];
$rowno = $_POST['rowno'];
$error = '';  // Variable To Store Error Message

$code =    stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);

//echo "admin is ";
if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
	// echo " dashboard redirect to index";
} else
if ($code == "1") {

	$seller_id =  $_SESSION['seller_id'];
	//Calculating start for every given page number

	include('../app/db_connection.php');
	global $conn;
	try {

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		//  echo "sfsadf";
		$status = 0;
		$information = array();
		$i = 0;
		$Exist = false;
		$limit = 10;
		$start = ($page - 1) * $limit;
		$totalrow = 0;
		$stmt12 = $conn->prepare("SELECT count(sno) FROM notifyme");
		$stmt12->execute();
		$stmt12->store_result();
		$stmt12->bind_result($col15);

		while ($stmt12->fetch()) {
			$totalrow = $col15;
		}

		if ($page == 99999) {
			$start =   $totalrow - ($totalrow % $limit);
			$page = (int)(($totalrow / $limit) + 1);

			if ($start == $totalrow) {
				$start = $start - $limit;
				$page = (int)((($totalrow - $limit) / $limit) + 1);
			}
			// echo " stat ".$start." limi ".$limit;
		}
		//  echo "start " . $start. " page ".$page." totalrow ". $totalrow;
		$stmt11 = $conn->prepare("SELECT sno, prodid,  phone, email, createby, remark FROM notifyme ORDER BY sno DESC LIMIT ?, ?");
		$stmt11->bind_param("ii", $start, $limit);

		$stmt11->execute();
		$stmt11->store_result();
		$stmt11->bind_result($col1, $col2, $col4, $col5, $col7, $col8);

		while ($stmt11->fetch()) {
			// echo " order id ".$col1;
			$Exist = true;
			$prodid = $col2;
			$prodname = "";
			$imageurl = "";
			$stmt12 = $conn->prepare("SELECT prod_name, prod_img_url FROM productdetails WHERE prod_id=?");
			$stmt12->bind_param("i", $prodid);
			$stmt12->execute();
			$stmt12->store_result();
			$stmt12->bind_result($col11, $col12);

			while ($stmt12->fetch()) {
				$prodname = $col11;
				$imgarray = json_decode($col12, true);
				$count    = 1;
				foreach ($imgarray as $arraykey) {
					if ($count === 1) {
						$imageurl = "../media/" . $arraykey['url'];
						$count++;
					}
				}
			}

			$return[$i] =
				array(
					'sno' => $col1,
					'phone' => $col4,
					'email' => $col5,
					'createby' =>  date('d-m-Y h:i A', strtotime($col7)),
					'prodname' => $prodname,
					'prodimg' => $imageurl,
					'remark' => $col8
				);
			$i = $i + 1;
		}
		if ($Exist) {

			$status = 1;
			$information = array(
				'status' => $status,
				'totalrow' => $totalrow,
				'pageno' => $page,
				'details' => $return
			);
		} else {

			// echo " No Order in seller account ";
			$status = 0;
			$information = array(
				'status' => $status,
				'totalrow' => $totalrow,
				'pageno' => $page,
				'details' => $return
			);
		}

		echo  json_encode($information);

		//----------



		//return json_encode($return);    
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
}
