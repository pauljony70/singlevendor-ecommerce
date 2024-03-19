<?php

$hash  = 0 ;// if valid input
 $action = 'https://pay.afrahalkhaleej.com/pos/crt/'; 
$post_data['amount'] =  $_REQUEST['amount'];  // "15";// 
$post_data['order_no'] =  $_REQUEST['order_no'];  //"55588"; //
$post_data['currency_code'] =  "KWD"; // $_REQUEST['currency_code'];
$post_data['gateway_code'] =  "knet"; //"kpayt"; //$_REQUEST['gateway_code'];
$post_data['customer_email'] = $_REQUEST['customer_email'];  // "kamal.bunkar07@gmail.com"; //
$post_data['disclosure_url'] = "http://app.afrahalkhaleej.com/app/payment/knet_disclosure_url.php";
$post_data['redirect_url'] = "http://app.afrahalkhaleej.com/app/payment/success.php";

//traverse array and prepare data for posting (key1=value1)
foreach ( $post_data as $key => $value) {
    $post_items[] = $key . '=' . $value;
}

//create the final string to be posted using implode()
$post_string = implode ('&', $post_items );

//create cURL connection
$curl_connection =  curl_init('https://pay.afrahalkhaleej.com/pos/crt/');

//set options
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT, 
  "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

//set data to be posted
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

//perform our request
$result = curl_exec($curl_connection);

//echo " response ".$result;
$oldarray = json_decode( $result, true) ;
echo  " hit url ".$oldarray['url']." ---";
$payment_url = $oldarray['url'];

//show information regarding the request
//print_r(curl_getinfo($curl_connection));
//echo curl_errno($curl_connection) . '-' .   curl_error($curl_connection);

header("Location: ".$payment_url);

//close the connection
//curl_close($curl_connection);

?>