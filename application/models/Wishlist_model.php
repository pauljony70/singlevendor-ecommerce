<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$date = $this->date_time = date('Y-m-d H:i:s');
	}

	function getcategor($langauge, $securecode)
	{
		$status = 0;
		if ($langauge === "1") {
			$msg = "No Category found";
			$Information = "No Category found";
		} else {
			$msg = "कोई श्रेणी नहीं मिली";
			$Information = "कोई श्रेणी नहीं मिली";
		}
		$jsonarray =  array();
		$count = 0;

		$parent = 0;
		$this->db->select('cat_id, cat_name, cat_img, parent_id');
		$this->db->where(array('parent_id' => $parent));
		$this->db->order_by('cat_order', 'ASC');
		$query2 = $this->db->get('category');

		$cat_array = $query2->result_object();
		foreach ($cat_array as $cat_details) {

			$catid = $cat_details->cat_id;
			$prodcount = 0;

			$this->db->select('count(prod_id) as count');
			$this->db->where(array('cat_id' => $catid));
			$query3 = $this->db->get('productdetails');

			$prod_array = $query3->result_object();
			foreach ($prod_array as $prod_details) {
				$prodcount = $prod_details->count;
			}

			$status = 1;
			$msg = " category details is here";
			$jsonarray[$count] = array(
				'id' => $cat_details->cat_name,
				'name' => $cat_details->cat_id,
				'img_url' => $cat_details->cat_img,
				'parent' => $cat_details->parent_id,
				'prodcount' =>  $prodcount
			);


			$count = $count + 1;
		}
		$Information = $jsonarray;

		$post_data = array(
			'status' => $status,
			'msg' => $msg,
			'Information' => $Information
		);

		//$post_data= json_encode( $post_data );

		return $post_data;
	}

	function getcategory($langauge, $securecode)
	{
		$status = 0;
		if ($langauge === "1") {
			$msg = "No Category found";
			$Information = "No Category found";
		} else {
			$msg = "कोई श्रेणी नहीं मिली";
			$Information = "कोई श्रेणी नहीं मिली";
		}
		$category_result = array();

		$this->db->select('cat.cat_id,cat.cat_name,cat.cat_img,cat.parent_id');

		$this->db->where(array('cat.parent_id' => 0, 'cat.cat_id !=' => 10));
		$this->db->order_by('cat.cat_order', 'ASC');

		//$this->db->limit(8, 0);
		$query = $this->db->get('category cat');

		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			foreach ($category_array as $cat_details) {
				$cat_response = array();
				$cat_response['cat_id'] = $cat_details->cat_id;
				// 1 arabic 2 english

				$cat_response['cat_name'] = $cat_details->cat_name;


				$cat_response['parent_id'] = $cat_details->parent_id;

				$img_decode = $cat_details->cat_img;


				$web_banner = '';


				$cat_response['imgurl'] = $img_decode;

				//get sub category 
				$this->db->select('cat.cat_id,cat.cat_name, cat.cat_img,cat.parent_id');

				$this->db->where(array('cat.parent_id' => $cat_details->cat_id));
				$this->db->order_by('cat.cat_order', 'ASC');

				//$this->db->limit(8, 0);
				$querysubcat = $this->db->get('category cat');
				$cat_response['subcat_1'] = array();
				if ($querysubcat->num_rows() > 0) {
					$category_sub = $querysubcat->result_object();
					foreach ($category_sub as $subcat_details) {
						$scat_response = array();
						$scat_response['cat_id'] = $subcat_details->cat_id;
						// 1 arabic 2 english

						$scat_response['cat_name'] = $subcat_details->cat_name;

						$scat_response['parent_id'] = $subcat_details->parent_id;

						$img_decode = $subcat_details->cat_img;

						$scat_response['imgurl'] = $img_decode;

						//getsub sub category 
						$this->db->select('cat.cat_id,cat.cat_name,cat.cat_img,cat.parent_id');

						$this->db->where(array('cat.parent_id' => $subcat_details->cat_id));
						$this->db->order_by('cat.cat_order', 'ASC');

						//$this->db->limit(8, 0);
						$querysubcat1 = $this->db->get('category cat');
						$scat_response['subsubcat_2'] = array();
						if ($querysubcat1->num_rows() > 0) {
							$category_sub1 = $querysubcat1->result_object();
							foreach ($category_sub1 as $subcat_details1) {
								$scat_response1 = array();
								$scat_response1['cat_id'] = $subcat_details1->cat_id;
								// 1 arabic 2 english

								$scat_response1['cat_name'] = $subcat_details1->cat_name;

								$scat_response1['parent_id'] = $subcat_details1->parent_id;

								$img_decode = $subcat_details1->cat_img;


								$scat_response1['imgurl'] = $img_decode;

								$scat_response['subsubcat_2'][] = $scat_response1;
							}
						}
						$cat_response['subcat_1'][] = $scat_response;
					}
				}

				$category_result[] = $cat_response;
			}
		}
		// echo "<pre>";
		// print_r($category_result);
		// exit;
		$post_data = array(
			'status' => 1,
			'msg' => $msg,
			'Information' => $category_result
		);
		return $post_data;
	}

	function deletewishlistitem($langauge, $securecode, $user_id, $prod_id)
	{
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");

		$status = 0;
		$totalPrice = 0;
		if ($langauge === "1") {
			$msg = "fail to delete product from wishlist";
		} else {
			$msg = "ಇಚ್ಛೆಪಟ್ಟಿಯಿಂದ ಉತ್ಪನ್ನವನ್ನು ಅಳಿಸಲು ವಿಫಲವಾಗಿದೆ";
		}

		$information = array(
			'status' =>  $msg,
			'totalprice' =>   $totalPrice
		);
		$detailsarray =  array();

		$notExist = true;
		$qouteId = 1000;
		$rowUser_id = 0;
		$rowProdJsonArray = array();

		$this->db->select('user_id, prod_id');
		$this->db->where(array('user_id' => $user_id));
		$query2 = $this->db->get('wishlist');

		$order_array = $query2->result_object();
		foreach ($order_array as $order_details) {

			$notExist = false;

			$rowUser_id = $order_details->user_id;
			$rowProdJsonArray = $order_details->prod_id;
		}

		if ($notExist) {
		} else {
			/// yes userid exist

			//echo " hh";		 
			$oldarray = json_decode($rowProdJsonArray, true);

			$prodIDexist = false;
			$i = 0;



			foreach ($oldarray as $arraykey) {
				//  echo "prod id ".$arraykey['prod_id'];

				if ($prod_id === $arraykey['prod_id']) {
					$prodIDexist = true;

					unset($oldarray[$i]);
				}


				$i++;
			}

			if ($prodIDexist) {

				$oldarray =	array_values($oldarray);

				$tempnewarray = 	 json_encode($oldarray);

				$data5['prod_id'] = $tempnewarray;

				$this->db->where('user_id', $user_id);
				$qrysd = $this->db->update('wishlist', $data5);

				if ($qrysd) {
					//echo " row affected is ".;
					$status = 1;
					if ($langauge === "1") {
						$msg = "Successfully Delete product from wishlist";
					} else {
						$msg = "ಬಯಕೆಪಟ್ಟಿಗೆ ಉತ್ಪನ್ನವನ್ನು ಯಶಸ್ವಿಯಾಗಿ ಅಳಿಸಿ";
					}
					$information  = array(
						'status' =>  $msg,
						'totalprice' =>  number_format($totalPrice, 2)
					);
				} else {


					$status = 1;
					if ($langauge === "1") {
						$msg = "fail to delete product from wishlist";
					} else {
						$msg = "ಇಚ್ಛೆಪಟ್ಟಿಯಿಂದ ಉತ್ಪನ್ನವನ್ನು ಅಳಿಸಲು ವಿಫಲವಾಗಿದೆ";
					}
					$information  = array(
						'status' =>  $msg,
						'totalprice' =>  number_format($totalPrice, 2)
					);
				}
			}
		}


		$post_data = array(
			'status' => $status,
			'msg' => $msg,
			'Information' => $information
		);


		//$post_data= json_encode( $post_data );

		return $post_data;
	}

	function add_prod_into_wishlist($langauge, $securecode, $user_id, $prod_id)
	{
		if (!empty($user_id) && isset($prod_id) && !empty($prod_id)) {

			$query = $this->db->get_where('wishlist', array('user_id' => $user_id));
			$wishlist_data = $query->row_array();

			// Decode the existing JSON data if it exists
			$wishlist_items = $wishlist_data ? json_decode($wishlist_data['prod_id'], true) : array();

			// Check if the product already exists in the wishlist
			$existing_key = null;
			foreach ($wishlist_items as $key => $item) {
				if ($item['prod_id'] == $prod_id) {
					$existing_key = $key;
					break;
				}
			}

			if ($existing_key !== null) {
				// If product exists, update the quantity
				unset($wishlist_items[$existing_key]);

				$updated_wishlist_data = json_encode($wishlist_items);

				// Update or insert the data in the database
				if ($wishlist_data) {
					// Update existing record
					$this->db->where('user_id', $user_id);
					$this->db->update('wishlist', array('prod_id' => $updated_wishlist_data));
				} else {
					// Insert new record
					$this->db->insert('wishlist', array('user_id' => $user_id, 'prod_id' => $updated_wishlist_data));
				}

				// Count total unique products and return the status
				$total_products = count($wishlist_items);
				return array('status' => 1, 'msg' => 'Prodcut is removed from wishlist', 'data' => array('total_products' => $total_products, 'wishlist_items' => $wishlist_items));
			} else {
				// If product doesn't exist, add a new item
				$new_item = array(
					'index' => count($wishlist_items),
					'prod_id' => $prod_id,
					'date' => date('Y-m-d'), // Assuming current date for new items
				);

				$wishlist_items[] = $new_item;

				$updated_wishlist_data = json_encode($wishlist_items);

				// Update or insert the data in the database
				if ($wishlist_data) {
					// Update existing record
					$this->db->where('user_id', $user_id);
					$this->db->update('wishlist', array('prod_id' => $updated_wishlist_data));
				} else {
					// Insert new record
					$this->db->insert('wishlist', array('user_id' => $user_id, 'prod_id' => $updated_wishlist_data));
				}

				// Count total unique products and return the status
				$total_products = count($wishlist_items);
				return array('status' => 1, 'msg' => 'Prodcut is added to wishlist', 'data' => array('total_products' => $total_products, 'wishlist_items' => $wishlist_items));
			}
		}

		return array('status' => 0, 'message' => 'Invalid input parameters');
	}

	public function getuserwishlist($langauge, $securecode, $user_id)
	{
		$wishlist_details = $this->db->get_where('wishlist', array('user_id' => $user_id))->row_array();
		$wishlist_result = array();
		$total_wishlist_value = 0;
		if (!empty($wishlist_details)) {

			$wishlist_prod_details = json_decode($wishlist_details['prod_id'], true);

			if (!empty($wishlist_prod_details)) {
				foreach ($wishlist_prod_details as $key => $wishlist_prod_detail) {
					$prodid = $wishlist_prod_detail['prod_id'];

					$this->db->select('pd.prod_id, pd.prod_name, pd.prod_mrp, pd.prod_price, pd.prod_img_url, ct.cat_name, pd.unit, pd.other_attribute, pd.pricearray, pd.stock, prod.status');
					$this->db->join('product prod', 'prod.prod_id = pd.prod_id', 'INNER');
					$this->db->join('category ct', 'ct.cat_id= pd.cat_id', 'INNER');
					$this->db->where(array('pd.prod_id' => $prodid, 'prod.status' => 'active'));
					$query = $this->db->get('productdetails pd');
					$prod_array = $query->row_array();

					if (!empty($prod_array)) {
						$offpercent = ($prod_array['prod_mrp'] - $prod_array['prod_price']) * 100 /  $prod_array['prod_mrp'];
						$prod_array['prod_mrp_value'] = $prod_array['prod_mrp'];
						$prod_array['prod_price_value'] = $prod_array['prod_price'];
						$prod_array['prod_mrp'] = price_format($prod_array['prod_mrp']);
						$prod_array['prod_price'] = price_format($prod_array['prod_price']);
						$prod_array['offpercent'] = number_format($offpercent, 0);
						$prod_array['prod_img_url'] = json_decode($prod_array['prod_img_url']);
						$wishlist_result[] = $prod_array;
					}
				}
			}
		}
		return $wishlist_result;
	}
}
