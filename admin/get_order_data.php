<?php
include('session.php');
$code =  $_POST['code'];
$page = $_POST['page'];
$rowno = $_POST['rowno'];
$sortdate = $_POST['sortdate'];
$sortstatus = $_POST['sortstatus'];
$error = '';  // Variable To Store Error Message

$code =    stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);
$sortdate =  stripslashes($sortdate);
$sortstatus =  stripslashes($sortstatus);

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
      $stmt12 = $conn->prepare("SELECT count(sno) FROM orders");
      $stmt12->execute();
      $stmt12->store_result();
      $stmt12->bind_result($col5);

      while ($stmt12->fetch()) {
         $totalrow = $col5;
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
      $stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.create_date, up.full_name  FROM orders odr, user_profile up WHERE odr.user_id = up.user_id ORDER BY odr.sno DESC LIMIT ?, ?");

      if ($sortdate === "true" && $sortstatus === "true") {
         $stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.create_date, up.full_name  FROM orders odr, user_profile up WHERE odr.user_id = up.user_id ORDER BY odr.create_date DESC, odr.status DESC LIMIT ?, ?");
         //	echo " both true ";
      } else if ($sortdate === "false" && $sortstatus === "true") {
         $stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.create_date, up.full_name  FROM orders odr, user_profile up WHERE odr.user_id = up.user_id ORDER BY odr.status DESC LIMIT ?, ?");
         //  echo " status true ";
      } else if ($sortdate === "true" && $sortstatus === "false") {
         $stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.create_date, up.full_name  FROM orders odr, user_profile up WHERE odr.user_id = up.user_id ORDER BY odr.create_date DESC LIMIT ?, ?");
         //  echo " date true ";
      } else if ($sortdate === "false" && $sortstatus === "false") {
         $stmt11 = $conn->prepare("SELECT odr.sno, odr.order_id, odr.status, odr.create_date, up.full_name  FROM orders odr, user_profile up WHERE odr.user_id = up.user_id ORDER BY odr.sno DESC LIMIT ?, ?");
         // echo " both false ";
      }

      $stmt11->bind_param("ii", $start, $limit);

      $stmt11->execute();
      $stmt11->store_result();
      $stmt11->bind_result($col00, $col1, $col2, $col3, $col4);

      while ($stmt11->fetch()) {
         // echo " order id ".$col1;
         $Exist = true;

         $return[$i] =
            array(
               'sno' => $col00,
               'orderid' => $col1,
               'orderstatus' => $col2,
               'orderdate' =>  date('d-m-Y h:i A', strtotime($col3)),
               'name' => $col4
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
