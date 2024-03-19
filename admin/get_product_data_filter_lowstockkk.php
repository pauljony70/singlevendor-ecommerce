<?php

include('session.php');
include('common_functions.php');

$code  = $_POST['code'];
$page  = $_POST['page'];
$sortcat = $_POST['sortcat'];
$catid = $_POST['catid'];
$applysize =  $_POST['size'];
$applycolor = $_POST['color'];
$lowstock = $_POST['lowstock'];
$error = ''; // Variable To Store Error Message

$code =  stripslashes($code);
$page =  stripslashes($page);
$sortcat =  stripslashes($sortcat);
$catid =  stripslashes($catid);
$applysize =  stripslashes($applysize);
$applycolor =  stripslashes($applycolor);
$lowstock =  stripslashes($lowstock);

//echo " value ".$page."---".;
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
  // echo " dashboard redirect to index";
} else if ($code == "123") {

  $seller_id = $_SESSION['seller_id'];
  //Calculating start for every given page number

  // include('../app/db_connection.php');
  global $conn;
  try {

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $jsonarray =  array();
    $filtersize = array();
    $filtercolor = array();
    $filterbrand = array();
    $bothfilter = 0;

    // if ($applysize !== "blank" && $applycolor !== "blank") {
    //   $bothfilter = 1;
    // }

    $count = 0;
    $count_c = 0;

    // $applybrand = explode(',', $applybrand);
    $applysize  = explode(',', $applysize);
    $applycolor = explode(',', $applycolor);

    $Exist = false;
    $status = 0;
    $information = array();
    $limit = 100;
    $start = ($page - 1) * $limit;
    $totalrow = 0;

    if ($catid !== "blank") {
      $stmt12 = $conn->prepare("SELECT count(prod_id) FROM product pd WHERE prod_cat_id=?");
      $stmt12->bind_param("i", $catid);
    } else {
      $stmt12 = $conn->prepare("SELECT count(prod_id) FROM product");
    }

    $stmt12->execute();
    $stmt12->store_result();
    $stmt12->bind_result($col5);

    while ($stmt12->fetch()) {
      $totalrow = $col5;
    }

    $return = array();
    $i = 0;
    $i_i = 0;
    $filterrowcount = false;

    if ($sortcat === "true") {
      $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_mrp, pt.prod_price, pt.w_price, pt.w_qty, pt.other_attribute,  pt.prod_img_url, ct.cat_name, pt.pricearray, pt.stock,  pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id ORDER BY ct.cat_name ASC");
    } else if ($catid !== "blank") {
      $filterrowcount = true;
      $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_mrp, pt.prod_price, pt.w_price, pt.w_qty, pt.other_attribute,  pt.prod_img_url, ct.cat_name, pt.pricearray, pt.stock, pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id AND pt.cat_id=? ORDER BY ct.cat_name ASC");
      $stmt->bind_param("i", $catid);
    } else {
      $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.prod_desc, pt.prod_mrp, pt.prod_price, pt.w_price, pt.w_qty, pt.other_attribute,  pt.prod_img_url, ct.cat_name, pt.pricearray, pt.stock, pr.status, pt.hsn_code FROM product pr, productdetails pt, category ct WHERE pt.prod_id = pr.prod_id AND pt.cat_id= ct.cat_id ORDER BY pt.prod_name ASC");
    }

    $stmt->execute();
    $data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14);

    while ($stmt->fetch()) {
      $Exist = true;
      $imgarray = json_decode($col9, true) ?? array();
      $imageurl = "";
      $imgcount    = 1;
      foreach ($imgarray as $arraykey) {
        if ($imgcount === 1) {
          $imageurl = MEDIA_URL . $arraykey;
          $imgcount++;
        }
      }

      //echo " array created".json_encode($return);
      $price = $col5;
      $prodsize = "";
      $prodcolor = "";
      $stock = $col12;
      if ($stock <= 0) {
        $stock = "Low";
      }
      $filterprod = 0;
      $sizeexist =  0;
      $colorexist = 0;
      // filter option size
      $attrobj = json_decode($col8, true);

      $tempsizeArray = explode(',', $attrobj['size']);
      $firstsizearray = 0;
      foreach ($tempsizeArray as $arraykey) {
        if ($firstsizearray == 0) {
          $prodsize = $arraykey;
        }
        if (!in_array($arraykey, $filtersize) && $arraykey != "" && $arraykey !== "") {

          array_push($filtersize, $arraykey);
        }

        // if size is in applysize filter 
        if (in_array($arraykey, $applysize) && $arraykey != "" && $arraykey !== "") {

          $filterprod = 1;
          $sizeexist =  1;
          $prodsize = $arraykey;
        }


        $firstsizearray++;
      }

      // filter option color
      $attrobj = json_decode($col8, true);
      $tempcolorArray = explode(',', $attrobj['color']);
      $firstcolor = 0;
      foreach ($tempcolorArray as $arraykeycc) {
        if ($firstcolor == 0) {
          $prodcolor = $arraykeycc;
        }

        if (!in_array($arraykeycc, $filtercolor) && $arraykeycc != "" && $arraykeycc !== "") {

          array_push($filtercolor, $arraykeycc);
        }
        // if color is in applycolor filter 
        if (in_array($arraykeycc, $applycolor) && $arraykeycc != "" && $arraykeycc !== "") {

          $filterprod = 1;
          $colorexist = 1;
          $prodcolor = $arraykeycc;
        }
        $firstcolor++;
      }

      // filter multiprice array with size
      $multipricearray = json_decode($col11, true);

      $firstprice = 0;
      if (!empty($multipricearray)) {
        foreach ($multipricearray as $arraykey) {
          //  echo " attrname-- ".$arraykey['attrnam']."--";
          if ($firstprice == 0) {
            $price =  $arraykey['attrvalue'];
            $prodsize = $arraykey['attrnam'];
            $stock = $arraykey['attrstockvalue'];
          }
          if (!in_array($arraykey['attrnam'], $filtersize) && $arraykey['attrnam'] !== "" && $arraykey['attrnam'] != "") {
            array_push($filtersize, $arraykey['attrnam']);
          }

          // if size if in applysize filter 
          if (in_array($arraykey['attrnam'], $applysize) && $arraykey['attrnam'] != "" && $arraykey['attrnam'] !== "") {

            $filterprod = 1;
            $sizeexist =  1;
            $price =  $arraykey['attrvalue'];
            $prodsize = $arraykey['attrnam'];
          }
          if ($arraykey['attrstockvalue'] <= 0) {
            $stock = "Low";
          }

          $firstprice++;
        }
      }

      // product details array
      if ($lowstock === "true") {

        if ($stock == "Low") {

          if ($i >= $start) {

            $return[$i_i] = array(
              'id' => $col1,
              'name' => $col2,
              'desc' => $col3,
              'price' => $price,
              'color' => $prodcolor,
              'size' => $prodsize,
              'img' => $imageurl,
              'cat' => $col10,
              'stock' => $stock,
              'active' => $col13,
              'hsncode' => $col14
            );
            $i_i = $i_i + 1;
          }
        }
      } else {
        // echo "elese";
        if ($i >= $start && $i < ($start + $limit)) {

          $return[$i_i] = array(
            'id' => $col1,
            'name' => $col2,
            'desc' => $col3,
            'price' => $price,
            'color' => $prodcolor,
            'size' => $prodsize,
            'img' => $imageurl,
            'cat' => $col10,
            'stock' => $stock,
            'active' => $col13,
            'hsncode' => $col14
          );
          $i_i = $i_i + 1;
        }
      }

      $i  = $i + 1;
      // product details array close

      if ($filterprod == 1) {

        if ($bothfilter == 1) {

          if ($sizeexist == 1 && $colorexist == 1) {

            if ($count >= $start && $count < ($start + $limit)) {

              $jsonarray[$count_c] = array(
                'id' => $col1,
                'name' => $col2,
                'desc' => $col3,
                'price' => $price,
                'color' => $prodcolor,
                'size' => $prodsize,
                'img' => $imageurl,
                'stock' => $stock,
                'cat' => $col10,
                'active' => $col13,
                'hsncode' => $col14,
                'attr' => $col8,
                'pricearray' => $col11
              );
              $count_c = $count_c + 1;
            } // if count 
            $count = $count + 1;
            $totalrow = $count;
          } else {
            //   echo "both not true";
          }
        } else {
          if ($count >= $start && $count < ($start + $limit)) {

            // echo "both not blank";
            $jsonarray[$count_c] = array(
              'id' => $col1,
              'name' => $col2,
              'desc' => $col3,
              'price' => $price,
              'color' => $prodcolor,
              'size' => $prodsize,
              'img' => $imageurl,
              'stock' => $stock,
              'cat' => $col10,
              'active' => $col13,
              'hsncode' => $col14,
              'attr' => $col8,
              'pricearray' => $col11
            );
            $count_c = $count_c + 1;
          }
          $count = $count + 1;
          $totalrow = $count;
        } // if else bothfilter 


      } // if filterprod ==1		

    }

    if ($Exist) {
      $page_html =  pagination('getProducts', $page, $limit, $totalrow);
      $status = 1;
      $information = array(
        'status' => $status,
        'totalrow' => $totalrow,
        'pageno' =>  $page,
        'page_html' =>  $page_html,
        'details' => $return,
        'filterarray' => $jsonarray,
        'bothfilter' => $bothfilter
      );
    } else {


      $status = 0;
      $information = array(
        'status' => $status,
        'totalrow' => $totalrow,
        'pageno' =>  $page,
        'details' => $return,
        'filterarray' => $jsonarray,
        'bothfilter' => $bothfilter
      );
    }

    echo  json_encode($information);
    //return json_encode($return);    
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
