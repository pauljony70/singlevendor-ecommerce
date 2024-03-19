<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$date = $this->date_time = date('Y-m-d H:i:s');
	}

	public function getorderhistoryOld($langauge, $securecode, $user_id)
	{
		$orderid = "";
		$address = "";
		$price = "";
		$date = "";
		$orderstatus = "";
		$curriername = "";
		$trackid = "";

		$status = 0;
		if ($langauge === "default") {
			$msg = "User Order History is empty.";
		} else {
			$msg = "User Order History is empty.";
		}
		$information = array();

		$count = 0;

		$emptyorderhistory = true;

		$this->db->select('order_id, address_id, total_price, create_date, status, curriername, trackid, prod_details');
		$this->db->where(array('user_id' => $user_id));
		$this->db->order_by('order_id', 'DESC');
		$query2 = $this->db->get('orders');

		$add_array = $query2->result_object();
		foreach ($add_array as $add_details) {

			$timestamp = strtotime($add_details->create_date);
			$new_date = date('d-m-Y', $timestamp);

			$emptyorderhistory = false;
			$orderid  = $add_details->order_id;
			$address  = $add_details->address_id;
			$price  =  number_format($add_details->total_price, 2);
			$date   = $new_date;
			$orderstatus = $add_details->status;
			$curriername = $add_details->curriername;
			$trackid = $add_details->trackid;
			$prod_details = $add_details->prod_details;

			$tempaddress = "";
			$finaladddress = "";

			$this->db->select('addressarray');
			$this->db->where(array('user_id' => $user_id));
			$query2 = $this->db->get('address');

			$order_array = $query2->result_object();
			foreach ($order_array as $order_details) {
				$tempaddress = $order_details->addressarray;
			}

			$oldarray = json_decode($tempaddress, true);

			$prodIDexist = false;

			foreach ($oldarray as $arraykey) {
				if ($arraykey['address_id'] === $address) {
					$finaladddress = $arraykey['address1'] . " " . $arraykey['address2'] . " " . $arraykey['city'] . " " . $arraykey['state'] . " " . $arraykey['pincode'] . "\nPhone- " . $arraykey['phone'];
				}
			}

			// store complete address in address variable
			$address = $finaladddress;

			$information[$count] = array(
				'order_id' => $orderid,
				'shippingaddress' =>   $address,
				'price' =>  $price,
				'date' =>   $date,
				'orderstatus' => $orderstatus,
				'curriername' =>	$curriername,
				'trackid' => 	$trackid,
				'prod_details' => $prod_details,
			);

			// // Get Product Details
			// $prod_detail = json_decode($add_details->prod_details);
			// // echo($add_details->prod_details);
			// $details = array();
			// foreach($prod_detail as $pd_detail)
			// {
			// 	$this->db->select('prod_name, prod_mrp, prod_price, prod_img_url, other_attribute');
			// 	$this->db->where(array('prod_id' => $pd_detail->prod_id));
			// 	$query3 = $this->db->get('productdetails');
			// 	array_push($details, $query3->result_object());
			// }
			// echo($details);

			$count = $count + 1;
		}

		if ($prodIDexist) {
			// user didn't add any product till now
			$status = 1;
			if ($langauge === "1") {
				$msg = "User Order History is empty.";
			} else {
				$msg = "User Order History is empty.";
			}
			$information = array();
		} else {
			$status = 1;
			$msg = "User Order History is details.";
		}


		$post_data = array(
			'status' => $status,
			'msg' => $msg,
			'Information' => $information
		);


		//$post_data= json_encode( $post_data );

		return $post_data;
	}

	function getorderhistorydetailsOld($langauge, $securecode, $user_id, $order_id)
	{
		$orderid = "";
		$address = "";
		$price = "";
		$date = "";
		$orderstatus = "";
		$status = 0;
		if ($langauge === "default") {
			$msg = "Unable to find product.";
		} else {
			$msg = "प्रोडक्ट खोजने में असमर्थ है";
		}
		$information = array();
		$prodJsonarray_new = array();
		$i = 0;
		$subtotal = 0.00;
		$shiparray = array();
		$nettotal = 0.00;
		$cgst = 0.00;
		$sgst = 0.00;
		$igst = 0.00;

		$count = 0;
		$emptyorderhistory = true;

		$this->db->select('sno, prod_details, address_id, total_price, create_date, status');
		$this->db->where(array('user_id' => $user_id, 'order_id' => $order_id));
		$query2 = $this->db->get('orders');

		$add_array = $query2->result_object();
		foreach ($add_array as $add_details) {

			$timestamp = strtotime($add_details->create_date);
			$new_date = date('d-m-Y', $timestamp);

			$emptyorderhistory = false;
			$prod_array  = $add_details->prod_details;
			$address  = $add_details->address_id;
			$date   = $add_details->create_date;
			$orderstatus = $add_details->status;
		}

		$prodJsonarray = json_decode($prod_array, true);

		$prodIDexist = false;
		$countobj = 0;

		foreach ($prodJsonarray as $arraykey) {

			$prod_id = $arraykey['prod_id'];
			$msgoncake = $arraykey['msgoncake'];
			$eggless = $arraykey['eggless'];

			$this->db->select('prod_img, prod_name, qty, prod_price, cgst, sgst, igst, shipping, total, status, status_date, refund_amt, refund_txnno, refund_date, pickup_date, return_status, return_reason');
			$this->db->where(array('order_id' => $order_id, 'prod_id' => $prod_id));
			$query3 = $this->db->get('order_product');

			$ord_array = $query3->result_object();
			foreach ($ord_array as $ord_details) {

				$prodJsonarray[$countobj]['prod_img'] =  $ord_details->prod_img;
				$prodJsonarray[$countobj]['prod_name'] =  $ord_details->prod_name;
				$prodJsonarray[$countobj]['qty'] =  $ord_details->qty;
				$prodJsonarray[$countobj]['total'] =  $ord_details->total;
				$prodJsonarray[$countobj]['prodstatus'] =  $ord_details->status;
				$prodJsonarray[$countobj]['status_date'] = date('d-m-Y', strtotime($ord_details->status_date));
				$prodJsonarray[$countobj]['refundamt'] = $ord_details->refund_amt;
				$prodJsonarray[$countobj]['refundtxnno'] = $ord_details->refund_txnno;
				$prodJsonarray[$countobj]['refunddate'] = date('d-m-Y', strtotime($ord_details->refund_date));
				$prodJsonarray[$countobj]['pickupdate'] = date('d-m-Y', strtotime($ord_details->pickup_date));
				$prodJsonarray[$countobj]['returnstatus'] = $ord_details->return_status;
				$prodJsonarray[$countobj]['returnreason'] = $ord_details->return_reason;
				$prodJsonarray[$countobj]['msgoncake'] =  $msgoncake;
				$prodJsonarray[$countobj]['eggless'] =  $eggless;

				$shiparray[$i] = $ord_details->shipping;
				$subtotal =  $subtotal + ($ord_details->prod_price * $ord_details->qty);
				$cgst = $cgst + (($ord_details->prod_price * $ord_details->qty) * $ord_details->cgst) / 100;
				$sgst = $sgst + (($ord_details->prod_price * $ord_details->qty) * $ord_details->sgst) / 100;
				$igst = $igst + (($ord_details->prod_price * $ord_details->qty) * $ord_details->igst) / 100;

				$i = $i + 1;
			}
			$status = 1;
			$msg = " order product details is here";

			$countobj = $countobj + 1;
		}
		$prodJsonarray_new =  $prodJsonarray;
		$ordertotal = $subtotal  + $cgst + $sgst + $igst  + max($shiparray);

		$post_data = array(
			'status' => $status,
			'msg' => $msg,
			'orderid' => $order_id,
			'orderstatus' => $orderstatus,
			'Information' => $prodJsonarray_new,
			'subtotal' =>   number_format($subtotal, 2),
			'shippingfee' =>     number_format(max($shiparray), 2),
			'discountvalue' => "0",
			'cgst' =>   number_format($cgst,  2),
			'sgst' =>   number_format($sgst,  2),
			'igst' =>   number_format($igst,  2),
			'grandtotal' =>  number_format($ordertotal, 2)
		);



		// $post_data= json_encode( $post_data );

		return $post_data;
	}

	public function getorderdetailsByOrderId($user_id, $order_id)
	{
		$order_details = $this->db->get_where('orders', array('order_id' => $order_id, 'user_id' => $user_id))->row_array();

		$this->db->select('order_product.*');
		$this->db->where(array('order_product.order_id' => $order_id, 'order_product.user_id' => $user_id, 'order_product.qty >' => 0));

		$order_products = $this->db->get('order_product')->result_array();
		return array(
			'order_details' => $order_details,
			'order_products' => $order_products
		);
	}

	public function getOrderDetailsByUserId($user_id)
	{
		$this->db->select('order_product.*, orders.status, customer_name, customer_email, customer_phone, customer_address, customer_city, customer_state, customer_pincode, payment_id, payment_mode');
		$this->db->join('orders', 'orders.order_id = order_product.order_id');
		$this->db->where(array('order_product.user_id' => $user_id, 'order_product.qty >' => 0));
		$this->db->order_by('order_product.id', 'DESC');
		$order_details = $this->db->get('order_product')->result_array();
		return $order_details;
	}

	public function getOrderHistoryDetails($user_id, $order_id, $prod_id)
	{
		$this->db->select('order_product.*, orders.status, customer_name, customer_email, customer_phone, customer_address, customer_city, customer_state, customer_pincode, payment_id, payment_mode');
		$this->db->join('orders', 'orders.order_id = order_product.order_id');
		$this->db->where(array('orders.order_id' => $order_id, 'prod_id' => $prod_id, 'order_product.user_id' => $user_id, 'order_product.qty >' => 0));
		$order_details = $this->db->get('order_product')->row_array();

		$other_products = array();

		if (!empty($order_details)) {
			$this->db->select('order_product.*, orders.status, customer_name, customer_email, customer_phone, customer_address, customer_city, customer_state, customer_pincode, payment_id, payment_mode');
			$this->db->join('orders', 'orders.order_id = order_product.order_id');
			$this->db->where(array('orders.order_id' => $order_id, 'prod_id !=' => $prod_id, 'order_product.user_id' => $user_id, 'order_product.qty >' => 0));
			$other_products = $this->db->get('order_product')->row_array();
		}

		return array(
			'order_details' => $order_details,
			'other_products' => $other_products
		);
	}
}
