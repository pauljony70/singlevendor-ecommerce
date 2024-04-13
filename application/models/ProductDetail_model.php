<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProductDetail_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$date = $this->date_time = date('Y-m-d H:i:s');
	}

	function get_review($langauge, $securecode, $prodid)
	{
		$langauge = 'default';
		$status = 0;
		if ($langauge === "default") {
			$msg = "No Product found";
			$Information = "No Product found";
		} else {
			$msg = "No Product found";
			$Information = "No Product found";
		}
		$jsonarray =  array();
		$review = "";
		$reviewid = "";
		$count = 0;

		$related = array();
		$count = 0;
		$active = "active";

		$this->db->select('pd.prod_id, pd.prod_name, pd.prod_desc, pd.prod_mrp, pd.prod_price, pd.w_price, pd.w_qty, pd.other_attribute,  pd.prod_img_url, bd.brand_name, pd.prod_fulldetail, pd.prod_rating, pd.prod_rating_count, pd.review_id, pd.cat_id, pd.unit, ct.cat_name, pd.pricearray');
		$this->db->join('productdetails pd', 'prod.prod_id = pd.prod_id', 'INNER');
		$this->db->join('brand bd', 'prod.prod_brand_id= bd.brand_id', 'INNER');
		$this->db->join('category ct', 'ct.cat_id= pd.cat_id', 'INNER');
		$this->db->where(array('prod.prod_id' => $prodid, 'prod.status' => $active));


		$this->db->order_by("pd.prod_name", 'ASC');

		$this->db->limit(5);

		$query = $this->db->get('product prod');
		$query_result = $query->result_object();

		foreach ($query_result as $product_data) {
			$offpercent =  ($product_data->prod_mrp - $product_data->prod_price) * 100 /  $product_data->prod_mrp;

			//$status =1;
			//$msg =" Product details are here";
			$related[$count] = array(
				'id' => $product_data->prod_id,
				'name' => $product_data->prod_name,
				'short_desc' => $product_data->prod_desc,
				'mrp' => number_format($product_data->prod_mrp, 2),
				'price' => number_format($product_data->prod_price, 2),
				'offpercent' =>  number_format($offpercent, 0),

				'w_price' => number_format($product_data->w_price, 2),
				'w_qty' => $product_data->w_qty
			);


			$count = $count + 1;


			//	$count = $count+1;				
		}
	}

	function add_review($langauge, $securecode, $username, $prod_id, $user_id, $title, $feedback, $rating)
	{

		$langauge = 'default';
		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");

		$status = 0;
		//	echo "inside if ".$user_id." ".$prod_id;
		/*if($langauge == "default"){
            $msg ="fail to submit review. Please Try Again.";
    	    
        }else{
        	$msg ="रिव्यु सबमिट नहीं हुआ है कृपया पुन: प्रयास करें।";
    	}*/
		$Exist = false;
		$prod_rating = 0;
		$prod_rating_count = 0;
		$prod_reviewid = 0;


		$this->db->select('op.order_id, pd.prod_rating, pd.prod_rating_count, pd.review_id');
		$this->db->join('order_product op', 'op.prod_id = pd.prod_id', 'INNER');
		$this->db->where(array('op.user_id' => $user_id, 'op.prod_id' => $prod_id));

		$query3 = $this->db->get('productdetails pd');
		$query3_result = $query3->result_object();

		//	echo 'ddddd';
		//print_r($this->db->last_query());    
		//	die;

		foreach ($query3_result as $product3_data) {

			$Exist = true;
			$prod_rating = $product3_data->prod_rating;
			$prod_rating_count = $product3_data->prod_rating_count;
			$prod_review_id = $product3_data->review_id;
		}

		if ($Exist) {

			//	echo " prod reviewid ".$prod_review_id;
			/// get last qoute id 

			if ($prod_review_id == 0) {

				$ratingdate = date("d/m/Y");

				$prod_review_array[0] = array(
					'title' => $title,
					'feedback' => $feedback,
					'rating' => $rating,
					'username' => $username,
					'userid' => $user_id,
					'date' => $ratingdate
				);


				$prod_reviewarray = json_encode($prod_review_array);
				//echo " prod_id_array ".	$prod_id_array;
				$review_data['review_array'] = $prod_reviewarray;

				$qry = $this->db->insert('review', $review_data);
				print_r($this->db->last_query());
				echo $this->db->insert_id() . 'ids';
				// die;
				if (!empty($this->db->insert_id())) {

					$status = 1;
					if ($langauge === "default") {
						$msg = "Thank You for Submitting Review.";
					} else {
						$msg = "रिव्यु देने के लिए धन्यवाद";
					}
					$id = $this->db->insert_id();
					//	echo " review id ".$id;
					$newcount = $prod_rating_count + 1;
					$newrating = (($prod_rating * $prod_rating_count) + $rating) / $newcount;

					$data['prod_rating'] = $newrating;
					$data['prod_rating_count'] = $newcount;
					$data['review_id'] = $id;


					$this->db->where('prod_id', $prod_id);
					$qrysd = $this->db->update('productdetails', $data);

					// check whether password already exist on same row or not	   	
					//$rows=$stmt32->affected_rows;


				} else {
					$status = 1;
				}
			} else {
				//	echo "update review ";
				$prod_review_array = "[]";

				$this->db->select('review_array');
				$this->db->where(array('review_id' => $prod_review_id));

				$query4 = $this->db->get('review');
				$query4_result = $query4->result_object();

				foreach ($query4_result as $product4_data) {

					$prod_review_array = $product4_data->review_array;
				}


				$oldArray = json_decode($prod_review_array, true);
				$userIDexist = false;

				foreach ($oldArray as $arraykey) {
					// echo "user id ".$user_id." reivewuser ". $arraykey['userid'];
					if ($user_id === $arraykey['userid']) {
						$userIDexist = true;
					}
				}

				if ($userIDexist) {
					$status = 1;
					if ($langauge === "default") {
						$msg = "You have already submitted the review for this product";
					} else {
						$msg = "आप पहले भी इसी प्रोडक्ट के लिए रिव्यु दे चुके है";
					}
				} else {

					$ratingdate = date("d/m/Y");
					$newreview_array = array(
						'title' => $title,
						'feedback' => $feedback,
						'rating' => $rating,
						'username' => $username,
						'userid' => $user_id,
						'date' => $ratingdate
					);


					array_push($oldArray, $newreview_array);

					//echo " old arrays is ".json_encode( $oldArray);
					$newProdArray = json_encode($oldArray);

					$data0['review_array'] = $newProdArray;

					$this->db->where('review_id', $prod_review_id);
					$qrysd0 = $this->db->update('review', $data0);


					// check whether password already exist on same row or not	   	
					// $rows=$stmt32->affected_rows;
					//echo " row ".$rows;
					if ($qrysd0) {
						//echo " row affected is ";
						$status = 1;
						if ($langauge === "default") {
							$msg = "Thank You for Submitting Review.";
						} else {
							$msg = " रिव्यु देने के लिए सुक्रिया";
						}
					} else {

						$status = 1;
						if ($langauge === "default") {
							$msg = "Failed to submit review. Please try again";
						} else {
							$msg = "रिव्यु सबमिट नहीं हुआ है कृपया पुन: प्रयास करें।";
						}
					}
				}
			}
		} else {
			//echo "id exist ".$rowUserId." qoute id ".$rowQouteId. " products  ".	$prod_id_array;
			$status = 1;
			if ($langauge === "default") {
				$msg = "You can't submit the review. Please buy the product then you can submit review";
			} else {
				$msg = "कृपया प्रोडक्ट को खरीदने के बाद रिव्यु सबमिट करे";
			}
		}



		$post_data = array(
			'status' => $status,
			'msg' => $msg
		);


		// $post_data= json_encode( $post_data );

		return $post_data;

		// mysqli_close($conn);
	}

	function get_product_attributes_details($prod_id)
	{
		$this->db->select("pa.attr_value, pa.prod_attr_id, pas.attribute");
		$this->db->join('product_attributes_set pas', 'pas.id = pa.prod_attr_id', 'INNER');
		$this->db->where(array('prod_id' => $prod_id));

		$attribute = $attribute_array = array();
		$query = $this->db->get('product_attribute pa');

		if ($query->num_rows() > 0) {
			$attr_result = $query->result_array();
			foreach ($attr_result as $attr) {
				$val_decode = json_decode($attr['attr_value']);
				$new_attr = array();
				foreach ($val_decode as $key => $val) {
					$new_attr[]['itemvalue'] = $val;
				}

				$attribute['attr_id'] = $attr['prod_attr_id'];
				$attribute['attr_name'] = $attr['attribute'];
				$attribute['item'] = $new_attr;
				$attribute_array[] = $attribute;
			}
		}
		return $attribute_array;
	}

	function get_product_details($langauge, $securecode, $prodid)
	{
		$this->load->model('category_model');
		$status = 0;
		if ($langauge === "default") {
			$msg = "No Product found";
			$Information = "No Product found";
		} else {
			$msg = "No Product found";
			$Information = "No Product found";
		}
		$jsonarray = array();
		$review = "";
		$reviewid = "";
		$count = 0;


		$catid = "";
		$active = "active";
		$this->db->select('pd.prod_id, pd.prod_name, pd.name_ar, pd.prod_desc, pd.prod_mrp, pd.prod_price, pd.w_price, pd.w_qty, pd.other_attribute, pd.prod_img_url, bd.brand_name, pd.prod_fulldetail, pd.prod_rating, pd.prod_rating_count, pd.review_id, pd.cat_id, pd.unit, ct.cat_name, pd.pricearray, pd.stock, pd.prod_remark');
		$this->db->join('product prod', 'prod.prod_id = pd.prod_id', 'INNER');
		$this->db->join('brand bd', 'prod.prod_brand_id= bd.brand_id', 'INNER');
		$this->db->join('category ct', 'ct.cat_id= pd.cat_id', 'INNER');
		$this->db->where(array('prod.prod_id' => $prodid, 'prod.status' => $active));

		$query = $this->db->get('productdetails pd');


		if ($query->num_rows() > 0) {
			$query_result = $query->row_array();

			$catid = $query_result['cat_id'];
			$reviewid = $query_result['review_id'];
			$offpercent =  number_format(($query_result['prod_mrp'] - $query_result['prod_price']) / $query_result['prod_mrp'] * 100, 2);

			$status = 1;
			$msg = " Product details are here";
			$jsonarray = array(
				'id' => $query_result['prod_id'],
				'name' => $query_result['prod_name'],
				'short_desc' => $query_result['prod_desc'],
				'fulldetail' => $query_result['prod_fulldetail'],
				'offpercent' =>  $offpercent,
				'mrp' => $query_result['prod_mrp'],
				'price' => $query_result['prod_price'],
				'w_price' => number_format($query_result['w_price'], 0),
				'w_qty' => $query_result['w_qty'],
				'attr' => $query_result['other_attribute'],
				'img_url' => $query_result['prod_img_url'],
				'brand' => $query_result['brand_name'],
				'prod_rating' => $query_result['prod_rating'],
				'prod_rating_count' => $query_result['prod_rating_count'],
				'prod_review_id' => $query_result['review_id'],
				'unit' => $query_result['unit'],
				'cat_name' => $query_result['cat_name'],
				'pricearray' => $query_result['pricearray'],
				'stock' => $query_result['stock'],
				'remark' => $query_result['prod_remark'],
				'configure_attr' => $this->get_product_attributes_details($query_result['prod_id']),
				'category_tree' => $this->category_model->getCategoryTree($catid)
			);
		}

		$Information = $jsonarray;

		//  get related product
		$related = array();
		$count = 0;
		$active = "active";
		$this->db->select('pd.prod_id, pd.prod_name, pd.name_ar, pd.prod_desc, pd.prod_mrp, pd.prod_price, pd.w_price, pd.w_qty, pd.other_attribute,  pd.prod_img_url, bd.brand_name, pd.prod_rating, pd.pricearray');
		$this->db->join('product prod', 'prod.prod_id = pd.prod_id', 'INNER');
		$this->db->join('brand bd', 'prod.prod_brand_id= bd.brand_id', 'INNER');
		$this->db->where(array('prod.prod_cat_id' => $catid, 'prod.prod_id !=' => $prodid, 'prod.status' => $active));

		$query2 = $this->db->get('productdetails pd');

		if ($query2->num_rows() > 0) {
			$query2_result = $query2->result_object();
			//print_r($query_result);
			foreach ($query2_result as $product2_data) {

				$offpercent =  number_format(($product2_data->prod_mrp - $product2_data->prod_price) / $product2_data->prod_mrp * 100, 2);

				$related[] = array(
					'id' => $product2_data->prod_id,
					'name' => str_replace('"', '', $product2_data->prod_name),
					'short_desc' => $product2_data->prod_desc,
					'mrp' => $product2_data->prod_mrp,
					'price' => $product2_data->prod_price,
					'offpercent' =>  number_format($offpercent, 0),

					'w_price' => number_format($product2_data->w_price, 0),
					'w_qty' => $product2_data->w_qty,
					'attr' => $product2_data->other_attribute,
					'img_url' => json_decode($product2_data->prod_img_url),
					'brand' => $product2_data->brand_name,
					'rating' => $product2_data->prod_rating,
					'pricearray' => $product2_data->pricearray
				);
			}
		}

		$this->db->select('review_array');
		$this->db->where(array('review_id' => $reviewid));

		$query3 = $this->db->get('review');
		$query3_result = $query3->result_object();

		foreach ($query3_result as $product3_data) {

			$review = $product3_data->review_array;
		}

		//mysqli_close($conn);

		$post_data = array(
			'status' => $status,
			'msg' => $msg,
			'Information' => $Information,
			'related' => $related,
			'review' => $review
		);

		return $post_data;
	}

	function get_product_price_request($prodid, $config_attr)
	{
		$config_attr_decode =  json_decode($config_attr);

		$this->db->select("pav.price, pav.mrp, pav.stock, pav.conf_image");
		$this->db->where(array('pav.product_id' => $prodid));

		foreach ($config_attr_decode as $config_attribute) {
			$this->db->like('prod_attr_value', ':"' . $config_attribute->attr_value . '"');
		}

		$query = $this->db->get('product_attribute_value pav');

		$attribute = array();
		if ($query->num_rows() > 0) {
			$attr_results = $query->result_object();
			$attr_result = $attr_results[0];

			$attribute['product_mrp'] = price_format($attr_result->mrp);
			$attribute['product_price'] = price_format($attr_result->price);
			$attribute['product_stock'] = $attr_result->stock;
			if ($attr_result->stock == 0) {
				$attribute['stock_status'] = "Out of Stock";
			} else {
				$attribute['stock_status'] = "In Stock";
			}

			$attribute['imgurl'] = $attr_result->conf_image;

			$discount_per = 0;
			$discount_price = 0;
			if ($attr_result->price != $attr_result->mrp) {
				$discount_price = ($attr_result->mrp - $attr_result->price);
				$discount_per = ($discount_price / $attr_result->mrp) * 100;
			}
			$attribute['totaloff'] = price_format($discount_price);
			$attribute['offpercent'] = number_format($discount_per, 2);
		}
		return $attribute;
	}

	public function getProductData($prod_id)
	{
		return $this->db->get_where('product', array('prod_id' => $prod_id))->row_array();
	}

	public function getNewArrivals()
	{
		$products =  $this->db->select('productdetails.*')
			->join('product', 'product.prod_id = productdetails.prod_id')
			->join('category', 'category.cat_id = product.prod_cat_id')
			->join('brand', 'brand.brand_id = product.prod_brand_id')
			->order_by('product.prod_id', 'desc')
			->limit(8)
			->get('productdetails')
			->result_array();
		foreach ($products as &$product) {
			$product['offpercent'] =  number_format(($product['prod_mrp'] - $product['prod_price']) / $product['prod_mrp'] * 100, 2);
			$product['prod_mrp'] = price_format($product['prod_mrp']);
			$product['prod_price'] = price_format($product['prod_price']);
		}

		return $products;
	}
}
